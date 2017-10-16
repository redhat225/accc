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
use PollingEntity\Courrier;
class Rejet{

	private $numRejet;
	private $motif;
	private $dateRejet;
	private $idCourrier;
	public  $Courrier;

	public function __construct(){
		$this->numRejet=null;
		$this->motif=null;
		$this->dateRejet=null;
		$this->Courrier=null;
	}


	public function getNumRejet(){
	return $this->numRejet;
	}


	public function setNumRejet($numRejet){
		$this->numRejet=$numRejet;
	}


	public function getMotif(){
	return $this->motif;
	}


	public function setMotif($motif){
		$this->motif=$motif;
	}

	public function getRejDate(){
	return $this->dateRejet;
	}


	public function setRejDate($dateRejet){
		$this->dateRejet=$dateRejet;
	}

		public function getidCourrier(){
	return $this->idCourrier;
	}


	public function setidCourrier($idCourrier){
		$this->idCourrier=$idCourrier;
	}



}