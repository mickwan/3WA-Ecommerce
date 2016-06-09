<?php
	$cartManager = new CartManager($link);
	$carts = $cartManager->findByUser($_SESSION['user']);
	$max = count($carts);
	$i = 0;
	while ($i < $max)
	{
		if ($carts[$i]->getStatus() == 0)  // condition si panier validé par admin en status 2
			$class = "current";
		else if ($carts[$i]->getStatus() == 1)
			$class = "waitinglist";
		else if ($carts[$i]->getStatus() == 2)
			$class = "valid";
		else if ($carts[$i]->getStatus() == 3)
			$class = "refuse";
		require 'views/contents/display_carts.phtml';
		$i++;
	}
?>