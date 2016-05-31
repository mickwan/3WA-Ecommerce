<?php

try 
{
// if (isset($_GET['product.id']))
// {
	$id = 1;
	$productsManager = new ProductsManager($link);
	$product = $productsManager->findById($id);
	require('views/contents/product.phtml');
/*
}
else
	throw nex Exception("error Id product not found");

*/
}
catch (Exception $exception)
{
	$error = $exception->getMessage();
}

?>