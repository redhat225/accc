<?php 
session_start();
header("Content-type: text/plain : charset=utf-8");
require_once ('../bdConnect/accc-connect.php');
global $PDO;
 if( ($_SESSION['adminInfo']->idService==1)  || (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) || (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="secretaire")) || (($_SESSION['adminInfo']->idService==2) && ($_SESSION['adminInfo']->poste=="secretaire")) || (($_SESSION['adminInfo']->idService==2) && ($_SESSION['adminInfo']->poste=="responsable"))  )
 {
	$req=$PDO->query("SELECT count(id) as nbreCourrierWarning FROM newcourrier WHERE DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(newcourrier.dateEnr,'%Y-%m-%d'),INTERVAL newcourrier.delaiTraitement DAY))>0 AND state=1 AND stateNotification=1");
	$datareq=$req->fetch();
	$result=$datareq->nbreCourrierWarning;
	if(empty($result))
		$result=0;
	$req->closeCursor();
 }
 else
 {
	$req=$PDO->prepare("SELECT count(newcourrier.id) as nbreCourrierWarning FROM newcourrier LEFT JOIN imputation ON newcourrier.id=imputation.idCourrier WHERE DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_ADD(DATE_FORMAT(newcourrier.dateEnr,'%Y-%m-%d'),INTERVAL newcourrier.delaiTraitement DAY))>0 AND newcourrier.state=1 AND imputation.idDesigne=:idDesigne AND stateNotification=1");
	$req->execute(array("idDesigne"=>$_SESSION['AuthClient']->id));
	$datareq=$req->fetch();
	$result=$datareq->nbreCourrierWarning;
	if(empty($result))
		$result=0;
	$req->closeCursor();

 }

echo $result;
 ?>
