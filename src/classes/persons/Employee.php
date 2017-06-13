<?php
namespace JScarton\classes\persons;

class Employee
{	
	private $id;
	private $role;
	private $shelve;    

    public function __construct($shelve){
        $this->id='EMP-'.rand();
        $this->shelve=$shelve;
        $this->role='Employee';        
    }

	public function getId()
    {
        return $this->id;
    }     
    public function getType()
    {
        return $this->role;
    }
    public function add()
    {
        $this->log('add an apple','');

    }    
    public static function create($data=[])
    {
        return new Employee($data['shelve']);
    }

    public function log($action, $message)
    {
        echo " -".$this->id." $action on shelve ".$this->shelve.". $message\n";
    }    
}