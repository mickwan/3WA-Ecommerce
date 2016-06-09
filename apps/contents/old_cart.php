<?php
	$id_cart = intval($_GET['id_cart']);
	$cartManager = new CartManager($link);
	$cart = $cartManager->findById($id_cart);
	if ($cart == null)
		require 'views/contents/url_error.phtml';
	else
		require 'views/contents/old_cart.phtml';
?>