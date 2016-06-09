<?php
if (isset($_SESSION['id_user']))
{
	$id_address = '0';
	$action = 'add'; 
	$name = 'Specify a name (firstname & lastname)';
	$nameEdit = '';
	$number = 'Your street number';
	$numberEdit = '';
	$pathway = 'Your pathway';
	$pathwayEdit = '';
	$city = 'Your city';
	$cityEdit = '';
	$country = 'Your country';
	$countryEdit = '';
	$zipcode = 'Your zipcode';
	$zipcodeEdit = '';
	$home = 'checked';
	$work = '';
	if (isset($_POST['action']) && $_POST['action'] == 'edit')
	{
		$id_address = intval($_POST['id_address']);
		$address = $addressManager->findById($id_address);
		$action = 'edit';
		$name = htmlentities($address->getName());
		$nameEdit = htmlentities($address->getName());
		$number = htmlentities($address->getNumber());
		$numberEdit = htmlentities($address->getNumber());
		$pathway =  htmlentities($address->getPathway());
		$pathwayEdit =  htmlentities($address->getPathway());
		$city = htmlentities($address->getCity());
		$cityEdit = htmlentities($address->getCity());
		$country = htmlentities($address->getCountry());
		$countryEdit = htmlentities($address->getCountry());
		$zipcode = htmlentities($address->getZipcode());
		$zipcodeEdit = htmlentities($address->getZipcode());
		if ($address->getType() == 1)
		{
			$home = '';
			$work = 'checked';
		}
	}
	require 'views/contents/add_edit_address.phtml';
}
else
	require 'views/contents/must_be_logged.phtml';
?>