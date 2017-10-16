<?php
session_start();
require("vendor/autoload.php");
use suiviClient\Entity\AuthClient;
use suiviClient\Entity\ManageClient;
require("bdConnect/accc-connect.php");

$AuthClient = new AuthClient();
$ManageClient = new ManageClient();


if(isset($_GET['p']) && preg_match("/^[a-z0-9]+$/i", $_GET['p']))
{	
	if(file_exists("suiviClient/View/".strtolower($_GET['p']).".php"))	
	$p=strtolower($_GET['p']);
	else
	$p="error";
}
else
{
	$p="login";
}
ob_start();
include "suiviClient/View/$p.php";
$layout_content=ob_get_contents();
ob_end_clean();

include "template.php";



 ?>