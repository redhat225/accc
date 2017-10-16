<?php
namespace PollingEntity;
header("Content-Type: text/plain; charset=UTF-8"); 

try {
	if(file_exists("/vendor/autoload.php"))
		require "/vendor/autoload.php";
	else{
		if(file_exists("../vendor/autoload.php"))
		require "../vendor/autoload.php";
	}

} catch (Exception $e)
{

}

use Pheanstalk\Pheanstalk;
use PDO;
use Mailgun\Mailgun;
use Http\Adapter\Guzzle6;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class Worker{

	private $tube;
	private $client;
	private $WorkerPDO;

	public function __construct($args)
	{
		$this->tube = $args;
		$this->client = new Pheanstalk('127.0.0.1');
	}
    
	public function listen()
	{
		$this->client->watch($this->tube);

		while($job = $this->client->reserve())
		{
			$message = json_decode($job->getData(), true);
			//$message=$job->getData();
			$status = $this->process($message);
			//status return true or false
			if($status)
			{
				$this->client->delete($job);
				echo "job delete";
			}
				
			else
			{
				$this->client->bury($job);
				echo "Job burried";
			}
		}

	}

	public function process($message)
	{
		$complete=false;
		//$objet=$message->sujet;

		try{
				$Mail = new Message();
				$Mail->addTo($message['mailto'])
				        ->addFrom('servicecourrier@vne-ci.com')
				        ->setSubject($message['subject'])
				        ->setBody($message['messageBody']);

				// Setup SMTP transport using LOGIN authentication
				$transport = new SmtpTransport();
				$options   = new SmtpOptions(array(
				    //'name'              => 'localhost.localdomain',
				    'host'              => 'ssl0.ovh.net',
				    'connection_class'  => 'login',
				    'port'	=> 465,
				    //'secure' => true,
				    'connection_config' => array(
				    	'ssl' => 'ssl',
				        'username' => 'no-reply@vne-ci.com',
				        'password' => 'noreply@2016',
				    ),
				));
				$transport->setOptions($options);
				$transport->send($Mail);

				$complete=true;
		   }catch(\Exception $e){
		   	var_dump($e->getMessage());
		   	
		   }

		return $complete;
	}




}//end class

$Worker = new Worker('myTube');
$Worker->listen();
