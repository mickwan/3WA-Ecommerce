<?php
	try
	{
		if (isset($_GET['id'], $_GET['action']))
		{
			$id = intval($_GET['id']);
			$feedbackManager = new FeedbackManager($link);
			$feedback = $feedbackManager->findById($id);
		}
		else 
			throw new Exception("No id");
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	} 
?>