<?php
	$action = 'add';
	$id_sub_cat = '0';
	$name = 'Enter a Name...';
	$description= 'Enter a small description...';
	$nameEdit = '';
	$descriptionEdit = '';
	if (isset($_POST['action']) && $_POST['action'] == 'edit')
	{
		$action = 'edit';
		$id_sub_cat = $_POST['id_sub_cat'];
		$subCategoryManager = new SubCategoryManager($link);
		$subCategory = $subCategoryManager->findById($id_sub_cat);
		$name = htmlentities($subCategory->getName());
		$description = htmlentities($subCategory->getDescription());
		$nameEdit = htmlentities($subCategory->getName());
		$descriptionEdit = htmlentities($subCategory->getDescription());
		$id_cat = htmlentities($subCategory->getCategory());
	}
	require 'views/contents/add_edit_sub_cat.phtml';
?>