<?php
session_start();
require("../vendor/autoload.php");
use suiviClient\Entity\AuthClient;
use PollingEntity\Validator;
use PollingEntity\NewCourrier;
use suiviAdmin\Entity\ManageAdmin;
require("../bdConnect/accc-connect.php");

$AuthClient = new AuthClient();
$ManageAdmin = new ManageAdmin();
	 
if ( (isset($_SESSION['AuthClient'])) && (isset($_GET['f'])) && ($_GET['p']=="login") ) {
  				$filterValidation=new Validator\FilterValidator();
			if($filterValidation->flexFileValidator($_GET['f']))
			{
				$NewCourrier = new NewCourrier();
					$verdict=$NewCourrier->checkedFlexFile($_GET['f']);
							if($verdict)
							{
								header("Location:../simple_flex/index.php?pathPdf=".$_GET['f']);
							  	exit();
							}
							else
							{
								header("Location:index.php?p=compte");
								exit();
							}

  			}
  			else{
				header("Location:index.php?p=compte");
				exit();
  			}
 
 }

if( isset($_GET['p']) && preg_match("/^[a-z0-9]+$/i", $_GET['p']) )
	{	
		if(file_exists("View/".strtolower($_GET['p']).".php"))	
		$p=strtolower($_GET['p']);
		else
		$p="error";
		
		if(isset($_GET['f']) && preg_match("/^([a-z0-9]){20,150}\.pdf$/i", $_GET['f']) )
			$f=$_GET['f'];
		else
			$f="";

		if( (isset($_GET['token'])) && (preg_match("/^([a-z0-9]){20,150}$/i", $_GET['token'])) )
			$token=$_GET['token'];
	}
	else
	{
		$p="login";
	}

	ob_start();
	include "View/$p.php";
	$layout_content=ob_get_contents();
	ob_end_clean();

	include "template.php";





 ?>