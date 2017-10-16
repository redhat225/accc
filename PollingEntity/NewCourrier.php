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

class NewCourrier{

	private $id;
	private $reference;
	private $expediteur;
	private $objet;
	private $state;
	private $dateEnr;
	private $dateTrt;
	private $piece;
	private $urgence;
	private $numSuivi;
	private $dateRedaction;
	private $delaiTraitement;
	private $Fonde;
	private $ChefService;
	private $pieceDepart;
	private $stateNotification;
	private $destinataire;
	private $numSuiviDepart;
	private $idAgentArrive;
	private $idAgentDepart;


	public function __construct(){
		$this->id=null;
		$this->reference=null;
		$this->id=null;
		$this->idAgentArrive=null;
		$this->idAgentDepart=null;
		$this->delaiTraitement=null;
		$this->objet=null;
		$this->state=null;
		$this->dateEnr=null;
		$this->dateTrt=null;
		$this->piece=null;
		$this->urgence=null;
		$this->numSuiviDepart=null;
		$this->numSuivi=null;
		$this->dateRedaction=null;
		$this->Fonde=null;
		$this->stateNotification=null;
		$this->ChefService=null;
		$this->destinataire=null;
		$this->pieceDepart=null;
	}


	public function registerCourrier(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO newcourrier(reference,destinataire,expediteur,objet,state,piece,urgence,numSuivi,delaiTraitement,stateNotification) VALUES (:ref,:dest,:exp,:obj,:state,:piece,:level,:numSuivi,:delay,1)");
				$req->execute(array("ref"=>$this->reference,"dest"=>$this->destinataire,"exp"=>$this->expediteur,"obj"=>$this->objet,"state"=>$this->state,"piece"=>$this->piece,"level"=>$this->urgence,"numSuivi"=>$this->numSuivi,"delay"=>$this->delaiTraitement));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function getFullAdrresses(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM administrators");
				$req->execute();
				while($datareq=$req->fetch())
				$result[]=$datareq;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}		

	public function getLastId(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT max(id) as lastId FROM newcourrier");
				$req->execute();
				$datareq=$req->fetch();
				$result=$datareq->lastId;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

			public function alternumSuiviDepart(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET numSuiviDepart=:numSuiviDepart WHERE id=:id");
				$req->execute(array("id"=>$this->id,"numSuiviDepart"=>$this->numSuiviDepart));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){	$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function buildSuivi(){
			$ob="ACCC";

			$date = date_create();
			$currentDate=date_timestamp_get($date);
			// définition du numéro de suivi unique
			$suivi=$ob.'-'.$currentDate;
			return $suivi;
	}

	public function isPieceDepart(){
				global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM newcourrier WHERE piece=:piece");
				$req->execute(array("piece"=>$this->piece));
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

	public function getIdFlexReadCourrier($data)
	{
		global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM newcourrier WHERE piece=:piece OR pieceDepart=:pieceDepart");
				$req->execute(array("piece"=>$data,"pieceDepart"=>$data));
				$datareq=$req->fetch();
				if(empty($datareq))
					$result="";
				else
					$result=$datareq->id;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

	public function checkFonde($data){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT fonde FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$data));
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

		public function checkSce($data){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT chefserv FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$data));
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

	public function getcheckFonde($data){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT fonde FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$data));
				$datareq=$req->fetch();
				if(empty($datareq))
					$result="";
				else
					$result=$datareq->fonde;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

		public function getcheckSce($data){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT chefserv FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$data));
				$datareq=$req->fetch();
				if(empty($datareq))
					$result="";
				else
					$result=$datareq->chefserv;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}


