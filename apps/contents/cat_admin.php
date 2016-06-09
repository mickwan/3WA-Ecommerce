<?php
if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
	require 'views/contents/cat_admin.phtml';
else
	require 'views/must_be_logged.phtml';
?>