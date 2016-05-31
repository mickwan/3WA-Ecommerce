<?php
	try
	{
		$option = "Add ";
		$content = "Feedback content...";
		$id_product = '';

		if (isset($_GET['id'], $_GET['action']) && $_GET['action'] == 'edit')
		{
			if ($_GET['action'] == 'edit')
			{
				$id = intval($_GET['id']);
				$feedbackManager = new FeedbackManager($link);
				$feedback = $feedbackManager->findById($id);

				$option = "Edit ";
				$content = $feedback->getContent();
			}
			else if ($_GET['action'] == 'add')
				$id_product = $_GET['id_product'];
		}
		require 'views/contents/add_edit_feedback.phtml';
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	} 
?>