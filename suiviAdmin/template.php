<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($headTitle)) echo $headTitle; else echo "Bienvenue | Service de suivi courrier ACCC"; ?></title>
<link rel="stylesheet" type="text/css" href="../bower_components/Materialize/dist/css/materialize.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="../css/style.min.css"/>
<link rel="stylesheet" type="text/css" href="../Assets/ionicons-2.0.1/css/ionicons.min.css" media="screen"/>
<link rel="shortcut icon" href="../img/favicon.ico" media="screen"/>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/Materialize/dist/js/materialize.min.js"></script>
<script src="../js/accc-client.js"></script>

</head>
<body <?php if (isset($backGreen)) echo "class=backGreen"; ?>>

<?php echo $layout_content; ?>

</body>
</html>
	