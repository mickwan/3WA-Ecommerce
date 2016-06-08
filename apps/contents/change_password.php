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
		require 'views/must_be_logged.phtml';
?>