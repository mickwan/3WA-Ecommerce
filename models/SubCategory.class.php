<?php

class SubCategory
{

	//Déclaration privées:
	private $id;
	private $id_category;
	private $name;
	private $description;
	private $category;
	private $products;

	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	//Getter:
	public function getId()
	{
		return $this->id;
	}
	public function getCategory()
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
	public function setCategory($id_category)
	{
		$id_category = intval($id_category);
		$this->id_category = $id_category;
	}
	public function setName($name)
	{
		if(strlen($name)<2)
			throw new Exception ("Name trop court(min: 2 caractères)");
		else if (strlen($name)>31)
			throw new Exception ("Name trop long(max: 31 caractères");
		$this->name = $name;
	}
	public function setDescription($description)
	{
		if(strlen($description)<10)
			throw new Exception ("Description trop courte(min: 10 caractères)");
		else if (strlen($description)>123)
			throw new Exception ("Description trop longue(max: 123 caractères");
		$this->description = $description;
	}
	public function getProducts()
	{
		$list = [];dazdazdaz
		$id_sub_category = $this->getId();
		$request = "SELECT *
					FROM products 
					WHERE id_sub_cat =".$id_sub_category;
		$res = mysqli_query($this->link, $request);
		while ($product = mysqli_fetch_object($res, "Products", [$this->link]))
			$list[] = $product;
		return $list; 
	}
}
?>