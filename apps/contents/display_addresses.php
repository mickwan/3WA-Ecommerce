<?php
	$i = 0;
	while ($i < count($address))
	{
		if ($address[$i]->getType() == 0)
			$type = 'Home';
		else
			$type = 'Work';
		require 'views/contents/display_addresses.phtml';
		$i++;
	}
?>