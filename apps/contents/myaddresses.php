<?php
	$add_address = null;
	if (count($address) >= 2)
		$add_address = "You can't add an address until you delete an other!";
	if (isset($_SESSION['success']))
	{
		$success = $_SESSION['success'];
		$_SESSION['success'] = '';
	}
	require ('views/contents/myaddresses.phtml')
?>