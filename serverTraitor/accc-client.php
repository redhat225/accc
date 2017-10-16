<?php
session_start();
header("Content-type: text/plain ; charset=utf-8");
require ('../vendor/autoload.php');
use PollingEntity\Validator;
use PollingEntity\NewCourrier;
use PollingEntity\Recover;
use PollingEntity\Worker;
use PollingEntity\Publisher;
use suiviClient\Entity;


if(isset($_POST['client-control']) && is_numeric($_POST['client-control'])) 
{
	$filterValidation=new Validator\FilterValidator();												
	if($filterValidation->switchInput($_POST['client-control']))
	{
				$swicthInput=$_POST['client-control'];
				foreach ($_POST as $value) {$filterValidation->MyFilter($value);}
				require_once('../bdConnect/accc-connect.php');

					switch ($swicthInput){

					case 1 :
								if($filterValidation->switchInput($_POST['login-client-content']))
								{
										$NewCourrier= new NewCourrier();
										$NewCourrier->setId($_POST['login-client-content']);
										$results=$NewCourrier->getInfoClient();
										if($results=="")
											echo "Le numéro identifiant de suivi fourni est probablement incorrect ou dû à un problème de connexion veuillez réessayer.";
										else{
											 if($results->state==1)
											 	echo "Le courrier numéro: ".$results->id." est en cours de traitement.";
											 if($results->state==2)
												echo "Le courrier portant le numéro: ".$results->id." a été traité et est disponible pour le retrait.";
											
										}
								}
								else
									echo "Coordonnées fournies incorrectes, veuillez réessayer.";
					break;
					case 2 : 
								if($filterValidation->loginValidation($_POST['password-admin-content']) && $filterValidation->NewsletterValidation( $_POST['login-admin-content']))
								{	
									$AuthClient = new Entity\AuthClient();
									if($AuthClient->loginAdmin($_POST))
									{
										if($_POST['flexpaper-content']!==""){
											if($filterValidation->flexFileValidator($_POST['flexpaper-content'])){
												$NewCourrier = new NewCourrier();
												$verdict=$NewCourrier->checkedFlexFile($_POST['flexpaper-content']);
												if($verdict)
													$reponse=$_POST['flexpaper-content'];
												else
													$reponse="ok";
											}else
											$reponse="ok";
										}else
										$reponse="ok";
									}
									else
										$reponse="ko";
									
									echo $reponse;
								}
								else
									echo "ko";
					break;

					case 3:
							if($filterValidation->NewsletterValidation($_POST['recovery-admin-content']))
							{		
									$Recover = new Recover();
									$idAdmin=$Recover->Administrator->getIdRecover($_POST['recovery-admin-content']);
									if(!(empty($idAdmin)))
									{			
											$token=md5(uniqid('',true));
											$Recover->settoken($token);
											$Recover->setidAdmin($idAdmin);
											if($Recover->registerRecover())
											{
												//$mailto=$_POST['recovery-admin-content'];
												array_push($_POST,$_POST['subject']="Réinitialisation de mot passe !");
											    array_push($_POST,$_POST['mailto']="remmanuel@vne-ci.com");

												$messageBody="Veuillez cliquer sur ce lien de réinitialisation pour recouvrer votre mot de passe http://accc.vne-ci.com/suiviAdmin/index.php?p=reset&token={$token}";

												array_push($_POST, $_POST['messageBody']="{$messageBody}");

												$Publisher = new Publisher('myTube');
												$Publisher->send($_POST);
												echo "Un lien de renitialisation de votre mot de passe vous a été envoyé par mail";
											}
											else
												echo "Erreur lors de l'envoi du lien de reinitialisation";
									}
									else
										echo "Cette addresse ne correspond à aucun administrateur";

							}else
							echo "Données fournies incorrectes";
					break;

					case 4:
							if($filterValidation->loginValidation($_POST['recovery-reset-content-confirm']) && ($filterValidation->tokenValidation($_POST['token'])))
							{		
								$Recover = new Recover();
								$Recover->settoken($_POST['token']);
								if($Recover->checkToken())
								{
									$idAdmin=$Recover->getIdAdmin();
									$Recover->Administrator->setIdAdmin($idAdmin);
									$Recover->Administrator->setPassword($_POST['recovery-reset-content-confirm']);
									if($Recover->Administrator->updateAdminPassword())
										if($Recover->deleteRecover())
											 echo $reponse="Réinitialisation réussi, veuillez-vous reconnecter avec votre nouveau mot de passe";
								}
								else
									echo "Données fournies inconformes/token supprimé.Veuillez réessayer";
							}
							else
								echo "Données fournies inconformes";
					break;

		


					}
	}


}

?>