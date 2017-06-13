<?php
namespace JScarton\classes\events;


class EmployeeAddSomeFruits extends Event
{	
	private $id;
	protected $type;
	private $probability;
    private $domain;

    public function __construct(){
        parent::__construct('Employee','EmployeeAddSomeFruits',100);
    }

	public function execute($data=[]){
        $addFruits=rand(0,intval($data['shelve_capacity'])-1);
        return $addFruits;        
    }        
}