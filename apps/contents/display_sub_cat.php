<?php
	$subCatManager = new SubCategoryManager($link);
	$subCategories = $subCatManager->findByCategory($categories[$i]->getId());
	$j = 0;
	$max = count($subCategories);
	while ($j < $max)
	{
		require 'views/contents/display_sub_cat.phtml';
		$j++;
	}
?>