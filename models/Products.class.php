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

	private $feedbacks;
	private $subCat;
	private $cat;


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
	public function getIdSubCat()
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

	public function getFeedbacks()
	{
		if($this->feedbacks == NULL)
		{
			$feedbackManager = new FeedbackManager($this->link);
			$this->feedbacks = $feedbackManager->findByProduct($this);
		}
		return $this->feedbacks;
	}

	public function getSubCat()
	{
		if($this->subCat == NULL)
		{
			$subCategoryManager = new SubCategoryManager($this->link);
			$this->subCat = $subCategoryManager->findById($this->id_sub_cat);
		}
		return $this->subCat;
	}

	public function getCat()
	{
		if($this->cat == NULL)
		{
			$categoryManager = new categoryManager($this->link);
			$this->cat = $categoryManager->findByProduct($this);
		}		
		return $this->cat;
	}

	public function setRef($ref)
	{
		if (strlen($ref) < 2)
			throw new Exception ("Référence trop courte (< 2)");
		else if (strlen($ref) > 63)
			throw new Exception ("Référence trop longue (> 63)");
		$this->ref = $ref;
	}

	public function setStock($stock)
	{		
		if (is_int($stock))
			throw new Exception ("Entrez un nombre entier");
		else if ($stock < 0)
			throw new Exception ("La quantité doit être positive");
		$this->stock = $stock;
	}
	public function changeStock($nbr)
	{
		$this->stock = $this->stock + $nbr;
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

	public function setSubCat($id_sub_cat)
	{	
		$id_sub_cat = intval($id_sub_cat);
		$this->id_sub_cat =  $id_sub_cat;
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
//		$_FILES['icone']['name']     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
//		$_FILES['icone']['type']     //Le type du fichier. Par exemple, cela peut être « image/png ».
//		$_FILES['icone']['size']     //La taille du fichier en octets.
//		$_FILES['icone']['tmp_name'] //L'adresse vers le fichier uploadé dans le répertoire temporaire.
//		$_FILES['icone']['error']    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.

		if ($_FILES['picture']['error'] > 0)
			throw new Exception ("Erreur lors du transfert");
		$name = $_FILES['picture']['name'];
		move_uploaded_file($_FILES['picture']['tmp_name'], 'public/images/'.$name.'');
	/*	if ($_FILES['picture']['size'] > $maxsize)
			throw new Exception ("Fichier trop lourd > à 1Mo");
		if (!in_array($extension_upload,$extensions_valides))
			throw new Exception ("Extension non valide (acceptées : jpg, jpeg, png");
		if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
			throw new Exception ("Taille image trop grande (accepté : 150x150");*/

		$this->picture = 'public/images/'.$name.'';
	}


}
?>