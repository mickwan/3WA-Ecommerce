<?php
	$Mcheck = '';
	$Fcheck = '';
	if (isset($_SESSION['id_user']))
	{
		try 
		{
			$user_manager = new UsersManager($link);
			$user = $user_manager->findById($_SESSION['id_user']);
			if ($user->getSex() == 'M')
				$Mcheck = 'checked';
			else
				$Fcheck = 'checked';
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
		require 'views/contents/edit_contact.phtml';
	}
	else 
		require 'views/contents/must_be_logged.phtml';
?>