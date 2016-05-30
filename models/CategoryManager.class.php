<?php
// models/CategoryManager.class.php
class CategoryManager
{
	private $link;

	// Liste des fonctions magiques en php : http://php.net/manual/fr/language.oop5.magic.php
	// $this->link <===> $link index.php
	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findAll()
	{
		$list = [];
		$request = "SELECT * FROM category";
		$res = mysqli_query($this->link, $request);
		while ($category = mysqli_fetch_object($res, "Category", [$this->link]))
			$list[] = $category;
		return $list;
	}

	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM category WHERE id=".$id;
		// SELECT * FROM category WHERE id=1
		$res = mysqli_query($this->link, $request);
		$category = mysqli_fetch_object($res, "Category", [$this->link]);
		return $category;
	}

	public function findByName($name)
	{
		$name = mysqli_escape_string($this->link, $name);
		$request = "SELECT FROM category WHERE name = '".$name."'";
		$res = mysqli_query($this->link, $request);
		$category = mysqli_fetch_object($res, "Category", [$this->link]);
		return $category;
	}
	public function findByProduct(Products $product)
	{
		$id_sub_cat = $product->getSubCat();
		$request = "SELECT category.* 
					FROM category 
					INNER JOIN sub_category 
					ON category.id = sub_category.id_category 
					WHERE sub_category.id =".$id_sub_cat;
		$res = mysqli_query($this->link, $request);
		$category = mysqli_fetch_object($res, "Category", [$this->link]);
		return $category;	
	}

	public function create($data)
	{
		if (!isset($_SESSION['id']))
			throw new Exception("Vous devez être connecté");
		if (($_SESSION['id']) != "1")
			throw new Exception("Vous n'êtes pas administrateur");
		$category = new Category();
		if (!isset($data['name']))
			throw new Exception("Nommer la catégorie");
		if (!isset($data['description']))
			throw new Exception("Donner une description succincte de la catégorie");

		//
		$category->setName($data['name']);
		$category->setDescription($data['description']);
		//
		$name = $category->getName();
		$description = $category->getDescription();
		//
		$request = "INSERT INTO category (name, description)
					VALUES ('".$name."', '"..$description"')";
		$res = mysqli_query($this->link, $request);
		if ($res)	// si la requete est bien effectuée
		{
			$id = mysqli_insert_id($this->link);
			if($id)  // si l'id est > à 0
			{
				$category = $this->findById($id);
				return $category;
			}
			else
			{
				throw new Exception("Internal server error");
			}
		}
		else
		{
			throw new Exception("Internal server error");
		}
	}

	public function update(Category $category)// type-hinting
	{
		$id = $category->getId();
		if ($id)// true si > 0
		{
			$name = mysqli_real_escape_string($this->link, $category->getName());
			$description = mysqli_real_escape_string($this->link, $category->getDescription());
			$request = "UPDATE category SET name='".$name."', description='".$description."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception("Internal server error");
		}
	}

	public function remove(Category $category)
	{
		$id = $category->getId();
		// droit ? admin ? access ?
		if ($id)
		{
			$request = "DELETE FROM category WHERE id='".$id."' LIMIT 1";
			$res = mysqli_query($this->link, $request);
			if($res)
				return $category;
			else
				throw new Exception("Internal server error");
		}
	}
}
?>