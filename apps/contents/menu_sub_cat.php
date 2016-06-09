<?php
	$subCatMan = new SubCategoryManager($link);
	$sub_cat = $subCatMan->findByCategory($category);

	if ($sub_cat == null)
		require 'views/contents/url_error.phtml';
	else
	{
		$i = 0;
		while ($i < count($sub_cat))
		{
			require ("views/contents/menu_sub_cat.phtml");
			$i++;
		}
	} 
?>