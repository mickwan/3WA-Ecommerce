<?php
	if (isset($_SESSION['id_user']))
	{
		if ($_SESSION['admin'] == 0)
		{
			if(isset($_POST['action']))
			{
				$addressManager = new AddressManager($link);
				if ($_POST['action'] == 'add' 
					&& (isset($_POST['form']) && $_POST['form'] == '1'))
				{
					try
					{
						$addressManager->create($_POST);
						$_SESSION['success'] = 'Your address has been added';
						header('Location: index.php?page=address');
						exit;
					}
					catch (Exception $exception)
					{
						$error = $exception->getMessage();
					}
				}
				if ($_POST['action'] == 'edit' 
					&& (isset($_POST['form']) && $_POST['form'] == '1'))
				{
					if (!isset($_POST['name']))
						$error = "Contenu manquant : Nom";
					else if (!isset($_POST['number']))
						$error = "Contenu manquant : Numéro de voie";
					else if (!isset($_POST['pathway']))
						$error = "Contenu manquant : Voie";
					else if (!isset($_POST['city']))
						$error = "Contenu manquant : Ville";
					else if (!isset($_POST['country']))
						$error = "Contenu manquant : Pays";
					else if (!isset($_POST['zipcode']))
						$error = "Contenu manquant : Code postal";
					else if (!isset($_POST['type']))
						$error = "Choisir le type d'adresse";
					if (empty($error))
					{
						try 
						{
							$id_address = intval($_POST['id_address']);
							$address = $addressManager->findById($id_address);
							$address->setName($_POST['name']);
							$address->setNumber($_POST['number']);
							$address->setPathway($_POST['pathway']);
							$address->setCity($_POST['city']);
							$address->setCountry($_POST['country']);
							$address->setZipcode($_POST['zipcode']);
							$address->setType($_POST['type']);
							$addressManager->update($address);
							$_SESSION['success'] = 'Your address has been edited';
							header('Location: index.php?page=address');
							exit;
						}
						catch (Exception $exception)
						{
							$error = $exception->getMessage();
						}
					}
				}
				if ($_POST['action'] == 'delete')
				{
					try 
					{
						var_dump($address);
						$id_address = intval($_POST['id_address']);
						$address = $addressManager->findById($id_address);
						$addressManager->delete($address);
						$_SESSION['success'] = 'Your address has been deleted';
						header('Location: index.php?page=address');
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
		require 'views/contents/must_be_logged.phtml';
?>