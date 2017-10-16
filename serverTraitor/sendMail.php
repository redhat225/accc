<?php 
session_start();
require ('../vendor/autoload.php');
use Mailgun\Mailgun;
use Http\Adapter\Guzzle6;

if(isset($_SESSION['adminInfo']))
{

	$domain="sandbox5d223d543a164309b87be0980fb39309.mailgun.org";
	$client = new Guzzle6\Client();
	$mailgun = new Mailgun('key-3ebb8831aa5860a07023ea6c3aecaa86', $client);
	$result= $mailgun->sendMessage($domain, array(
	'from' => 'sandbox5d223d543a164309b87be0980fb39309@sandbox.mailgun.org',
	'to'      => 'riehlemm@gmail.com,tgiscard@vne-ci.com',
	'subject' => 'Enregistrement Courrier (Service Courrier ACCC)',
	'text'    => 'Un nouveau courrier vient d\'être enregistré au service courrier de l\'ACCC, veuillez-vous connecter pour le consulter http://accc.vne-ci.com/suiviAdmin/index.php?p=compte' 
	 )
	);	

}else
header("location:/");
 ?>
