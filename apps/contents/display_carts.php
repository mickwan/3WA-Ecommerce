<?php
	$cartManager = new CartManager($link);
	$carts = $cartManager->findByUser($_SESSION['user']);
	$max = count($carts);
	$i = 0;
	while ($i < $max)
	{
		if ($carts[$i]->getStatus() == 2)  // condition si panier validé par admin en status 2
		{
			$cart = $carts[$i];
			require 'views/contents/display_carts.phtml';
			$i++;
		}
	}



?>