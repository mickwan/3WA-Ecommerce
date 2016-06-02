<?php
		$feedbacksManager = new FeedbackManager($link);
		$feedbacks = $feedbacksManager->findByStatus(0);
		$max = count($feedbacks);
		$i=0;
		while ($i < $max)
		{
			$user = $feedbacks[$i]->getAuthor();
			$product = $feedbacks[$i]->getProduct();
			require 'views/contents/display_feedback_admin.phtml';
			$i++;
		}
?>