<?php
namespace JScarton\classes\fruits;

/**
*	Common Functionality for all fruits
*/
interface IFruit
{	
	public function getId();
	public function getType();
    public function setPrice($price);
    public function getPrice();        
}