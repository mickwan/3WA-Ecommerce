<?php
	$access = array(/* Tab contenant les pages disponibles du site */);
	$page = 'home'; /*page courante : home par default*/ 
	$error = '';
	require('config.php');
	$link = mysqli_connect($localhost, $login, $pass, $database);

	if (!$link)
	{
	    require('views/bigerror.phtml');
	    exit;
	}

	if (isset($_GET['page']))
	{
		if (in_array($_GET['page'], $access))
			$page = $_GET['page'];
	}

	$access_traitement = array(/*tab contenant les traitements.php*/);
	
	if (in_array($page, $access_traitement))
		require('apps/treatments/traitement_'.$page.'.php');
	require 'apps/skel.php';
?>