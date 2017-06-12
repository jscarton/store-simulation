<?
namespace JScarton\Interfaces;

/**
*	Common Functionality for all fruits
*/
interface iFruit
{	
	public function getId();	
    public function setPrice($price);
    public function getPrice();        
}