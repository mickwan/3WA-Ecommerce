<?php

class UsersManager
{
	private $link;
	//Index.php : $link = mysqli_connect($localhost, $login, $pass, $database)
	//Fonction magique pour le lien à la base de donnée
	public function __construct($link)
	{
		$this->link = $link;
	}

	//FindBy:
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT *
					FROM users
					WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$users = mysqli_fetch_object($res, "users");
		return $users
	}
}
?>