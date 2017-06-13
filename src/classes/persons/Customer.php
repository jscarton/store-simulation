<?php
namespace JScarton\classes\persons;

class Customer
{	
	private $id;
	private $role;
	private $shelve;
    private $fruits;

    public function __construct($shelve){
        $this->id='CUST-'.rand();
        $this->shelve=$shelve;
        $this->fruits=[]; // customers starts with an empty cart
        $this->role='Customer';
    }

	public function getId()
    {
        return $this->id;
    }     
    public function getType()
    {
        return $this->role;
    }

    public function pick($fruit)
    {
        $this->fruits[]=$fruit;
        $this->log('picks an apple','');
    }

    public function leave()
    {
        $counter=count($this->fruits);
        $total=0.00;        
        foreach ($this->fruits as $fruit) {            
            $total+=$fruit->getPrice();
        }
        $this->log('leave','he buys '.$counter." and paid \$$total");
        return [$counter,$total];
    }
    public function move($shelve)
    {
        $this->log('moved','to '.$shelve);
        $this->shelve=$shelve;
    }

    public function log($action, $message)
    {
        echo " -".$this->id." $action on shelve ".$this->shelve.". $message\n";
    }
}