<?php
	$id_product = intval($_GET['id_product']);
	$productsManager = new ProductsManager($link);
	$product = $productsManager->findById($id_product);
	if ($product != null)
	{
		$arraySize = $productsManager->findByName($product->getName());
		require('views/contents/product.phtml');
	}
	else
		require('views/contents/url_error.phtml');
?>