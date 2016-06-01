<?php

try 
{
	$feedbackManager = new FeedbackManager($link);
	$feedbacks = $feedbackManager->findByProduct($id_product);
	$userManager = new UsersManager($link);
	$user = new Users($link);

	$i = 0;
	$count = count($feedbacks); 
	while ($i < $count)
	{
		$user = $userManager->findById($feedbacks[$i]->getAuthor());
		require('views/contents/display_feedback.phtml');
		$i++;
	}
}
catch (Exception $exception)
{
	$error = $exception->getMessage();
}

?>