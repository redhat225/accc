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
use PollingEntity\TypeTache;
use PollingEntity\SuiviCourrier;

class Tache{

	private $iDTache;
	private $descriptif;
	private $levelUrgence;
	private $idTypeTache;
	private $numSuiviCourrier;
	private $dateDefinition;
	private $stateExecution;
	private $seenTache;
	private $idInitiateur;
	private $idExecutor;
	public  $TypeTache;
	public  $SuiviCourrier;

	public function __construct(){
		$this->iDTache=null;
		$this->seenTache=null;
		$this->descriptif=null;
		$this->levelUrgence=null;
		$this->idTypeTache=null;
		$this->numSuiviCourrier=null;
		$this->dateDefinition=null;
		$this->stateExecution=null;
		$this->idInitiateur=null;
		$this->idExecutor=null;
		$this->SuiviCourrier=new SuiviCourrier();
		$this->TypeTache=new TypeTache();
	}

	public function registerTask(){
		global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO tache(descTache,niveauUrgence,numSuiviCourrier,executionState,idInitiateur,idExecuteur) VALUES(:descTache,:niveauUrgence,:numSuiviCourrier,:executionState,:idInitiateur,:idExecuteur)");
				$req->execute(array("descTache"=>$this->descriptif,
							"niveauUrgence"=>$this->levelUrgence,
							"numSuiviCourrier"=>$this->numSuiviCourrier,
							"executionState"=>$this->stateExecution,
							"idInitiateur"=>$this->idInitiateur,
							"idExecuteur"=>$this->idExecutor
					));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	

	}

	public function deleteTask(){
		global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM tache WHERE idTache=:idTache");
				$req->execute(array("idTache"=>$this->iDTache
					));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	

	}

	public function updateTask(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE tache SET descTache=:descTache,niveauUrgence=:level,idInitiateur=:idResp,idExecuteur=:idExecutor WHERE idTache=:idTache");
				$req->execute(array("descTache"=>$this->descriptif,"level"=>$this->levelUrgence,"idResp"=>$this->idInitiateur,"idExecutor"=>$this->idExecutor,"idTache"=>$this->iDTache));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;
	}

	public function updateStateTask(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE tache SET executionState=:state WHERE idTache=:idTache");
				$req->execute(array("state"=>$this->stateExecution,"idTache"=>$this->iDTache));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;

	}

		public function seenTache(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE tache SET seenTache=:seenTache WHERE idTache=:idTache");
				$req->execute(array("idTache"=>$this->iDTache,"seenTache"=>$this->seenTache));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;

	}


	public function getCumulTaches(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare(	"SELECT count(tache.idTache) as totalTache FROM tache WHERE idExecuteur=:executor AND tache.seenTache=0");
				$req->execute(array("executor"=>$this->idExecutor));
				$datareq=$req->fetch();
				$results=$datareq->totalTache;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$results=0; $PDO->rollback();}
		
			return $results;
	} 

	/*GETTERS SETTERS*/
	public function getiDTache()
	{
	return $this->iDTache;
	}


	public function setiDTache($iDTach)
	{
		$this->iDTache=$iDTach;
	}


	public function getseenTache()
	{
	return $this->seenTache;
	}


	public function setseenTache($seenTache)
	{
		$this->seenTache=$seenTache;
	}

	public function getidInitiateur()
	{
	return $this->idInitiateur;
	}

	public function setidInitiateur($idInitiateur)
	{
		$this->idInitiateur=$idInitiateur;
	}

		public function getidExecutor()
	{
	return $this->idExecutor;
	}


	public function setidExecutor($idExecutor)
	{
		$this->idExecutor=$idExecutor;
	}

	public function getdateDefinition()
	{
	return $this->dateDefinition;
	}


	public function setdateDefinition($dateDefinition)
	{
		$this->dateDefinition=$dateDefinition;
	}

	public function getstateExecution()
	{
	return $this->stateExecution;
	}


	public function setstateExecution($stateExecution)
	{
		$this->stateExecution=$stateExecution;
	}

	public function getidTypeTache()
	{
	return $this->idTypeTache;
	}


	public function setidTypeTache($idTypeTache)
	{
		$this->idTypeTache=$idTypeTache;
	}



	public function getDescriptif(){
	return $this->descriptif;
	}

	public function setDescriptif($descriptif){
		$this->descriptif=$descriptif;
	}

	public function getLevPass()
	{
	return $this->levelUrgence;
	}

	public function setLevPass($newLev)
	{
		$this->levelUrgence=$newLev;
	}

		public function getNumSuivi()
	{
	return $this->numSuiviCourrier;
	}

	public function setNumSuivi($numSuiviCourrier)
	{
		$this->numSuiviCourrier=$numSuiviCourrier;
	}

}