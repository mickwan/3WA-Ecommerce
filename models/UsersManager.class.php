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
		$user = mysqli_fetch_object($res, "Users", [$this->link]);
		return $user;
	}
	public function findByCredential($email, $login)
	{
		$email = mysqli_real_escape_string($this->link, $email);
		$login = mysqli_real_escape_string($this->link, $login);
		$request = "SELECT *
					FROM users
					WHERE email = '".$email."' OR login='".$login."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "Users", [$this->link]);
		return $user;
	}
	public function findByEmail($email)
	{
		$email = mysqli_real_escape_string($this->link, $email);
		$request = "SELECT *
					FROM users
					WHERE email = '".$email."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "Users", [$this->link]);
		return $user;
	}

	//Création d'un user:
	public function create($data)
	{
		if (!isset($data['login']))
			throw new Exception("Missing parameter: login");
		if (!isset($data['firstname']))
			throw new Exception("Missing parameter: firstname");
		if (!isset($data['lastname']))
			throw new Exception("Missing parameter: lastname");
		if (!isset($data['email']))
			throw new Exception("Missing parameter: email");
		if (!isset($data['password']))
			throw new Exception("Missing parameter: password");
		if (!isset($data['confirmPassword']))
			throw new Exception("Missing parameter: password");
		if (!isset($data['birth_date']))
			throw new Exception("Missing parameter: birth date");
		if (!isset($data['phone']))
			throw new Exception("Missing parameter: phone");
		if (!isset($data['sex']))
			throw new Exception("Missing parameter: sex");	

		$user = new Users($this->link);

		$user->setLogin($data['login']);
		$user->setFirstName($data['firstname']);
		$user->setLastName($data['lastname']);
		$user->setEmail($data['email'], $data['confirmEmail']);
		$user->setPassword($data['password'], $data['confirmPassword']);
		$user->setBirthDate($data['birth_date']);
		$user->setPhone($data['phone']);
		$user->setSex($data['sex']);

		$login = mysqli_real_escape_string($this->link, $user->getLogin());
		$firstname = mysqli_real_escape_string($this->link, $user->getFirstname());
		$lastname = mysqli_real_escape_string($this->link, $user->getLastname());
		$email = mysqli_real_escape_string($this->link, $user->getEmail());
		$password = $user->getPassword();
		$birth_date = $user->getBirthDate();
		$phone = $user->getPhone();
		$sex = $user->getSex();

		$request ="INSERT INTO users(login, firstname, lastname, email, password, birth_date, phone, sex) 
				   VALUES ('".$login."', '".$firstname."', '".$lastname."', '".$email."', '".$password."', '".$birth_date."', '".$phone."', '".$sex."')";

		$res = mysqli_query($this->link, $request);

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
			throw new Exception("Internal server error 1 ");
	}	

	//Modification d'un user:
	public function update(Users $user)
	{
		$id = $user->getId();

		if ($id)
		{
			$login = mysqli_real_escape_string($this->link, $user->getLogin());
			$firstname = mysqli_real_escape_string($this->link, $user->getFirstname());
			$lastname = mysqli_real_escape_string($this->link, $user->getLastname());
			$email = mysqli_real_escape_string($this->link, $user->getEmail());
			$password = $user->getPassword();
			$birth_date = $user->getBirthDate();
			$phone = $user->getPhone();
			$sex = mysqli_real_escape_string($this->link, $user->getSex());
			$status = $user->getStatus();

			$request = "UPDATE users 
						SET login = '".$login."', firstname = '".$firstname."', lastname = '".$lastname."', email = '".$email."', password = '".$password."', birth_date = '".$birth_date."', phone = '".$phone."', sex = '".$sex."', status = '".$status."'
						WHERE id=".$id;
			$res = mysqli_query($this->link, $request);

			if ($res)
				return $this->findById($id);
			else
				throw new Exception("Internal server error");
		}
	}
}
?>