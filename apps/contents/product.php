<?php
	try 
	{
		$id_product = intval($_GET['id_product']);
		$productsManager = new ProductsManager($link);
		$product = $productsManager->findById($id_product);
		require('views/contents/product.phtml');
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
?>