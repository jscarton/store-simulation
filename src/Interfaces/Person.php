<?
namespace JScarton\Interfaces;

/**
*	Common Functionality for all persons in the simulation
*/
interface iPerson
{	
	public function getId();	  
	public function geRole();	    
    public static function create($data=[]);    
}