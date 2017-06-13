<?php
namespace JScarton\classes\fruits;

class Apple implements IFruit
{
    private $id;
    private $price=0;    
    protected $type='APPLE';
    public function __construct()
    {
        //sets the id automatically
        $this->id=$this->getType()."-".rand();
        //initializes the price
        $this->price=rand(1,10)/rand(1,5); //apples always will have a float price between 1 and 10
    }

    public function getId(){
        return $this->id;
    }
    public function getType()
    {
        return $this->type;
    }
    public function setPrice($price)
    {
        $this->price=floatval($price);
    }
    public function getPrice()
    {
        return $this->price;
    }
    
}