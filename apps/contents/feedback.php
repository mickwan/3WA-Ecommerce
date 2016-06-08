<?php
	if (isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 1)
			require 'views/contents/feedback_admin.phtml';
		else
			require 'views/contents/feedback_user.phtml';
	}
	else 
		require 'views/contents/must_be_logged.phtml';
?>