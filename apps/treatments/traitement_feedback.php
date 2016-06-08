<?php
	if (isset($_SESSION['id_user']))
	{
		if (isset($_POST['action']))
		{
			$feedbackManager = new FeedbackManager($link);
			if ($_SESSION['user']->getAdmin() == 1 && $page == 'feedback')
			{
				$id_feedback = intval($_POST['id_feedback']);
				$feedback = $feedbackManager->findById($id_feedback);
				if ($_POST['action'] == 'valid')
				{
					try
					{
						$feedback->setStatus(1);
						$feedbackManager->update($feedback);
						$_SESSION['success'] = "This feedback has been checked";
						header('Location: index.php?page=feedback');
						exit;
					}
					catch (Exception $exception)
					{	
						$error = $exception->getMessage();
					}
				}
				else if ($_POST['action'] == 'refuse')
				{
					try
					{
						$feedback->setStatus(2);
						$feedbackManager->update($feedback);
						$_SESSION['success'] = "This feedback has been refused";
						header('Location: index.php?page=feedback');
						exit;
					}
					catch (Exception $exception)
					{
						$error = $exception->getMessage();
					}
				}
			}
			else if ($_SESSION['user']->getAdmin() == 0)
			{
				if ($_POST['action'] == 'add' && !isset($_POST['form']))
				{
					try
					{
						$feedbackManager->create($_POST);
						$id_product = intval($_POST['id_product']);
						$_SESSION['success'] = "Your feedback has been added. Waiting for validation";
						header('Location: index.php?page=product&id_product='.$id_product);
						exit;
					}
					catch (Exception $exception)
					{
						$error = $exception->getMessage();
					}
				}
				else if ($_POST['action'] == 'edit' && !isset($_POST['form']))
				{
					$id_feedback = intval($_POST['id_feedback']);
					$feedback = $feedbackManager->findById($id_feedback);
					if (!isset($_POST['content']))
						$error = "Paramètre manquant : Contenu";
					if (empty($error))
					{
						try
						{
							$feedback->setStatus(0);
							$feedback->setContent($_POST['content']);
							$feedbackManager->update($feedback);
							$_SESSION['success'] = "Your feedback has been edited. Waiting for validation";
							header('Location: index.php?page=feedback');
							exit;
						}
						catch (Exception $exception)
						{
							$error = $exception->getMessage();
						}
					}
				}
				else if ($_POST['action'] == 'delete')
				{
					$id_feedback = intval($_POST['id_feedback']);
					$feedback = $feedbackManager->findById($id_feedback);
					try
					{
						$feedbackManager->delete($feedback);
						$_SESSION['success'] = "Your feedback has been deleted.";
						header('Location: index.php?page=feedback');
						exit;
					}
					catch (Exception $exception)
					{
						$error = $exception->getMessage();
					}
				}
			}
		}
	}
	else 
	{
		header('Location: index.php?page=login');
		exit;
	}
?>