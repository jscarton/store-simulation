<?php
namespace JScarton\classes\events;


class CustomerPicksSomeApples extends Event
{	
	private $id;
	protected $type;
	private $probability;
    private $domain;

    public function __construct(){
        parent::__construct('Customer','CustomerPicksSomeApples',70);
    }

	public function execute($data=[]){
        $randomNumberOfApples=rand(0,10);
        $fromShelve=rand(0,intval($data['number_of_shelves'])-1);
        return [$randomNumberOfApples,$fromShelve];
    }        
}