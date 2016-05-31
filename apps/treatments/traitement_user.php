<?php
	if (isset($_POST['action']))
	{
		if ($_POST['action'] == 'logout')
		{
			session_destroy();
			header ('Location: index.php?page=home');
			exit;
		}

		if ($_POST['action'] == 'login')
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			$usersManager = new UsersManager($link);
			try 
			{
				if ($user = $usersManager->findByEmail($email))
				{
					if ($user->getStatus() == 0)
					{					
						throw new Exception("Inactive Account");
					}
					else if (password_verify($password, $user->getPassword()))
					{
						$_SESSION['id_user'] = $user->getID();
						$_SESSION['admin'] = $user->getAdmin();
						header ('Location: index.php?page=home');
						exit; 
					}
					else
						throw new Exception("Invalid Password");
				}
				else 
					throw new Exception("Invalid Email");
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}

		if ($_POST['action'] == 'register')
		{
			$usersManager = new UsersManager($link);
			try
			{
				$usersManager->create($_POST);
				header('Location: index.php?page=login');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}

		if ($_POST['action'] == 'edit')
		{
			try
			{
				$usersManager = new UsersManager($link);
				$user = $usersManager->findById($_SESSION['id_user']);
				$user->setLogin($_POST['login']);
				$user->setFirstName($_POST['firstname']);
				$user->setLastName($_POST['lastname']);
				$user->setEmail($_POST['email'], $_POST['confirmEmail']);
				$user->setPassword($_POST['password'], $_POST['confirmPassword']);
				$user->setBirthDate($_POST['birth_date']);
				$user->setPhone($_POST['phone']);
				$user->setSex($_POST['sex']);

				$usersManager->update($user);
				header('Location: index.php?page=profile');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}

		if ($_POST['action'] = 'delete') // Le compte User n'est jamais supprimé mais plutôt rendu inactif
		{
			$usersManager = new UsersManager($link);
			$user = $usersManager->findById($_SESSION['id_user']);
			$user->setInactive();
			header ('Location: index.php?page=logout');
			exit;
		}
	}
?>