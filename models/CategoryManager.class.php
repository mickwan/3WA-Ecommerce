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
		while ($category = mysqli_fetch_object($res, "category"))
			$list[] = $category;
		return $list;
	}


?>