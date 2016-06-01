<?php

try 
{
// if (isset($_GET['product.id']))
// {
	$id = 1;
	$feedbackManager = new FeedbackManager($link);
	$feedback = $feedbackManager->findByProduct($id);

	$user = new Users($link);
	$utilisateur = $user->getLogin($id);
	var_dump($user);
	var_dump($utilisateur);

	
	$i = 0;
//	var_dump($list[0]);
	$count = count($feedback); 
		while ($i < $count)
		{
			$commentaire = $feedback[$i];
			$utilisateur = $login;
			require('views/contents/display_feedback.phtml');
			$i++;
		}

/*
}
else
	throw nex Exception("error Feedback not found");

*/
}
catch (Exception $exception)
{
	$error = $exception->getMessage();
}

?>