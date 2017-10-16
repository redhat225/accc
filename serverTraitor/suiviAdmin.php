<?php
session_start();
header("Content-type: text/plain ; charset=utf-8");
require ('../vendor/autoload.php');
use PollingEntity\Validator\FilterValidator;
use PollingEntity\Client;
use PollingEntity\Passage;
use PollingEntity\CompteRendu;
use PollingEntity\Tache;
use PollingEntity\Suggestion;
use PollingEntity\Administrator;
use PollingEntity\SuiviCourrier;
use PollingEntity\Notification;
use PollingEntity\Courrier;
use PollingEntity\Push;
use PollingEntity\Imputation;
use Zend\Validator\File;
use PollingEntity\Worker;
use PollingEntity\Publisher;
use PollingEntity\CourrierAccc;
use PollingEntity\ClientAccc;
use PollingEntity\NewCourrier;

if(isset($_POST['admin-control']) && is_numeric($_POST['admin-control'])) 
{

	$filterValidation=new FilterValidator();												
	if($filterValidation->switchInput($_POST['admin-control']))
	{
				$swicthInput=$_POST['admin-control'];
				foreach ($_POST as $value) {$filterValidation->MyFilter($value);}
				require_once('../bdConnect/accc-connect.php');

					switch ($swicthInput){

					case 1 : 
					
								 if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<3000000)
														{	

															$validator= new File\MimeType('image/jpeg,image/png,image/gif');
															
															if($validator->isValid($_FILES["avatar"]))
															{


																
																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];

																$valid=true;

																switch ($extension) {
																	case 'jpg':
																			$imageChoisie=imagecreatefromjpeg($_FILES["avatar"]["tmp_name"]);
																		break;
																	case 'jpeg':
																			$imageChoisie=imagecreatefromjpeg($_FILES["avatar"]["tmp_name"]);
																		break;
																	
																	case 'png':
																			$imageChoisie=imagecreatefrompng($_FILES["avatar"]["tmp_name"]);
																	break;

																	case 'gif':
																			$imageChoisie=imagecreatefromgif($_FILES["avatar"]["tmp_name"]);
																	break;

																	default:
																		$valid=false;
																	break;
																}
																
																	if($valid)
																	{
																						
																		$OriginalimageSize=getimagesize($_FILES["avatar"]["tmp_name"]);
																		$fixedL=200;
																		$ratioP=(($fixedL*100)/$OriginalimageSize[0]);
																		$newH=(($OriginalimageSize[1] * $ratioP)/100);

																		$nouvelleImage=imagecreatetruecolor($fixedL, $newH) or die ("erreur");

																		imagecopyresampled($nouvelleImage, $imageChoisie, 0, 0, 0, 0, $fixedL, $newH, $OriginalimageSize[0], $OriginalimageSize[1]);

																		$nameFile=md5(uniqid('',true));
																		$ext=strrchr($_FILES['avatar']['name'],'.');
																		$nameFile.=$ext;

																		
																			$Administrator=new Administrator();
																			$Administrator->setIdAdmin($_SESSION['adminInfo']->id);
																			$Administrator->setAvatar($nameFile);
																			if($Administrator->UpdateAvatar())
																				{

																																										
																					    imagedestroy($imageChoisie);

																					    $transmit=true;
																						switch ($extension) 
																						{
																							case 'jpg':
																								if(!imagejpeg($nouvelleImage,"../suiviAdmin/suiviAdmin-img/avatar/{$nameFile}",100))
																								$transmit=false;
																							break;
																							case 'jpeg':
																								if(!imagejpeg($nouvelleImage,"../suiviAdmin/suiviAdmin-img/avatar/{$nameFile}",100))
																								$transmit=false;
																							break;
																							case 'png':
																								if(!imagepng($nouvelleImage,"../suiviAdmin/suiviAdmin-img/avatar/{$nameFile}",100))
																								$transmit=false;
																								break;
																							case 'gif':
																								if(!imagegif($nouvelleImage,"../suiviAdmin/suiviAdmin-img/avatar/{$nameFile}",100))
																								$transmit=false;
																							break;
																							default:
																								$transmit=false;
																							break;
																						}

																						if($transmit)
																						{	
																							$oldAvatar=$_SESSION['adminInfo']->avatar;
																							if(!empty($oldAvatar))
																							{
																							$opendir=opendir("../suiviAdmin/suiviAdmin-img/avatar");
																							if(file_exists("../suiviAdmin/suiviAdmin-img/avatar/$oldAvatar"))
																							unlink("../suiviAdmin/suiviAdmin-img/avatar/$oldAvatar");
																							closedir($opendir);
																							}

																							echo"Photo de profil actualisé";
																							// $Administrator->Notification->setIdTypeNotification(1);
																							// $Administrator->Notification->setIdInitiateur($_SESSION['AdminInfo']->id);
								
																							// if($Administrator->Notification->registerNotification())
																							// 	echo "Changements éffectués. Veuillez rafraichir la page pour constater les changements";
																							// else
																							// 	echo "Changements éffectués mais non inscrits aux notifications courantes";		

																							
																						}
																						else
																							echo "Fichier non transmis";	


																				}
																				else
																					echo "Erreur de la base veuillez réessayer";
																		
					
																	}
																	else
																		echo "Le fichier est correct mais l'extension est mal définie";
															}
															else
																echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Fichier non Uploadé correctement";	
								
					break;   

					case 2 :

							  if($filterValidation->loginValidation($_POST['admin-suivi-new-Password']))
											{
													$Administrator = new Administrator();
													$Administrator->setIdAdmin($_SESSION['adminInfo']->id);
													$Administrator->setPassword($_POST['admin-suivi-new-Password']);
													
													if($Administrator->updateAdminPassword())
														echo "Changements éffectués. Veuillez-vous reconnecter pour constater les changements";
													else
														echo "Une érreur est survenue lors de l'enregistrement veuillez réessayer";


									 }
									 else
									 	echo "Validation Incorrecte";
					   break;

					case 3:

												 	 		$RegisterAdmin= new Administrator();

												 	 		$RegisterAdmin->setRole(1);
															$RegisterAdmin->setName($_POST['suivi-member-register-name']);
															$RegisterAdmin->setLastName($_POST['suivi-member-register-surname']);
															$RegisterAdmin->setLogin($_POST['suivi-member-register-mail']);
															$RegisterAdmin->setPassword("00000000");
															$RegisterAdmin->setidService($_POST['suivi-member-register-service']);
															$RegisterAdmin->setposte($_POST['suivi-admin-register-access']);
															$RegisterAdmin->setFonction($_POST['suivi-member-register-fonction']);

															if($_POST['suivi-admin-register-sce-responsible']!=="")
																$RegisterAdmin->setIdResponsible($_POST['suivi-admin-register-sce-responsible']);
															else
																$RegisterAdmin->setIdResponsible(0);

															if($RegisterAdmin->RegisterAdmin()){
																				//Enregistrement de la notification
																unset($_POST['admin-control']);
																$_POST['suivi-member-register-name']="Nom: ".$_POST['suivi-member-register-name'];
																$_POST['suivi-member-register-surname']="Prenom: ".$_POST['suivi-member-register-surname'];
																$_POST['suivi-member-register-mail']="Login: ".$_POST['suivi-member-register-mail'];
																$_POST['suivi-admin-register-access']="Poste: ".$_POST['suivi-admin-register-access'];
																$_POST['suivi-member-register-fonction']="Fonction: ".$_POST['suivi-member-register-fonction'];

																switch ($_POST['suivi-member-register-service']) {
																	case 1:
																		$_POST['suivi-member-register-service']="Service: Service Courrier";
																	break;

																	case 2:
																		$_POST['suivi-member-register-service']="Service: Secretariat & Bureau AC";
																	break;

																	case 3:
																		$_POST['suivi-member-register-service']="Service: Secretariat & Bureau Fonde";
																	break;

																	case 4:
																		$_POST['suivi-member-register-service']="Service: Secretariat & Bureau Chef Sce";
																	break;
																}

																if($_POST['suivi-admin-register-sce-responsible']!=="")
																{
																$fullInfoResponsible=$RegisterAdmin->getNameResp($_POST['suivi-admin-register-sce-responsible']);
																$_POST['suivi-admin-register-sce-responsible']="Responsable: ".$fullInfoResponsible->nom." ".$fullInfoResponsible->prenom." Poste Responsable: ".$fullInfoResponsible->poste;
																}
															


																				$Notification = new Notification();
																				$infoLog=json_encode($_POST);
																				$Notification->setContenu($infoLog);
																				$Notification->setIdTypeNotification(11);
																				$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																				$Notification->registerNotification();
																				echo $reponse="ok";	
															}
																else
																	echo "L'enregistrement a échoué veuillez réessayer";

					break;


					case 4:


												 	 		$RegisterAdmin= new Administrator();
												 	 		$RegisterAdmin->setIdAdmin($_POST['suivi-alter-adminId']);
															$RegisterAdmin->setName($_POST['suivi-alter-admin-name']);
															$RegisterAdmin->setLastName($_POST['suivi-alter-admin-surname']);
															$RegisterAdmin->setLogin($_POST['suivi-alter-admin-login']);
															$RegisterAdmin->setidService($_POST['service-alter-selection']);
															$RegisterAdmin->setposte($_POST['acces-alter-selection']);
															$RegisterAdmin->setFonction($_POST['suivi-member-register-alter-fonction']);

															if($_POST['suivi-admin-register-sce-responsible-alter']!=="")
																$RegisterAdmin->setIdResponsible($_POST['suivi-admin-register-sce-responsible-alter']);
															else
																$RegisterAdmin->setIdResponsible(0);

															if($RegisterAdmin->updateAdmin())
																	{
																				//Enregistrement de la notification
																				unset($_POST['admin-control']);
																				$_POST['suivi-alter-admin-name']="Nom: ".$_POST['suivi-alter-admin-name'];
																				$_POST['suivi-alter-admin-surname']="Prenom: ".$_POST['suivi-alter-admin-surname'];
																				$_POST['suivi-alter-admin-login']="Login: ".$_POST['suivi-alter-admin-login'];
																				$_POST['acces-alter-selection']="Poste: ".$_POST['acces-alter-selection'];

																	switch ($_POST['service-alter-selection']) {
																	case 1:
																		$_POST['service-alter-selection']="Niveau: Service Courrier";
																	break;

																	case 2:
																		$_POST['service-alter-selection']="Niveau: Secretariat & Bureau AC";
																	break;

																	case 3:
																		$_POST['service-alter-selection']="Niveau: Secretariat & Bureau Fonde";
																	break;

																	case 4:
																		$_POST['service-alter-selection']="Niveau: Secretariat & Bureau Chef Sce";
																	break;
																}

																if($_POST['suivi-admin-register-sce-responsible-alter']!=="")
																{
																$fullInfoResponsible=$RegisterAdmin->getNameResp($_POST['suivi-admin-register-sce-responsible-alter']);
																$_POST['suivi-admin-register-sce-responsible-alter']="Responsable: ".$fullInfoResponsible->nom." ".$fullInfoResponsible->prenom." Poste Responsable: ".$fullInfoResponsible->poste;
															    }
																				$Notification = new Notification();
																				$infoLog=json_encode($_POST);
																				$Notification->setContenu($infoLog);
																				$Notification->setIdTypeNotification(12);
																				$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																				$Notification->registerNotification();
																				echo $reponse="ok";
																	}
																else
																	echo "La modification de l'administrateur a échoué veuillez réessayer";
					break;

					case 5:	
					//supprimer membre
					   					if( $filterValidation->switchInput($_POST['idMember']))
					   					{
					   									$Administrator = new Administrator();
													 	$Administrator->setIdAdmin($_POST['idMember']);
													 	$fullInfoResponsible=$Administrator->getNameResp($_POST['idMember']);
												 	 	if($Administrator->DeleteAdmin())
												 	 	{
								   							$deletedAvatarAdmin=$_POST['adminAvatar'];
															if(!empty($deletedAvatarAdmin))
																{
																	$opendir=opendir("../suiviAdmin/suiviAdmin-img/avatar");
																	if(file_exists("../suiviAdmin/suiviAdmin-img/avatar/$deletedAvatarAdmin"))
																	unlink("../suiviAdmin/suiviAdmin-img/avatar/$deletedAvatarAdmin");
																	closedir($opendir);
																	$done=true;
																	if($done)
																	{
																				//Enregistrement de la notification
																				unset($_POST['admin-control']);
																				unset($_POST['idMember']);
																				unset($_POST['adminAvatar']);
																				$Notification = new Notification();
																				$infoLog=json_encode($_POST);
																				$Notification->setContenu($infoLog);
																				$Notification->setIdTypeNotification(13);
																				$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																				$Notification->registerNotification();
																				echo $reponse="ok";
																	}
																}
																	
												 	 	}
												 	 		
												 	 	else
												 	 		echo $reponse="La suppression de l'administrateur a échuoé veuillez réessayer";

					   					}else
					   						echo "Données fournies incorrectes";

					break;


					case 6:
					//ajouter un client
					   		if($filterValidation->registerNewClientValidation($_POST))
					   		{


													$Client = new Client();
													if($Client->verifLoginClient($_POST['suivi-client-register-login']))
													{

														$Client->setPhone($_POST['suivi-client-register-phone']);
														$Client->setRaison($_POST['raison-client-register-selection']);
														$Client->setnomClient($_POST['suivi-client-register-name']);
														$Client->setmdp("00000000");
														$Client->setrole_id(2);
														$Client->setlogin($_POST['suivi-client-register-login']);
														$Client->setmail($_POST['suivi-client-register-email']);

														if($Client->registerClient())
														{
																$Notification = new Notification();
																unset($_POST['admin-control']);
																$infoLog=json_encode($_POST);

																$Notification->setContenu($infoLog);
																$Notification->setIdTypeNotification(4);
																$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																if($Notification->registerNotification())
																			echo "Client enregistré";
														}
														
															else
																echo "L'enregistrement du client a échoué veuillez réessayer";
													}
													else
														echo "Login déja attribué veuillez le changer";


					   		}
					   		else
					   			echo "Données fournies inconformes";
					break;

					case 7: 
						//modifier un client
							if($filterValidation->registerNewClientValidation($_POST))
						   		{

													$Client = new Client();
													if(!($Client->verifUpdateLoginClient($_POST['suivi-client-register-login'])))
													{
														$Client->setIdClient($_POST['suivi-alter-client']);
														$Client->setPhone($_POST['suivi-client-register-phone']);
														$Client->setRaison($_POST['raison-client-register-selection']);
														$Client->setnomClient($_POST['suivi-client-register-name']);
														$Client->setlogin($_POST['suivi-client-register-login']);
														$Client->setmail($_POST['suivi-client-register-email']);

														if($Client->updateInfoClient())
														{
																$Notification = new Notification();
																unset($_POST['admin-control']);
																$infoLog=json_encode($_POST);

																$Notification->setContenu($infoLog);
																$Notification->setIdTypeNotification(5);
																$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																if($Notification->registerNotification())
																	echo $reponse="ok";
														}
															
														else
															echo "L'enregistrement du client a échoué veuillez réessayer";

													}
													else
														echo "Login déja attribué veuillez le changer";
					   			
						   		}
					   		else
					   			echo "Données fournies inconformes";
					break;  

					case 8:
						//retirer un client
								if($filterValidation->switchInput($_POST['idMember']))
						   		{

													$Client = new Client();
													$Client->setIdClient($_POST['idMember']);
													if($Client->deleteClient())
													{
																$Notification = new Notification();
																unset($_POST['admin-control']);
																$infoLog=json_encode($_POST);

																$Notification->setContenu($infoLog);
																$Notification->setIdTypeNotification(6);
																$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																if($Notification->registerNotification())
																		echo $reponse="ok";
													}
													
													else
														echo "L'opération de suppression du client a échoué veuillez réessayer";
					   			
						   		}
					   		else
					   			echo "Données fournies inconformes";
					break;


					case 9:
	   							if($filterValidation->TextAreaValidation($_POST['push-message-content']))
	   							{
	   								if(isset($_POST['destinataire']))
	   								{			$validationContact=true;
			   									foreach ($_POST['destinataire'] as $value) {
			   									if($filterValidation->switchInput($value)==false)
			   										$validationContact=false;
			   								}

			   								if($validationContact)
			   								{
	
									   						$allSend=true;
									   						foreach ($_POST['destinataire'] as $value) {
									   							$PushMessage = new Push();
									   							$PushMessage->setIdExp($_SESSION['adminInfo']->id);
									   							$PushMessage->setIdDest($value);
									   							$PushMessage->setIdBox($_SESSION['adminInfo']->id);
									   							$PushMessage->setMessagePush($_POST['push-message-content']);
									   							$PushMessage->setStatePush(2);
									   							if(!($PushMessage->RegisterPush()))
									   								$allSend=false;

									   							$PushMessage->setIdBox($value);
									   							$PushMessage->setStatePush(0);

									   							if(!($PushMessage->RegisterPush()))
									   								$allSend=false;

									   						}

									   						if($allSend)
									   							echo "Message(s) envoyé(s) et enregistré dans la boite d'envoi";
									   						else
									   							echo "Votre message n'a probablement pas été envoyé ou reçu par vos destinataires";
									   						

			   								}
			   								else
			   									echo "contact inconforme";
	   								}else
	   								echo "contact non spécifié";

	   							}else
	   							echo "Données fournies inconformes";
	   					break;

	   					case 10:
	   							$Push = new Push();
	   							$Push->setIdDest($_SESSION['adminInfo']->id);
								$Push->setIdBox($_SESSION['adminInfo']->id);
								$Push->setDateSend($_POST['latenceTime']);
	   						    $pushCollected=$Push->ReactPush();
	   						    $pushCollected=(int)$pushCollected;
	   						    echo $pushCollected;				
																	
	   					break;
	   					
	   					case 11:	
	   							$Push = new Push();
	   							$Push->setIdDest($_SESSION['adminInfo']->id);
								$Push->setIdBox($_SESSION['adminInfo']->id);
								$PushCollected=$Push->getUnreadPush();
								$PushCollected=(int)$PushCollected;
								echo $PushCollected;
	   					break;	


					case 12:
							 if($filterValidation->TextAreaValidation($_POST['register-courrier-objet']) && $filterValidation->switchInput($_POST['register-courrier-exp']))
							 {
									$Administrator = new Administrator();
								   	$Administrator->setIdAdmin($_SESSION['adminInfo']->id);	
												if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																		$nameFile=md5(uniqid('',true));
																		$ext=strrchr($_FILES['avatar']['name'],'.');
																		$nameFile.=$ext;

																		if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																		{

																			$Courrier = new Courrier();
																				$Courrier->setDelay(15);
																				$Courrier->setState(2);
																				$Courrier->setObjet($_POST['register-courrier-objet']);
																				$Courrier->setPieceJointe($nameFile);
																				$Courrier->setExpediteur($_POST['register-courrier-exp']);
																				$Courrier->setNiveauUrgence($_POST['register-courrier-urgence']);
																					if($Courrier->registerCourrier())
																					{
																						$idCourrier=$Courrier->getIdCourrier();
																						$Passage =new Passage();
																						$numeroSuivi=$Passage->SuiviCourrier->buildSuivi($_POST['register-courrier-exp']);
																						$Passage->SuiviCourrier->setIdSuivi($numeroSuivi);
																						$Passage->SuiviCourrier->setIdCourrier($idCourrier);
																						if($Passage->SuiviCourrier->RegisterNumSuivi())
																						{
																							$Passage->setIdAdmin($_SESSION['adminInfo']->id);
																							$Passage->setnumSuivi($numeroSuivi);
																											if($Passage->entryPassage())
																												{

																															$done=true;

																															if($done)
																															{
																																// $Notification = new Notification();
																																// unset($_POST['admin-control']);

																																// $infoLog=json_encode($_POST);

																																// $Notification->setContenu($infoLog);
																																// $Notification->setIdTypeNotification(8);
																																// $Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																																// if($Notification->registerNotification())
																																// {
																			//array_push($_POST,$_POST['sujet']="Agentcomptable@tresoraccc.net");

																																	array_push($_POST,$_POST['numSuivi']="{$numeroSuivi}");

																																		$ladate=date('d-m-Y H:i:s');
																																		array_push($_POST, $_POST['ladate']="{$ladate}");

																																		$Publisher = new Publisher('myTube');
																																		$Publisher->send(json_encode($_POST));
																																// }
																																echo $_POST['sujet'];
																															}
																												}
																											else
																												echo "Courrier Enregistré, Passage non renseigné";
																						}
																						else
																						  echo"L'enregistrement du numéro de suivi a échoué";
																					}
																					else
																					echo "L'enregistrement du courrier a échoué veuillez réessayer";

																		}
																		else
																			echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Fichier non Uploadé correctement";	
							 }
							 else
							 	echo "Données fournies inconformes";								
					break;   


					case 13:
						//enregistrement tache
						if($filterValidation->TextAreaValidation($_POST['suivi-task-register-desc']) && $filterValidation->TextAreaValidation($_POST['numSuivi-courrier-task']) && $filterValidation->switchInput($_POST['suivi-task-register-level']) && $filterValidation->switchInput($_POST['suivi-task-executor']))
						{

										$Tache = new Tache();
										$Tache->setstateExecution(0);
										$Tache->setDescriptif($_POST['suivi-task-register-desc']);
										$Tache->setLevPass($_POST['suivi-task-register-level']);
										$Tache->setNumSuivi($_POST['numSuivi-courrier-task']);
										$Tache->setidInitiateur($_SESSION['adminInfo']->id);
										$Tache->setidExecutor($_POST['suivi-task-executor']);

										if($Tache->registerTask())
											echo "Tache enregistrée avec succes";
										else
											echo "Enregistrement de la tache échoué"; 									

						}
						else
							echo "Donées fournies inconformes";

					break;

					case 14:
						//modification de la tache
						if($filterValidation->TextAreaValidation($_POST['suivi-task-alter-desc']) && $filterValidation->switchInput($_POST['alter-task-id-content'])&& $filterValidation->switchInput($_POST['suivi-task-alter-register-level']) && $filterValidation->switchInput($_POST['suivi-task-executor']))
						{

										$Tache = new Tache();
										$Tache->setiDTache($_POST['alter-task-id-content']);
										$Tache->setidInitiateur($_SESSION['adminInfo']->id);
										$Tache->setidExecutor($_POST['suivi-task-executor']);
										$Tache->setDescriptif($_POST['suivi-task-alter-desc']);
										$Tache->setLevPass($_POST['suivi-task-alter-register-level']);
										if($Tache->updateTask())
											echo $reponse="ok";
										else
											echo "L'opération de modification a échoué";



						}
						else
							echo "Donées fournies inconformes";
					break;

					case 15:
						//marqué comme executé
							if($filterValidation->TextAreaValidation($_POST['suivi-task-done-desc']) && $filterValidation->switchInput($_POST['task-done-id-content']))
							{	

										$CompteRendu = new CompteRendu();
										$CompteRendu->setidTache($_POST['task-done-id-content']);
										$CompteRendu->setContenu($_POST['suivi-task-done-desc']);
										$CompteRendu->setseen(0); 
										if($CompteRendu->RegisterCompteRendu())
										{
											$CompteRendu->Tache->setiDTache($_POST['task-done-id-content']);
											$CompteRendu->Tache->setstateExecution(1);
											if($CompteRendu->Tache->updateStateTask())
												echo $reponse="ok";
											else
												echo "Compte rendu enregistré mais tache non actualisée";
										}
										else
											echo "Le compte rendu n'a pas été enregistré";

							}else
							echo "Données fournies inconformes";
					break;

					case 16:
						//supprimer la tache
						if($filterValidation->switchInput($_POST['idTask']))
						{


										$CompteRendu = new CompteRendu();
										$CompteRendu->Tache->setiDTache($_POST['idTask']);
										if($CompteRendu->Tache->deleteTask())
											{
												$CompteRendu->setidTache($_POST['idTask']);
												if($CompteRendu->deleteCompteRendu())
													echo $reponse="ok";
												else
													echo "La tâche a été supprimé mais le compte rendu reste visible, prière de le supprimer";
											}
										else
											echo"L'opération de suppression a échoué";									

						}
						else
							echo "Donées fournies inconformes";

					break;

					case 17:
						//décocher tache exécutée
						if( $filterValidation->switchInput($_POST['idTaskDeleteCr']) )
							{	

										$CompteRendu = new CompteRendu();
										$CompteRendu->Tache->setiDTache($_POST['idTaskDeleteCr']);
										$CompteRendu->Tache->setstateExecution(0);
											
											if($CompteRendu->Tache->updateStateTask())
											{	
												$CompteRendu->setidTache($_POST['idTaskDeleteCr']);
												if($CompteRendu->deleteCompteRendu())
													echo $reponse="ok";
												else
													echo "Le retrait du compte rendu a échoué veuillez le supprimer de puis la page dédiée";
											}
											else
												echo "L'oération a échoué veuillez réessayer";
							}else
							echo "Données fournies inconformes";
					break;

					case 18:
						//modification compte-rendu
					 if($filterValidation->TextAreaValidation($_POST['suivi-alter-cr-desc']) && $filterValidation->switchInput($_POST['id-cr-alter']))
						{

										$CompteRendu = new CompteRendu();
										$CompteRendu->setIdCr($_POST['id-cr-alter']);
										$CompteRendu->setContenu($_POST['suivi-alter-cr-desc']);

										if($CompteRendu->alterCompteRendu())
											echo $reponse="ok";
										else
											echo "Actualisation du compte rendu éhoué veuillez réessayer";

						}
						else
							echo "Données fournies inconformes";

					break;

					case 19:
						//marqué le cr comme lu
						if($filterValidation->switchInput($_POST['idCr']))
						{
							$CompteRendu = new CompteRendu();
							$CompteRendu->setIdCr($_POST['idCr']);
							if($CompteRendu->tagSeenCr())
								echo $reponse="ok";
							else
								echo "L'actualisation a échouée";
						}
						else
							echo "Données fournies incorrecets";
					break;

					case 20:
						//marqué le cr comme non-lu*
						if($filterValidation->switchInput($_POST['idCr']))
						{
							$CompteRendu = new CompteRendu();
							$CompteRendu->setIdCr($_POST['idCr']);
							if($CompteRendu->UnSeenCr())
								echo $reponse="ok";
							else
								echo "L'actualisation a échouée";
						}
						else
							echo "Données fournies incorrecets";
					break;

					case 21:
						//seenSuggest
						if($filterValidation->switchInput($_POST['idSuggest']))
						{
							$Suggestion = new Suggestion();
							$Suggestion->setIdSuggest($_POST['idSuggest']);
							if($Suggestion->tagSeenSuggest())
								echo $reponse="ok";
							else
								echo "L'actualisation a échouée";
						}
						else
							echo "Données fournies incorrecets";
					break;

					case 22:
						//unseenSuggest
						if($filterValidation->switchInput($_POST['idSuggest']))
						{
							$Suggestion = new Suggestion();
							$Suggestion->setIdSuggest($_POST['idSuggest']);
							if($Suggestion->UnSeenSuggest())
								echo $reponse="ok";
							else
								echo "L'actualisation a échouée";
						}
						else
							echo "Données fournies incorrecets";
					break;
					
					case 23:
						//réassigner un courrier
						if ($filterValidation->switchInput($_POST['assigning-courrier-suivi']) && $filterValidation->switchInput($_POST['assigning-courrier-service']))
						{

										$Courrier = new Courrier();
										$Courrier->setidService($_POST['assigning-courrier-service']);
										$Courrier->setIdCourrier($_POST['assigning-courrier-suivi']);
										if($Courrier->setService())
										{
											$Notification = new Notification();
																																						
											unset($_POST['admin-control']);
											$infoLog=json_encode($_POST);

											$Notification->setContenu($infoLog);
											$Notification->setIdTypeNotification(11);
											$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
											if($Notification->registerNotification())
											echo $reponse="ok";
										}
											else
												echo "Opération échouée veuillez réessayer";
						}
					break;


					case 24:
					
					
					
							//enregistrer courrier en sortie
							if($filterValidation->TextAreaValidation($_POST['sortie-courrier-obs']) && $filterValidation->TextAreaValidation($_POST['sortie-courrier-suivi']))
							{

										  	 	if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																$nameFile=md5(uniqid('',true));
																$ext=strrchr($_FILES['avatar']['name'],'.');
																$nameFile.=$ext;
																//recherche de l'ancienne piece jointe (courrier départ)
																$Courrier = new Courrier();
																$oldPiece=$Courrier->getPieceJointe($_POST['sortie-courrier-suivi']);																								
																$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
																if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece"))
																unlink("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece");
																closedir($opendir);

																				if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																				{
																					$CourrierPieces = new Courrier();
																					$idCourrier=$CourrierPieces->getCourrierId($_POST['sortie-courrier-suivi']);
																					$CourrierPieces->setIdCourrier($idCourrier);
																					$CourrierPieces->setPieceJointe($nameFile);
																					$CourrierPieces->setObs($_POST['sortie-courrier-obs']);
																					if($CourrierPieces->courrierSortieRegister())
																					{

																							$SuiviCourrier=new SuiviCourrier();
																							$SuiviCourrier->setIdCourrier($idCourrier);
																							$numeroSuivi=$SuiviCourrier->getNumeroSuivi();
																							array_push($_POST,$_POST['subject']="Enregistrement Courrier Client Départ!");
																							array_push($_POST,$_POST['numSuivi']="{$numeroSuivi}");
																							$Publisher = new Publisher('myTube');
																							$Publisher->send($_POST);
																						echo $reponse="ok";
																					}else
																					echo "L'Enregistrement du courrier en sortie a échoué";
																				}
																				else
																					echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Pas de pieces jointes spécifiée ,";								
							}
							else
								echo "Données fournies inconformes";
					break;

					case 25:								
															
															
							 if($filterValidation->TextAreaValidation($_POST['alter-register-courrier-objet']))
							 {

										  	 	if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																$nameFile=md5(uniqid('',true));
																$ext=strrchr($_FILES['avatar']['name'],'.');
																$nameFile.=$ext;

																$oldPiece=$_POST['id-alter-scan-courrier'];																									
																$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
																if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece"))
																unlink("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece");
																closedir($opendir);


																				if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																				{
																					$CourrierPieces = new Courrier();
																					$CourrierPieces->setIdCourrier($_POST['id-alter-register-courrier']);
																					$CourrierPieces->setPieceJointe($nameFile);
																					$CourrierPieces->alterCourrierPieces();
																					$done=true;
																					if($done)
																					{
																						echo $reponse="pièce jointe modifiée ";
																					}
																				}
																				else
																					echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Pas de pieces jointes spécifiée ,";


													$Courrier = new Courrier();
													$Courrier->setIdCourrier($_POST['id-alter-register-courrier']);
													$Courrier->setObs($_POST['alter-register-courrier-objet']);

														if($Courrier->alterCourrierInfo())
														{
															echo "modifications terminées veuillez rafraichir la page";
														}
														else
														echo "La modfication du courrier a échoué veuillez réessayer";	


							 }
							 else
							 	echo "Données fournies inconformes";								
					break;   

					case 26:
						//suppression courrier
						if($filterValidation->switchInput($_POST['idCourrier']) && $filterValidation->TextAreaValidation($_POST['numSuivi']))
						{
							$SuiviCourrier = new SuiviCourrier();
							$SuiviCourrier->Courrier->setIdCourrier($_POST['idCourrier']);
							$stateTreatment=$SuiviCourrier->Courrier->getStateCourrier();
							$state=(int)$stateTreatment;
							if($_SESSION['adminInfo']->acces==2)
							{
								if($SuiviCourrier->Courrier->deleteCourrier())
								{	
									$SuiviCourrier->setIdSuivi($_POST['numSuivi']);
									if($SuiviCourrier->deleteSuiviCourrier())
									{
										$pathPieceJointe=$_POST['pathScan'];
										$opendir=opendir("../suiviAdmin/suiviAdmin-img/avatar");
										if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$pathPieceJointe"))
										unlink("../suiviAdmin/suiviAdmin-img/courriers/$pathPieceJointe");
										closedir($opendir);
										$done=true;
										if($done)
										{
											echo $reponse="ok";
										}
									}
									else 
										echo "La suppression des informations connexes au courriers n'ont pas pu être supprimées";
								}else
								  echo "La suppression a échoué";
								
								
							}
							else
							echo "Vous n'avez pas les droits suffisants pour supprimer un courrier";

						}else
						 echo "Données fournies inconformes";
					break;

					case 27:
						//marqué push comme lu
						if($filterValidation->switchInput($_POST['idPush']))
						{
							$Push = new Push();
							$Push->setIdPush($_POST['idPush']);
							if($Push->seenPush())
								echo $reponse="ok";
							else
								echo "L'actualisation a échouée";
						}
						else
							echo "Données fournies incorrects";
					break;

					case 28:
						//marqué push comme non lu
						if($filterValidation->switchInput($_POST['idPush']))
						{
							$Push = new Push();
							$Push->setIdPush($_POST['idPush']);
							if($Push->unseenPush())
								echo $reponse="ok";
							else
								echo "L'actualisation a échouée";
						}
						else
							echo "Données fournies incorrects";
					break;

					case 29:
						//supprimer push
						if($filterValidation->switchInput($_POST['idPush']))
						{
							$Push = new Push();
							$Push->setIdPush($_POST['idPush']);
							if($Push->deletePush())
								echo $reponse="ok";
							else
								echo "L'actualisation a échouée";
						}
						else
							echo "Données fournies incorrects";
					break;

					case 30:
						//enregistrer passage en sortie
						if($filterValidation->switchInput($_POST['idPassage']))
						{
								$Passage = new Passage();
								$Passage->setIdPass($_POST['idPassage']);
								if($Passage->outPassage())
								{
									$Notification = new Notification();
																																						
									unset($_POST['admin-control']);
									$infoLog=json_encode($_POST);

									$Notification->setContenu($infoLog);
									$Notification->setIdTypeNotification(22);
									$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
									if($Notification->registerNotification())
									echo $reponse="ok";
								}
								else
									echo "L'actualisation du passage a échoué";
						}else
						echo "Données fournies inconformes";
					break;

					case 31:
							//supprimer un passage
						if($filterValidation->switchInput($_POST['idPassage']) && $filterValidation->TextAreaValidation($_POST['numSuiviPassageSelected']))
						{
								$Passage = new Passage();
								$Passage->setnumSuivi($_POST['numSuiviPassageSelected']);
								$nbrePass=$Passage->getCountPassage();

								if($nbrePass>1)
									{
											$Passage->setIdPass($_POST['idPassage']);
											if($Passage->deletePassage())
												{
													$Notification = new Notification();
																																						
													unset($_POST['admin-control']);
													$infoLog=json_encode($_POST);

													$Notification->setContenu($infoLog);
													$Notification->setIdTypeNotification(23);
													$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
													if($Notification->registerNotification())
													echo $reponse="ok";
												}
											else
												echo "La suppression du passage a échoué";
									}
								else
									echo "Ce passage ne peut être supprimé. Pour ce faire il faudrait supprimer le courrier";
						}else
						echo "Données fournies inconformes";
					break;


					case 32:
						    //passage en entrée
							if($filterValidation->TextAreaValidation($_POST['numSuivi']) && $filterValidation->switchInput($_POST['idCourrierPassageSelected']))
							{
								if ($_POST['serviceUser']=="courrier") 
									$state=1;
								else
									$state=2;

								$Passage = new Passage();
								$Passage->setnumSuivi($_POST['numSuivi']);
								$Passage->setIdAdmin($_SESSION['adminInfo']->id);
								if($Passage->entryPassage())
									{
										if ($state==2)
										{
											$Courrier = new Courrier();
											$Courrier->setIdCourrier($_POST['idCourrierPassageSelected']);
											$Courrier->setTreatingCourrier();
										}

										$done=true;
										if($done)
										{
											$Notification = new Notification();
																																						
											unset($_POST['admin-control']);
											$infoLog=json_encode($_POST);

											$Notification->setContenu($infoLog);
											$Notification->setIdTypeNotification(21);
											$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
											if($Notification->registerNotification())
											echo $reponse="ok";
										}
									}
									
								else
									echo "L'enregistrement du pasasge a échoué";

							}else
							echo "Données fournies inconformes";
					break;

					case 33:
						//marqué la tâche comme vu/non vue
						if($filterValidation->switchInput($_POST['idTask']) && $filterValidation->switchInput($_POST['seenTache']) )
						{
							$Tache = new Tache();
							$Tache->setiDTache($_POST['idTask']);
							$Tache->setseenTache($_POST['seenTache']);
							if($Tache->seenTache())
								echo $reponse="ok";
							else
								echo "L'opération a échoué, veuillez réessayer";
						}else
						echo "Données inconformes"; 
					break;

					case 34:
						//récupérer le cumul des taches non vue executeur
						$Tache = new Tache();
						$Tache->setidExecutor($_SESSION['adminInfo']->id);
						$cumulTache=$Tache->getCumulTaches();
						echo $cumulTache;

					break;

					case 35:
						//récupere le cumul des cr non vu initiateur
						$CompteRendu = new CompteRendu();
						$CompteRendu->Tache->setidInitiateur($_SESSION['adminInfo']->id);
						$cumulCr=$CompteRendu->getCumulCr();
						echo $cumulCr;
					break;

					case 36:
						//récupérer les suggestions non lues
						$Suggestion = new Suggestion();
						$cumulSuggest=$Suggestion->getCumulUnreadSuggest();
						echo $cumulSuggest;
					break;

					case 37:
						//supprimer un push inbox
					/*
						$Push = new Push();
						$Push->setIdPush($_POST['idPush']);
						if($Push->deletePush())
						echo $response="ok";
					*/
						/*
					$Pheanstalk= new Pheanstalk('127.0.0.1');

					//producer
					$Pheanstalk
						->useTube('testtube')
						->put("job payload goes here \n");

					//worker
						$job = $Pheanstalk
							->watch('testtube')
							->ignore('default')
							->reserve();

					echo $job->getData();

					$Pheanstalk->delete($job);

					$Pheanstalk->getConnection()->isServiceListening();
					*/
					$Publisher = new Publisher('myTube');
					$Publisher->send($_POST);

					break;

					case 38:
						//modifier courrier sortie
						if($filterValidation->TextAreaValidation($_POST['alter-register-courrier-sortie-obs']) && $filterValidation->TextAreaValidation($_POST['id-alter-sortie-courrier-suivi']))
							 {

								  	 	if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																$nameFile=md5(uniqid('',true));
																$ext=strrchr($_FILES['avatar']['name'],'.');
																$nameFile.=$ext;

																$Courrier = new Courrier();
																$oldPiece=$Courrier->getPieceJointe($_POST['id-alter-sortie-courrier-suivi']);																								
																$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
																if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece"))
																unlink("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece");
																closedir($opendir);


																				if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																				{
																					$CourrierPieces = new Courrier();
																					$CourrierPieces->setIdCourrier($_POST['id-alter-sortie-courrier']);
																					$CourrierPieces->setPieceJointe($nameFile);
																					if($CourrierPieces->alterCourrierPieces())
																					{
																						echo $reponse="pièce jointe modifiée ";
																					}else
																					echo "L'enregistrement des infos dans la base a échoué veuillez réessayer";
																				}
																				else
																					echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Pas de pieces jointes spécifiée ,";


													$Courrier = new Courrier();
													$Courrier->setIdCourrier($_POST['id-alter-sortie-courrier']);
													$Courrier->setObs($_POST['alter-register-courrier-sortie-obs']);

														if($Courrier->alterCourrierInfoSortie())
														{
															echo "modifications terminées veuillez rafraichir la page";
														}
														else
														echo "La modfication du courrier a échoué veuillez réessayer";	


							 }
							 else
							 	echo "Données fournies inconformes";	
					break;

					case 39:
							//enregistrer courrier départ interne
												if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																		$nameFile=md5(uniqid('',true));
																		$ext=strrchr($_FILES['avatar']['name'],'.');
																		$nameFile.=$ext;

																		if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																		{
																			
																				$CourrierAccc = new CourrierAccc();
																				$CourrierAccc->setreference($_POST['register-courrier-reference']);
																				$CourrierAccc->setobjet($_POST['register-courrier-objet']);
																				$CourrierAccc->setnumSuivi($_POST['register-courrier-suffixe']);
																				$CourrierAccc->seturgence($_POST['register-courrier-urgence']);
																				if(!empty($_POST['register-courrier-mail']))
																					$CourrierAccc->setmailDest($_POST['register-courrier-mail']);
																				else
																					$CourrierAccc->setmailDest("indéfini");
																				$CourrierAccc->setdestinataire($_POST['register-courrier-destinataire']);
																				$CourrierAccc->setexpediteur($_POST['register-courrier-expediteur']);
																				$CourrierAccc->setstate(1);
																				if($_POST['register-courrier-urgence']==1)
																					$CourrierAccc->setDelaiTraitement(14);
																				else
																					$CourrierAccc->setDelaiTraitement(7);
																				$CourrierAccc->setpieceDepart($nameFile);
																					if($CourrierAccc->registerCourrier())
																					{			
																								$numeroSuivi=$CourrierAccc->getLastId()."".$_POST['register-courrier-suffixe'];
																								array_push($_POST,$_POST['mailto']="fonde@tresoraccc.net");
																								$objetCourrier=$_POST['register-courrier-objet'];
																								$ladate=date('d-m-Y H:i:s');
																								array_push($_POST,$_POST['subject']="Enregistrement courrier départ interne!");
																								$messageBody="Un nouveau courrier interne départ vient d'être enregistré à la date suivante:{$ladate} au service courrier de l'ACCC sous le numero de suivi {$numeroSuivi} vous concernant avec pour objet suivant: {$objetCourrier} veuillez-vous connecter pour le consulter http://accc.vne-ci.com/suiviAdmin/index.php?p=compte";
																								array_push($_POST, $_POST['messageBody']="{$messageBody}");
																								$Publisher = new Publisher('myTube');
																								$Publisher->send($_POST);
																								echo $reponse="ok";
																					}
																					else
																					echo "L'enregistrement du courrier a échoué veuillez réessayer";

																		}
																		else
																			echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Fichier non Uploadé correctement";	
					break;

					case 40:
						//modifier un courrier départ Accc																				
										  	 	if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																$nameFile=md5(uniqid('',true));
																$ext=strrchr($_FILES['avatar']['name'],'.');
																$nameFile.=$ext;

																$CourrierAccc = new CourrierAccc();
																$CourrierAccc->setId($_POST['id-alter-register-courrier-depart-accc']);
																$oldPiece=$CourrierAccc->getPieceJointeDepart();																									
																$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
																if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece"))
																unlink("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece");
																closedir($opendir);


																				if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																				{
																					$CourrierPieces = new CourrierAccc();
																					$CourrierPieces->setId($_POST['id-alter-register-courrier-depart-accc']);
																					$CourrierPieces->setpieceDepart($nameFile);
																					if($CourrierPieces->alterPieceDepart())
																						echo $reponse="pièce jointe modifiée ";
																					else
																						echo $reponse="Opération de modification dans la base échoué";
																				}
																				else
																					echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Pas de pieces jointes spécifiée ,";


													$CourrierAccc = new CourrierAccc();
													$CourrierAccc->setId($_POST['id-alter-register-courrier-depart-accc']);
													$CourrierAccc->setObjet($_POST['alter-register-courrier-objet']);
													$CourrierAccc->setdestinataire($_POST['alter-register-courrier-destinataire']);
													$CourrierAccc->seturgence($_POST['alter-register-courrier-urgence']);
													$CourrierAccc->setnumSuivi($_POST['alter-register-courrier-suivi']);
													$CourrierAccc->setmailDest($_POST['alter-register-courrier-mail']);
													$CourrierAccc->setreference($_POST['alter-register-courrier-reference']);
													$CourrierAccc->setexpediteur($_POST['alter-register-courrier-expediteur']);
													$urgenceLevel=$CourrierAccc->getUrgence();
													if($urgenceLevel!==$_POST['alter-register-courrier-urgence'])
													{
														if($urgenceLevel==1 && $_POST['alter-register-courrier-urgence']==2)
															$delay=-7;
														if($urgenceLevel==2 && $_POST['alter-register-courrier-urgence']==1)
															$delay=7;
													}else
													$delay=0;

														if($CourrierAccc->alterCourrierInfo($delay))
															echo "modifications terminées veuillez rafraichir la page";
														else
														echo "La modfication du courrier a échoué veuillez réessayer";	
					break;

					case 41 :
						//supprimer un courrier départ Accc
							$CourrierAccc = new CourrierAccc();
							$CourrierAccc->setId($_POST['idCourrier']);
							$oldPiece=$CourrierAccc->getPieceJointeDepart();																									
							$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
							if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece"))
							unlink("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece");
							closedir($opendir);
							$done=true;
							if($done)
							{
								$CourrierAccc = new CourrierAccc();
								$CourrierAccc->setId($_POST['idCourrier']);
								if($CourrierAccc->deleteCourrier())
									echo $reponse="ok";
								else
									echo $reponse="La suppression des informations courrier dans la base a échoué";
							}
							else
								echo "La suppression de la pièce jointe a échoué veuillez réessayer";

					break;


					case 42:
						//enregistrer un courrier arrivé Interne
										$newCourrier = new CourrierAccc();
										$newCourrier->setId($_POST['register-courrier-suivi-depart']);
										if($newCourrier->checkedId())
										{
										  	 	if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																$nameFile=md5(uniqid('',true));
																$ext=strrchr($_FILES['avatar']['name'],'.');
																$nameFile.=$ext;

																				if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																				{
																					$CourrierPieces = new CourrierAccc();
																					$CourrierPieces->setId($_POST['register-courrier-suivi-depart']);
																					$CourrierPieces->setpieceArrive($nameFile);
																					$CourrierPieces->setDateRedaction($_POST['date-search-courrier']);
																					if($CourrierPieces->registerCourrierOut())
																					{
																								$numeroSuivi=$_POST['register-courrier-suivi-depart']."".$CourrierPieces->getNumFollow();
																								array_push($_POST,$_POST['mailto']="fonde@tresoraccc.net");
																								$objetCourrier=$CourrierPieces->getObjet();
																								$ladate=date('d-m-Y H:i:s');
																								array_push($_POST,$_POST['subject']="Enregistrement courrier arrivé interne!");
																								$messageBody="Un nouveau courrier interne arrivé vient d'être enregistré à la date suivante:{$ladate} au service courrier de l'ACCC portant le numero de suivi {$numeroSuivi} vous concernant avec pour objet suivant: {$objetCourrier} veuillez-vous connecter pour le consulter http://accc.vne-ci.com/suiviAdmin/index.php?p=compte";
																								array_push($_POST, $_POST['messageBody']="{$messageBody}");
																								$Publisher = new Publisher('myTube');
																								$Publisher->send($_POST);
																								echo $reponse="ok";
																					}else
																					echo "L'Enregistrement du courrier en sortie a échoué";
																				}
																				else
																					echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Pas de pieces jointes spécifiée ,";	
									}
									else echo "Ce courrier ne correspond pas à un courrier interne départ / n'existe pas dans la base veuillez réessayer.";							
					break;

					case 43:
						//modifier un courrier arrivé interne
											//modifier courrier sortie
								  	 	if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																$nameFile=md5(uniqid('',true));
																$ext=strrchr($_FILES['avatar']['name'],'.');
																$nameFile.=$ext;

																$Courrier = new CourrierAccc();
																$Courrier->setId($_POST['id-alter-sortie-courrier']);
																$oldPiece=$Courrier->getPieceJointeArrive();															
																$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
																if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece"))
																unlink("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece");
																closedir($opendir);

																				if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																				{
																					$CourrierPieces = new CourrierAccc();
																					$CourrierPieces->setId($_POST['id-alter-sortie-courrier']);
																					$CourrierPieces->setPieceArrive($nameFile);
																					if($CourrierPieces->alterPieceArrive())
																						echo "Pièce jointe modifiée, ";
																					else
																						echo "L'enregistrement des infos dans la base a échoué veuillez réessayer";
																				}
																				else
																					echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Pas de pieces jointes spécifiée ,";

												if($_POST['date-search-courrier']!="")
												{
													$Courrier = new CourrierAccc();
													$Courrier->setId($_POST['id-alter-sortie-courrier']);
													$Courrier->setDateRedaction($_POST['date-search-courrier']);

														if($Courrier->alterDateRedaction())
															echo "date de rédaction modifiée.";
														else
														echo "La modfication du courrier a échoué veuillez réessayer";	
												}else
												 	echo "date de rédaction inchangée.";

					break;


					case 44:
							//enregistrer courrier arrivé
												if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																		$nameFile=md5(uniqid('',true));
																		$ext=strrchr($_FILES['avatar']['name'],'.');
																		$nameFile.=$ext;

																		if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																		{
																				$Courrier = new NewCourrier();

																				$numeroSuivi=$_POST['register-courrier-suffixe'];
																				$Courrier->setreference($_POST['register-courrier-reference']);
																				$Courrier->setexpediteur($_POST['register-courrier-expeditor']);
																				$Courrier->setobjet($_POST['register-courrier-objet']);
																				if($_POST['register-courrier-urgence']==1)
																				$delay=14;
																				else
																				$delay=7;
																				$Courrier->setDelaiTraitement($delay);
																				$Courrier->setstate($_POST['register-courrier-type']);
																				$Courrier->setpiece($nameFile);
																				$Courrier->setdestinataire($_POST['register-courrier-destinataire']);
																				if($_POST['register-courrier-type']==3)
																					$Courrier->seturgence(0);
																				else
																				$Courrier->seturgence($_POST['register-courrier-urgence']);
																				$Courrier->setnumSuivi($numeroSuivi);
																					if($Courrier->registerCourrier())
																					{	
																						$idCourrier=$Courrier->getLastId();

																						if($Courrier->setIdAgentArrive($idCourrier,$_SESSION['adminInfo']->id))
																						{
																							//penser à créer un tube pour les imputations catégorie 1
																							
																							//un tube en cas de courrier autre et un autre en cas de courrier normal
																							if($_POST['register-courrier-type']==3)
																							{
																								$Imputation = new Imputation();
																								$ArrayGlobalImputation=$Imputation->NewCourrier->getFullAdrresses();
																								foreach ($ArrayGlobalImputation as $key => $value) {
																									foreach ($value as $ind => $val) {
																									
																									
																									$Imputation->setCategorie(1);
																									$Imputation->setIdCourrier($idCourrier);
																									$Imputation->setIdResponsible(0);
																									$Imputation->setIdDesigne($val);
																									$Imputation->registerImputation();
																								  }
																								}

																							}
																							else
																								{ 
																									$ArrayImputation=[1,2,14,16];
																									foreach ($ArrayImputation as $value)
																									{
																									$Imputation = new Imputation();
																									$Imputation->setCategorie(1);
																									$Imputation->setIdCourrier($idCourrier);
																									$Imputation->setIdResponsible(0);
																									$Imputation->setIdDesigne($value);
																									$Imputation->registerImputation();
																									}

																							}
																								$destinataire=$_POST['register-courrier-destinataire'];
																								$expediteur=$_POST['register-courrier-expeditor'];
																								if($_POST['register-courrier-type']==3)
																								array_push($_POST,$_POST['subject']="Nouveau Courrier Information !");
																								else
																								array_push($_POST,$_POST['subject']="Nouveau Courrier Arrivé !");

																									array_push($_POST,$_POST['mailto']="agentcomptable@tresoraccc.net");
																									$objetCourrier=$_POST['register-courrier-objet'];
																									$ladate=date('d-m-Y H:i:s');

																									$messageBody="Courrier arrive inscrit a la date suivante:{$ladate} au service courrier de l'ACCC avec le numero identifiant {$idCourrier} portant le numero de suivi arrive {$numeroSuivi} avec pour objet suivant: {$objetCourrier}. Exp :{$expediteur} , Dest: {$destinataire}. Veuillez-vous connecter pour le consulter via ce lien http://accc.vne-ci.com/suiviAdmin/index.php?p=login&f={$nameFile}";

																									array_push($_POST, $_POST['messageBody']="{$messageBody}");

																									$Publisher = new Publisher('myTube');
																									$Publisher->send($_POST);
																									$done=true;
																							if($done){
																									$Notification = new Notification();
																									//epurer les informations
																									$stateCourrier=$_POST['register-courrier-type'];
																									$_POST['register-courrier-type'] = $stateCourrier ==1 ? "courrier arrivé" : "courrier autre";

																									$urgence=$Courrier->getUrgenceWR();
																										switch ($urgence) {
																											case 0:
																												$_POST['register-courrier-urgence']="Courrier sans délai";
																												break;

																											case 1:
																												$_POST['register-courrier-urgence']="Courrier normal";
																											break;

																											case 2:
																												$_POST['register-courrier-urgence']="Courrier urgent";
																											break;
																										}

																									unset($_POST['subject']);
																									unset($_POST['0']);
																									unset($_POST['1']);
																									unset($_POST['2']);
																									unset($_POST['3']);
																									unset($_POST['mailto']);
																									unset($_POST['messageBody']);
																									unset($_POST['admin-control']);

																									$_POST['register-courrier-suffixe']="Numéro de suivi départ: ".$_POST['register-courrier-suffixe'];

																									$_POST['register-courrier-reference']="ref: ".$_POST['register-courrier-reference'];
											
																									$_POST['register-courrier-expeditor']="expéditeur: ".$_POST['register-courrier-expeditor'];

																									$_POST['register-courrier-destinataire']="destinataire: ".$_POST['register-courrier-destinataire'];

																									array_push($_POST,$_POST['NotCourrier']=$idCourrier);
																									$infoLog=json_encode($_POST);
																									$Notification->setContenu($infoLog);
																									$Notification->setIdTypeNotification(1);
																									$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																									$Notification->registerNotification();

																								echo $reponse="Enregistrement d'un nouveau courrier arrivé sous le numéro {$idCourrier}";
																							}
																							//Enregistrement de la notification

																					    }
																						else
																					    	echo "Enregistrement de l'agent dans la base échoué, veuillez contacter l'administrateur";
																					}
																					else
																					echo "L'enregistrement du courrier a échoué veuillez réessayer";

																		}
																		else
																			echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  	echo "Fichier non Uploadé correctement";	
					break;

					case 45 :
						//modification courrier arrivé
						//unset($_POST['admin-control']);
										  	 	if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																$nameFile=md5(uniqid('',true));
																$ext=strrchr($_FILES['avatar']['name'],'.');
																$nameFile.=$ext;

																$Courrier = new NewCourrier();
																$Courrier->setId($_POST['id-alter-alter-courrier']);

																$oldPiece=$Courrier->getPieceJointe();																									
																$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
																if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece"))
																unlink("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece");
																closedir($opendir);
																						
																						

																				if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																				{
																					$CourrierPieces = new NewCourrier();
																					$CourrierPieces->setId($_POST['id-alter-alter-courrier']);
																					$CourrierPieces->setpiece($nameFile);
																					if($CourrierPieces->alterPiece())
																						$temp=true;
																				}
																				else
																					echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else
												  {
												  	echo "Pas de pieces jointes spécifiée ,";
												  	$temp=false;
												  }
												  	


													$Courrier = new NewCourrier();


													$Courrier->setId($_POST['id-alter-alter-courrier']);
													$urgenceLevel=$Courrier->getUrgence();
													$Courrier->setreference($_POST['alter-courrier-reference']);
													$Courrier->setexpediteur($_POST['alter-courrier-expeditor']);
													$Courrier->setobjet($_POST['alter-courrier-objet']);
													if($urgenceLevel==0)
														$Courrier->seturgence(0);
													else
													$Courrier->seturgence($_POST['alter-courrier-urgence']);
													$Courrier->setnumSuivi($_POST['alter-courrier-suffixe']);
													$Courrier->setdestinataire($_POST['register-courrier-destinataire-alter']);
													
													if($urgenceLevel!==$_POST['alter-courrier-urgence'])
													{
														if($urgenceLevel==1 && $_POST['alter-courrier-urgence']==2)
															$delay=-7;
														if($urgenceLevel==2 && $_POST['alter-courrier-urgence']==1)
															$delay=7;
														if($urgenceLevel==0)
															$delay=0;
													}else
													$delay=0;
														if($Courrier->alterCourrierInfo($delay))
														{
															//Enregistrement de la notification
															
															$urgence=$Courrier->getUrgenceWR();
																switch ($urgence) {
																	case 1:
																		$_POST['alter-courrier-urgence']="Courrier normal";
																	break;
																	
																	case 2:
																		$_POST['alter-courrier-urgence']="Courrier normal";
																	break;
																	case 0:
																	   $_POST['alter-courrier-urgence']="Courrier autre";
																	break;
																}

																$_POST['alter-courrier-reference']="Référence courrier: ".$_POST['alter-courrier-reference'];

																$_POST['alter-courrier-expeditor']="Expéditeur courrier: ".$_POST['alter-courrier-expeditor'];

																$_POST['alter-courrier-suffixe']="Numéro de suivi départ: ".$_POST['alter-courrier-suffixe'];

																$_POST['register-courrier-destinataire-alter']="Destinataire: ".$_POST['register-courrier-destinataire-alter'];

															unset($_POST['admin-control']);
															$_POST['NotCourrier']=$_POST['id-alter-alter-courrier'];
															unset($_POST['id-alter-alter-courrier']);
															$Notification = new Notification();
															$infoLog=json_encode($_POST);
															$Notification->setContenu($infoLog);
															if($temp)
															$Notification->setIdTypeNotification(14);
															else
															$Notification->setIdTypeNotification(2);

															$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
															$Notification->registerNotification();
															if($temp)
															echo "Piece jointe modifiée, modifications terminées veuillez rafraichir la page";
														else
															echo "modifications terminées veuillez rafraichir la page";
														}
														else
														echo "La modfication du courrier a échoué veuillez réessayer";	
					break;

					case 46 :
						//supprimer un courrier arrive					
							$Courrier = new NewCourrier();
							$Courrier->setId($_POST['idCourrier']);
							$piece=$Courrier->getPieceJointe();
							if($piece!=="")
							{
								$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
								if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$piece"))
								unlink("../suiviAdmin/suiviAdmin-img/courriers/$piece");
								closedir($opendir);
								$done=true;

								if($done)
								{
									if($Courrier->deleteCourrier())
									{
										//Enregistrement de la notification
										unset($_POST['admin-control']);
										$_POST['NotCourrier']=$_POST['idCourrier'];
										unset($_POST['idCourrier']);
										$Notification = new Notification();
										$infoLog=json_encode($_POST);
										$Notification->setContenu($infoLog);
										$Notification->setIdTypeNotification(3);
										$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
										$Notification->registerNotification();
										echo $reponse="ok";
									}
									else
										echo "La suppression du courrier dans la base a échoué veuillez réessayer";
								}
								else
									echo "La suppression du courrier dans la base a échoué veuillez réessayer";

							}else
							echo "La piece jointe est introuvable veuillez réessayer ou contacter l'administrateur";

						break;


					case 47:
						//enregistrer un courrier depart externe
						$newCourrier = new NewCourrier();
						$newCourrier->setId($_POST['register-courrier-suivi-depart']);
						if($newCourrier->checkedId())
						{
							if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
								{
													//traitement sur l'image
									if($_FILES["avatar"]["size"]<50000000)
									{	

										$validator= new File\MimeType('pdf');
															
										if($validator->isValid($_FILES["avatar"]))
										{

											$infoFichier=pathinfo($_FILES["avatar"]["name"]);
											$extension=$infoFichier['extension'];
			
											$nameFile=md5(uniqid('',true));
											$ext=strrchr($_FILES['avatar']['name'],'.');
											$nameFile.=$ext;

												if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
												{
													$newCourrier->setId($_POST['register-courrier-suivi-depart']);
													$newCourrier->setpieceDepart($nameFile);
													$newCourrier->setnumSuiviDepart($_POST['numSuiviDepart']);
													if($newCourrier->registerCourrierOut())
													{
															if($newCourrier->setIdAgentDepart($_POST['register-courrier-suivi-depart'],$_SESSION['adminInfo']->id))
															{

															    //Enregistrement de la notification
																unset($_POST['admin-control']);
																$_POST['numSuiviDepart']="numéro de suivi départ: ".$_POST['numSuiviDepart'];
																$_POST['NotCourrier']=$_POST['register-courrier-suivi-depart'];
																unset($_POST['register-courrier-suivi-depart']);
																$Notification = new Notification();
																$infoLog=json_encode($_POST);
																$Notification->setContenu($infoLog);
																$Notification->setIdTypeNotification(4);
																$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
																$Notification->registerNotification();

																echo $reponse="ok";
															}
															else
																echo "Enregistrement de l'agent dans la base échoué, veuillez contacter l'administrateur";
													}else
													 echo "L'enregistrement du courrier dans la base a échoué!";
												}
												else
													echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
											}
											else
															echo "Mauvais Fichier";	
										}	
										else
											echo "Fichier trop gros";
									}
									else
										echo "Fichier non Uploadé correctement";
						}
						else
							echo "Ce numero de suivi ne correspond pas à un courrier arrivé";


					break;

					case 48:
						//modifier la piece jointe d'un courrier depart
						if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0)
												{
													//traitement sur l'image
														if($_FILES["avatar"]["size"]<50000000)
														{	

															$validator= new File\MimeType('pdf');
															
															if($validator->isValid($_FILES["avatar"]))
															{

																$infoFichier=pathinfo($_FILES["avatar"]["name"]);
																$extension=$infoFichier['extension'];
			
																$nameFile=md5(uniqid('',true));
																$ext=strrchr($_FILES['avatar']['name'],'.');
																$nameFile.=$ext;

																$Courrier = new NewCourrier();
																$Courrier->setId($_POST['id-alter-alter-courrier-depart']);

																$oldPiece=$Courrier->getPieceJointeDepart();																									
																$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
																if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece"))
																unlink("../suiviAdmin/suiviAdmin-img/courriers/$oldPiece");
																closedir($opendir);


																				if(move_uploaded_file($_FILES['avatar']['tmp_name'],'../suiviAdmin/suiviAdmin-img/courriers/'.$nameFile))
																				{
																					$CourrierPieces = new NewCourrier();
																					$CourrierPieces->setId($_POST['id-alter-alter-courrier-depart']);
																					$CourrierPieces->setpieceDepart($nameFile);
																					if($CourrierPieces->alterPieceDepart()){
																						//Enregistrement de la notification
																						$temp=true;
																					}
																					else
																						echo $reponse="Erreur lors de l'enregistrement de la piece jointe dans la base";
																				}
																				else
																					echo "L'enregistrement des pièces jointes a échoué veuillez réessayer";	
															 }
															 else
															    	echo "Mauvais Fichier";	
														}	
														else
															echo "Fichier trop gros";
												}
												  else{
												  	$temp=false;
												  	echo "Pas de pièce jointe spécifiée, ";

												  }

												if($_POST['numSuiviDepart']!=="")
												{
													$Courrier = new NewCourrier();
													$Courrier->setId($_POST['id-alter-alter-courrier-depart']);
													$Courrier->setnumSuiviDepart($_POST['numSuiviDepart']);

														if($Courrier->alternumSuiviDepart()){
															//Enregistrement de la notification
															unset($_POST['admin-control']);
															$_POST['numSuiviDepart']="Numéro de suivi départ: ".$_POST['numSuiviDepart'];
															$_POST['NotCourrier']=$_POST['id-alter-alter-courrier-depart'];
															unset($_POST['id-alter-alter-courrier-depart']);
															$Notification = new Notification();
															$infoLog=json_encode($_POST);
															$Notification->setContenu($infoLog);
															if($temp)
																$Notification->setIdTypeNotification(15);
															else
																$Notification->setIdTypeNotification(5);
															$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
															$Notification->registerNotification();
															if($temp)
															echo "Pièce jointe modifiée, numéro de suivi départ modifié.";
															else
																echo "numéro de suivi départ modifié.";
														}
														else
															echo "La modfication du numéro de suivi départ a échoué.";	
												}else
												 	echo "numéro de suivi départ inchangé.";
					break;


					case 49:
							if(!empty( $_POST['imputation-selection-resp']))
							{
								foreach ($_POST['imputation-selection-resp'] as $value) 
								{
									$Imputation = new Imputation();
 						   			$Administrator=new Administrator();
 						   		    $Administrator->setIdAdmin($value);
 						    		$FullInfo=$Administrator->getFullInfo();
 								    if($FullInfo!=="")
 								    	{
 								    		$Imputation->setIdDesigne($value);
 								    		$Imputation->setIdCourrier($_POST['suivi-courrier-imputation']);
 								    		$Imputation->setCategorie(2);
 								    		$Imputation->setIdResponsible($_SESSION['adminInfo']->id);
 								    		if(!($Imputation->checkAlreadyImputation())){
 								    			 if($Imputation->registerImputation())
	 								    		{


	 						  		     			//mailto $FullInfo->login
	 						  		    			array_push($_POST,$_POST['mailto']="fonde@tresoraccc.net");
												    array_push($_POST,$_POST['subject']="Imputation Courrier!");
												    $idCourrier=$_POST['suivi-courrier-imputation'];
												    $Imputator=$_SESSION['adminInfo']->nom." ".$_SESSION['adminInfo']->prenom;
												    $ServiceImputator=$_SESSION['adminInfo']->nomService;
												    $ladate=date('d-m-Y H:i:s');
												    $PathFile=$_POST['pathFile'];
													$messageBody="Le courrier numero {$idCourrier} vous a ete impute par {$Imputator} du {$ServiceImputator} a la date suivante: {$ladate}.Veuillez-vous connecter pour le consulter http://accc.vne-ci.com/suiviAdmin/index.php?p=login&f={$PathFile}";
													array_push($_POST, $_POST['messageBody']="{$messageBody}");
													$Publisher = new Publisher('myTube');
												    $Publisher->send($_POST);
												    $done=true;
												    if($done)
												    {
												    	echo "Imputation à ".$FullInfo->nom." ".$FullInfo->prenom." effectuée avec succes! \n";
												    	    //Enregistrer la notification
												    		$Notification = new Notification();
												    		$idCourrierImput=$_POST['suivi-courrier-imputation'];
												    		$contenu="{\"NotCourrier\":\"{$idCourrierImput}\"}";
															$Notification->setContenu($contenu);
															$Notification->setIdTypeNotification(16);
															$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
															$Notification->registerNotification();
												    }
	 								    		}
	 								    		else
	 								    			echo "L'opération d'imputation du courrier ".$_POST['suivi-courrier-imputation']." a échoué pour ".$FullInfo->nom." ".$FullInfo->prenom." veuillez réessayer de lui imputer le courrier <br/>";

 								    		}else
 								    		 echo $FullInfo->nom." ".$FullInfo->prenom." a déja été imputé pour le courrier ".$_POST['suivi-courrier-imputation']."\n";

 								    	}
 								    	else
 								    		echo "Coordonnées fournies incorrectes";			
								}						

							}else
							echo "Aucun option sélectionnée pour l'imputation";



					break;

					case 50 :
							echo "OK";
					break;

					case 51 :
						//supprimer un courrier départ					
							$Courrier = new NewCourrier();
							$Courrier->setId($_POST['idCourrier']);
							$piece=$Courrier->getPieceJointe();
							if($piece!=="")
							{
								$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
								if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$piece"))
								unlink("../suiviAdmin/suiviAdmin-img/courriers/$piece");
								closedir($opendir);
								$done=true;

								if($done)
								{

									$piece=$Courrier->getPieceJointeDepart();
									if($piece!=="")
										{
												$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
												if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$piece"))
												unlink("../suiviAdmin/suiviAdmin-img/courriers/$piece");
												closedir($opendir);
												$done=true;
												if($done)
												{
													if($Courrier->deleteCourrier())
													{
														//Enregistrement de la notification
														unset($_POST['admin-control']);
														$_POST['idCourrier']="identifiant courrier: ".$_POST['idCourrier'];
														$Notification = new Notification();
														$infoLog=json_encode($_POST);
														$Notification->setContenu($infoLog);
														$Notification->setIdTypeNotification(6);
														$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
														$Notification->registerNotification();
														echo $reponse="ok";
													}
													else
														echo "La suppression du courrier dans la base a échoué veuillez réessayer";
												}
												else
												 echo "erreur lors de la suppression veuillez réessayer";
										}
										else
											echo "La piece jointe est introuvable veuillez réessayer ou contacter l'administrateur";
								}
								else
									echo "La suppression du courrier dans la base a échoué veuillez réessayer";

							}else
							echo "La piece jointe est introuvable veuillez réessayer ou contacter l'administrateur";

						break;

						case 53:
							$Courrier = new CourrierAccc();
							$Courrier->setId($_POST['idCourrier']);
							$piece=$Courrier->getPieceJointeArrive();
							if($piece!=="")
							{
								$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
								if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$piece"))
								unlink("../suiviAdmin/suiviAdmin-img/courriers/$piece");
								closedir($opendir);
								$done=true;

								if($done)
								{

									$piece=$Courrier->getPieceJointeDepart();
									if($piece!=="")
										{
												$opendir=opendir("../suiviAdmin/suiviAdmin-img/courriers");
												if(file_exists("../suiviAdmin/suiviAdmin-img/courriers/$piece"))
												unlink("../suiviAdmin/suiviAdmin-img/courriers/$piece");
												closedir($opendir);
												$done=true;
												if($done)
													{
														if($Courrier->deleteCourrier())
															echo $reponse="ok";
														else
															echo $reponse="l'opération de suppression a échoué veuillez réessayer";
													}
												else
												    echo "erreur lors de la suppression veuillez réessayer";
										}
										else
											echo "La piece jointe est introuvable veuillez réessayer ou contacter l'administrateur";
								}
								else
									echo "La suppression du courrier dans la base a échoué veuillez réessayer";

							}else
							echo "La piece jointe est introuvable veuillez réessayer ou contacter l'administrateur";
						break;

						//OFF Notification
						case 54:
							if ($filterValidation->switchInput($_POST['idCourrier'])) 
							{
								$NewCourrier = new NewCourrier();
								$NewCourrier->setId($_POST['idCourrier']);
								if($NewCourrier->OfflineNot())
								{
									//Enregistrement de la notification
									unset($_POST['admin-control']);
									$_POST['idCourrier']="Identifiant courrier: ".$_POST['idCourrier'];
									$Notification = new Notification();
									$infoLog=json_encode($_POST);
									$Notification->setContenu($infoLog);
									$Notification->setIdTypeNotification(10);
									$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
									$Notification->registerNotification();
									echo "Notifications d'alerte désactivées pour le courrier numéro ".$_POST['idCourrier'];
								}
							}
						break;

						case 55:
							if ($filterValidation->switchInput($_POST['idCourrier'])) 
							{
								$NewCourrier = new NewCourrier();
								$NewCourrier->setId($_POST['idCourrier']);
								if($NewCourrier->OnlineNot())
								{
																		//Enregistrement de la notification
									unset($_POST['admin-control']);
									$_POST['idCourrier']="Identifiant courrier: ".$_POST['idCourrier'];
									$Notification = new Notification();
									$infoLog=json_encode($_POST);
									$Notification->setContenu($infoLog);
									$Notification->setIdTypeNotification(9);
									$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
									$Notification->registerNotification();
									echo "Notifications d'alerte réactivées pour le courrier numéro ".$_POST['idCourrier'];
								}
							}
						break;


						case 57:
							   	    //load unread messages / charger en temps réel les nouveaux messages
									$Imputation = new Imputation();
									$Imputation->setIdDesigne($_SESSION['adminInfo']->id);
									$totalUnread=$Imputation->getFullUnread();
									echo $totalUnread;
						break;

						case 58:
								   //marquer un courrier comme lu
									$Imputation = new Imputation();
									$Imputation->NewCourrier->setId($_POST['idCourrier']);
									$Imputation->NewCourrier->setpiece($_POST['piece']);
									if($Imputation->NewCourrier->isPieceDepart())
									{
									   $Imputation->setIdDesigne($_SESSION['adminInfo']->id);
									   $Imputation->setIdCourrier($_POST['idCourrier']);
									   if($Imputation->setSeen())
									   {
									   		//Enregistrement de la notification
									   	unset($_POST['admin-control']);
									   	unset($_POST['piece']);
									   	$_POST['NotCourrier']=$_POST['idCourrier'];
									   	unset($_POST['idCourrier']);
											$Notification = new Notification();
											$infoLog=json_encode($_POST);
											$Notification->setContenu($infoLog);
											$Notification->setIdTypeNotification(8);
											$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
											$Notification->registerNotification();
											echo "OK";
									   }
									   else
									   	echo "NO";
									   
									}else
									return false;
						break;

							// charger les imputations en temps réel
						case 59:
									$Imputation = new Imputation();
									$Imputation->setIdDesigne($_SESSION['adminInfo']->id);
									$totalUnread=$Imputation->getFullUnreadImputation();
									echo $totalUnread;
						break;

								//révoquer les imputations
						case 60:
							if(!empty( $_POST['imputation-selection-resp']))
							{
								foreach ($_POST['imputation-selection-resp'] as $value) 
								{
									$Imputation = new Imputation();
 						   			$Administrator=new Administrator();
 						   		    $Administrator->setIdAdmin($value);
 						    		$FullInfo=$Administrator->getFullInfo();
 								    if($FullInfo!=="")
 								    	{
 								    		$Imputation->setIdDesigne($value);
 								    		$Imputation->setIdCourrier($_POST['suivi-courrier-imputation']);
 								    		if(($Imputation->checkAlreadyImputation())){
 								    			 if($Imputation->deleteImputation())
	 								    		{


	 						  		     			//mailto $FullInfo->login
	 						  		    			array_push($_POST,$_POST['mailto']="fonde@tresoraccc.net");
												    array_push($_POST,$_POST['subject']="Imputation Courrier!");
												    $idCourrier=$_POST['suivi-courrier-imputation'];
												    $Imputator=$_SESSION['adminInfo']->nom." ".$_SESSION['adminInfo']->prenom;
												    $ServiceImputator=$_SESSION['adminInfo']->nomService;
												    $ladate=date('d-m-Y H:i:s');
												    $PathFile=$_POST['pathFile'];
													$messageBody="Le courrier numero {$idCourrier} vous a révoqué par {$Imputator} du {$ServiceImputator} a la date suivante: {$ladate}.Veuillez-vous connecter pour le consulter http://accc.vne-ci.com/suiviAdmin/index.php?p=login&f={$PathFile}";
													array_push($_POST, $_POST['messageBody']="{$messageBody}");
													$Publisher = new Publisher('myTube');
												    $Publisher->send($_POST);
												    $done=true;
												    if($done)
												    {
												    	echo "Révocation à ".$FullInfo->nom." ".$FullInfo->prenom." effectuée avec succes! \n";
												    	    //Enregistrer la notification
												    		$Notification = new Notification();
												    		$idCourrierImput=$_POST['suivi-courrier-imputation'];
												    		$contenu="{\"NotCourrier\":\"{$idCourrierImput}\"}";
															$Notification->setContenu($contenu);
															$Notification->setIdTypeNotification(17);
															$Notification->setIdInitiateur($_SESSION['adminInfo']->id);
															$Notification->registerNotification();
												    }
	 								    		}
	 								    		else
	 								    			echo "L'opération de révocation du courrier ".$_POST['suivi-courrier-imputation']." a échoué pour ".$FullInfo->nom." ".$FullInfo->prenom." veuillez réessayer de lui révoquer le courrier <br/>";

 								    		}else
 								    		 echo $FullInfo->nom." ".$FullInfo->prenom." n'a pas été révoqué pour le courrier ".$_POST['suivi-courrier-imputation']."\n cela est probablement du à une érreur veuillez contacter l'administrateur.";

 								    	}
 								    	else
 								    		echo "Coordonnées fournies incorrectes";			
								}				
						}else
						echo "Aucune entité sélectionnée";

						break;

			}	
	}


}

?>