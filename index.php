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

	$access = array('logout', 'login', 'register', 'change_password', 'home', 'shop', 'product', 'current_cart', 'profile', 'cart', 'edit_contact', 'feedback', 'cat_admin', 'add_edit_cat', 'add_edit_sub_cat', 'product_admin', 'add_edit_feedback');
	$page = 'home'; /*page courante : home par default*/ 
	$error = '';
	$success = '';

	if (isset($_GET['page']))
	{
		if (in_array($_GET['page'], $access))
			$page = $_GET['page'];
	}

	$access_traitement = array(
								"login" => "user", 
								"logout" => "user", 
								"register" => "user", 
								"edit_contact" => "user",
								"change_password" => "user",
								"current_cart" => "cart", 
								"cart" => "cart",  
								"feedback" => "feedback",
								"add_edit_feedback" => "feedback",
								"cat_admin" => "cat",
								"add_edit_cat" => "cat",
								"add_edit_sub_cat" => "cat",
								"product_admin" => "product"
								);
	
	if (array_key_exists($page, $access_traitement))
		require('apps/treatments/traitement_'.$access_traitement[$page].'.php');
	require 'apps/skel.php';
?>