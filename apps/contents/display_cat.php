<?php
	$catManager = new CategoryManager($link);
	$categories = $catManager->findAll();
	$i = 0;
	$max = count($categories);
	while ($i < $max)
	{
		$categorie = $categories[$i];
		require 'views/contents/display_cat.phtml';
		$i++;
	}
?>