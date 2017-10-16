<?php 
Namespace suiviClient\Entity;

class ManageClient{
	public function clientInfo($data){
		global $PDO;
		$req=$PDO->prepare("SELECT * FROM client WHERE client.id=:id");
		$req->execute(array("id"=>$data));
		$datareq=$req->fetchAll();
		$_SESSION['clientInfo']=$datareq[0];

	}

	public function accountClientInfo($idExp){
		global $PDO;
		$req=$PDO->prepare("SELECT count(courrier.idCourrier)as sendCourrier FROM courrier  WHERE courrier.idExpediteur=:idExp");
		$req->execute(array("idExp"=>$idExp));
		$result=$req->fetch();
		if(!isset($result->sendCourrier))
			$result->sendCourrier=0;
		$finalResult[]=$result;

		$req=$PDO->prepare("SELECT count(courrier.idCourrier)as treatedCourrier FROM courrier WHERE courrier.idExpediteur=:idExp AND courrier.state=3");
		$req->execute(array("idExp"=>$idExp));
		$result=$req->fetch();
		if(!isset($result->treatedCourrier))
			$result->treatedCourrier=0;
		array_push($finalResult, $result);
		
		$req=$PDO->prepare("SELECT count(courrier.idCourrier)as treatingCourrier FROM courrier WHERE courrier.idExpediteur=:idExp AND courrier.state=2");
		$req->execute(array("idExp"=>$idExp));
		$result=$req->fetch();
		if(!isset($result->treatingCourrier))
			$result->treatingCourrier=0;
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT count(courrier.idCourrier)as castCourrier FROM courrier WHERE courrier.idExpediteur=:idExp AND courrier.state=4");
		$req->execute(array("idExp"=>$idExp));
		$result=$req->fetch();
		if(!isset($result->castCourrier))
			$result->castCourrier=0;
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT round(sum(DATEDIFF(DATE_FORMAT(courrier.treatedDate,'%Y-%m-%d'),DATE_FORMAT(courrier.recordDate,'%Y-%m-%d')))/count(courrier.idCourrier),2) as tempsMoyenTraitement FROM courrier WHERE courrier.idExpediteur=:idExp AND courrier.state>2");
		$req->execute(array("idExp"=>$idExp));
		$result=$req->fetch();
		if(!isset($result->tempsMoyenTraitement))
			$result->tempsMoyenTraitement=0;
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT count(courrier.idCourrier) as timeout FROM courrier WHERE DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY)<DATE_FORMAT(NOW(),'%Y-%m-%d') AND courrier.idExpediteur=:idExp AND courrier.state<3");
		$req->execute(array("idExp"=>$idExp));
		$result=$req->fetch();
		if(!isset($result->timeout))
			$result->timeout=0;
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT count(courrier.idCourrier)as depotCourrier FROM courrier WHERE courrier.idExpediteur=:idExp AND courrier.state=1");
		$req->execute(array("idExp"=>$idExp));
		$result=$req->fetch();
		if(!isset($result->depotCourrier))
			$result->depotCourrier=0;
		array_push($finalResult, $result);

		$req=$PDO->prepare("SELECT count(suggestion.idSuggest)as sendSuggest FROM suggestion LEFT JOIN courrier ON suggestion.idCourrier=courrier.idCourrier  WHERE courrier.idExpediteur=:idExp");
		$req->execute(array("idExp"=>$idExp));
		$result=$req->fetch();
		if(!isset($result->sendSuggest))
			$result->sendSuggest=0;
		array_push($finalResult,$result);


		$_SESSION['accountClientInfo']=$finalResult;
	}

	public function courrierInfo($idExp)
	 {
		global $PDO;
		$req=$PDO->prepare("SELECT courrier.idCourrier, courrier.recordDate, courrier.objetCourrier, courrier.state, courrier.delaiTraitement, courrier.treatedDate,service.nomService,suivicourrier.numSuivi,DATE_ADD(DATE_FORMAT(courrier.recordDate,'%Y-%m-%d'),INTERVAL courrier.delaiTraitement DAY) as datePrevueTraitement, courrier.Obs  FROM courrier LEFT JOIN service ON courrier.idService=service.idService LEFT JOIN suivicourrier ON courrier.idCourrier=suivicourrier.Idcourrier  WHERE courrier.idExpediteur=:idExp");
		$req->execute(array("idExp"=>$idExp));
	 	$datareq=$req->fetchAll();
	 	if(empty($datareq))
	 	$datareq=0;
		$_SESSION['courrier']=$datareq;
	 }
}

$ManageClient=new ManageClient();
