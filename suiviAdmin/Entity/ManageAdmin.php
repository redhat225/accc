<?php 
Namespace suiviAdmin\Entity;
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class ManageAdmin{

	public function adminInfo($data){
		global $PDO;
		$req=$PDO->prepare("SELECT * FROM administrators LEFT JOIN service ON administrators.idService=service.idService WHERE administrators.id=:id");
		$req->execute(array("id"=>$data));
		$datareq=$req->fetchAll();
		$_SESSION['adminInfo']=$datareq[0];

	}

	public function generalInfoCourrier(){
		global $PDO;
		$req=$PDO->prepare("SELECT count(courrier.idCourrier) as nbreReceiveCourrier FROM courrier");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->nbreReceiveCourrier))
		$result->nbreReceiveCourrier=0;
		$finalResult[]=$result;

		for ($i=1; $i <=3 ; $i++) { 
			$req=$PDO->prepare("SELECT count(courrier.idCourrier)as courrierCateg FROM courrier WHERE courrier.state=:state");
			$req->execute(array("state"=>$i));
			$result=$req->fetch();
			if(!isset($result->courrierCateg))
				$result->courrierCateg=0;
			array_push($finalResult, $result);
		}


		$req=$PDO->prepare("SELECT round(sum(DATEDIFF(DATE_FORMAT(courrier.treatedDate,'%Y-%m-%d'),DATE_FORMAT(courrier.recordDate,'%Y-%m-%d')))/count(courrier.idCourrier),2) as tempsMoyenTraitement FROM courrier WHERE courrier.state>2");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->tempsMoyenTraitement))
			$result->tempsMoyenTraitement=0;
		array_push($finalResult, $result);


		$req=$PDO->prepare("SELECT count(courrier.idCourrier) as timeout FROM courrier WHERE DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY)<DATE_FORMAT(NOW(),'%Y-%m-%d') AND courrier.state<3");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->timeout))
			$result->timeout=0;
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT round(sum(DATEDIFF(DATE_FORMAT(courrier.treatedDate,'%Y-%m-%d'),DATE_FORMAT(courrier.recordDate,'%Y-%m-%d')))/count(courrier.idCourrier),2) as bestMoyTreatment, service.nomService as bestService FROM courrier LEFT JOIN service ON courrier.idService=service.idService WHERE courrier.state>2 GROUP BY bestService ORDER BY bestMoyTreatment LIMIT 1");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->bestMoyTreatment))
			$result->bestMoyTreatment=0;
		if(!isset($result->bestService))
			$result->bestService="indefini";
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT round(sum(DATEDIFF(DATE_FORMAT(courrier.treatedDate,'%Y-%m-%d'),DATE_FORMAT(courrier.recordDate,'%Y-%m-%d')))/count(courrier.idCourrier),2) as badMoyTreatment, service.nomService as badService FROM courrier LEFT JOIN service ON courrier.idService=service.idService WHERE courrier.state>2 GROUP BY badService ORDER BY badMoyTreatment DESC LIMIT 1");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->badMoyTreatment))
			$result->badMoyTreatment=0;
		if(!isset($result->badService))
			$result->badService="indefini";
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT count(suggestion.idSuggest) as mostSuggest, service.nomService as BestServiceSuggest FROM suggestion LEFT JOIN courrier ON suggestion.idCourrier=courrier.idCourrier LEFT JOIN service ON courrier.idService=service.idService GROUP BY BestServiceSuggest ORDER BY mostSuggest DESC LIMIT 1");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->mostSuggest))
			$result->mostSuggest=0;
		if(!isset($result->BestServiceSuggest))
			$result->BestServiceSuggest="indefini";
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT count(suggestion.idSuggest) as weakSuggest, service.nomService as weakServiceSuggest FROM suggestion LEFT JOIN courrier ON suggestion.idCourrier=courrier.idCourrier LEFT JOIN service ON courrier.idService=service.idService GROUP BY weakServiceSuggest ORDER BY weakSuggest ASC LIMIT 1");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->weakSuggest))
			$result->weakSuggest=0;
		if(!isset($result->weakServiceSuggest))
			$result->weakServiceSuggest="indefini";
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT count(courrier.idCourrier) as nbreCourrierMostSollicited, service.nomService as mostSollicitedService FROM courrier LEFT JOIN service ON courrier.idService=service.idService GROUP BY mostSollicitedService ORDER BY nbreCourrierMostSollicited DESC LIMIT 1");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->nbreCourrierMostSollicited))
			$result->nbreCourrierMostSollicited=0;
		if(!isset($result->mostSollicitedService))
			$result->mostSollicitedService="indefini";
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT count(courrier.idCourrier) as nbreCourrierWeakSollicited, service.nomService as weakSollicitedService FROM courrier LEFT JOIN service ON courrier.idService=service.idService GROUP BY weakSollicitedService ORDER BY nbreCourrierWeakSollicited ASC LIMIT 1");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->nbreCourrierWeakSollicited))
			$result->nbreCourrierWeakSollicited=0;
		if(!isset($result->weakSollicitedService))
			$result->weakSollicitedService="indefini";
		array_push($finalResult, $result);

		//daily courrier
		$req=$PDO->prepare("SELECT count(courrier.idCourrier) as dailyCourrier FROM courrier WHERE DATE_FORMAT(NOW(), '%Y-%m-%d')=DATE_FORMAT(courrier.recordDate, '%Y-%m-%d')");
		$req->execute();
		$result=$req->fetch();
		if(!isset($result->dailyCourrier))
			$result->dailyCourrier=0;
		array_push($finalResult, $result);

		$req->closeCursor();

		$_SESSION['generalInfoCourrier']=$finalResult;
	}

	 public function NotificationsInfo(){
	 	global $PDO;
	 	$req=$PDO->prepare("SELECT * FROM notifications LEFT JOIN typenotification ON notifications.idTypeNotification=typenotification.id LEFT JOIN administrators ON notifications.idInitiateur=administrators.id");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['NotificationsInfo']=$result;
	 }

	 	//recupérer les utilisateurs imputés pour révocation
	 public function revokResp($idService,$idAdmin,$idCourrier)
	 {	
	 	if($idService==4)
	 	{
	 		$poste='agent';
	 		$myService=$idService;
	 	}
	 	else
	 	{
	 		$poste='responsable';
	 		$myService=$idService;
	 	}
	 	global $PDO;
	 	$req=$PDO->prepare("SELECT administrators.id,login,nom,prenom,idService,poste,fonction FROM newcourrier LEFT JOIN imputation ON newcourrier.id=imputation.idCourrier LEFT JOIN administrators ON administrators.id=imputation.idDesigne WHERE  idService>=:service  AND imputation.idResponsible=:idResp AND administrators.poste IN ('responsable','secretaire','agent') AND newcourrier.id=:idCourrier AND imputation.categorie=2");
	 	$req->execute(array("service"=>$myService,"idResp"=>$idAdmin,"idCourrier"=>$idCourrier));
	 	while ($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['revokResp']=$result;
	 }

	 //recupérer les utilisateurs pas encore imputés pour imputation
	 public function ImpResp($idService,$idAdmin,$idCourrier)
	 {	
	 	if($idService==4)
	 	{
	 		$poste='responsable';
	 		$myService=$idService;
	 	}
	 	else
	 	{
	 		$poste='responsable';
	 		$myService=$idService;
	 	}
	 	global $PDO;
	 	$req=$PDO->prepare("SELECT administrators.id,login,nom,prenom,idService,poste,fonction FROM administrators WHERE idService>=:service  AND idResponsible=:idResp AND poste IN ('responsable','secretaire','agent') AND administrators.id NOT IN (SELECT imputation.idDesigne FROM imputation WHERE idCourrier=:idCourrier)");
	 	$req->execute(array("service"=>$myService,"idResp"=>$idAdmin,"idCourrier"=>$idCourrier) ) ;
	 	while ($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['ImpResp']=$result;
	 }


	 public function recupResponsible($idCourrier){
	 		global $PDO;
	 	$req=$PDO->prepare("SELECT administrators.id,login,nom,prenom,idService,poste,fonction FROM administrators WHERE administrators.poste='responsable' AND idService>2 AND administrators.id NOT IN (SELECT imputation.idDesigne FROM imputation WHERE idCourrier=:idCourrier)");
	 	$req->execute(array("idCourrier"=>$idCourrier));
	 	while ($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['recupResponsible']=$result;
	 }

	 public function recupRevokeResponsible($idCourrier){
	 		global $PDO;
	 	$req=$PDO->prepare("SELECT administrators.id,login,nom,prenom,idService,poste,fonction FROM administrators WHERE idService>2 AND administrators.id IN (SELECT imputation.idDesigne FROM imputation WHERE idCourrier=:idCourrier)");
	 	$req->execute(array("idCourrier"=>$idCourrier));
	 	while ($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['recupRevokeResponsible']=$result;
	 }
	 public function superior(){
	 	global $PDO;
	 	$req=$PDO->prepare("SELECT * FROM administrators WHERE idService>2 AND poste='responsable' ");
	 	$req->execute();
	 	while ($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['superior']=$result;
	 }


	public function memberAdminInfo(){
		global $PDO;
		$req=$PDO->prepare("SELECT id,nom,prenom,login,date_creation,service.nomService,poste,avatar,idResponsible,fonction FROM administrators LEFT JOIN service ON administrators.idService=service.idService");
		$req->execute();
		while($datareq=$req->fetch())
		$finalResult[]=$datareq;
		$_SESSION['memberAdminInfo']=$finalResult;
	}
	

		public function checkEnregistrorArrive($idAdmin){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM newcourrier WHERE idAgentArrive=:idAdmin");
				$req->execute(array("idAdmin"=>$idAdmin));
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

			public function checkEnregistrorDepart($idAdmin){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM newcourrier WHERE idAgentDepart=:idAdmin");
				$req->execute(array("idAdmin"=>$idAdmin));
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

	public function CheckedImputation($idDesigne,$idCourrier){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("SELECT id FROM imputation WHERE idDesigne=:idDesigne AND idCourrier=:idCourrier");
				$req->execute(array("idDesigne"=>$idDesigne,"idCourrier"=>$idCourrier));
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

	public function distinctExpeditor(){
		global $PDO;
		$req=$PDO->prepare("SELECT DISTINCT client.nom FROM client");
		$req->execute();
		while($datareq=$req->fetch())
		$finalResult[]=$datareq;
		$_SESSION['distinctExpeditor']=$finalResult;
	}

	public function typeNotification(){
		global $PDO;
		$req=$PDO->prepare("SELECT DISTINCT typenotification.action FROM typenotification");
		$req->execute();
		while($datareq=$req->fetch())
		$finalResult[]=$datareq;
		$_SESSION['typeNotification']=$finalResult;
	}

	public function servicesInfo(){
		global $PDO;
		$req=$PDO->prepare("SELECT * FROM service");
		$req->execute();
		while($datareq=$req->fetch())
		$finalResult[]=$datareq;
		$_SESSION['servicesInfo']=$finalResult;
	}

	public function clientInfo(){
		global $PDO;
		$req=$PDO->prepare("SELECT * FROM client ORDER BY date_inscription DESC");
		$req->execute();
		while($datareq=$req->fetch())
		$finalResult[]=$datareq;
		$_SESSION['clientInfo']=$finalResult;
	}

	public function clientInfoAccc(){
		global $PDO;
		$req=$PDO->prepare("SELECT * FROM clientAccc ORDER BY dateInscr DESC");
		$req->execute();
		while($datareq=$req->fetch())
		$finalResult[]=$datareq;
		$_SESSION['clientInfoAccc']=$finalResult;
	}


	public function suggestInfo(){
		global $PDO;
		$req=$PDO->prepare("SELECT client.nom as nomExp, suggestion.idSuggest as idSuggestion, suggestion.idCourrier as idCourrierSuggest, suggestion.suggestion, suggestion.dateEnvoi, service.nomService, suivicourrier.numSuivi, suggestion.state FROM suggestion LEFT JOIN courrier ON suggestion.idCourrier=courrier.idCourrier LEFT JOIN service ON courrier.idService=service.idService LEFT JOIN suivicourrier ON courrier.idCourrier=suivicourrier.Idcourrier LEFT JOIN client ON courrier.idExpediteur=client.id");
		$req->execute();
		while($datareq=$req->fetch())
			$result[]=$datareq;
		 if(empty($result))
	 		$result=0;
		$_SESSION['suggestInfo']=$result;	
	}

	//récupération des messages Push
	public	function recupPush($data){
			global $PDO;
			$req=$PDO->prepare("SELECT push.idPush,push.date_envoi,push.messagePush,administrators.prenom as destinataire FROM push LEFT JOIN administrators ON push.idDest=administrators.id WHERE push.idBoite=:idBox AND push.idExp=:idPush ORDER BY push.date_envoi DESC ");
			$req->execute(array("idBox"=>$data,"idPush" =>$data
				));
			while($datareq=$req->fetch())
				$result[]=$datareq;

			if(empty($result))
				$result=0;
			$_SESSION['SendPush']=$result;

			$req=$PDO->prepare("SELECT push.idPush,push.date_envoi,push.messagePush,push.statePush,administrators.prenom as expediteur FROM push LEFT JOIN administrators ON push.idExp=administrators.id WHERE push.idBoite=:idBox AND push.idDest=:idDest ORDER BY push.date_envoi DESC ");
			$req->execute(array("idBox"=>$data,"idDest"=>$data));
			while($datareq=$req->fetch())
				$result2[]=$datareq;

			if(empty($result2))
				$result2=0;
			$_SESSION['ReceivePush']=$result2;


			$req->closeCursor();
		}

	public function courrierAdminInfo()
	 {
		global $PDO;

	 	$req=$PDO->prepare("SELECT client.nom,client.raisonSocial,courrier.niveauUrgence,courrier.idCourrier, courrier.recordDate, courrier.objetCourrier, courrier.state, courrier.delaiTraitement, courrier.treatedDate,service.nomService,suivicourrier.numSuivi,DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY) as datePrevueTraitement, courrier.Obs, courrier.pieces,DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY)) as dayRest, DATE_FORMAT(courrier.recordDate,'%Y-%m-%d') as filterPickDate  FROM courrier LEFT JOIN service ON courrier.idService=service.idService LEFT JOIN suivicourrier ON courrier.idCourrier=suivicourrier.Idcourrier  LEFT JOIN client ON courrier.idExpediteur=client.id WHERE DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY))<0 AND courrier.state=2 ORDER BY courrier.recordDate DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result1[]=$datareq;
	 	if(empty($result1))
	 		$result1=0;
	 	$finalResult[]=$result1;

	 	$req=$PDO->prepare("SELECT client.nom,client.raisonSocial,courrier.niveauUrgence,courrier.idCourrier, courrier.recordDate, courrier.objetCourrier, courrier.state, courrier.delaiTraitement, courrier.treatedDate,service.nomService,suivicourrier.numSuivi,DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY) as datePrevueTraitement, courrier.Obs, courrier.pieces,DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY)) as dayRest, DATE_FORMAT(courrier.recordDate,'%Y-%m-%d') as filterPickDate  FROM courrier LEFT JOIN service ON courrier.idService=service.idService LEFT JOIN suivicourrier ON courrier.idCourrier=suivicourrier.Idcourrier  LEFT JOIN client ON courrier.idExpediteur=client.id WHERE DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY))>0 AND courrier.state=2 ORDER BY courrier.recordDate DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result2[]=$datareq;
	 	if(empty($result2))
	 		$result2=0;
	 	array_push($finalResult,$result2);

	 	$req=$PDO->prepare("SELECT client.nom,client.raisonSocial,courrier.niveauUrgence,courrier.idCourrier, courrier.recordDate, courrier.objetCourrier, courrier.state, courrier.delaiTraitement, courrier.treatedDate,service.nomService,suivicourrier.numSuivi,DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY) as datePrevueTraitement, courrier.Obs, courrier.pieces,DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY)) as dayRest, DATE_FORMAT(courrier.recordDate,'%Y-%m-%d') as filterPickDate  FROM courrier LEFT JOIN service ON courrier.idService=service.idService LEFT JOIN suivicourrier ON courrier.idCourrier=suivicourrier.Idcourrier  LEFT JOIN client ON courrier.idExpediteur=client.id WHERE DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY))=0 AND courrier.state=2 ORDER BY courrier.recordDate DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result3[]=$datareq;
	 	if(empty($result3))
	 		$result3=0;
	 	array_push($finalResult,$result3);


		$_SESSION['courrierAdminInfo']=$finalResult;
	}

		public function courrierAdminInfoAccc()
	 {
		global $PDO;
	 	$req=$PDO->prepare("SELECT id,reference,expediteur,destinataire,mailDest,objet,dateEnr,pieceDepart,urgence,numSuivi,delaiTraitement, DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrieraccc.dateEnr,'%Y-%m-%d'),INTERVAL courrieraccc.delaiTraitement DAY)) as dayRest FROM courrieraccc WHERE state=1 ORDER BY dateEnr DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result1[]=$datareq;
	 	if(empty($result1))
	 		$result1=0;
	 	$finalResult[]=$result1;
	 	$_SESSION['courrierAdminInfoAccc']=$finalResult;
	 }

	 public function courrierArriveInfo()
	 {
		global $PDO;
	 	$req=$PDO->prepare("SELECT * FROM courrieraccc WHERE state=2 ORDER BY dateTrt DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result1[]=$datareq;
	 	if(empty($result1))
	 		$result1=0;
	 	$finalResult[]=$result1;
	 	$_SESSION['courrierArriveInfo']=$finalResult;
	 }


	public function archivesInfo(){
		global $PDO;
	 	$req=$PDO->prepare("SELECT id,reference,expediteur,destinataire,objet,dateEnr,state,piece,pieceDepart,dateTrt,urgence,numSuivi,numSuiviDepart,delaiTraitement, DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(newcourrier.dateEnr,'%Y-%m-%d'),INTERVAL newcourrier.delaiTraitement DAY)) as dayRest,state FROM newcourrier ORDER BY dateEnr DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 	{	
	 		
	 		$foo = (array)$datareq;
			$req3=$PDO->prepare("SELECT nom,prenom FROM administrators LEFT JOIN newcourrier ON administrators.id=newcourrier.idAgentArrive WHERE newcourrier.id=:id");
	 		$req3->execute(array("id"=>$datareq->id));
	 		$datareq4=$req3->fetch();
	 		$foo['agentarrive'] = $datareq4->nom." ".$datareq4->prenom;

	 		$req4=$PDO->prepare("SELECT nom,prenom FROM administrators LEFT JOIN newcourrier ON administrators.id=newcourrier.idAgentDepart WHERE newcourrier.id=:id");
	 		$req4->execute(array("id"=>$datareq->id));
	 		$datareq5=$req4->fetch();
	 		$foo['agentDepart'] = $datareq5->nom." ".$datareq5->prenom;

	 		$req5=$PDO->prepare("SELECT nom,prenom FROM newcourrier LEFT JOIN imputation ON newcourrier.id=imputation.idCourrier LEFT JOIN administrators ON imputation.idDesigne=administrators.id WHERE newcourrier.id=:id AND imputation.categorie=2 AND administrators.poste='responsable' AND administrators.idService=3");
	 		$req5->execute(array("id"=>$datareq->id));
	 		while($datareq6=$req5->fetch())
	 		$foo['fonde'][]= $datareq6->nom." ".$datareq6->prenom ;

	 		$req6=$PDO->prepare("SELECT nom,prenom FROM newcourrier LEFT JOIN imputation ON newcourrier.id=imputation.idCourrier LEFT JOIN administrators ON imputation.idDesigne=administrators.id WHERE newcourrier.id=:id AND imputation.categorie=2 AND administrators.poste='responsable' AND administrators.idService=4");
	 		$req6->execute(array("id"=>$datareq->id));
	 		while($datareq7=$req6->fetch())
	 		$foo['chefserv'][]= $datareq7->nom." ".$datareq7->prenom ;


	 		$req7=$PDO->prepare("SELECT nom,prenom FROM newcourrier LEFT JOIN imputation ON newcourrier.id=imputation.idCourrier LEFT JOIN administrators ON imputation.idDesigne=administrators.id WHERE newcourrier.id=:id AND imputation.categorie=2 AND administrators.poste='agent' AND administrators.idService=4");
	 		$req7->execute(array("id"=>$datareq->id));
	 		while($datareq8=$req7->fetch())
	 		$foo['agentserv'][]= $datareq8->nom." ".$datareq8->prenom ;

	 		$foo = (object)$foo;
	 		$result1[]=$foo;
	 	}
	 	if(empty($result1))
	 		$result1=0;
	 	$finalResult[]=$result1;

	 	$_SESSION['archiveInfo']=$finalResult;
	}

		public function archivesInfoInternal(){
		global $PDO;
	 	$req=$PDO->prepare("SELECT id,reference,expediteur,destinataire,mailDest,objet,dateEnr,pieceDepart,pieceArrive,dateTrt,dateRedaction,urgence,numSuivi,delaiTraitement, DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrieraccc.dateEnr,'%Y-%m-%d'),INTERVAL courrieraccc.delaiTraitement DAY)) as dayRest,state FROM courrieraccc ORDER BY dateEnr DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result1[]=$datareq;
	 	if(empty($result1))
	 		$result1=0;
	 	$finalResult[]=$result1;

	 	$_SESSION['archivesInfoInternal']=$finalResult;
	}

public function courrierWarning(){
	global $PDO;

 if( ($_SESSION['AuthClient']->idService==1)  || (($_SESSION['AuthClient']->idService==1) && ($_SESSION['AuthClient']->poste=="responsable")) || (($_SESSION['AuthClient']->idService==1) && ($_SESSION['AuthClient']->poste=="secretaire")) || (($_SESSION['AuthClient']->idService==2) && ($_SESSION['AuthClient']->poste=="secretaire")) || (($_SESSION['AuthClient']->idService==2) && ($_SESSION['AuthClient']->poste=="responsable"))  )
 {

	$req=$PDO->query("SELECT newcourrier.id,piece,destinataire,expediteur,objet, DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(newcourrier.dateEnr,'%Y-%m-%d'),INTERVAL newcourrier.delaiTraitement DAY)) as dayRest FROM newcourrier WHERE DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(newcourrier.dateEnr,'%Y-%m-%d'),INTERVAL newcourrier.delaiTraitement DAY))>0 AND state=1 AND stateNotification=1");
	while($datareq=$req->fetch())
	$resultA[]=$datareq;
	if(empty($resultA))
		$resultA=0;
	
		$_SESSION['courrierWarning']=$resultA;
	$req->closeCursor();
 }
else
{
	$req=$PDO->prepare("SELECT newcourrier.id,piece,destinataire,expediteur,objet,  DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(newcourrier.dateEnr,'%Y-%m-%d'),INTERVAL newcourrier.delaiTraitement DAY)) as dayRest  FROM newcourrier LEFT JOIN imputation ON newcourrier.id=imputation.idCourrier WHERE DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(newcourrier.dateEnr,'%Y-%m-%d'),INTERVAL newcourrier.delaiTraitement DAY))>0 AND newcourrier.state=1 AND imputation.idDesigne=:idDesigne AND stateNotification=1");
	$req->execute(array("idDesigne"=>$_SESSION['adminInfo']->id));
	while($datareq=$req->fetch())
	$resultA[]=$datareq;
	if(empty($resultA))
		$resultA=0;

		$_SESSION['courrierWarning']=$resultA;
	$req->closeCursor();
}

}

	public function courrierArrive($idAdminPassed){
		global $PDO;
	 	$req=$PDO->prepare("SELECT id,reference,state,destinataire,stateNotification,expediteur,objet,dateEnr,piece,urgence,numSuivi,delaiTraitement, DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(newcourrier.dateEnr,'%Y-%m-%d'),INTERVAL newcourrier.delaiTraitement DAY)) as dayRest FROM newcourrier WHERE state<>2 ORDER BY dateEnr DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 	{
	 		$req1=$PDO->prepare("SELECT seen FROM imputation LEFT JOIN newcourrier ON imputation.idCourrier=newcourrier.id WHERE imputation.idDesigne=:idDesigne AND newcourrier.id=:idCourrier");
	 		$req1->execute(array("idDesigne"=>$idAdminPassed,"idCourrier"=>$datareq->id));
	 		$datareq2=$req1->fetch();
			$foo = (array)$datareq;
			 if($datareq2->seen=="")
	   		$foo['seen']=0;
			  else
			  $foo['seen'] = $datareq2->seen;
		    $foo = (object)$foo;

	 		$result1[]=$foo;
	 	}

	 	if(empty($result1))
	 		$result1=0;
	 	$finalResult[]=$result1;

	 	$_SESSION['courrierArrive']=$finalResult;
	}

		public function courrierDepart()
		{
		global $PDO;
	 	$req=$PDO->prepare("SELECT * FROM newcourrier WHERE state=2 ORDER BY dateEnr DESC");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result1[]=$datareq;
	 	if(empty($result1))
	 		$result1=0;
	 	$finalResult[]=$result1;

	 	$_SESSION['courrierDepart']=$finalResult;
	}

	public function courrierRoadInfo($idCourrier,$numSuivi)
	{
		global $PDO;
		$req=$PDO->prepare("SELECT client.nom,client.raisonSocial,courrier.idCourrier, courrier.recordDate, courrier.objetCourrier, courrier.state, courrier.delaiTraitement, courrier.treatedDate,service.nomService,suivicourrier.numSuivi,DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY) as datePrevueTraitement, courrier.Obs  FROM courrier LEFT JOIN service ON courrier.idService=service.idService LEFT JOIN suivicourrier ON courrier.idCourrier=suivicourrier.Idcourrier  LEFT JOIN client ON courrier.idExpediteur=client.id WHERE courrier.idCourrier=:idCourrier");
		$req->execute(array("idCourrier"=>$idCourrier));
	 	$datareq=$req->fetch();
	 	$_SESSION['singleCourrierInfo']=$datareq;
	 	$req->closeCursor();

	 	$req=$PDO->prepare("SELECT administrators.id,administrators.nom,administrators.prenom, passage.idPassage,passage.dateEnter,passage.dateExit,administrators.poste,service.nomService FROM passage LEFT JOIN administrators ON passage.idAdmin=administrators.id LEFT JOIN service ON administrators.idService=service.idService  WHERE passage.numSuiviCourrier=:suivi ORDER BY passage.dateExit DESC");
		$req->execute(array("suivi"=>$numSuivi));
	 	while($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['singleRoadCourrier']=$result;

	 	$req=$PDO->prepare("SELECT max(passage.idPassage) as maxPassage FROM passage WHERE passage.numSuiviCourrier=:suivi");
	 	$req->execute(array("suivi"=>$numSuivi));
	 	$datareq=$req->fetch();
	 	$resulMax->maximum=$datareq->maxPassage;

	 	$_SESSION['maximumPass']=$resulMax;
	 }
	 
	public function TaskInfo(){
	 	global $PDO;
	 	$req=$PDO->prepare("SELECT administrators.nom,administrators.prenom,tache.seenTache,tache.idInitiateur,tache.idExecuteur,tache.idTache,tache.descTache, tache.niveauUrgence, tache.numSuiviCourrier, tache.executionState, tache.dateDefinition, DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY)) as today FROM tache LEFT JOIN suivicourrier ON tache.numSuiviCourrier=suivicourrier.numSuivi LEFT JOIN courrier ON suivicourrier.Idcourrier=courrier.idCourrier LEFT JOIN administrators ON tache.idInitiateur=administrators.id");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['TaskInfo']=$result;
	 }

	 public function crInfo(){
	 	global $PDO;
	 	$req=$PDO->prepare("SELECT compterendu.idCompteRendu, compterendu.dateEdition, compterendu.contenu, compterendu.idTache, compterendu.state, tache.descTache, tache.idInitiateur,tache.numSuiviCourrier,administrators.id,administrators.nom,administrators.prenom,administrators.poste FROM compterendu LEFT JOIN tache ON compterendu.idTache=tache.idTache LEFT JOIN administrators ON tache.idExecuteur=administrators.id");
		$req->execute();
	 	while($datareq=$req->fetch())
	 		$result[]=$datareq;
	 	if(empty($result))
	 		$result=0;
	 	$_SESSION['crInfo']=$result;
	 }

}

$ManageAdmin= new ManageAdmin();