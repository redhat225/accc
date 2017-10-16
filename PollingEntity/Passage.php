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
use PollingEntity\SuiviCourrier;

class Passage{
	private $numSuivi;
	private $idPass;
	private $dateEnter;
	private $dateExit;
	private $idAdmin;
	public  $SuiviCourrier;

	public function __construct(){
		$this->idPass=null;
		$this->dateEnter=null;
		$this->dateExit=null;
		$this->timePassage=null;
		$this->idAdmin=null;
		$this->numSuivi=null;
		$this->SuiviCourrier=new SuiviCourrier();
	}

	public function entryPassage(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO passage(numSuiviCourrier,idAdmin) VALUES (:numSuivi,:idAdmin)");
				$req->execute(array("numSuivi"=>$this->numSuivi,"idAdmin"=>$this->idAdmin));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}

	public function outPassage(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE passage SET dateExit=NOW() WHERE passage.idPassage=:idPassage");
				$req->execute(array("idPassage"=>$this->idPass));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}


	public function getCountPassage(){
		global $PDO;	
		try{
			$PDO->beginTransaction();
			$req=$PDO->prepare("SELECT count(passage.idPassage) as nbrePass FROM passage LEFT JOIN suivicourrier ON passage.numSuiviCourrier=suivicourrier.numSuivi WHERE passage.numSuiviCourrier=:numSuivi");
			$req->execute(array("numSuivi"=>$this->numSuivi));
			$datareq=$req->fetch();
			$resultat=$datareq->nbrePass;
			$req->closeCursor();
			$PDO->commit();
		}catch(Exception $e){$resultat=""; $PDO->rollback();}

		return $resultat;
	}

		public function deletePassage(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM passage WHERE passage.idPassage=:idPassage");
				$req->execute(array("idPassage"=>$this->idPass));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}


	/*GETTERS SETTERS*/
	public function getIdPass()
	{
	return $this->idPass;
	}


	public function setIdPass($newIdPass)
	{
		$this->idPass=$newIdPass;
	}

		public function getnumSuivi()
	{
	return $this->numSuivi;
	}


	public function setnumSuivi($numSuivi)
	{
		$this->numSuivi=$numSuivi;
	}

	public function getDateIn(){
	return $this->dateEnter;
	}


	public function setDateIn($newDateIn){
		$this->dateEnter=$newDateIn;
	}


		public function getDateOut(){
	return $this->dateExit;
	}


	public function setDateOut($newDateOut){
		$this->dateExit=$newDateOut;
	}


	public function getIdAdmin(){
	return $this->idAdmin;
	}


	public function setIdAdmin($newIdAdmin){
		$this->idAdmin=$newIdAdmin;
	}

}
 