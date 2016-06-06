<?php
	$i = 0;
	while ($i < count($arraySize))
	{
		if ($arraySize[$i]->getSize() == "S"
			|| $arraySize[$i]->getSize() == "M"
			|| $arraySize[$i]->getSize() == "L")
		{
			$size = $arraySize[$i]->getSize();
			require 'views/contents/product_size_option.phtml';
		}
		$i++;
	}
?>