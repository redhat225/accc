<?php
namespace PollingEntity;

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
use PollingEntity\Notification;
use PollingEntity\Service;

class Administrator{
		 private $id;	
		 private $nom;
		 private $prenom;
		 private $login;
		 private $password;
		 private $avatar;
		 private $role;
		 private $dateEnr;
		 private $idService;
		 private $poste;
		 private $niveauAcces;
		 private $fonction;
		 
		 public  $Notification;
		 public  $Service;
		 private $idResponsible;

		public function __construct(){
				$this->id=null;
				$this->nom=null;
				$this->fonction=null;
				$this->prenom=null;
				$this->login=null;
				$this->password=null;
				$this->avatar=null;
				$this->role=null;
				$this->dateEnr=null;
				$this->idService=null;
				$this->poste=null;
				$this->idResponsible=null;
				$this->niveauAcces=null;
				$this->Notification=new Notification();
				$this->Service=new Service();
		}

		
		public function RegisterAdmin(){		
			global $PDO;
			$cryptPass=$this->CryptPassword($this->password);

			try{
				$PDO->beginTransaction();

				$req=$PDO->prepare('INSERT INTO administrators(nom,prenom,login,idService,poste,password,role_id,idResponsible,fonction) VALUES (:AdminName, :AdminSurname, :login,:idService,:poste, :pass, :roleAdmin, :idResp, :fonction)');
			    $req->execute(array("AdminName" => $this->nom,
			    					"AdminSurname" => $this->prenom,
			    					"login" => $this->login,
			    					"idService" =>$this->idService,
			    					"poste" =>$this->poste,
			    					"pass" =>$cryptPass,
			    					"roleAdmin" =>$this->role,
			    					"idResp" => $this->idResponsible,
			    					"fonction" => $this->fonction
			    					
			    		));
			    $req->closeCursor();
			    $result=true;
			    $PDO->commit();
			} catch(Exception $e){$result=false;	$PDO->rollback(); }

		    return $result;

		}


		private function CryptPassword($element){
			$bcrypt=new Bcrypt();
			$newElement=$bcrypt->create($element);
			return $newElement;
		}

		


		public function updateAdmin(){
			global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE administrators SET nom=:newName, prenom=:newLast, login=:newLogin, idService=:idService, poste=:poste, idResponsible=:idResp, fonction=:fonction WHERE administrators.id=:idAdmin");
				$req->execute(array(
						"newName" =>$this->nom,
						"newLast" => $this->prenom,
						"newLogin" =>$this->login,
						"idService" =>$this->idService,
						"poste" =>$this->poste,
						"idAdmin"=>$this->id,
						"idResp"=>$this->idResponsible,
						"fonction"=>$this->fonction
					));
				$req->closeCursor();
			    $result=true;
			    $PDO->commit();
			}catch(Exception $e){$result=false ; $PDO->rollback();}
		
			return $result;

		}

		public function updateAdminPassword(){
			global $PDO;
			$cryptPass=$this->CryptPassword($this->password);
						try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE administrators SET password=:newPassword WHERE administrators.id=:idAdmin");
				$req->execute(array(
						"newPassword" => $cryptPass,
						"idAdmin"=>$this->id
					));
				$req->closeCursor();
			    $result=true;
			    $PDO->commit();
			}catch(Exception $e){$result=false ; $PDO->rollback();}
		
			return $result;

		}



		public function UpdateAvatar(){
			global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE administrators SET administrators.avatar=:avatar WHERE administrators.id=:id");
				$req->execute(array(
						"avatar" => $this->avatar,
						"id" => $this->id
					));
				$req->closeCursor();
			    $result=true;
			    $PDO->commit();
			}catch(Exception $e){$result=false ; $PDO->rollback();}
		
			return $result;

			}

		public function getIdRecover($login){
				global $PDO;	
				try{
					$PDO->beginTransaction();
					$req=$PDO->prepare("SELECT id FROM administrators WHERE login=:login");
					$req->execute(array("login"=>$login));
					$datareq=$req->fetch();
					if(empty($datareq))
					$result="";
					else
						$result=$datareq->id;
					$req->closeCursor();
					$PDO->commit();
				}catch(Exception $e){$result="" ; $PDO->rollback();}
			
				return $result;	
		}

		public function getFullInfo(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT * FROM administrators WHERE id=:adminId");
				$req->execute(array("adminId"=>$this->id));
				$result=$req->fetch();
				if(empty($result))
				$result="";
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result="" ; $PDO->rollback();}
		
			return $result;		
		}

			public function getNameResp($data){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT nom,prenom,poste FROM administrators WHERE id=:adminId");
				$req->execute(array("adminId"=>$data));
				$result=$req->fetch();
				if(empty($result))
				$result="";
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result="" ; $PDO->rollback();}
		
			return $result;		
		}


		public function VerifyAdmin($password){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT password FROM administrators WHERE administrators.id=:adminId");
				$req->execute(array("adminId"=>$this->id));
				$result=$req->fetch();
				$req->closeCursor();
				$securePass=$result->password;
				$Bcrypt=new Bcrypt();
				if($Bcrypt->verify($password,$securePass))
					$isVerify=true;
				else
					$isVerify=false;

				$PDO->commit();
			}catch(Exception $e){$isVerify=false ; $PDO->rollback();}
		
			return $isVerify;		
		}


		public function DeleteAdmin(){
			global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare('DELETE FROM administrators WHERE administrators.id=:idAdmin');
			    $req->execute(array("idAdmin" => $this->id));
			    $req->closeCursor();
			    $result=true;
			    $PDO->commit();
			} catch(Exception $e){$result=false;	$PDO->rollback(); }
		    return $result;
		}



/*GETTERS ET SETTERS*/

public function getIdAdmin(){
	return $this->id;
}

public function setIdResponsible($idResp){
	$this->idResponsible=$idResp;
}

public function setIdAdmin($newId)
{
	$this->id=$newId;
}

public function getRole(){
	return $this->role;
}

public function setRole($newRole)
{
	$this->role=$newRole;
}

public function getName(){
	return $this->nom;
}

public function setName($newName)
{
	$this->nom=$newName;
}

public function setFonction($fonction)
{
	$this->fonction=$fonction;
}

public function getLastName(){
	return $this->prenom;
}

public function setLastName($newLastName)
{
	$this->prenom=$newLastName;
}


public function getLogin(){
	return $this->login;
}

public function setLogin($newLogin)
{
	$this->login=$newLogin;
}



public function getPassword(){
	return $this->password;
}

public function setPassword($newPassword)
{
	$this->password=$newPassword;
}

public function getAvatar(){
	return $this->avatar;
}

public function setAvatar($newAvatar)
{
	$this->avatar=$newAvatar;
}

public function getdateEnr(){
	return $this->dateEnr;
}

public function setdateEnr($dateEnr)
{
	$this->dateEnr=$dateEnr;
}

public function getidService(){
	return $this->idService;
}

public function setidService($idService)
{
	$this->idService=$idService;
}

public function getposte(){
	return $this->poste;
}

public function setposte($poste)
{
	$this->poste=$poste;
}

public function getniveauAcces(){
	return $this->niveauAcces;
}

public function setniveauAcces($niveauAcces)
{
	$this->niveauAcces=$niveauAcces;
}








}