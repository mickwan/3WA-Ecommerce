<?php
	$action = "add";
	$ref = "add reference";
	$stock = "Stock of this products";
	$price = "Price (form 0.00)";
	$tax = "Tax (form 0.00)";
	$description = "Product description (max. 123 char.)";
	$name = "Product name (max. 15 char.)";
	$weight = "Weight (form 0.00)";
	$id_sub_cat = "Choice a sub category";
	$id_product = '0';
	$refEdit = '';
	$stockEdit = '';
	$sizeEdit = '';
	$priceEdit = '';
	$taxEdit = '';
	$descriptionEdit = '';
	$nameEdit = '';
	$weightEdit = '';
	$id_sub_catEdit = '';
	$statusEdit = '';
	$status0 = '';
	$status1 = '';
	$S = '';
	$M = '';
	$L = '';
	$O = '';

	if (isset($_POST['action']) && $_POST['action'] == 'edit')
	{
		$action = "edit";
		$id_product = intval($_POST['id_product']);
		$productManager = new ProductsManager($link);
		$product = $productManager->findById($id_product);
		$refEdit = $product->getRef();
		$stockEdit = $product->getStock();
		$priceEdit = $product->getPrice();
		$taxEdit = $product->getTax();
		$descriptionEdit = $product->getDescription();
		$nameEdit = $product->getName();
		$weightEdit = $product->getWeight();
		$id_sub_catEdit = $product->getIdSubCat();

		if ($product->getStatus() == 0)
			$status0 = 'selected';
		else
			$status1 = 'selected';

		if ($sizeEdit = $product->getSize() == 'S')
			$S = 'selected';
		else if ($sizeEdit = $product->getSize() == 'M')
			$M = 'selected';
		else if ($sizeEdit = $product->getSize() == 'L')
			$L = 'selected';
		else
			$O = 'selected';

	}
	
	require 'views/contents/product_admin.phtml';

?>