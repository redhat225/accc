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
use Pheanstalk\Pheanstalk;

class Publisher{
	private $tube;
	private $client;

	public function __construct($args)
	{
		$this->tube = $args;
		$this->client = new Pheanstalk('127.0.0.1');

	}

	public function send($request)
	{
		return $this->client
			 ->useTube($this->tube)
			 ->put(json_encode($request));	
			 //->put($request);
	}	
}

