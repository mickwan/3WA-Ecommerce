<?php
class AddressManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM address WHERE id=".$id;
		$res = mysqli_query($this->link,$request);
		$address = mysqli_fetch_object($res, "Address");
		return $address;
	}
	public function findByUser($id_user)
	{
		$id_user = intval($id_user);
		$request = "SELECT * FROM address WHERE id=".$id_user;
		$res = mysqli_query($this->link, $request);
		$address = mysqli_fetch_object($res, "Address");
		return $address;
	}
	public function findByName($name)
	{
		$name = mysqli_real_escape_string($this->link, $name);
		$request = "SELECT * FROM address WHERE id=".$name;
		$res = mysqli_query($this->link,$request);
		$address = mysqli_fetch_object($res, "Address");
		return $address;
	}

	public function create($data)
	{
		if (!isset($_SESSION['id']))
			throw new Exception ("Vous devez être connecté");
		$address = new Address($link);

		if (!isset($data['name']))
			throw new Exception ("Contenu manquant : Nom");
		if (!isset($data['number']))
			throw new Exception ("Contenu manquant : Numéro de voie");
		if (!isset($data['pathway']))
			throw new Exception ("Contenu manquant : Voie");
		if (!isset($data['city']))
			throw new Exception ("Contenu manquant : Ville");
		if (!isset($data['country']))
			throw new Exception ("Contenu manquant : Pays");
		if (!isset($data['zipcode']))
			throw new Exception ("Contenu manquant : Code postal");
		if (!isset($data['type']))
			throw new Exception ("Choisir le type d'adresse");
		$address->setName($data['name']);
		$address->setNumber($data['number']);
		$address->setPathway($data['pathway']);
		$address->setCity($data['city']);
		$address->setCountry($data['country']);
		$address->setZipcode($data['zipcode']);
		$address->setType($data['type']);

		$name = $address->getName();
		$number = $address->getNumber();
		$pathway = $address->getPathway();
		$city = $address->getCity();
		$country = $address->getCountry();
		$zipcode = $address->getZipcode();
		$type = $address->getType();
		$id_user = $_SESSION['id'];
		$request = "INSERT INTO address (name, 'number', pathway, city, country, zipcode, type, id_user) VALUES('".$name."', '".$number."', '".$pathway."', '".$city."', '".$country."', '".$zipcode."', '".$type."', '".$id_user."')";
		$res = mysql_query($this->link, $request);

		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if($id)
			{
				$address = $this->findById($id);
				return $address;
			}
			else
				throw new Exception("Internal server error");	
		}
		else
			throw new Exception("Internal server error");
	}

	public function getById($id)
	{
		return $this->findById($id);
	}

	public function update (Address $address)
	{
		$id = $address->getId();
		if ($id)
		{
			$name = mysqli_real_escape_string($this->link, $address->getName());
			$number = mysqli_real_escape_string($this->link, $address->getNumber());
			$pathway = mysqli_real_escape_string($this->link, $address->getPathway());
			$city = mysqli_real_escape_string($this->link, $address->getCity());
			$country = mysqli_real_escape_string($this->link, $address->getCountry());
			$zipcode = mysqli_real_escape_string($this->link, $address->getZipcode());
			$type = mysqli_real_escape_string($this->link, $address->getType());
			$request = "UPDATE address SET name='".$name."', number='".$number."', pathway ='".$pathway ."', city='".$city."', country='".$country."', zipcode='".$zipcode."', type='".$type."' WHERE id=".$id;
			$res = mysql_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception ("Internal server error");
		}
	}

	public function remove(Address $address)
	{
		$id = $address->getId();
		if ($id)
		{
			$request = "DELETE FROM address WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $address;
			else
				throw new Exception("Internal server error");		
		}
	}
}

?>