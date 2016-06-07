<?php
	$cartManager = new CartManager($link);
	$carts = $cartManager->findByStatus(1); // panier en status 1 validé uniquement par user	
	$i = 0;
	$max = count($carts);
	while ($i < $max)
	{
			$cart = $carts[$i];
			$products = $cart->getProducts();
			$j = 0;
			$maxprod = count($products);

			while ($j < $maxprod)
			{
				
				require 'views/contents/display_carts_admin.phtml';
				$j++;	
			}

			$i++;
	}

?>