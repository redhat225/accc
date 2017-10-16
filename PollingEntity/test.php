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
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

		try{
				$Mail = new Message();
				$Mail->addTo('agentcomptable@tresoraccc.net')
				        ->addFrom('remmanuel@vne-ci.com')
				        ->setSubject('Salutation')
				        ->setBody("Bonjour et bienvenue!!!");

				// Setup SMTP transport using LOGIN authentication
				$transport = new SmtpTransport();
				$options   = new SmtpOptions(array(
				    //'name'              => 'localhost.localdomain',
				    'host'              => 'ssl0.ovh.net',
				    'connection_class'  => 'login',
				    'port'	=> 465,
				    //'secure' => true,
				    'connection_config' => array(
				    	'ssl' => 'tls',
				        'username' => 'no-reply@vne-ci.com',
				        'password' => 'noreply@2016',
				    ),
				));
				$transport->setOptions($options);
				$transport->send($Mail);
		   }catch(\Exception $e){
		   	var_dump($e->getMessage());
		   	
		   }
