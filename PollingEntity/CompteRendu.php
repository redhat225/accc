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
use PollingEntity\Tache;

class CompteRendu{

	private $idCr;
	private $dateEdit;
	private $contenu;
	private $idTache;
	private $seen;
	public  $Tache;

	public function __construct()
	{
		$this->idCr = null;
		$this->seen = null;
		$this->dateEdit = null;
		$this->idTache = null;
		$this->contenu = null;
		$this->Tache = new Tache();
	}


	public function RegisterCompteRendu(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO compterendu(contenu,idTache,state) VALUES(:contenu,:idTache,:state)");
				$req->execute(array("contenu"=>$this->contenu,"idTache"=>$this->idTache,"state"=>$this->seen));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

	public function deleteCompteRendu(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM compterendu WHERE compterendu.idTache=:idTache");
				$req->execute(array("idTache"=>$this->idTache));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

	public function alterCompteRendu(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE compterendu SET compterendu.contenu=:newContent WHERE compterendu.idCompteRendu=:idCr");
				$req->execute(array("idCr"=>$this->idCr,"newContent"=>$this->contenu));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}


	public function tagSeenCr(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE compterendu SET compterendu.state=1 WHERE compterendu.idCompteRendu=:idCr");
				$req->execute(array("idCr"=>$this->idCr));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

	public function UnSeenCr(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE compterendu SET compterendu.state=0 WHERE compterendu.idCompteRendu=:idCr");
				$req->execute(array("idCr"=>$this->idCr));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

	public function getCumulCr(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare(	"SELECT count(compterendu.idCompteRendu) as totalCr FROM compterendu LEFT JOIN tache ON compterendu.idTache=tache.idTache WHERE tache.idInitiateur=:initiator AND compterendu.state=0");
				$req->execute(array("initiator"=>$this->Tache->getidInitiateur()));
				$datareq=$req->fetch();
				$results=$datareq->totalCr;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$results=0; $PDO->rollback();}
		
			return $results;
	} 

	/*GETTERS SETTERS*/
	public function getIdCr(){
	return $this->idCr;
	}


	public function setIdCr($newIdCr){
		$this->idCr=$newIdCr;
	}

	public function getseen(){
	return $this->seen;
	}


	public function setseen($seen){
		$this->seen=$seen;
	}

	public function getidTache(){
	return $this->idTache;
	}


	public function setidTache($idTache){
		$this->idTache=$idTache;
	}


	public function getDateEdit(){
	return $this->dateEdit;
	}


	public function setDateEdit($dateEdit){
		$this->dateEdit=$dateEdit;
	}

	public function getContenu(){
	return $this->contenu;
	}


	public function setContenu($contenu){
		$this->contenu=$contenu;
	}

}