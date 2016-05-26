<?php

class Sub_category
{
	//Déclaration privées:
	private $id;
	private $id_category;
	private $name;
	private $description;

	//Getter:
	public function getId()
	{
		return $this->id;
	}
	public function getIdCategory()
	{
		return $this->id_category;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getDescription()
	{
		return $this->description;
	}

	//Setter:
	public function setName($name)
	{
		if(strlen($name)<2)
			return "Name trop court(min: 2 caractères)";
		else if (strlen($name)>31)
			return "Name trop long(max: 31 caractères";
		$this->name = $name;
	}
	public function setDescription($description)
	{
		if(strlen($description)<10)
			return "Description trop courte(min: 10 caractères)";
		else if (strlen($description)>123)
			return "Description trop longue(max: 123 caractères";
		$this->description = $description;
	}
}
?>