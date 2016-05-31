<?php
	if (isset($_SESSION['id_user']))
	{
		$user_manager = new UsersManager($link);
		$user = $user_manager->findById($_SESSION['id_user']);
		require 'views/contents/edit_contact.phtml';
	}
	else 
		header ('Location: index.php?page=login');
?>