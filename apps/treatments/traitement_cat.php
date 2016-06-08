<?php
	if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
	{
		if (isset($_POST['action']))
		{
			if (isset($_POST['id_category']) && !isset($_POST['id_sub_cat']))
			{
				$categoryManager = new CategoryManager($link);
				if ($_POST['action'] == 'add' && !isset($_POST['form']))
				{
					try
					{	
						$categoryManager->create($_POST);
						$_SESSION['success'] = "Your category has been added";
						header('Location: index.php?page=cat_admin');
						exit;
					}
					catch (Exception $exception)
					{
						$error = $exception->getMessage();
					}
				}
				else if ($_POST['action'] == 'edit' && !isset($_POST['form']))
				{
					if (!isset($_POST['name']))
						$error = "Nommer la catégorie";
					if (!isset($_POST['description']))
						$error = "Donner une description succincte de la catégorie";
					if (empty($error))
					{
						try
						{
							$id_category = intval($_POST['id_category']);
							$category = $categoryManager->findById($id_category);
							$category->setName($_POST['name']);
							$category->setDescription($_POST['description']);
							$categoryManager->update($category);
							$_SESSION['success'] = "Your category has been edited";
							header('Location: index.php?page=cat_admin');
							exit;
						}
						catch (Exception $exception)
						{
							$error = $exception->getMessage();
						}
					}

				}
				else if ($_POST['action'] == 'delete')
				{
					try 
					{
						$id_category = intval($_POST['id_category']);
						$category = $categoryManager->findById($id_category);
						$categoryManager->delete($category);
						$_SESSION['success'] = "Your category has been deleted";
						header('Location: index.php?page=cat_admin');
						exit;
					}
					catch (Exception $exception)
					{
						$error = $exception->getMessage();
					}
				}
			}
			else if (isset($_POST['id_sub_cat']))
			{
				$subCategoryManager = new SubCategoryManager($link);
				if ($_POST['action'] == 'add' && !isset($_POST['form']))
				{
					try
					{	
						$subCategoryManager->create($_POST);
						$_SESSION['success'] = "Your sub-category has been added";
						header('Location: index.php?page=cat_admin');
						exit;
					}
					catch (Exception $exception)
					{
						$error = $exception->getMessage();
					}
				}
				else if ($_POST['action'] == 'edit' && !isset($_POST['form']))
				{
					if (!isset($_POST['id_category']))
						$error = "Missing paramater: id_category";
					if (!isset($_POST['name']))
						$error = "Nommer la sous catégorie";
					if (!isset($_POST['description']))
						$error = "Donner une description succincte de la sous catégorie";
					if (empty($error))
					{
						try
						{
							$id_sub_cat = intval($_POST['id_sub_cat']);
							$subCategory = $subCategoryManager->findById($id_sub_cat);
							$subCategory->setCategory($_POST['id_category']);
							$subCategory->setName($_POST['name']);
							$subCategory->setDescription($_POST['description']);
							$subCategoryManager->update($subCategory);
							$_SESSION['success'] = "Your sub-category has been edited";
							header('Location: index.php?page=cat_admin');
							exit;
						}
						catch (Exception $exception)
						{
							$error = $exception->getMessage();
						}
					}
				}
				else if ($_POST['action'] == 'delete')
				{
					try 
					{
						$id_sub_cat = intval($_POST['id_sub_cat']);
						$subCategory = $subCategoryManager->findById($id_sub_cat);
						$subCategoryManager->delete($subCategory);
						$_SESSION['success'] = "Your sub-category has been deleted";
						header('Location: index.php?page=cat_admin');
						exit;
					}
					catch (Exception $exception)
					{
						$error = $exception->getMessage();
					}
				}
			}
		}
	}
	else
	{
		header('Location: index.php?page=login');
		exit;
	}
?>