<?php
	if (isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 0)
			require 'views/contents/profile_user.phtml';
		else if ($_SESSION['admin'] == 1)
			require 'views/contents/profile_admin.phtml';
	}
	else 
	{
		header ('Location: index.php?page=login');
		exit;
	}
?>