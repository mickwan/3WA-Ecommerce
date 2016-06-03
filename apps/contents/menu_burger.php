<?php
	if (isset($_SESSION['admin']) && $_SESSION['admin'] == '1')
		require 'views/contents/menu_burger.phtml';
?>