<?php
	try
	{
		if (isset($_SESSION['id_user']))
		{
			if (isset($_GET['action']))
			{
				if ($_SESSION['admin'] == 1)
				{
					$id = intval($_GET['id']);
					$feedbackManager = new FeedbackManager($link);
					$feedback = $feedbackManager->findById($id);
					if ($_GET['action'] == 'valid')
					{
						$feedback->setStatus(1);
						$feedbackManager->update($feedback);
						header('Location: index.php?page=feedback');
						exit;
					}
					else if ($_GET['action'] == 'refuse')
					{
						$feedback->setStatus(2);
						$feedbackManager->update($feedback);
						header('Location: index.php?page=feedback');
						exit;
					}
				}
				else if ($_SESSION['admin'] == 0)
				{
					$id = intval($_GET['id']);
					$feedbackManager = new FeedbackManager($link);
					$feedback = $feedbackManager->findById($id);
					if ($_GET['action'] == 'edit')
					{

					}
					else if ($_GET['action'] == 'delete')
					{
						$feedbackManager->remove($feedback);
						header('Location: index.php?page=feedback');
						exit;
					} 
				}
			}
		}
		else
		{
			header ('Location: index.php?page=login');
			exit;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	} 
?>