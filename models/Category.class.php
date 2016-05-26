<?php
// Category.class.php -> PascalCase
class Category
{
	// Déclaration des propriétés privées
	private $id;
	private $name;
	private $description;

	// Ctor

	// Getter/Setter | Accesseur/Mutateur | Accessor/Mutator
	public function getId()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setName($name)
	{
		if (strlen($name) < 4)
			return "Nom trop court (< 4)";
		else if (strlen($name) > 31)
			return "Nom trop long (> 31)";
		$this->name = $name;
	}

	public function setDescription($description)
	{
		if (strlen($description) < 4)
			return "Description trop courte (< 4)";
		else if (strlen($description) > 123)
			return "Description trop longue (> 123)";
		$this->description = $description;
	}

}
?>