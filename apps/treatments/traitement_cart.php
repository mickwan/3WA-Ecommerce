<?php
	if (isset($_SESSION['id_user']))
	{
		if (isset($_POST['action']))
		{
			if ($_SESSION['admin'] == 0)
			{
				if ($_POST['action'] == 'add')
				{

				}
			}
			else if ($_SESSION['admin'] == 1)
			{
				
			}
		}
	}
	else
		require 'views/contents/must_be_logged.phtml';
?>