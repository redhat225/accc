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
use PollingEntity\Administrator;

class Push{
	private $idPush;
	private $idExp;
	private $idDest;
	private $messagePush;
	private $statePush;
	private $idBoite;
	private $date_envoi;
	public  $Administrator;

	public function __construct(){
		$this->idPush=null;
		$this->date_envoi=null;
		$this->idExp=null;
		$this->idDest=null;
		$this->idBoite=null;
		$this->messagePush=null;
		$this->statePush=null;
		$this->Administrator=new Administrator();
	}

	public function RegisterPush(){
		global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO push(idExp,idDest,messagePush,statePush,idBoite) VALUES(:exp,:dest,:message,:state,:poBox)");
				$req->execute(array("exp"=>$this->idExp,"dest"=>$this->idDest,"message"=>$this->messagePush,"state"=>$this->statePush,"poBox"=>$this->idBoite));
				$req->closeCursor();
			    $result=true;
			    $PDO->commit();
			} catch(Exception $e){$result=false; $PDO->rollback();}

		    return $result;
	}



	public function seenPush(){
			global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE push  SET statePush=1 WHERE push.idPush=:idPush");
				$req->execute(array("idPush"=>$this->idPush));
				$req->closeCursor();
			    $result=true;
			    $PDO->commit();
			} catch(Exception $e){$result=false; $PDO->rollback(); }

		    return $result;
	}

		public function unseenPush(){
			global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE push  SET statePush=0 WHERE push.idPush=:idPush");
				$req->execute(array("idPush"=>$this->idPush));
				$req->closeCursor();
			    $result=true;
			    $PDO->commit();
			} catch(Exception $e){$result=false; $PDO->rollback(); }

		    return $result;
	}

	public function deletePush(){
			global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM push  WHERE push.idPush=:idPush");
				$req->execute(array("idPush"=>$this->idPush));
				$req->closeCursor();
			    $result=true;
			    $PDO->commit();
			} catch(Exception $e){$result=false;	$PDO->rollback(); }

		    return $result;
	}

	public function ReactPush(){
			global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT count(push.idPush) as NbrePush FROM push  WHERE push.idDest=:idDest AND push.idBoite=:idBoite AND push.date_envoi>:timer");
				$req->execute(array("idDest"=>$this->idDest,"idBoite"=>$this->idBoite,"timer"=>$this->date_envoi));
				$datareq=$req->fetch();
				$result=$datareq->NbrePush;
				$req->closeCursor();
			    $PDO->commit();
			} catch(Exception $e){$result=0;	$PDO->rollback(); }

		    return $result;	
	}

	public function getUnreadPush(){
			global $PDO;
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT count(push.idPush) as NbrePush FROM push  WHERE push.idDest=:idDest AND push.idBoite=:idBoite AND push.statePush=0");
				$req->execute(array("idDest"=>$this->idDest,"idBoite"=>$this->idBoite));
				$datareq=$req->fetch();
				$result=$datareq->NbrePush;
				$req->closeCursor();
			    $PDO->commit();
			} catch(Exception $e){$result=0;	$PDO->rollback(); }

		    return $result;	
	}


/*GETTERS ET SETTERS*/

public function getIdPush(){
	return $this->idPush;
}

public function setIdPush($newIdPush)
{
	$this->idPush=$newIdPush;
}

public function getIdExp(){
	return $this->idExp;
}

public function setIdExp($newIdExp)
{
	$this->idExp=$newIdExp;
}

public function getIdDest(){
	return $this->idDest;
}

public function setIdDest($newIdDest)
{
	$this->idDest=$newIdDest;
}

public function getMessagePush(){
	return $this->messagePush;
}

public function setMessagePush($newMessagePush)
{
	$this->messagePush=$newMessagePush;
}


public function getStatePush(){
	return $this->statePush;
}

public function setStatePush($newStatePush)
{
	$this->statePush=$newStatePush;
}

public function getIdBox(){
	return $this->idBoite;
}

public function setIdBox($newIdBox)
{
	$this->idBoite=$newIdBox;
}

public function getDateSend(){
	return $this->date_envoi;
}

public function setDateSend($newDateSend)
{
	$this->date_envoi=$newDateSend;
}







}