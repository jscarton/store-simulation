<?php
namespace JScarton\classes\simulation;

class Shelve
{	
	private $id;
    private $capacity;
	private $fruits;
    private $persons;

    public function __construct($id,$capacity){
        $this->id='SHELVE-'.$id;
        $this->capacity=$capacity;
        $this->fruits=[];
        $this->persons=[];          
    }

	public function getId()
    {
        return $this->id;
    } 

    public function addFruit($fruit)
    {
        if (count($this->fruits)<$this->capacity)
        {
            $this->fruits[]=$fruit;
            return true;
        }
        return false;
    }    

    public function pickAFruit()
    {
         $fruit=array_shift($this->fruits);
         return $fruit;
    }

    public function getFruitsCount()
    {
        return count($this->fruits);
    }

    public function addPerson($person)
    {        
        $this->persons[]=$person;
        if ($person->getType()=='Customer')
            $this->log('A customer arrived','');
        else
            $this->log('An Employee arrived','');
    }    

    public function getCurrentPerson()
    {
        
        return $this->persons[0];
    }

    public function removePerson()
    {
        if (count($this->persons)>0)
        {
            array_shift($this->persons);
            return true;
        }
        return false;
    }

    public function getPersonsCount()
    {
        return count($this->persons);
    }

    public static function getStoreShelves($numberOfShelves,$shelveCapacity)
    {
        $shelves=[];
        for ($i=0;$i<$numberOfShelves; $i++)
        {
            $shelves[]=new Shelve($i,$shelveCapacity);
        }
        return $shelves;
    }

    public function log($action, $message)
    {
        echo " - $action on shelve ".$this->id.". $message\n";
    }
}