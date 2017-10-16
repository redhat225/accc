<?php 
session_start();
if(isset($_SESSION['adminInfo']))
{	

	$path="../suiviAdmin/suiviAdmin-img/courriers/{$_GET['piece']}";

	header("Content-Type: application/octet-stream");
	header('Content-Transfer-Encoding: Binary');
	header('Content-Disposition: attachement; filename="'.basename($path).'"');
	//header("XSendfile:".$path);
	
	echo readfile($path);
	//header("location:tchat.zip");
}else
header("location:../index.php?p=login");
 ?>
