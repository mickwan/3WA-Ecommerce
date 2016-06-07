<?php
	$products = $cart->getProducts();
	$i = 0;
	while ($i < count($products))
	{
		$max = $products[$i]->getStock();
		$quantity = $cartManager->getQuantity($products[$i], $cart);
		if ($i == 0 || ($i > 0 && $products[$i] != $products[$i-1]))
			require 'views/contents/form_current_cart.phtml';
		$i++;
	}
?>