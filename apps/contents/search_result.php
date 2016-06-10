<?php
	$search = $_GET['search'];
	$productsManager = new ProductsManager($link);
	$result = $productsManager->findBySearch($search);

	$x=0;
	while ($x < count($result))
	{
		require 'views/contents/search_result.phtml';
		$x++;
	}
?>