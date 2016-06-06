<?php
	$cartManager = new CartManager($link);
	$carts = $cartManager->findByStatus(1); // panier en status 1 validé uniquement par user
	$max = count($carts);
	$i = 0;
	while ($i < $max)
	{
			$cart = $carts[$i];
			require 'views/contents/display_carts_admin.phtml';
			$i++;
	}

?>