<?php

	if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
	{
		if (isset($_POST['action']))
		{
			$productsManager = new ProductsManager($link);
			if ($_POST['action'] == 'add' && isset($_POST['form']))
			{
				try
				{
					$product = $productsManager->create($_POST);
					$id_product = $product->getId();
					header('Location: index.php?page=product&id_product='.$id_product);
					exit;
				}
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				}
			}
			else if ($_POST['action'] == 'edit'  && isset($_POST['form']))
			{
				try 
				{	 
					if (!isset($_POST['ref']))
						$error = "Indiquez la référence";
					if (!isset($_POST['stock']))
						$error = "Indiquez la quantité en stock";
					if (!isset($_POST['size']))
						$error = "Indiquez la taille (S, M, L ou 0 si l'article n'en a pas)";
					if (!isset($_POST['price']))
						$error = "Indiquez le prix (avec un . pour la virgule sans le sigle monétaire)";
					if (!isset($_POST['tax']))
						$error = "Indiquez la TVA (avec un . pour la virgule sans le %)";
					if (!isset($_POST['description']))
						$error = "Donnez une description du produit";
					if (!isset($_POST['name']))
						$error = "Donnez le nom (ou la désignation) du produit";
					if (!isset($_POST['weight']))
						$error = "Donnez le poids du produit (avec un . pour la virgule)";
					if (!isset($_POST['id_sub_cat']))
						$error = "Indiquez la sous-categorie du produits";
					if (!isset($_POST['status']))
						$error = "Indiquez le statut du produit";
					if (!isset($_FILES['picture']))
						$error = "picture";

					$id_product = intval($_POST['id_product']);
					$product = $productsManager->findById($id_product);

					$product->setRef($_POST['ref']);
					$product->setStock($_POST['stock']);
					$product->setSize($_POST['size']);
					$product->setPrice($_POST['price']);
					$product->setTax($_POST['tax']);
					$product->setDescription($_POST['description']);
					$product->setName($_POST['name']);
					$product->setWeight($_POST['weight']);
					$product->setSubCat($_POST['id_sub_cat']);
					$product->setStatus($_POST['status']);
					$product->setPicture($_FILES['picture']);

					$productsManager->update($product);
					header('Location: index.php?page=product&id_product='.$id_product);
					exit;
				}
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				}
			}
			else if ($_POST['action'] == 'delete')
			{
				try
				{
					$id_product = intval($_POST['id_product']);
					$product = $productsManager->findById($id_product);
					$productsManager->delete($product);
					header('Location: index.php?page=profile');
					exit;
				}
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				}
			}
		}
	}
	else 
	{
		require 'views/contents/must_be_logged.phtml';
		exit;
	}
?>