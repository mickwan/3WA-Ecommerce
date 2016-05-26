<?php

class Users
{
	//Déclaration privées:
	private $id;
	private $login;
	private $firstname;
	private $lastname;
	private $email;
	private $password;
	private $register_date;
	private $birth_date;
	private $phone;
	private $sex;
	private $admin;
	private $status;

	//Getter:
	public function getId()
	{
		return $this->id;
	}
	public function getLogin()
	{
		return $this->login;
	}
	public function getFirstname()
	{
		return $this->firstname;
	}
	public function getLastname()
	{
		return $this->lastname;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getRegisterDate()
	{
		return $this->register_date;
	}
	public function getBirthDate()
	{
		return $this->birth_date;
	}
	public function getPhone()
	{
		return $this->phone;
	}
	public function getSex()
	{
		return $this->sex;
	}
	public function getAdmin()
	{
		return $this->admin;
	}
	public function getStatus()
	{
		return $this->status;
	}

	//Setter:
	public function setLogin($login)
	{
		if(strlen($login)<2)
			return "Login trop court(min: 2 caractères)";
		else if (strlen($login)>31)
			return "Login trop long(max: 31 caractères";
		$this->login = $login;
	}
	public function setFirstName($firstname)
	{
		if(strlen($firstname)<2)
			return "Firstname trop court (min: 2 caractères)";
		else if (strlen($firstname)>63)
			return "Firstname trop long (max: 63 caractères)";
		$this->firstname = $firstname;
	}
	public function setLastName($lastname)
	{
		if (strlen($lastname)<2)
			return "Lastname trop court (min: 2 caractères)";
		else if(strlen($lastname)>63)
			return "Lastname trop long (max: 63 caractères)";
		$this->lastname = $lastname;
	}
	public function setEmail($email, $confirmEmail)
	{
		if ($email != $confirmEmail)
			return "Email différents";
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			return "Email non valide";
		$this->email = $email;
	}
	public function setPassword($password , $confirmPassword)
	{
		if ($password != $confirmPassword)
			return "Password différents";
		else if (strlen($password)<4)
			return "Password trop court (min: 4 caractères)";
		$this->password = $password_hash($password, PASSWORD_BCRYPT, array("cost"=>8));
	}
	public function setBirthDate($birth_date)
	{
		$birth_date = strtotime($birth_date);
		$this->birth_date = $birth_date;
	}
	public function setPhone($phone)
	{
		if (strlen($phone)==10 || preg_match("#^+[0-9]{10}$#", $phone))
			return "Phone non valide";
		$this->phone = $phone;
	}
	public function setSex($sex)
	{
		if($sex != "M" && $sex != "W")
			return "Choissez votre  sex";
		$this->sex = $sex;
	}
}
?>