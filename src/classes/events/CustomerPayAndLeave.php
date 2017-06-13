<?php
namespace JScarton\classes\events;


class CustomerPayAndLeave extends Event
{	
	private $id;
	protected $type;
	private $probability;
    private $domain;

    public function __construct(){
        parent::__construct('Customer','CustomerPayAndLeave',70);
    }

	public function execute($data=[]){
        $Cashiers=$data['max_cashiers'];
        $workingCashiers=rand($data['min_cashiers'],$Cashiers);
        $availableCashiers=rand(0,$workingCashiers);
        $fromShelve=rand(0,intval($data['number_of_shelves'])-1);
        return [$availableCashiers,$fromShelve];
    }        
}