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

	private $feedback;
	/// ...

	private $link;
	//Index.php : $link = mysqli_connect($localhost, $login, $pass, $database)
	//Fonction magique pour le lien à la base de donnée
	public function __construct($link)
	{
		$this->link = $link;
	}

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
			throw new Exception ("Login trop court(min: 2 caractères)");
		else if (strlen($login)>31)
			throw new Exception ("Login trop long(max: 31 caractères");
		$this->login = $login;
	}
	public function setFirstName($firstname)
	{
		if(strlen($firstname)<2)
			throw new Exception ("Firstname trop court (min: 2 caractères)");
		else if (strlen($firstname)>63)
			throw new Exception ("Firstname trop long (max: 63 caractères)");
		$this->firstname = $firstname;
	}
	public function setLastName($lastname)
	{
		if (strlen($lastname)<2)
			throw new Exception ("Lastname trop court (min: 2 caractères)");
		else if(strlen($lastname)>63)
			throw new Exception ("Lastname trop long (max: 63 caractères)");
		$this->lastname = $lastname;
	}
	public function setEmail($email, $confirmEmail)
	{
		if ($email != $confirmEmail)
			throw new Exception ("Email différents");
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			throw new Exception ("Email non valide");
		$this->email = $email;
	}
	public function setPassword($password , $confirmPassword)
	{
		if ($password != $confirmPassword)
			throw new Exception ("Password différents");
		else if (strlen($password)<4)
			throw new Exception ("Password trop court (min: 4 caractères)");
		$this->password = password_hash($password, PASSWORD_BCRYPT, array("cost"=>8));
	}
	public function setBirthDate($birth_date)
	{
		//mettre les conditions pour vérifier le  format!
		$this->birth_date = $birth_date;
	}
	public function setPhone($phone)
	{
		if (strlen($phone) == 10 || preg_match("#^+[0-9]{10}$#", $phone))
			$this->phone = $phone;
		else
			throw new Exception ("Phone non valide");
	}
	public function setSex($sex)
	{
		if($sex != "M" && $sex != "W")
			throw new Exception ("Choissez votre  sexe");
		$this->sex = $sex;
	}

	// Méthodes spécifiques:

	//Trouver le paniers de l'utilisateur:
	// public function findCart()
	public function getCart()
	{
		if ($this->user_cart === null)
		{
			$cart_manager = new cartManager($this->link);
			$this->user_cart = $cart_manager->findByUser($this->id);
		}
		return $this->user_cart;
	}

	//Trouver l'adresse de l'utilisateur:
	public function getAddress()
	{
		$address_manager = new AddressManager($this->link);
		$user_address = $address_manager->findByUser($this->id);
		return $user_address;
	}

	//Trouver les feedback de l'utilisateur:
	public function getFeedback()
	{
		$feedback_manager = new FeedbackManager($this->link);
		$user_feedbacks = $feedback_manager->findByAuthor($this->id);
		return $user_feedbacks;
	}

	//Trouver les produits acheté de l'utilisateur:
	// $user->getProduts();
	/*public function findProducts()
	{
		$list = [];
		$request = "SELECT link_cart_product.id_product 
					FROM link_cart_product 
					INNER JOIN cart 
					ON link_cart_product.id_cart = cart.id
					WHERE cart.id_user =".$this->id;
		$res = mysqli_query($this->link, $request);
		while ($product = mysqli_fetch_assoc($res))
			$list = $product;
		return $list;
	}*/

	//Quand l'utilisateur n'est plus actif sur le site:
	public function setInactive()
	{
		$this->status = 0;
		return $this->status;
	}
}
?>