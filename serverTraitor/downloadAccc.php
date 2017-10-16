<?php 
session_start();
if(isset($_SESSION['adminInfo']))
{
	$file=$_GET['piece'];
	$path="../suiviAdmin/suiviAdmin-img/courriersAccc/".$file;

	header('Content-Type: application/octet-stream');

	header('Content-Transfer-Encoding: Binary');

	header('Content-disposition: attachment; filename='.$path);
	//header("X-Sendfile".$path);
	echo readfile($path);
	//header("location:tchat.zip");
}else
header("location:/");
 ?>