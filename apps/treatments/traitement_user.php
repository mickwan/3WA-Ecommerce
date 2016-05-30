<?php
	if ($_GET['action'] == 'logout')
	{
		session_destroy();
		header ('Location: index.php?page=home');
		exit;
	}
	if ($_GET['action'] == 'login')
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$usersManager = new UsersManager($link);
		try 
		{
			if ($user = $usersManager->findByEmail($email))
			{
				if (password_verify($password, $user->getPassword()))
				{
					$_SESSION['id_user'] = $user->getID();
					$_SESSION['admin'] = $user->getAdmin();
					header ('Location: index.php?page=home');
					exit; 
				}
				else
					$error = "Invalid password";
			}
			else 
				$error = "Invalid Email";
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
	if ($_GET['action'] == 'register')
	{
		$usersManager = new UsersManager;
		try
		{
			$usersManager->create($_POST);
			header('Location: index.php?page=login');
			exit;
		}
		catch 
		{
			$error = $exception->getMessage();
		}
	}
	if ($_GET['action'] == 'edit_info')
	{
		$usersManager = new UsersManager;
		try
		{
			$usersManager->update($_POST);
			header('Location: index.php?page=profile');
			exit;
		}
		catch 
		{
			$error = $exception->getMessage();
		}
	}
?>