<?php
	if (isset($_SESSION['id_user']))
	{
		$cartManager = new CartManager($link);
		$cart = $cartManager->findCurrentCart($_SESSION['user']);
	}
	else 
		require 'views/contents/must_be_logged.phtml';
?>