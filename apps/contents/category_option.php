<?php
	$categoryManager = new CategoryManager($link);
	$categories = $categoryManager->findAll();
	$i = 0;
	$max = count($categories);
	while ($i < $max)
	{
		$selected = '';
		if (isset($_GET['action']) && $_GET['action'] == 'edit')
		{
			if($id_cat == $categories[$i]->getId())
				$selected = 'selected';
		}
		require 'views/contents/category_option.phtml';
		$i++;
	}
?>