<?php
	$id = 1;
	$SubCategory = new SubCategoryManager($link);
	$sub_cat = $SubCategoryManager->findById($id);

	$i = 0;
	$count = count($sub_cat); 
		while ($i < $count)
		{
			$test = $sub_cat[$i];
			require('views/contents/shop.phtml');
			$i++;
		}
?>