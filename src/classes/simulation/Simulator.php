<?php
namespace JScarton\classes\simulation;

//declare available events
use JScarton\classes\events\CustomerArrives;
use JScarton\classes\events\CustomerChangeOfShelve;
use JScarton\classes\events\CustomerPayAndLeave;
use JScarton\classes\events\CustomerPickSomeFruits;
use JScarton\classes\events\EmployeeComesToShelve;
use JScarton\classes\events\EmployeeAddSomeFruits;
use JScarton\classes\events\PrintReport;
use JScarton\classes\fruits\Apple;
use JScarton\classes\persons\Customer;
use JScarton\classes\persons\Employee;

class Simulator
{	
	//store shelves
	private $shelves;
	//capacity of every shelve
	private $max_shelve_capacity;
	//max persons
	private $max_persons;
	//current number of persons in store
	private $current_persons;
	//possible events 
	private $possibleEvents=['CustomerArrives','CustomerPicksSomeApples','CustomerChangeOfShelve','CustomerPayAndLeave','EmployeeComesToShelve'];
	//event queue
	private $eventQueue;	
	// max cashiers
	private $max_cashiers;
	// min cashiers
	private $min_cashiers;	
	//time of start
	private $time_start;
	//time of end
	private $time_end;
	// time in minutes to check and trigger events
	private $tick_value;
	// current time
	private $current_time;
	// max number of events per tick
	private $max_events_per_tick;
	// print a report every X minutes
	private $report_tick;

	private $attended_persons=0;

	private $total_sales=0;
	private $sold_apples=0;

	public function __construct($MAX_PERSONS,$NUMBER_OF_SHELVES,$MAX_CAPACITY_OF_SHELVES,$MAX_CASHIERS,$MIN_CASHIERS,$TIME_START,$TIME_END,$TICK_VALUE,$MAX_EVENTS_PER_TICK,$REPORT_TICK)
	{
		$this->max_persons=$MAX_PERSONS;
      	$this->current_persons=0;
      	$this->current_time=$TIME_START*60;
      	$this->max_shelve_capacity=$MAX_CAPACITY_OF_SHELVES;
      	$this->shelves=Shelve::getStoreShelves(intval($NUMBER_OF_SHELVES),intval($MAX_CAPACITY_OF_SHELVES));
      	$this->max_cashiers=$MAX_CASHIERS;
      	$this->min_cashiers=$MIN_CASHIERS;      	
      	$this->time_start=$TIME_START*60;
      	$this->time_end=$TIME_END*60;
      	$this->tick_value=$TICK_VALUE;
      	$this->max_events_per_tick=$MAX_EVENTS_PER_TICK;
      	$this->report_tick=$REPORT_TICK;
      	$this->eventQueue=[];
	}

