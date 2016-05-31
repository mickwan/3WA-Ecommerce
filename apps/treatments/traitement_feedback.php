<?php
	if (isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 1)
		{
			if (isset($_GET['action']))
			{
				try
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
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				} 
			}
		}
		else
		{
			//Les changements du user
		}
	}
	else
	{
		header ('Location: index.php?page=login');
		exit;
	}
?>