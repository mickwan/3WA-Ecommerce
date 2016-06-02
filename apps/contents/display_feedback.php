<?php

	$feedbacks = $produit->getFeedbacks();

	$i = 0;
	$count = count($feedbacks); 
	while ($i < $count)
	{
		$user = $feedbacks[$i]->getAuthor();
		require('views/contents/display_feedback.phtml');
		$i++;
	}
?>