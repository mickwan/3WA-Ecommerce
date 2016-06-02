<?php
	$feedbacksManager = new FeedbackManager($link);
	$feedbacks = $feedbacksManager->findByAuthor($_SESSION['user']);
	$max = count($feedbacks);
	$i=0;
	while ($i < $max)
	{
		$refuse = '';
		$waitinglist = '';
		$product = $feedbacks[$i]->getProduct();
		if ($feedbacks[$i]->getStatus() == 2)
			$refuse = 'refuse';
		if ($feedbacks[$i]->getStatus() == 0)
			$waitinglist = 'waitinglist';
		require 'views/contents/display_feedback_user.phtml';
		$i++;
	}
?>