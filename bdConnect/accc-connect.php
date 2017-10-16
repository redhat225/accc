<?php 
try{
	$PDO = new PDO("mysql:host=localhost;dbname=accc","accc","accc",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}catch(PDOException $e){echo "Connexion Impossible";}
 ?>