<?php

class SubCategoryManager
{
	private $link;
	//Index.php : $link = mysqli_connect($localhost, $login, $pass, $database)
	//Fonction magique pour le lien à la base de donnée
	public function __construct($link)
	{
		$this->link = $link;
	}

	//FindBy:
	public function findAll()
	{
		$list = [];
		$request = "SELECT * 
					FROM sub_category";
		$res = mysqli_query($this->link, $request);
		while ($subCategory = mysqli_fetch_object($res, "SubCategory", [$this->link]))
			$list[] = $subCategory;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * 
					FROM sub_category 
					WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$sub_category = mysqli_fetch_object($res, "SubCategory", [$this->link]);
		return $sub_category;
	}
	public function findByCategory(Category $category)
	{
		$list = [];
		$id_category = $category->getId();
		$request = "SELECT * 
					FROM sub_category 
					WHERE id_category=".$id_category;
		$res = mysqli_query($this->link, $request);

		while($sub_category = mysqli_fetch_object($res, "SubCategory", [$this->link]))
			$list[] = $sub_category;
		return $list;
	}

	//Création d'une sub_category:
	public function create($data)
	{
		if (!isset($data['id_category']))
			throw new Exception("Missing paramater: id_category");
		if (!isset($data['name']))
			throw new Exception("Missing paramater: name");
		if (!isset($data['description']))
			throw new Exception("Missing paramater: description");

		$sub_category = new SubCategory($this->link);
		$sub_category->setCategory($data['id_category']);
		$sub_category->setName($data['name']);
		$sub_category->setDescription($data['description']);

		$id_category = $sub_category->getIdCategory();
		$name = $sub_category->getName();
		$description = $sub_category->getDescription();

		$request = "INSERT INTO sub_category (id_category, name, description)
					VALUES ('".$id_category."', '".$name."', '".$description."')";

		$res = mysqli_query($this->link, $request);

		if ($res)// Si la requete s'est bien passée
		{
			$id = mysqli_insert_id($this->link);

			if ($id)
			{
				$sub_category = $this->findById($id);
				return $sub_category;
			}
			else
				throw new Exception("Internal server error");
		}
		else
			throw new Exception("Internal server error");
	}

	//Modification d'une sub_category:
	public function update(SubCategory $sub_category)
	{
		$id = $sub_category->getId();

		if ($id)
		{
			$name = mysqli_real_escape_string($this->link, $sub_category->getName());
			$description = mysqli_real_escape_string($this->link, $sub_category->getDescription());
			$id_category = $sub_category->getCategory();
			$request = "UPDATE sub_category 
						SET id_category=".$id_category.", name='".$name."', description='".$description."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);

			if ($res)
				return $this->findById($id);
			else
				throw new Exception("Internal server error");
		}
	}

	//Supression d'une sub_category:
	public function delete(SubCategory $sub_category)
	{
		$id = $sub_category->getId();

		if ($id)
		{
			$request = "DELETE FROM sub_category 
						WHERE id=".$id;
			$res = mysqli_query($this->link, $request);

			if ($res)
				return $sub_category;
			else
				throw new Exception ("Internal server error");
		}
	}
}
?>