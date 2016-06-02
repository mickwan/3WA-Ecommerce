<?php
	if (isset($_SESSION['id_user']))
	{
		if (isset($_POST['action']))
		{
			if ($_POST['action'] == 'add')
			{
				$option = 'add';
				$content = 'Feedback content ...';
				$id_product = $_POST['id_product'];
				$id_feedback = 0;
			}
			else if ($_POST['action'] == 'edit')
			{
				$option = 'edit';
				$feedbackManager = new FeedbackManager($link);
				$feedback = $feedbackManager->findById($_POST['id_feedback']);
				$content = $feedback->getContent();
				$id_product = $feedback->getIdProduct();
				$id_feedback = $feedback->getId();
			}
			require 'views/contents/add_edit_feedback.phtml';
		}
	}
	else
	{
		require 'views/contents/must_be_logged.phtml';
		exit;
	}
?>