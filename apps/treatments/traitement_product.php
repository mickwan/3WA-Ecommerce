<?php

	try
	{
		if (isset($_GET['id'])
		{
			$id = intval($_GET['id']);
			$productsManager = new ProductsManager($link);
			$product = $productsManager->findById($id);
			$ref = $product->getRef();

		}
		else if 
		{

		}







	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
?>