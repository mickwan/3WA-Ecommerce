<?php
	if (isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 1)
			require 'views/contents/product_admin.phtml';
	}
	else
	{
		header ('Location : index.php?page=login');
	}

?>