<?php
	if (isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 0)
		{	
			if (isset($_POST['action']))
			{
				if ($_POST['action'] == 'add')
				{
					$contentEdit = null;
					$option = 'add';
					$contentAdd = 'Feedback content ...';
					$id_product = $_POST['id_product'];
					$id_feedback = 0;
				}
				else if ($_POST['action'] == 'edit')
				{
					$option = 'edit';
					$feedbackManager = new FeedbackManager($link);
					$feedback = $feedbackManager->findById($_POST['id_feedback']);
					$contentAdd = $feedback->getContent();
					$contentEdit = $feedback->getContent();
					$id_product = $feedback->getIdProduct();
					$id_feedback = $feedback->getId();
				}
				require 'views/contents/add_edit_feedback.phtml';
			}
		}
		else
			require 'views/contents/must_be_logged.phtml';
	}
	else
	{
		require 'views/contents/must_be_logged.phtml';
		exit;
	}
?>