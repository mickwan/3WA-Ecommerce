<?php
	try
	{
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
		{
			if (isset($_GET['action']) && $_GET['action'] == 'delete')
			{
				if (isset($_GET['id_cat']) && !isset($_GET['id_sub_cat']))
				{
					$categoryManager = new CategoryManager($link);
					$category = $categoryManager->findById($_GET['id_cat']);
					$categoryManager->delete($category);
					header ('Location: index.php?page=cat_admin');
					exit;
				}
				if (isset($_GET['id_sub_cat']))
				{
					$subCategoryManager = new SubCategoryManager($link);
					$subCategory = $subCategoryManager->findById($_GET['id_sub_cat']);
					$subCategoryManager->delete($subCategory);
					header ('Location: index.php?page=cat_admin');
					exit;
				}
			}
			if (isset($_POST['action']))
			{
				if (isset($_POST['id_cat']))
				{
					$categoryManager = new CategoryManager($link);
					if ($_POST['action'] == 'add')
					{
						$categoryManager->create($_POST);
						header ('Location: index.php?page=cat_admin');
						exit;
					}
					else if ($_POST['action'] == 'edit')
					{
						$category = $categoryManager->findById($_POST['id_cat']);
						$category->setName($_POST['name']);
						$category->setDescription($_POST['description']);
						$categoryManager->update($category);
						header ('Location: index.php?page=cat_admin');
						exit;
					}
				}	
				else if (isset($_POST['id_sub_cat']))
				{
					$subCategoryManager = new SubCategoryManager($link);
					if ($_POST['action'] == 'add')
					{
						$subCategoryManager->create($_POST);
						header ('Location: index.php?page=cat_admin');
						exit;
					}
					else if ($_POST['action'] == 'edit')
					{
						$subCategory = $subCategoryManager->findById($_POST['id_sub_cat']);
						$subCategory->setName($_POST['name']);
						$subCategory->setDescription($_POST['description']);
						$subCategory->setCategory($_POST['id_category']);
						$subCategoryManager->update($subCategory);
						header ('Location: index.php?page=cat_admin');
						exit;	
					}
				}
			}
		}
		else
			throw new Exception("Vous devez être connecté!");
			
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	} 
?>