<?php 
namespace PollingEntity;

 class Notification{
 		private $idNotification;
 		private $idTypeNotification;
 		private $idInitiateur; 
 		private $Contenu;
 		private $dateEnr; 

 		public function __construct()
 		{
 			$this->idNotification=null;
 			$this->contenu=null;
 			$this->idTypeNotification=null;
 			$this->idInitiateur=null;
 			$this->dateEnr=null;
 		}


 	public function registerNotification()
 			{
 			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO notifications(idTypeNotification,idInitiateur,contenu) VALUES(:idTypeNot,:idResp,:contenu)");
				$req->execute(array("idTypeNot"=>$this->idTypeNotification,"idResp"=>$this->idInitiateur,"contenu"=>$this->Contenu));
				$req->closeCursor();
					$isVerify=true;
				$PDO->commit();
			}catch(Exception $e){$isVerify=false ; $PDO->rollback();}
		
			return $isVerify;
			}
 		

 		public function deleteNotification(){

 		}

		//GETTERS & SETTERS

		public function getIdNotification(){
			return $this->idNotification;
		}


		public function setIdNotification($idNotif){
			 $this->idNotification=$idNotif;
		}

				public function getContenu(){
			return $this->Contenu;
		}


		public function setContenu($Contenu){
			 $this->Contenu=$Contenu;
		}

		public function getIdTypeNotification(){
			return $this->idTypeNotification;
		}

		public function setIdTypeNotification($typeNotif){
			   $this->idTypeNotification=$typeNotif;
		}


		public function getIdInitiateur(){
			return $this->idInitiateur;
		}

		public function setIdInitiateur($initiateur){
			$this->idInitiateur=$initiateur;
		}
		public function getDateEnr(){
			return $this->dateEnr;
		}

		public function setDateEnr($date){
			$this->dateEnr=$date;
		}

 }