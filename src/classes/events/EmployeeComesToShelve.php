<?php
namespace JScarton\classes\events;


class EmployeeComesToShelve extends Event
{	
	private $id;
	protected $type;
	private $probability;
    private $domain;

    public function __construct(){
        parent::__construct('Employee','EmployeeComesToShelve',70);
    }

	public function execute($data=[]){
        $goToShelve=rand(0,intval($data['number_of_shelves'])-1);
        return $goToShelve;        
    }        
}