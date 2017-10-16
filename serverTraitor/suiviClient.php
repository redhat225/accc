<?php
session_start();
header("Content-type: text/plain ; charset=utf-8");
require ('../vendor/autoload.php');
use PollingEntity\Validator\FilterValidator;
use PollingEntity\Client;
use PollingEntity\Suggestion;

if(isset($_POST['client-control']) && is_numeric($_POST['client-control'])) 
{

	$filterValidation=new FilterValidator();												
	if($filterValidation->switchInput($_POST['client-control']))
	{
				$swicthInput=$_POST['client-control'];
				foreach ($_POST as $value) {$filterValidation->MyFilter($value);}
				require_once('../bdConnect/accc-connect.php');

					switch ($swicthInput){

					case 1 :
								if($filterValidation->loginValidation($_POST['client-suivi-login']) && $filterValidation->loginValidation($_POST['client-suivi-conf-password']) && $filterValidation->NewsletterValidation($_POST['client-suivi-mail']) && $filterValidation->switchInput($_POST['client-suivi-phone']))
								{

										$Client = new Client();
										$Client->setIdClient($_SESSION['AuthClient']->id);
										$Client->setmdp($_POST['client-suivi-conf-password']);
										if($Client->verifClient())
											{
												$Client->setPhone($_POST['client-suivi-phone']);
												$Client->setlogin($_POST['client-suivi-login']);
												$Client->setmail($_POST['client-suivi-mail']);

												if($Client->updateInfoClient())
													echo "L'actualisation du compte client a reussi veuillez recharger la page pour constater les changements";
												else
													echo "L'actualisation du compte client a échoué";
											}
										else
											echo "Mot de passe incorrect";
								}else
								echo "Données Fournies incorrectes";
				    break;

					case 2:

							if($filterValidation->loginValidation($_POST['client-suivi-conf-password']) && $filterValidation->loginValidation($_POST['client-suivi-new-Password']))
							{
										$Client = new Client();
										$Client->setIdClient($_SESSION['AuthClient']->id);
										$Client->setmdp($_POST['client-suivi-conf-password']);
										if($Client->verifClient())
											{
												$Client->setmdp($_POST['client-suivi-new-Password']);
												if($Client->updatePasswordClient())
													echo "L'actualisation du mot de passe a reussi. il est conseillé de vous reconnecter pour constater les changements";
												else
													echo "L'actualisation du compte client a échoué";
											}
										else
											echo "Mot de passe incorrect";
							}
							else
								echo "Données fournies iconformes";
					break;


					case 3 :
							if($filterValidation->TextAreaValidation($_POST['client-suivi-suggest']) && $filterValidation->switchInput($_POST['suggest-idCourrier']) && $filterValidation->loginValidation($_POST['client-suivi-conf-password']))
							{
										$Client = new Client();
										$Client->setIdClient($_SESSION['AuthClient']->id);
										$Client->setmdp($_POST['client-suivi-conf-password']);
										if($Client->verifClient())
											{
												$Suggestion= new Suggestion();
												$Suggestion->setIdCourrierSuggest($_POST['suggest-idCourrier']);
												$Suggestion->setSuggestion($_POST['client-suivi-suggest']);
												if($Suggestion->registerSuggest())
													echo "Suggestion envoyée";
												else
													echo "Erreur lors de l'envoi de la suggestion";
											}
										else
											echo "Mot de passe incorrect";
							}	
							else
							  echo "Donnes fournies inconformes";
					break;


					}
	}


}

?>