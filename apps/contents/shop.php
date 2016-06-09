<?php
	if (isset($_GET['id_cat']))
	{
		$id_cat = intval($_GET['id_cat']);
		$catMan = new CategoryManager($link);
		$category = $catMan->findById($id_cat);
		if ($category == null)
			require 'views/contents/url_error.phtml';
		else
			require ("views/contents/shop.phtml"); 
	}
?>