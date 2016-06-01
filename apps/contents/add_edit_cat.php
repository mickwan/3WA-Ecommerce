<?php
	$action = 'add';
	$id_cat = '0';
	$name = 'Enter a Name...';
	$description= 'Enter a small description...';
	$nameEdit = '';
	$descriptionEdit = '';
	if (isset($_GET['action']) && $_GET['action'] == 'edit')
	{
		$action = 'edit';
		$id_cat = $_GET['id_cat'];
		$categoryManager = new CategoryManager($link);
		$category = $categoryManager->findById($id_cat);
		$name = $category->getName();
		$description = $category->getDescription();
		$nameEdit = $category->getName();
		$descriptionEdit = $category->getDescription();
	}
	require 'views/contents/add_edit_cat.phtml';
?>