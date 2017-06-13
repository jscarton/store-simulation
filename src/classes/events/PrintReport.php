<?php
namespace JScarton\classes\events;


class PrintReport extends Event
{	
	private $id;
	protected $type;
	private $probability;
    private $domain;

    public function __construct(){
        parent::__construct('Employee','EmployeeComesToShelve',100);
    }

    public function maybeFire()
    {
        return true;
    }

	public function execute($data=[]){
        $hour=intval($data['current_time']/60);        
        $min=intval($data['current_time'])%60;
        echo "===================================\nOPERATIONAL REPORT AT  $hour:$min\n===================================\n";
        foreach ($data as $key=>$value) {
            if (!is_array($value)&& $key!='current_time')
                echo $key.":".$value."\n";
        }
        foreach ($data['shelves'] as $shelve) {
            echo $shelve->getId().":".$shelve->getFruitsCount()." apples and ".$shelve->getPersonsCount()." persons in shelve's queue\n";
        }
      
    }        
}