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

class CourrierAccc{

	private $id;
	private $reference;
	private $expediteur;
	private $objet;
	private $state;
	private $dateEnr;
	private $dateTrt;
	private $urgence;
	private $numSuivi;
	private $dateRedaction;
	private $delaiTraitement;
	private $pieceArrive;
	private $pieceDepart;
	private $destinataire;
	private $mailDest;


	public function __construct(){
		$this->id=null;
		$this->reference=null;
		$this->expediteur=null;
		$this->delaiTraitement=null;
		$this->objet=null;
		$this->state=null;
		$this->mailDest=null;
		$this->dateEnr=null;
		$this->dateTrt=null;
		$this->pieceArrive=null;
		$this->urgence=null;
		$this->numSuivi=null;
		$this->dateRedaction=null;
		$this->destinataire=null;
		$this->pieceDepart=null;
	}


	public function registerCourrier(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO courrieraccc(reference,expediteur,objet,state,pieceDepart,urgence,numSuivi,delaiTraitement,destinataire,mailDest) VALUES (:ref,:exp,:obj,:state,:piece,:level,:numSuivi,:delay,:destinataire,:mailDest)");
				$req->execute(array("ref"=>$this->reference,"exp"=>$this->expediteur,"obj"=>$this->objet,"state"=>$this->state,"piece"=>$this->pieceDepart,"level"=>$this->urgence,"numSuivi"=>$this->numSuivi,"delay"=>$this->delaiTraitement,"destinataire"=>$this->destinataire,"mailDest"=>$this->mailDest));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function getLastId(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT max(id) as lastId FROM courrieraccc");
				$req->execute();
				$datareq=$req->fetch();
				$result=$datareq->lastId;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}


	public function buildSuivi(){
			$ob="ACCC";

			$date = date_create();
			$currentDate=date_timestamp_get($date);
			// définition du numéro de suivi unique
			$suivi=$ob.'-'.$currentDate;
			return $suivi;
	}

	public function getPieceJointeDepart(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT pieceDepart FROM courrieraccc WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->pieceDepart;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

	public function getPieceJointeArrive(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT pieceArrive FROM courrieraccc WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->pieceArrive;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}


	public function alterPieceArrive(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrieraccc SET pieceArrive=:piece WHERE id=:id");
				$req->execute(array("id"=>$this->id,"piece"=>$this->pieceArrive));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){	$complete=false; $PDO->rollback();}
		return $complete;
	}

		public function alterPieceDepart(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrieraccc SET pieceDepart=:piece WHERE id=:id");
				$req->execute(array("id"=>$this->id,"piece"=>$this->pieceDepart));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){	$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function alterCourrierInfo($delay){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrieraccc SET reference=:ref, mailDest=:mailDest,destinataire=:destinataire,expediteur =:exp, objet=:obj, urgence=:urg, numSuivi=:numSuivi, delaiTraitement=delaiTraitement+$delay WHERE id=:id");
				$req->execute(array("id"=>$this->id,"ref"=>$this->reference,"exp"=>$this->expediteur,"obj"=>$this->objet,"urg"=>$this->urgence,"numSuivi"=>$this->numSuivi,"mailDest"=>$this->mailDest,"destinataire"=>$this->destinataire));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){	$complete=false; $PDO->rollback();}
		return $complete;
	}

			public function alterDateRedaction(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrieraccc SET dateRedaction=:dateRedaction WHERE id=:id");
				$req->execute(array("id"=>$this->id,"dateRedaction"=>$this->dateRedaction));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){	$complete=false; $PDO->rollback();}
		return $complete;
	}


	public function getUrgence(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT urgence FROM courrieraccc WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->urgence;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

	public function deleteCourrier(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("DELETE FROM courrieraccc WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){	$complete=false; $PDO->rollback();}
		return $complete;
	}


	public function getId(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM courrieraccc WHERE id=:id");
				$req->execute(array("id"=>$this->numSuivi));
				$datareq=$req->fetch();
				$result=$datareq->id;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}


		public function checkedId(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM courrieraccc WHERE id=:id AND state=1");
				$req->execute(array("id"=>$this->id));
				if($req->fetch())
					$isVerify=true;
				else
					$isVerify=false;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$isVerify=false; $PDO->rollback();}
		return $isVerify;
	}


	public function registerCourrierOut(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrieraccc SET state=2, pieceArrive=:piece,dateTrt=NOW(),dateRedaction=:dateRedaction  WHERE id=:id");
				$req->execute(array("id"=>$this->id,"piece"=>$this->pieceArrive,"dateRedaction"=>$this->dateRedaction));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function updateFonde(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrieraccc SET fonde=:fonde  WHERE id=:id");
				$req->execute(array("id"=>$this->id,"fonde"=>$this->Fonde));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function archiveCourrier(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrieraccc SET archived=:archived  WHERE id=:id");
				$req->execute(array("id"=>$this->id,"archived"=>$this->archived));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}


	public function updateChefServ(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE courrieraccc SET chefserv=:chefserv  WHERE id=:id");
				$req->execute(array("id"=>$this->id,"chefserv"=>$this->ChefService));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function getResp($login)
	{
		global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT nom,prenom FROM administrators WHERE login=:login");
				$req->execute(array("login"=>$login));
				$datareq=$req->fetch();
				if(empty($datareq))
				$response="";
				else
				$response=$datareq->nom." ".$datareq->prenom;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){	$response=""; $PDO->rollback();}
		return $response;
	}


		public function setId($id){
		$this->id=$id;
	}

	public function setreference($reference){
		$this->reference=$reference;
	}
		public function setDelaiTraitement($delaiTraitement){
		$this->delaiTraitement=$delaiTraitement;
	}
			public function setFonde($Fonde){
		$this->Fonde=$Fonde;
	}

	public function setpieceDepart($pieceDepart){
		$this->pieceDepart=$pieceDepart;
	}

			public function setChefService($ChefService){
		$this->ChefService=$ChefService;
	}

			public function setexpediteur($expediteur){
		$this->expediteur=$expediteur;
	}
		public function setobjet($objet){
		$this->objet=$objet;
	}

	public function getNumFollow(){
					global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT numSuivi FROM courrieraccc WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->numSuivi;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

	public function getObjet(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT objet FROM courrieraccc WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->objet;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}
		public function setstate($state){
		$this->state=$state;
	}

			public function setArchived($archived){
		$this->archived=$archived;
	}
		public function setdateEnr($dateEnr){
		$this->dateEnr=$dateEnr;
	}
	
		public function setdestinataire($destinataire){
		$this->destinataire=$destinataire;
	}
		public function setdateTrt($dateTrt){
		$this->dateTrt=$dateTrt;
	}
		public function seturgence($urgence){
		$this->urgence=$urgence;
	}
		public function setnumSuivi($numSuivi){
		$this->numSuivi=$numSuivi;
	}

			public function setpieceArrive($pieceArrive){
		$this->pieceArrive=$pieceArrive;
	}


	

			public function getnumSuivi(){
		return $this->numSuivi;
	}

	public function setDateRedaction($dateRedaction){
		$this->dateRedaction=$dateRedaction;
	}

		public function setmailDest($mailDest){
		$this->mailDest=$mailDest;
	}



}