<?php
class Address
{
	private $id;
	private $id_user;
	private $name;
	private $number;
	private $pathway;
	private $city;
	private $country;
	private $zipcode;
	private $type;


	public function getId()
	{
		return $this->id;
	}
	public function getIdUser()
	{
		return $this->id_user;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getNumber()
	{
		return $this->number;
	}
	public function getPathway()
	{
		return $this->pathway;
	}
	public function getCity()
	{
		return $this->city;
	}
	public function getCountry()
	{
		return $this->country;
	}
	public function getZipcode()
	{
		return $this->zipcode;
	}
	public function getType()
	{
		return $this->type;
	}

	public function setName($name)
	{
		if (strlen($name) <1)
			return "Nom trop court (<1)";
		else if (strlen($name) >31)
			return "Nom trop long (>31)";
		$this->name = $name;
	}
	public function setNumber($number)
	{
		if (strlen($number) <1)
			return "Numéro trop court (<1)";
		else if (strlen($number) >31)
			return "Numéro trop long (>7)";
		$this->number = $number;
	}
	public function setPathway($pathway)
	{
		if (strlen($pathway) <2)
			return "Nom de la voie trop court (<2)";
		else if (strlen($pathway) >15)
			return "Nom de la voie trop long (>15)";
		$this->pathway = $pathway;
	}
	public function setCity($city)
	{
		if (strlen($city) <2)
			return "Nom de la ville trop court (<2)";
		else if (strlen($city) >63)
			return "Nom de la ville trop long (>63)";
		$this->city = $city;
	}
	public function setCountry($country)
	{
		if (strlen($country) <2)
			return "Nom du pays trop court (<2)";
		else if (strlen($country) >31)
			return "Nom du pays trop long (>31)";
		$this->country = $country;
	}
	public function setZipcode($zipcode)
	{
		if (strlen($zipcode) <3)
			return "Code postal trop court (<3)";
		else if (strlen($zipcode) >15)
			return "Code postal trop long (>15)";
		$this->zipcode = $zipcode;
	}
	public function setType($type)
	{
		if ($type != 0 || $type != 1)
			return $this->type = $type;
	}

}
?>