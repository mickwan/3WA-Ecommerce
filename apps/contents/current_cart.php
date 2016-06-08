<?php
	if (isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 0)
		{
			$cartManager = new CartManager($link);
			$cart = $cartManager->findCurrentCart($_SESSION['user']);
			require 'views/contents/current_cart.phtml';
		}
		else
			require 'views/must_be_user.phtml';
	}
	else 
		require 'views/contents/must_be_logged.phtml';
?>