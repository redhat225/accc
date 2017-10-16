<?php 
Namespace PollingEntity;
try {
	if(file_exists("/vendor/autoload.php"))
		require "/vendor/autoload.php";
	else{
		if(file_exists("../vendor/autoload.php"))
		require "../vendor/autoload.php";
	}

} catch (Exception $e) {
}

class TypeTache{
	private $numTypeTache;
	private $typeTache;
	private $nature;
	private $icon;


	public function __construct(){
		$this->numTypeTache=null;
		$this->typeTache=null;
		$this->nature=null;
		$this->icon=null;
	}


	/*GETTERS SETTERS*/
	public function getNumType()
	{
	return $this->numTypeTache;
	}


	public function setNumType($NumType)
	{
		$this->numTypeTache=$NumType;
	}


	public function getType(){
	return $this->typeTache;
	}


	public function setType($newType){
		$this->typeTache=$newType;
	}


	public function getNature(){
	return $this->nature;
	}


	public function setNature($newNature){
		$this->nature=$newNature;
	}


	public function getIcon(){
	return $this->icon;
	}


	public function setIcon($newIcon){
		$this->icon=$newIcon;
	}

}