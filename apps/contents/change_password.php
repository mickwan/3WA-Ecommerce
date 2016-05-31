<?php
	if (isset($_SESSION['id_user']))
	{
		try
		{
			$user_manager = new UsersManager($link);
			$user = $user_manager->findById($_SESSION['id_user']);
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
		require 'views/contents/change_password.phtml';
	}
	else 
		header ('Location: index.php?page=login');
?>