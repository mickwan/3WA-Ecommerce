<?php

try 
{
	$id = intval($_GET['id']);
	$productsManager = new ProductsManager($link);
	$product = $productsManager->findById($id);
	require('views/contents/product.phtml');
}
catch (Exception $exception)
{
	$error = $exception->getMessage();
}

?>