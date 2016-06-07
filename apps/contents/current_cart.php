<?php
	if (isset($_SESSION['id_user']))
	{
		$cartManager = new CartManager($link);
		$cart = $cartManager->findCurrentCart($_SESSION['user']);
		require 'views/contents/current_cart.phtml';
	}
	else 
		require 'views/contents/must_be_logged.phtml';
?>