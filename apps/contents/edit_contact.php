<?php
	$Mcheck = '';
	$Fcheck = '';
	if (isset($_SESSION['id_user']))
	{
		$user_manager = new UsersManager($link);
		$user = $user_manager->findById($_SESSION['id_user']);
		if ($user->getSex() == 'M')
			$Mcheck = 'checked';
		else
			$Fcheck = 'checked';
		require 'views/contents/edit_contact.phtml';
	}
	else 
		header ('Location: index.php?page=login');
?>