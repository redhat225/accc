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
use PollingEntity\Client;
use PollingEntity\Service;

	class Courrier{
	private $idCourrier;
	private $objet;
	private $idExpediteur;
	private $idService;
	private $recordDate;
	private $delayTreatmenent;
	private $stateTreatment;
	private $pieceJointe;
	private $archived;
	private $treatedDate;
	private $niveauUrgence;
	private $Obs;
	public  $Client;
	public  $Service;

	public function __construct()
	{
		$this->idCourrier=null;
		$this->niveauUrgence=null;
		$this->archived=null;
		$this->pieceJointe=null;
		$this->objet=null;
		$this->Obs=null;
		$this->idExpediteur=null;
		$this->treatedDate=null;
		$this->idService=null;
		$this->recordDate=null;
		$this->delayTreatmenent=null;
		$this->stateTreatment=null;
		$this->Client=new Client();
		$this->Service = new Service();
	}


 public function registerCourrier()
	{
		$this->setIdCourrier($this->getLastId());
		if(!($this->idCourrier===false))
		{
			$this->idCourrier=((int)$this->idCourrier)+1;
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO courrier(idCourrier,idExpediteur,objetCourrier,state,delaiTraitement,pieces,niveauUrgence) VALUES (:idCourrier,:idExpediteur,:objetCourrier,:state,:delaiTraitement,:pieces,:niveauUrgence)");
				$req->execute(array("idCourrier"=>$this->idCourrier,"idExpediteur"=>$this->idExpediteur,"objetCourrier"=>$this->objet,"state"=>$this->stateTreatment,"delaiTraitement"=>$this->delayTreatmenent,"pieces"=>$this->pieceJointe,"niveauUrgence"=>$this->niveauUrgence));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		}
		else
			$complete=false;

		return $complete;
	}

public function setService(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrier SET idService=:service WHERE courrier.idCourrier=:idCourrier");
				$req->execute(array("service"=>$this->idService,"idCourrier"=>$this->idCourrier));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		

		return $complete;
}

public function setSortieCourrier(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrier SET Obs=:obs,treatedDate=NOW(),state=:state WHERE courrier.idCourrier=:idCourrier");
				$req->execute(array("obs"=>$this->Obs,"idCourrier"=>$this->idCourrier,"state"=>$this->stateTreatment));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		

		return $complete;
}

public function alterCourrierInfo(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrier SET objetCourrier=:objet WHERE courrier.idCourrier=:idCourrier");
				$req->execute(array("objet"=>$this->objet,"idCourrier"=>$this->idCourrier));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		

		return $complete;
}

public function alterCourrierInfoSortie(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrier SET Obs=:obs WHERE courrier.idCourrier=:idCourrier");
				$req->execute(array("obs"=>$this->Obs,"idCourrier"=>$this->idCourrier));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		

		return $complete;
}

public function alterCourrierPieces(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrier SET pieces=:pieces WHERE courrier.idCourrier=:idCourrier");
				$req->execute(array("idCourrier"=>$this->idCourrier,"pieces"=>$this->pieceJointe));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		

		return $complete;
}



	public function getLastId()
	{
		global $PDO;	
		try{
			$PDO->beginTransaction();
			$req=$PDO->prepare("SELECT max(idCourrier) as last_id FROM courrier");
			$req->execute();
			$datareq=$req->fetch();
			if(empty($datareq->last_id))
				$id=0;
			else
				$id=$datareq->last_id;
			$req->closeCursor();
			$PDO->commit();
		}catch(Exception $e){$complete=false; $PDO->rollback();}

		if(isset($complete))
		return $complete;
		else	
		return $id;
	}


	public function getStateCourrier(){
		global $PDO;	
		try{
			$PDO->beginTransaction();
			$req=$PDO->prepare("SELECT state FROM courrier WHERE courrier.idCourrier=:idCourrier");
			$req->execute(array("idCourrier"=>$this->idCourrier));
			$datareq=$req->fetch();
			$resultat=$datareq->state;
			$req->closeCursor();
			$PDO->commit();
		}catch(Exception $e){$resultat=""; $PDO->rollback();}

		return $resultat;
	}



public function setTreatingCourrier(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrier SET courrier.state=2 WHERE courrier.idCourrier=:idCourrier");
				$req->execute(array("idCourrier"=>$this->idCourrier));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		

		return $complete;
}



public function deleteCourrier(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM courrier WHERE courrier.idCourrier=:idCourrier");
				$req->execute(array("idCourrier"=>$this->idCourrier));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		

		return $complete;
}

public function getPieceJointe($data){
		global $PDO;	
		try{
			$PDO->beginTransaction();
			$req=$PDO->prepare("SELECT courrier.pieces FROM courrier LEFT JOIN suivicourrier ON courrier.idCourrier=suivicourrier.Idcourrier WHERE suivicourrier.numSuivi=:numSuivi");
			$req->execute(array("numSuivi"=>$data));
			$datareq=$req->fetch();
			$resultat=$datareq->pieces;
			$req->closeCursor();
			$PDO->commit();
		}catch(Exception $e){$resultat=""; $PDO->rollback();}

		return $resultat;
}

public function courrierSortieRegister(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrier SET courrier.pieces=:newPiece, courrier.state=3, courrier.Obs=:obs, courrier.treatedDate=NOW() WHERE courrier.idCourrier=:idCourrier");
				$req->execute(array("idCourrier"=>$this->idCourrier,"newPiece"=>$this->pieceJointe,"obs"=>$this->Obs));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		

		return $complete;
}

public function getCourrierId($data)
{
		global $PDO;	
		try{
			$PDO->beginTransaction();
			$req=$PDO->prepare("SELECT courrier.idCourrier FROM courrier LEFT JOIN suivicourrier ON courrier.idCourrier=suivicourrier.Idcourrier WHERE suivicourrier.numSuivi=:numSuivi");
			$req->execute(array("numSuivi"=>$data));
			$datareq=$req->fetch();
			$resultat=$datareq->idCourrier;
			$req->closeCursor();
			$PDO->commit();
		}catch(Exception $e){$resultat=""; $PDO->rollback();}

		return $resultat;
}


	/*GETTERS SETTERS*/
	public function getIdCourrier(){
	return $this->idCourrier;
	}

	public function setIdCourrier($newId){
		$this->idCourrier=$newId;
	}

	public function getNiveauUrgence(){
	return $this->niveauUrgence;
	}

	public function setNiveauUrgence($niveauUrgence){
		$this->niveauUrgence=$niveauUrgence;
	}


	public function getArchived(){
	return $this->archived;
	}

	public function setArchived($archived){
		$this->archived=$archived;
	}

	public function getObs(){
	return $this->Obs;
	}

	public function setObs($Obs){
		$this->Obs=$Obs;
	}

	public function getTreatedDate(){
	return $this->treatedDate;
	}


	public function setTreatedDate($treatedDate){
		$this->treatedDate=$treatedDate;
	}


	public function getPieceJointess(){
	return $this->pieceJointe;
	}


	public function setPieceJointe($pieceJointe){
		$this->pieceJointe=$pieceJointe;
	}


		public function getDelay(){
	return $this->delayTreatmenent;
	}


	public function setDelay($delayTreatmenent){
		$this->delayTreatmenent=$delayTreatmenent;
	}

		public function getState(){
	return $this->stateTreatment;
	}


	public function setState($stateTreatment){
		$this->stateTreatment=$stateTreatment;
	}

	public function getObjet(){
	return $this->objet;
	}


	public function setObjet($objet){
		$this->objet=$objet;
	}



	public function getExpediteur(){
	return $this->idExpediteur;
	}


	public function setExpediteur($newExp){
		$this->idExpediteur=$newExp;
	}

	public function getRecDate(){
	return $this->recordDate;
	}


	public function setRecDate($newExp){
		$this->recordDate=$newExp;
	}

	public function getidService(){
	return $this->idService;
	}


	public function setidService($idService){
		$this->idService=$idService;
	}


}
