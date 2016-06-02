<?php
	if ($_GET['page'] == 'logout')
	{
		session_destroy();
		header ('Location: index.php?page=home');
		exit;
	}
	if (isset($_POST['action']))
	{
		if ($_POST['action'] == 'login')
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
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
			header('Location: index.php?page=profile');
			exit;
		}
		else if ($_POST['action'] == 'pass_change')
		{
			$usersManager = new UsersManager($link);
			$user = $usersManager->findById($_SESSION['id_user']);
			try
			{
				$user->setPassword($_POST['password'], $_POST['confirmPassword']);
				$usersManager->update($user);
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
			header('Location: index.php?page=profile');
			exit;
		}
		else if ($_POST['action'] == 'delete') // Le compte User n'est jamais supprimé mais plutôt rendu inactif
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
?>