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

class Client{
private $idClient;
private $nomClient;
private $mdp;
private $login;
private $phone;
private $raisonSociale;
private $mail;
private $role_id;
private $datecreation;

public function __construct(){
		$this->idClient=null;
		$this->nomClient=null;
		$this->phone=null;
		$this->raisonSociale=null;
		$this->mdp=null;
		$this->login=null;
		$this->mail=null;
		$this->role_id=null;
		$this->datecreation=null;
	}

	public function registerClient(){
			$CryptPassRegister=$this->CryptPassword($this->mdp);
			$nameClient=strtoupper($this->nomClient);
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO client(nom,login,mail,mdp,raisonSocial,telephone,role_id) VALUES(:name,:login,:mail,:mdp,:state,:phone,:role)");
				$req->execute(array("name"=>$nameClient,"login"=>$this->login,"mail"=>$this->mail,"mdp"=>$CryptPassRegister,"state"=>$this->raisonSociale,"phone"=>$this->phone,"role"=>$this->role_id));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}

	public function deleteClient(){

			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM client WHERE client.id=:idClient");
				$req->execute(array("idClient"=>$this->idClient));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	

	}

	public function verifLoginClient($data){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT client.login as login FROM client WHERE client.login=:login");
				$req->execute(array("login"=>$data));
				$datareq=$req->fetch();
				if(!empty($datareq->login))
					$complete=false;
				else
					$complete=true;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;
	}

	public function verifUpdateLoginClient($data){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT client.login FROM client WHERE client.login!=:login");
				$req->execute(array("login"=>$data));
				$datareq=$req->fetch();
				if(!empty($datareq->login))
					$complete=false;
				else
					$complete=true;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;
	}



	public function updateInfoClient(){
			global $PDO;	

			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE client SET raisonSocial=:state,nom=:nameClient,login=:log,mail=:mail,telephone=:phone WHERE client.id=:IdClient");
				$req->execute(array("IdClient"=>$this->idClient,"nameClient"=>strtoupper($this->nomClient),"log"=>$this->login,"mail"=>$this->mail,"phone"=>$this->phone,"state"=>$this->raisonSociale));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}

	public function updatePasswordClient(){

		$CryptPass=$this->CryptPassword($this->mdp);
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE client SET mdp=:newPass WHERE client.id=:IdClient");
				$req->execute(array("IdClient"=>$this->idClient,"newPass"=>$CryptPass));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}


			private function CryptPassword($element){
			$bcrypt=new Bcrypt();
			$newElement=$bcrypt->create($element);
			return $newElement;
		}


	public function verifClient(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT mdp FROM client WHERE client.id=:IdClient");
				$req->execute(array("IdClient"=>$this->idClient));
				$result=$req->fetch();
				$req->closeCursor();

				$securePass=$result->mdp;
				$Bcrypt=new Bcrypt();
				if($Bcrypt->verify($this->mdp,$securePass))
					$isVerify=true;
				else
					$isVerify=false;

				$PDO->commit();
			}catch(Exception $e){$isVerify=false ; $PDO->rollback();}
		
			return $isVerify;	
	}

/*GETTERS SETTERS*/
public function getIdClient(){
	return $this->idClient;
}

public function setIdClient($idclient){
	$this->idClient=$idclient;
}

public function getPhone(){
	return $this->phone;
}

public function setPhone($phone){
	$this->phone=$phone;
}

public function getRaison(){
	return $this->raisonSociale;
}

public function setRaison($raisonSociale){
	$this->raisonSociale=$raisonSociale;
}

public function getnomClient(){
	return $this->nomClient;
}

public function setnomClient($nomClient){
	$this->nomClient=$nomClient;
}


public function getmdp(){
	return $this->mdp;
}

public function setmdp($mdp){
	$this->mdp=$mdp;
}


public function getlogin(){
	return $this->login;
}

public function setlogin($login){
	$this->login=$login;
}


public function getmail(){
	return $this->mail;
}

public function setmail($mail){
	$this->mail=$mail;
}


public function getrole_id(){
	return $this->role_id;
}

public function setrole_id($role_id){
	$this->role_id=$role_id;
}


public function getdatecreation(){
	return $this->datecreation;
}

public function setdatecreation($datecreation){
	$this->datecreation=$datecreation;
}




}
