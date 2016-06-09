<?php
	if (htmlentities($product->getStock()))
	{
		$max = htmlentities($product->getStock());
		if (htmlentities($product->getSize()))
			require 'views/contents/form_product_size.phtml';
		else
			require 'views/contents/form_product_nosize.phtml';
	}
	else
		require 'views/contents/sold_out.phtml';
?>