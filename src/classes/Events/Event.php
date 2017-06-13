<?php
namespace JScarton\classes\events;


abstract class Event
{	
	private $id;
	protected $type;
	private $probability;
    private $domain;

    public function __construct($domain,$type,$probability=10){
        $this->domain=$domain;
        $this->type=$type;
        $this->setProbability($probability);
    }

	public function getId()
	{
		return $this->id;
	}
	public function getType()
	{
		return $this->type;
	}
    public function setProbability($prob)
    {
    	if (intval($prob)!=0 && intval($prob)>0)
    		$this->probability=floatval(1/$prob);
    	else
    		$this->probability=0.1; //default probability to 10%
    }
    public function getProbability()
    {
    	return $probability;
    }
    public function maybeFire()
    {
    	$check=floatval(rand(0,100)/100); // a random float number between 0 and 1

    	if ($check<$this->probability)
    		return true; // returns true if $check is between 0 and $this->probability
    	return false;
    }
    abstract public function execute($data=[]);        
}