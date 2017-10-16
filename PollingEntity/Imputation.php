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
use Zend\Crypt\Password\Bcrypt;
use PollingEntity\NewCourrier;

class Imputation{
private $id;
private $idCourrier;
private $idDesigne;
private $dateImputation;
private $idResponsible;
private $categorie;
private $seen;
public  $NewCourrier;

public function __construct(){
		$this->id=null;
		$this->categorie=null;
		$this->seen=null;
		$this->idResponsible=null;
		$this->idCourrier=null;
		$this->idDesigne=null;
		$this->dateImputation=null;
		$this->NewCourrier=new NewCourrier();
	}

	public function registerImputation(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO imputation(idCourrier,idResponsible,idDesigne,categorie,seen) VALUES(:idCourrier,:idResponsible,:idDesigne,:categorie,0)");
				$req->execute(array("idCourrier"=>$this->idCourrier,"idDesigne"=>$this->idDesigne,"categorie"=>$this->categorie,"idResponsible"=>$this->idResponsible));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

public function getFullUnread(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT count(id) as totalUnread FROM imputation WHERE idDesigne=:idDesigne AND seen=0");
				$req->execute(array("idDesigne"=>$this->idDesigne));
				$datareq=$req->fetch();
				if(empty($datareq))
					$result=0;
				else
					$result=$datareq->totalUnread;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=0; $PDO->rollback();}
			return $result;
}

public function getFullUnreadImputation(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT count(id) as totalUnread FROM imputation WHERE idDesigne=:idDesigne AND seen=0 AND categorie=2");
				$req->execute(array("idDesigne"=>$this->idDesigne));
				$datareq=$req->fetch();
				if(empty($datareq))
					$result=0;
				else
					$result=$datareq->totalUnread;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=0; $PDO->rollback();}
			return $result;
}

	public function RegisterImputationAgent(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO imputation(idCourrier,idDesigne,idResponsible) VALUES(:idCourrier,:idDesigne,:idResp)");
				$req->execute(array("idCourrier"=>$this->idCourrier,"idDesigne"=>$this->idDesigne,"idResponsible"=>$this->idResponsible));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

	public function setSeen(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE imputation SET seen=1 WHERE idDesigne=:idDesigne AND idCourrier=:idCourrier");
				$req->execute(array("idDesigne"=>$this->idDesigne , "idCourrier"=>$this->idCourrier));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;
	}
	


			public function CheckedImputation(){
				global $PDO;	
				try{
					$PDO->beginTransaction();
					$req=$PDO->prepare("SELECT id FROM imputation WHERE idDesigne=:idDesigne");
					$req->execute(array("idDesigne"=>$this->idDesigne));
					$datareq=$req->fetch();
					if(empty($datareq))
						$result=false;
					else
						$result=true;
					$req->closeCursor();
					$PDO->commit();
				}catch(Exception $e){$result=false; $PDO->rollback();}
			return $result;
		}

	public function deleteImputation(){

			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM imputation WHERE idCourrier=:idCourrier AND idDesigne=:idDesigne");
				$req->execute(array("idCourrier"=>$this->idCourrier,"idDesigne"=>$this->idDesigne));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	

	}

	public function deleteImputationAgent(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM imputation WHERE idCourrier=:idCourrier AND idResponsible=:idDesigne");
				$req->execute(array("idCourrier"=>$this->idCourrier,"idDesigne"=>$this->idDesigne));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;
	}

	public function updateImputation(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE imputation SET idDesigne=:idDesigne WHERE id=:id");
				$req->execute(array("id"=>$this->id, "idDesigne"=>$this->idDesigne));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}

	public function checkAlreadyImputation(){
				global $PDO;	
				try{
					$PDO->beginTransaction();
					$req=$PDO->prepare("SELECT id FROM imputation WHERE idDesigne=:idDesigne AND idCourrier=:idCourrier");
					$req->execute(array("idDesigne"=>$this->idDesigne,"idCourrier"=>$this->idCourrier));
					$datareq=$req->fetch();
					if(empty($datareq))
						$result=false;
					else
						$result=true;
					$req->closeCursor();
					$PDO->commit();
				}catch(Exception $e){$result=false; $PDO->rollback();}
			return $result;
	}


/*GETTERS SETTERS*/
public function getId(){
	return $this->id;
}

public function setId($id){
	$this->id=$id;
}

public function getIdCourrier(){
	return $this->idCourrier;
}

public function setIdCourrier($idCourrier){
	$this->idCourrier=$idCourrier;
}
public function setIdResponsible($idResponsible){
	$this->idResponsible=$idResponsible;
}

public function setCategorie($categorie)
{
	$this->categorie=$categorie;
}

// public function setSeen($seen){
// 	$this->seen=$seen;
// }

public function getIdDesigne(){
	return $this->idDesigne;
}

public function setIdDesigne($idDesigne){
	$this->idDesigne=$idDesigne;
}

public function getDateImputation(){
	return $this->dateImputation;
}

public function setDateImputation($dateImputation){
	$this->dateImputation=$dateImputation;
}



}
