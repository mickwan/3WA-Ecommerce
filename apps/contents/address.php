<?php
	$addressManager = new AddressManager($link);
	$address = $addressManager->findByUser($_SESSION['user']);
	if (empty($address) || 
		(isset($_POST['action']) && $_POST['action'] == 'edit'))
		require('apps/contents/add_edit_address.php');
	else
		require('apps/contents/myaddresses.php')
?>