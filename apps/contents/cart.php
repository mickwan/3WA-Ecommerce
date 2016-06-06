<?php

	if(isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 1)
			require 'views/contents/cart_admin.phtml';
		else
			require 'views/contents/cart_user.phtml';
	}
	else
		header('Location : index.php?page=login');

?>