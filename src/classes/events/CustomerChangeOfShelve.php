<?php
namespace JScarton\classes\events;


class CustomerChangeOfShelve extends Event
{	
	private $id;
	protected $type;
	private $probability;
    private $domain;

    public function __construct(){
        parent::__construct('Customer','CustomerChangeOfShelve',50);
    }

	public function execute($data=[]){
        $fromShelve=rand(0,intval($data['number_of_shelves'])-1);
        $toShelve=rand(0,intval($data['number_of_shelves'])-1);
        return [$fromShelve,$toShelve];
    }        
}