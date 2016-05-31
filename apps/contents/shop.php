<?php
	$id = 1;
	$SubCategoryManager = new SubCategoryManager($link);
	$sub_cat = $SubCategoryManager->findByCategory($id);
require('views/contents/shop.phtml');
?>