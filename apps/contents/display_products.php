<?php
	if (isset($_GET['id_cat'])&& !isset($_GET['id_sub_cat']))
	{
		$prodMan = new ProductsManager($link);
		$products = $prodMan->findByCategory($category);
		$i = 0;
		while ($i < count($products))
		{
			if ($i == 0 || ($i >= 1 && $products[$i]->getIdSubCat() != $products[$i-1]->getIdSubCat()))
			{
				$id_product = $products[$i]->getId();
				require 'views/contents/display_products.phtml';
			}
			$i++;
		}
	}
	else if (isset($_GET['id_sub_cat']))
	{
		$id_sub_cat = intval($_GET['id_sub_cat']);
		$subCatMan = new SubCategoryManager($link);
		$sub_cat = $subCatMan->findById($id_sub_cat);
		$products = $sub_cat->getProducts();

		$i = 0;
		while ($i < count($products))
		{
			$id_product = $products[$i]->getId();
			require 'views/contents/display_products.phtml';
			$i++;
		}
	}
?>