    public function run(){     	
     	//fill the shelves
     	foreach ($this->shelves as $shelve) {
     		while ($shelve->addFruit(new Apple())){};     		
     	}
     	//fill event queues
     	$this->eventQueue[$this->current_time][]=['time'=>$this->current_time,'event'=>'PrintReport'];
     	while ($this->current_time<=$this->time_end)
     	{
     		$number_of_events=rand(0,$this->max_events_per_tick);
     		while ($number_of_events>0)
     		{
     			$this->eventQueue[$this->current_time][]=['time'=>$this->current_time,'event'=>$this->possibleEvents[rand(0,count($this->possibleEvents)-1)]];
     			$number_of_events--;
     		}     		
     		if ($this->current_time%$this->report_tick==0 && $this->current_time>$this->time_start)
     			$this->eventQueue[$this->current_time][]=['time'=>$this->current_time,'event'=>'PrintReport'];
     		$this->current_time+=$this->tick_value;
     	}
     	//now process all events
     	foreach ($this->eventQueue as $time => $events) {
     			foreach ($events as $event) {
                    $classname="JScarton\\classes\\events\\".$event['event'];
     				$eventHandler= new $classname;
     				if ($eventHandler->maybeFire())
     				{
     					switch($event['event'])
     					{
     						case 'CustomerArrives':             if ($this->current_persons<$this->max_persons-1){
     															$shelve=$eventHandler->execute(['number_of_shelves'=>count($this->shelves)]);
                                                                $customer=new \JScarton\classes\persons\Customer($shelve);
     															$this->shelves[$shelve]->addPerson($customer);
                                                                $this->current_persons++;
     														}
     														break;
     						case 'CustomerChangeOfShelve': 	list($fromShelve,$toShelve)=$eventHandler->execute(['number_of_shelves'=>count($this->shelves)]);
     														if ($this->shelves[$fromShelve]->getPersonsCount()>0 && $this->shelves[$fromShelve]->getCurrentPerson()->getType()=='Customer'){
     															$this->shelves[$fromShelve]->getCurrentPerson()->move($toShelve);
     															$this->shelves[$toShelve]->addPerson($this->shelves[$fromShelve]->getCurrentPerson());
     															$this->shelves[$fromShelve]->removePerson();
     														}     														
     														break;
     						case 'CustomerPayAndLeave': 	list($availableCashiers,$fromShelve)=$eventHandler->execute(['number_of_shelves'=>count($this->shelves),'min_cashiers'=>$this->min_cashiers,'max_cashiers'=>$this->max_cashiers]);
     														if ($this->shelves[$fromShelve]->getPersonsCount()>0 && $this->shelves[$fromShelve]->getCurrentPerson()->getType()=='Customer'){
     															list($number_sold,$total_sold)=$this->shelves[$fromShelve]->getCurrentPerson()->leave();
     															$this->sold_apples+=$number_sold;
     															$this->total_sales+=$total_sold;
     															$this->shelves[$fromShelve]->removePerson();
     															$this->current_persons--;
     														}
     														break;
     						case 'CustomerPicksSomeApples': 	list($apples,$shelve)=$eventHandler->execute(['number_of_shelves'=>count($this->shelves)]);
     														    if ($this->shelves[$shelve]->getPersonsCount()>0 && $this->shelves[$shelve]->getCurrentPerson()->getType()=='Customer'){
                                                                    echo "Picking some apples\n";
                                                                    for($i=0;$i<$apples;$i++)
                                                                        if ($this->shelves[$shelve]->getFruitsCount()>0)
     															            $this->shelves[$shelve]->getCurrentPerson()->pick($this->shelves[$shelve]->pickAFruit());
     														     }
     														break;
     						case 'EmployeeComesToShelve':	if ($this->current_persons<$this->max_persons-1){
                                                                $shelve=$eventHandler->execute(['number_of_shelves'=>count($this->shelves)]);
                                                                $emp=new \JScarton\classes\persons\Employee($shelve);
     														     $this->shelves[$shelve]->addPerson($emp);
                                                                 $this->current_persons++;
                                                                }
     														break;
     						case 'EmployeeAddSomeFruits':	$fruitsToAdd=$eventHandler->execute(['shelve_capacity'=>$this->max_shelve_capacity]);	
     														foreach ($this->shelves as $shelve) {
     															if ($shelve->getPersonCount()>0 && $shelve->getCurrentPerson()->getType()=='Employee')
     															{
     																$i=0;
     																while ($i<$fruitsToAdd && $shelve->addFruit(new Apple())){
     																	$shelve->getCurrentPerson()->add();
     																	$i++;
     																}
                                                                    $shelve->removePerson();
                                                                    $this->current_persons--;
     															}
     														}
     														break;     														
     						case 'PrintReport':				$report_data=[
     															'current_persons'=>$this->current_persons,
     															'max_persons'=>$this->max_persons,
     															'number_of_shelves'=>count($this->shelves),
     															'shelves'=>$this->shelves,
     															'sold_apples'=>$this->sold_apples,
     															'total_sales'=>$this->total_sales,
     															'current_time'=>$event['time']
     														];
     														$eventHandler->execute($report_data);                                                           
     														break;
     					}
     				}
     			}
     		}
    }

}