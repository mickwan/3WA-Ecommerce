<?php

	if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
	{
		if (isset($_post['action']))
		{
			$productsManager = new ProductsManager($link);
			try
			{
				$productsManager->create($_POST);
				header('Location: index.php?page=product');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}

//  quelque chose ici !!!

	}
	else 
	{
		require 'views/contents/must_be_logged.phtml';
		exit;
	}







?>