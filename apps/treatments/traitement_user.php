<?php
	if ($_GET['page'] == 'logout')
	{
		$productManager = new ProductsManager($link);
		$cartManager = new CartManager($link);
		if ($_SESSION['admin'] == 0)
		{
			$cart = $cartManager->findCurrentCart($_SESSION['user']);
			if ($cart != null && $cart->getStatus() == 0)
			{
				$products = $cart->getProducts();
				$i = 0;
				try
				{
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
					$cartManager->removeCart($cart);
				}
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				}
			}
		}
		session_destroy();
		header ('Location: index.php?page=home');
		exit;
	}
	if (isset($_POST['action']))
	{
		if ($_POST['action'] == 'login')
		{
			if (!isset($_POST['email']))
				$error = "Enter your email";
			else if (!isset($_POST['password']))
				$error = "Enter your password";
			if (empty($error))
			{
				$email = $_POST['email'];
				$password = $_POST['password'];
				$usersManager = new UsersManager($link);
				if ($user = $usersManager->findByEmail($email))
				{
					if ($user->getStatus() == 0)
						$error = "Inactive Account";
					else
					{
						try
						{
							if ($user->verifPassword($password))
							{
								$_SESSION['id_user'] = $user->getID();
								$_SESSION['admin'] = $user->getAdmin();
								$_SESSION['user'] = $user;
								header ('Location: index.php?page=profile');
								exit; 
							}
						}
						catch (Exception $exception)
						{
							$error = $exception->getMessage();
						} 
					}
				}
				else 
					$error = "Invalid Email";	
			}
		}
		else if ($_POST['action'] == 'register')
		{
			try
			{
				$usersManager = new UsersManager($link);
				$usersManager->create($_POST);
				header('Location: index.php?page=login');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
		else if ($_POST['action'] == 'edit')
		{
			$usersManager = new UsersManager($link);
			$user = $usersManager->findById($_SESSION['id_user']);

			if (!isset($_POST['login']))
				$error = "Missing parameter: login";
			else if (!isset($_POST['firstname']))
				$error = "Missing parameter: firstname";
			else if (!isset($_POST['lastname']))
				$error = "Missing parameter: lastname";
			else if (!isset($_POST['email']))
				$error = "Missing parameter: email";
			else if (!isset($_POST['birth_date']))
				$error = "Missing parameter: birth date";
			else if (!isset($_POST['phone']))
				$error = "Missing parameter: phone";
			else if (!isset($_POST['sex']))
				$error = "Missing parameter: sex";	
			if (empty($error))
			{
				try
				{
					$user->setLogin($_POST['login']);
					$user->setFirstName($_POST['firstname']);
					$user->setLastName($_POST['lastname']);
					$user->setEmail($_POST['email'], $_POST['confirmEmail']);
					$user->setBirthDate($_POST['birth_date']);
					$user->setPhone($_POST['phone']);
					$user->setSex($_POST['sex']);
					$usersManager->update($user);
					$_SESSION['success'] = 'Your profile has been edited';
				}
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				}
				header('Location: index.php?page=profile');
				exit;
			}
		}
		else if ($_POST['action'] == 'pass_change')
		{
			$usersManager = new UsersManager($link);
			$user = $usersManager->findById($_SESSION['id_user']);
			if (!isset($_POST['password']))
				$error = "Missing parameter: password";
			else if (!isset($_POST['confirmPassword']))
				$error = "Missing parameter: password";
			if (empty($error))
			{		
				try
				{
					$user->setPassword($_POST['password'], $_POST['confirmPassword']);
					$usersManager->update($user);
					$_SESSION['success'] = 'Your password has been changed';
					header('Location: index.php?page=profile');
					exit;
				}
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				}
				header('Location: index.php?page=profile');
				exit;
			}
		}
		else if ($_POST['action'] == 'delete') // Le compte User n'est jamais supprimé mais plutôt rendu inactif
		{
			if ($_POST['choice'] == 'no')
			{
				header('Location: index.php?page=profile');
				exit;
			}
			else if ($_POST['choice'] == 'yes')
			{	
				$usersManager = new UsersManager($link);
				$user = $usersManager->findById($_SESSION['id_user']);
				try 
				{
					$user->setInactive();
					$usersManager->update($user);
				}
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				}
				header ('Location: index.php?page=logout');
				exit;
			}
		}
	}
?>