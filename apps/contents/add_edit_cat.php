<?php
	$action = 'add';
	$id_category = '0';
	$name = 'Enter a Name...';
	$description= 'Enter a small description...';
	$nameEdit = '';
	$descriptionEdit = '';
	if (isset($_POST['action']) && $_POST['action'] == 'edit')
	{
		$action = 'edit';
		$id_category = intval($_POST['id_category']);
		$categoryManager = new CategoryManager($link);
		$category = $categoryManager->findById($id_category);
		$name = $category->getName();
		$description = $category->getDescription();
		$nameEdit = $category->getName();
		$descriptionEdit = $category->getDescription();
	}
	require 'views/contents/add_edit_cat.phtml';
?>