<?php
	try 
	{
		$feedbacksManager = new FeedbackManager($link);
		$usersManager = new UsersManager($link);
		$productsManager = new ProductsManager($link);
		$feedbacks = $feedbacksManager->findByStatus(0);
		$max = count($feedbacks);
		$i=0;
		while ($i < $max)
		{
			$user = $usersManager->findById($feedbacks[$i]->getAuthor());
			$product = $productsManager->findById($feedbacks[$i]->getProduct());
			require 'views/contents/display_feedback_admin.phtml';
			$i++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
?>