	public function checkedFlexFile($data){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM newcourrier WHERE piece=:piece OR pieceDepart=:pieceDepart");
				$req->execute(array("piece"=>$data,"pieceDepart"=>$data));
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

	public function getPieceJointe(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT piece FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->piece;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

	public function getInfoClient(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id,state,DATE_FORMAT(newcourrier.dateEnr,'%d-%m-%Y à %H:%i:%s') as dateEnr,numSuivi FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				if(empty($datareq))
				$datareq="";
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$datareq=""; $PDO->rollback();}
		return $datareq;
	}

		public function getPieceJointeDepart(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT pieceDepart FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->pieceDepart;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}


	public function alterPiece(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET piece=:piece WHERE id=:id");
				$req->execute(array("id"=>$this->id,"piece"=>$this->piece));
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
				$req=$PDO->prepare("UPDATE newcourrier SET pieceDepart=:piece WHERE id=:id");
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
				$req=$PDO->prepare("UPDATE newcourrier SET reference=:ref, destinataire=:destinataire, expediteur =:exp, objet=:obj, urgence=:urg, numSuivi=:numSuivi, delaiTraitement=delaiTraitement+$delay WHERE id=:id");
				$req->execute(array("id"=>$this->id,"ref"=>$this->reference,"destinataire"=>$this->destinataire,"exp"=>$this->expediteur,"obj"=>$this->objet,"urg"=>$this->urgence,"numSuivi"=>$this->numSuivi));
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
				$req=$PDO->prepare("SELECT urgence FROM newcourrier WHERE id=:id");
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
				$req=$PDO->prepare("DELETE FROM newcourrier WHERE id=:id");
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
				$req=$PDO->prepare("SELECT id FROM newcourrier WHERE numSuivi=:suivi");
				$req->execute(array("suivi"=>$this->numSuivi));
				$datareq=$req->fetch();
				$result=$datareq->id;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

	public function OfflineNot(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET stateNotification=0 WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){	$complete=false; $PDO->rollback();}
		return $complete;

	}

		public function OnlineNot(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET stateNotification=1 WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){	$complete=false; $PDO->rollback();}
		return $complete;

	}

		public function checkedId(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM newcourrier WHERE id=:id AND state=1");
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
				$req=$PDO->prepare("UPDATE newcourrier SET state=2, pieceDepart=:piece,numSuiviDepart=:numSuiviDepart, dateTrt=NOW() WHERE id=:id");
				$req->execute(array("id"=>$this->id,"piece"=>$this->pieceDepart,"numSuiviDepart"=>$this->numSuiviDepart));
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
				$req=$PDO->prepare("UPDATE newcourrier SET fonde=:fonde  WHERE id=:id");
				$req->execute(array("id"=>$this->id,"fonde"=>$this->Fonde));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function stateNotificationCourrier(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET stateNotification=:stateNotification  WHERE id=:id");
				$req->execute(array("id"=>$this->id,"stateNotification"=>$this->stateNotification));
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
				$req=$PDO->prepare("UPDATE newcourrier SET chefserv=:chefserv  WHERE id=:id");
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

			public function setIdAgentArrive($idCourrier,$agentArrive){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET idAgentArrive=:idAgentArrive  WHERE id=:id");
				$req->execute(array("id"=>$idCourrier,"idAgentArrive"=>$agentArrive));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

				public function setIdAgentDepart($idCourrier,$agentDepart){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET idAgentDepart=:idAgentDepart  WHERE id=:id");
				$req->execute(array("id"=>$idCourrier,"idAgentDepart"=>$agentDepart));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

			public function setFonde($fonde){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET fonde=:fonde  WHERE id=:id");
				$req->execute(array("id"=>$this->id,"fonde"=>$fonde));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

	public function setpieceDepart($pieceDepart){
		$this->pieceDepart=$pieceDepart;
	}

			public function setChefService($ChefService){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE newcourrier SET chefserv=:chefserv  WHERE id=:id");
				$req->execute(array("id"=>$this->id,"chefserv"=>$ChefService));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		return $complete;
	}

			public function setexpediteur($expediteur){
		$this->expediteur=$expediteur;
	}
		public function setobjet($objet){
		$this->objet=$objet;
	}

	public function getObjet(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT objet FROM newcourrier WHERE id=:id");
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

		public function getState(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT state FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->state;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

			public function setstateNotification($stateNotification){
		$this->stateNotification=$stateNotification;
	}
		public function setdateEnr($dateEnr){
		$this->dateEnr=$dateEnr;
	}
		public function setdateTrt($dateTrt){
		$this->dateTrt=$dateTrt;
	}
			public function setdestinataire($destinataire){
		$this->destinataire=$destinataire;
	}
		public function setpiece($piece){
		$this->piece=$piece;
	}

			public function setnumSuiviDepart($numSuiviDepart){
		$this->numSuiviDepart=$numSuiviDepart;
	}

	
		public function seturgence($urgence){
		$this->urgence=$urgence;
	}

	public function getUrgenceWR(){
		return $this->urgence;
	}


		public function setnumSuivi($numSuivi){
		$this->numSuivi=$numSuivi;
	}

	public function getnumSuivi(){
					global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT numSuivi FROM newcourrier WHERE id=:id");
				$req->execute(array("id"=>$this->id));
				$datareq=$req->fetch();
				$result=$datareq->numSuivi;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$result=""; $PDO->rollback();}
		return $result;
	}

	public function setDateRedaction($dateRedaction){
		$this->dateRedaction=$dateRedaction;
	}



}