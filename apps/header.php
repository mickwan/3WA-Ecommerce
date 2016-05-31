<?php
	if (isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 1)
			require 'views/header_admin.phtml';
		else
			require 'views/header_log.phtml'; 
	}
	else
		require 'views/header_guest.phtml';
?> 