<?php
	$id_cart = intval($_GET['id_cart']);
	$cartManager = new CartManager($link);
	$cart = $cartManager->findById($id_cart);
	require 'views/contents/old_cart.phtml';
?>