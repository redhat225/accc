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

class Service{
	private $numService;
	private $nomService;

	public function __construct()
	{
		$this->numService=null;
		$this->nom=null;		
	}

	public function getNumService(){
	return $this->numService;
	}


	public function setNumService($numService){
		$this->numService=$numService;
	}

	public function getNameService(){
	return $this->nomService;
	}


	public function setNameService($service){
		$this->nomService=$service;
	}


}