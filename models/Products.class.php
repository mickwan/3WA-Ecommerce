<?php
// Products.class.php -> PascalCase
class Products
{
	// Déclaration des propriétés privées
	private $id;
	private $ref;
	private $stock;
	private $size;
	private $price;
	private $tax;
	private $description;
	private $name;
	private $weight;
	private $id_sub_cat;
	private $status;
	private $picture;
	private $link;

	// Liste des fonctions magiques en php : http://php.net/manual/fr/language.oop5.magic.php
	// $this->link <===> $link index.php
	public function __construct($link)
	{
		$this->link = $link;
	}

	// Getter/Setter | Accesseur/Mutateur | Accessor/Mutator
	public function getId()
	{
		return $this->id;
	}
	public function getRef()
	{
		return $this->ref;
	}
	public function getStock()
	{
		return $this->stock;
	}
	public function getSize()
	{
		return $this->size;
	}
	public function getPrice()
	{
		return $this->price;
	}
	public function getTax()
	{
		return $this->tax;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getWeight()
	{
		return $this->weight;
	}
	public function getSubCat()
	{
		return $this->id_sub_cat;
	}
	public function getStatus()
	{
		return $this->status;
	}
	public function getPicture()
	{
		return $this->picture;
	}


	public function setRef($ref)
	{
		if (strlen($ref) < 4)
			throw new Exception ("Référence trop courte (< 4)");
		else if (strlen($ref) > 63)
			throw new Exception "Référence trop longue (> 63)";
		$this->ref = $ref;
	}

	public function setStock($stock)
	{		
		if (!is_int($stock))
			throw new Exception ("Entrez un nombre entier");
		else if ($stock < 0)
			throw new Exception ("La quantité doit être positive");
		$this->stock = $stock;
	}

	public function setSize($size)
	{		
		if ($size !== "S" && $size !== "M" && $size !== "L" && $size !== "0")
			throw new Exception ("La taille n'est pas correcte");
		$this->size = $size;
	}

	public function setPrice($price)
	{	
		$price = str_replace(',' , '.', $price);
		$price = floatval($price);
		if ($price <= 0)
			throw new Exception ("Prix incorrect");
		$this->price = $price;
	}

	public function setTax($tax)
	{	
		$tax = str_replace(',' , '.', $tax);
		$tax = floatval($tax);
		if ($tax <= 0)
			throw new Exception ("Taxe incorrecte (entrer un nombre décimal ex: 5.5)");
		$this->tax = $tax;
	}

	public function setDescription($description)
	{
		if (strlen($description) < 4)
			throw new Exception ("Description trop courte (< 4)");
		else if (strlen($description) > 123)
			throw new Exception ("Description trop longue (> 123)");
		$this->description = $description;
	}

	public function setName($name)
	{
		if (strlen($name) < 4)
			throw new Exception ("Nom trop court (< 4)");
		else if (strlen($name) > 15)
			throw new Exception ("Nom trop long (> 15)");
		$this->name = $name;
	}

	public function setWeight($weight)
	{	
		$weight = str_replace(',' , '.', $weight);
		$weight = floatval($weight);
		if ($weight <= 0)
			throw new Exception ("Poids incorrect (entrer un nombre décimal ex: 2.4)");
		$this->weight = $weight;
	}

	public function setStatus($status)
	{	
		if ($status == "1" || $status == "0")
			$this->status = $status;
		else
			throw new Exception ("Status disponibilité incorrect");
	}

	public function setPicture($picture)
	{	
		$this->picture = $picture;
	}


	public function findCat(Products $product)
	{
		$categoryManager = new categoryManager($this->link);
		
	}

	public function getFeedback(Products $product)
	{
		$feedbackManager = new FeedbackManager($this->link);
		$feedback = $feedbackManager->findByProduct($this->id);
		return $feedback;
	}




}
?>