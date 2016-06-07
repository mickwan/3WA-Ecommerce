<?php
	if (isset($_SESSION['id_user']))
	{
		if (isset($_POST['action']))
		{
			if ($_SESSION['admin'] == 0)
			{
				$cartManager = new CartManager($link);
				$productsManager = new ProductsManager($link);
				$product = $productsManager->findById($_POST['id_product']);
				if ($_POST['action'] == 'addProduct')
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
							$currentCart->setNbProducts($_POST['quantity']);
							$currentCart->addProduct($product, $_POST['quantity']);
							$product->changeStock(-$_POST['quantity']);
							$i=0;
							while ($i < $_POST['quantity'])
							{
								$currentCart->setPrice($product->getPrice());
								$currentCart->setWeight($product->getWeight());
								$i++;
							}
							$cartManager->update($currentCart);
							$productsManager->update($product);
							var_dump($cartManager->getQuantity($product, $currentCart));
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
?>