<?php
session_start();
error_reporting(E_ALL & ~(E_WARNING));

	if(isset($_SESSION['AuthClient'])){

			//connexion à la bd
			require("../../../bdConnect/accc-connect.php");
			require("../../Entity/ManageClient.php");

			$ManageClient->accountClientInfo($_SESSION['AuthClient']->id);
			$ManageClient->courrierInfo($_SESSION['AuthClient']->id);
			if(isset($_REQUEST['ssPage']))
			{
				if(file_exists("Content/".strtolower($_REQUEST['ssPage']).".php"	))
				{
					$p=strtolower($_REQUEST['ssPage']);
				}
				else
				{
					$p="error-client-page";
				}

			}
			else
			{
				$p='suivi-general-client';
			}

			include "Content/$p.php";
	}else
	header("Location:/");

 ?>