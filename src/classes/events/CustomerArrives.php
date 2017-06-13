<?php
namespace JScarton\classes\events;


class CustomerArrives extends Event
{	
	private $id;
	protected $type;
	private $probability;
    private $domain;

    public function __construct(){
        parent::__construct('Customer','CustomerArrives',50);
    }

	public function execute($data=[]){
        return rand(0,intval($data['number_of_shelves'])-1);        
    }        
}