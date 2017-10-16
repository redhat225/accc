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
use PollingEntity\Administrator;

class Recover{
private $id;
private $token;
private $idAdmin;
public  $Administrator;

public function __construct(){
		$this->id=null;
		$this->token=null;
		$this->idAdmin=null;
		$this->Administrator=new Administrator();
	}

	public function registerRecover(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO recover(token,idAdmin) VALUES(:token,:idAdmin)");
				$req->execute(array("token"=>$this->token,"idAdmin"=>$this->idAdmin));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

	public function deleteRecover(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM recover WHERE token=:token");
				$req->execute(array("token"=>$this->token));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}

	public function checkToken(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT token FROM recover WHERE token=:token");
				$req->execute(array("token"=>$this->token));
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
public function getIdAdmin(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT idAdmin FROM recover WHERE token=:token");
				$req->execute(array("token"=>$this->token));
				$datareq=$req->fetch();
				if(empty($datareq))
					$result="";
				else
					$result=$datareq->idAdmin;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
}

public function setId($id){
	$this->id=$id;
}

public function gettoken(){
	return $this->token;
}

public function settoken($token){
	$this->token=$token;
}


public function setidAdmin($idAdmin){
	$this->idAdmin=$idAdmin;
}



}
