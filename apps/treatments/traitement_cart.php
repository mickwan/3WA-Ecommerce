<?php
	if (isset($_SESSION['id_user']))
	{
		if (isset($_POST['action']))
		{
			if ($_SESSION['admin'] == 0)
			{
				$cartManager = new CartManager($link);
				if ($_POST['action'] == 'add')
				{

					if (!isset($_POST['size']))
						$error = "Enter a size";
					if (!isset($_POST['quantity']))
						$error = "Enter a quantity";
					if (empty($error))
					{
						try
						{
							$currentCart = $cartManager->findCurrentCart($_SESSION['user']);
							if (empty($currentCart))
								$currentCart = $cartManager->create();
							/*Besoin d'un changement et de précision dans la bdd*/
						}
						catch (Exception $exception)
						{
							$error = $exception->getMessage();
						}
					}
				}
			}
			else if ($_SESSION['admin'] == 1)
			{

			}
		}
	}
	else
		require 'views/contents/must_be_logged.phtml';
?>