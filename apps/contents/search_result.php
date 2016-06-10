<?php
	$productsManager = new productsManager($link);
	$result = $productsManager->findBySearch($search);

	$x=0;
	while ($x < count($result))
	{

		require 'views/content/search_result.phtml';
		$x++;
	}
?>