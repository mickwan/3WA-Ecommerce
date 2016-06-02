<?php
	$feedbacks = $product->getFeedbacks();
	$i = 0;
	$count = count($feedbacks); 
	while ($i < $count)
	{
		$user = $feedbacks[$i]->getAuthor();
		if ($feedbacks[$i]->getStatus() == 1)
			require('views/contents/display_feedback.phtml');
		$i++;
	}
?>