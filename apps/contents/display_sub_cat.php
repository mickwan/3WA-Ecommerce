<?php
	$subCategories = $categorie->getSubCat();
	$j = 0;
	$maxj = count($subCategories);
	while ($j < $maxj)
	{
		require 'views/contents/display_sub_cat.phtml';
		$j++;
	}
?>