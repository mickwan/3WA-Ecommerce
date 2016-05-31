<?php
	$id = 1;
	$subCategoryManager = new SubCategoryManager($link);
	$sub_cat = $subCategoryManager->findByCategory($id);
require('views/contents/shop.phtml');
?>