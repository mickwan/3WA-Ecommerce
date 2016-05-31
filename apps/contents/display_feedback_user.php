<?php
	try 
	{
		$feedbacksManager = new FeedbackManager($link);
		$productsManager = new ProductsManager($link);
		$feedbacks = $feedbacksManager->findByAuthor($_SESSION['id_user']);
		$max = count($feedbacks);
		$i=0;
		$refuse = '';
		$waitinglist = '';
		while ($i < $max)
		{
			$product = $productsManager->findById($feedbacks[$i]->getProduct());
			if ($feedbacks[$i]->getStatus() == 2)
				$refuse = 'refuse';
			if ($feedbacks[$i]->getStatus() == 0)
				$waitinglist = 'waitinglist';
			require 'views/contents/display_feedback_user.phtml';
			$refuse = '';
			$i++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
?>