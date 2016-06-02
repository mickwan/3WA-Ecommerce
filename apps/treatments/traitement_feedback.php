<?php
	try
	{
		if (isset($_SESSION['id_user']))
		{
			if (isset($_GET['action']) || isset($_POST['action']))
			{
				if ($_GET['action'] == 'add' && $_SESSION['admin'] == 1)
				{
					header ('Location: index.php?page=profile');
					exit;
				}
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
					$feedbackManager = new FeedbackManager($link);
					if (isset($_POST['action']) && $_POST['action'] == 'add')
					{
						$feedbackManager->create($_POST);
						dazdaz
						// if exists $produit
						$feedbackManager->create($_POST, $user, $produit);
						header("Location: index.php?page=product&id_product=".$product->getId()."");
						exit;
					}

					if (isset($_POST['action']) && $_POST['action'] == "edit")
					{
						$id = intval($_GET['id']);
						$feedback = $feedbackManager->findById($id);
						$feedback->setContent($_POST['content']);
						$feedback->setStatus(0);
						$feedbackManager->update($feedback);
						header('Location: index.php?page=feedback');
						exit;
					}

					if ($_GET['action'] == 'delete')
					{
						$id = intval($_GET['id']);
						$feedback = $feedbackManager->findById($id);
						// if ($feedback->getAuthor() == $_SESSION['user_id'])
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