<?php
	if (isset($_POST['action']))
	{
		if (isset($_SESSION['id_user']))
		{
			if ($_SESSION['admin'] == 0)
			{
				$cartManager = new CartManager($link);
				$productsManager = new ProductsManager($link);
				$currentCart = $cartManager->findCurrentCart($_SESSION['user']);
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
							$id_product = intval($_POST['id_product']);
							$product = $productsManager->findById($id_product);
							$quantity = intval($_POST["quantity"]);
							$currentCart->setNbProducts($quantity);
							$currentCart->addProduct($product, $quantity);
							$product->changeStock(-$quantity);
							$i=0;
							while ($i < $quantity)
							{
								$currentCart->setPrice($product->getPrice());
								$currentCart->setWeight($product->getWeight());
								$i++;
							}
							$cartManager->update($currentCart);
							$productsManager->update($product);
							header('Location: index.php?page=product&id_product='.$id_product);
							exit;
						}
						catch (Exception $exception)
						{
							$error = $exception->getMessage();
						}
					}
				}
				if ($_POST['action'] == 'removeProduct')
				{
					if (!isset($_POST['quantity']))
						$error = "Enter a quantity";
					if (empty($error))
					{
						try
						{
							$product = $productsManager->findById($_POST['id_product']);
							$quantity = intval($_POST["quantity"]);
							$product->changeStock($quantity);
							$currentCart->removeProduct($product);
							$currentCart->setNbProducts(-$quantity);
							$i = 0;
							while ($i< $quantity)
							{
								$currentCart->setPrice(-$product->getPrice());
								$currentCart->setWeight(-$product->getWeight());
								$i++;
							}
							$cartManager->update($currentCart);
							$productsManager->update($product);
						}
						catch (Exception $exception)
						{
							$error = $exception->getMessage();
						}
					}
				}
				if ($_POST['action'] == 'valid')
				{
					$products = $currentCart->getProducts();
					if ($products == null)
						$error = "You can't check out an empty cart";
					//Vérifier si adresse présente					
					if (empty($error))
					{
						try
						{
						$currentCart->setStatus(1);
						$cartManager->update($currentCart);
						$cartManager->create();
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
			else if ($_SESSION['admin'] == 1)
			{
				$cartManager = new CartManager($link);
				$productsManager = new ProductsManager($link);
				if ($_POST['action'] == 'valid')
				{
					if (isset($_POST['id_cart']))
					{
						try
						{		
							$id_cart = intval($_POST['id_cart']);
							$cart = $cartManager->findById($id_cart);
							$cart->getProducts();;
	 						$cart->setStatus(2);
	 						$cartManager->update($cart);
	 					}
	 					catch (Exception $exception)
						{
							$error = $exception->getMessage();
						}
					}
				}
				if ($_POST['action'] == 'refuse')
				{
					if (isset($_POST['id_cart']))
					{
						try
						{	
							$productManager = new ProductsManager($link);
							$id_cart = intval($_POST['id_cart']);
							$cart = $cartManager->findById($id_cart);
							$products = $cart->getProducts();
	 						$cart->setStatus(3);
	 						$cartManager->update($cart);
	 						$i = 0;
	 						while ($i < count($products))
							{
								if ($i == 0 || ($i > 0 && $products[$i] != $products[$i-1]))
								{
									$quantity = $cartManager->getQuantity($products[$i], $cart);
									$products[$i]->changeStock($quantity);
									$productManager->update($products[$i]);
								}
								$i++;
							}
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
	}
?>