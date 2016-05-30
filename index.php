<?php
	session_start();

	//Connection à la BDD
	require('config.php');
	$link = mysqli_connect($localhost, $login, $pass, $database);

	if (!$link) 
	{
	    require('views/bigerror.phtml');
	    exit;
	}

	//Autoload des classes 
	function __autoload($className)
	{
		require ("models/".$className.".class.php");
	}

	$access = array('logout', 'login', 'register', 'home', 'shop', 'product', 'cart', 'profile', 'cart_user', 'edit_contact', 'feedback', 'cat_admin', 'product_admin', 'cart_admin');
	$page = 'home'; /*page courante : home par default*/ 
	$error = '';

	if (isset($_GET['page']))
	{
		if (in_array($_GET['page'], $access))
			$page = $_GET['page'];
	}

	$access_traitement = array(["login" => "user", "logout" => "user", "register" => "user", "edit_contact" => "user"],["cart" => "cart", "cart_user" => "cart", "cart_admin" => "cart"], "feedback", "cat_admin", "product_admin");
	
	if (in_array($page, $access_traitement))
		require('apps/treatments/traitement_'.$page.'.php');
	require 'apps/skel.php';
?>