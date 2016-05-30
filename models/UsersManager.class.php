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
		$user = mysqli_fetch_object($res, "user", [$this->link]);
		return $user
	}

	//Création d'un user:
	public function create($data)
	{
		if (!isset($_SESSION['id']))
			throw new Exception("Missing parameter: users");
		if (!isset($data['login']))
			throw new Exception("Missing parameter: login");
		if (!isset($data['firstname']))
			throw new Exception("Missing parameter: firstname");
		if (!isset($data['lastname']))
			throw new Exception("Missing parameter: lastname");
		if (!isset($data['email'])
			throw new Exception("Missing parameter: email");
		if (!isset($data['password']))
			throw new Exception("Missing parameter: password");
		if (!isset($data['birth_date']))
			throw new Exception("Missing parameter: birth date");
		if (!isset($data['phone']))
			throw new Exception("Missing parameter: phone");
		if (!isset($data['sex']))
			throw new Exception("Missing parameter: sex");	

		$user = new Users($this->link);

		$request ="INSERT INTO user (id, login, firstname, lastname, email, password, birth_date, phone, sex) 
				   VALUES ('".$id."', '".$login."', '".$firstname."''".$lastname."', '".$email."', '".$password."''".$birth_date."', '".$phone."', '".$sex."')";

		if ($res)// Si la requete s'est bien passée
		{
			$id = mysqli_insert_id($this->link);

			if ($id)
			{
				$user = $this->findById($id);
				return $user;
			}
			else
				throw new Exception("Internal server error");
		}
		else
			throw new Exception("Internal server error");
		}	
	}

	//Modification d'un user:
	public function update(Users $user)
	{
		$id = $user->getId();

		if ($id)
		{
			$login = mysqli_real_escape_string($this->link, $users->getLogin());
			$firstname = mysqli_real_escape_string($this->link, $users->getFirstname());
			$lastname = mysqli_real_escape_string($this->link, $users->getLastname());
			$email = mysqli_real_escape_string($this->link, $users->getEmail());
			$password = mysqli_real_escape_string($this->link, $users->getPasword());
			$birth_date = mysqli_real_escape_string($this->link, $users->getBirthDate());
			$phone = mysqli_real_escape_string($this->link, $users->getPhone());
			$sex = mysqli_real_escape_string($this->link, $users->getSex());
			$status = $user->getStatus;

			$request = "UPDATE users 
						SET login = '".$login."', firstname = '".$firstname."', lastname = '".$lastname."', email = '".$email."', password = '".$password."', birth_date = '".$birth_date."', phone = '".$phone."', sex = '".$sex."', status = '".$status."'";
			$res = mysqli_query($this->link, $request);

			if ($res)
				return $this->findById($id);
			else
				throw new Exception("Internal server error");
		}
	}
}
?>