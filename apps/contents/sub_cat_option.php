<?php
	$subCatMan = new SubCategoryManager($link);
	$subCategories = $subCatMan->findAll();
	$i = 0;
	while ($i < count($subCategories))
	{
		$selected = '';
		$category = $subCategories[$i]->getCategory();
		if (isset($id_sub_catEdit) && ($id_sub_catEdit == $subCategories[$i]->getId()))
			$selected = 'selected';
		require 'views/contents/sub_cat_option.phtml';
		$i++;
	}
?>