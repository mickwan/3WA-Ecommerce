<?php
	if (isset($_GET['id_cat']))
	{
		$id_cat = intval($_GET['id_cat']);
		$catMan = new CategoryManager($link);
		$category = $catMan->findById($id_cat);
		require ("views/contents/shop.phtml"); 
	}
?>