<?php
	$add_address = null;
	if (count($address) >= 2)
		$add_address = "You can't add an address until you delete an other!";
	require ('views/contents/myaddresses.phtml')
?>