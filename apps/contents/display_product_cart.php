<?php
	$products = $carts[$i]->getProducts();
	$j = 0;
	while ($j < count($products))
	{
		$quantity = $cartManager->getQuantity($products[$j], $carts[$i]);
		if ($j == 0 || ($j > 0 && $products[$j] != $products[$j-1]))
			require 'views/contents/display_product_cart.phtml';
		$j++;
	}
?>