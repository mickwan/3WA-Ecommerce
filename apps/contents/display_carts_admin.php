<?php
	$cartManager = new CartManager($link);
	$userManager = new UsersManager($link);
	$carts = $cartManager->findByStatus(1); // panier en status 1 validé uniquement par user	
	$i = 0;
	$max = count($carts);
	while ($i < $max)
	{
		$user = $userManager->findById($carts[$i]->getIdUser());
		require 'views/contents/display_carts_admin.phtml';
		$i++;
	}
?>