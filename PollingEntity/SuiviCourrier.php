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

class SuiviCourrier{
	private $numSuivi;
	private $idCourrier;
	public  $Courrier;

	public function __construct(){
		$this->numSuivi=null;
		$this->idCourrier=null;
		$this->Courrier=new Courrier();
	}


	public function RegisterNumSuivi(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO suivicourrier(numSuivi,Idcourrier) VALUES(:numSuivi,:idCourrier)");
				$req->execute(array("numSuivi"=>$this->numSuivi,"idCourrier"=>$this->idCourrier));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;
	}

	public function buildSuivi($idExp){
			global $PDO;
			$req=$PDO->prepare("SELECT nom FROM client WHERE client.id=:idExp");
			$req->execute(array("idExp"=>$idExp));
			$datareq=$req->fetch();
			$clientName=$datareq->nom;
			$req->closeCursor();

			$ob=substr($clientName,0,3);

			$date = date_create();
			$currentDate=date_timestamp_get($date);
			// définition du numéro de suivi unique
			$suivi=$ob.'-'.$currentDate;
			return $suivi;
	}

	public function deleteSuiviCourrier(){
			global $PDO;		
			try{
				$PDO->beginTransaction();
				
					$req=$PDO->prepare("DELETE FROM suivicourrier WHERE suivicourrier.numSuivi=:numSuivi");
					$req->execute(array("numSuivi" => $this->numSuivi));

					$req=$PDO->prepare("DELETE FROM passage WHERE passage.numSuiviCourrier=:numSuivi");
					$req->execute(array("numSuivi" => $this->numSuivi));

					$req=$PDO->prepare("DELETE FROM tache WHERE tache.numSuiviCourrier=:numSuivi");
					$req->execute(array("numSuivi" => $this->numSuivi));

					$req->closeCursor();

					$isVerify=true;

				$PDO->commit();
			}catch(Exception $e){$isVerify=false ; $PDO->rollback();}

			return $isVerify;

		}

		public function getNumeroSuivi(){
			global $PDO;	
			try{
				$PDO->beginTransaction();

				$req=$PDO->prepare("SELECT numSuivi FROM suivicourrier WHERE suivicourrier.Idcourrier=:Idcourrier");
				$req->execute(array("Idcourrier"=>$this->idCourrier));
				$datareq=$req->fetch();
				$result=$datareq->numSuivi;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
			return $result;


		}

	/*GETTERS SETTERS*/
	public function getIdSuivi(){
	return $this->numSuivi;
	}


	public function setIdSuivi($newIdSuivi){
		$this->numSuivi=$newIdSuivi;
	}


	public function getIdCourrier(){
	return $this->idCourrier;
	}


	public function setIdCourrier($newIdCourrier){
		$this->idCourrier=$newIdCourrier;
	}

}
