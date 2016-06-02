<?php
// models/ProductsManager.class.php
class ProductsManager
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
		$request = "SELECT * FROM products";
		$res = mysqli_query($this->link, $request);
		while ($product = mysqli_fetch_object($res, "Products", [$this->link]))
			$list[] = $product;
		return $list;
	}

	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM products WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$product = mysqli_fetch_object($res, "Products", [$this->link]);
		return $product;
	}

	public function findByName($name)
	{
		$name = mysqli_real_escape_string($this->link, $name);
		$request = "SELECT * FROM products WHERE name='".$name."'";
		$res = mysqli_query($this->link, $request);
		$product = mysqli_fetch_object($res, "Products", [$this->link]);
		return $product;
	}

	// trouver les produits dans une sous-categorie 
	public function findBySubCat(SubCategory $subCat)
	{
		$id_sub_cat = $subCat->getId();
		$list = [];
		$request = "SELECT * FROM products WHERE id_sub_cat=".$id_sub_cat;
		$res = mysqli_query($this->link, $request);
		while($product = mysqli_fetch_object($res, "Products", [$this->link]))
			$list[] = $product;
		return $list;
	}

	// trouver les produits dans une categorie
	// il faut trouver tous les produits dont les sous-catégories
	// appartiennent à la même catégorie !

	public function findByCategory(Category $cat)
	{
		$id_category = $cat->getId();
		$list = [];
		$request = "SELECT products.* 
					FROM products
					INNER JOIN sub_category
					ON sub_category.id = products.id_sub_cat
					WHERE sub_category.id_category = ".$id_category;
		$res = mysqli_query($this->link, $request);
		while($product = mysqli_fetch_object($res, "Products", [$this->link]))
			$list[] = $product;
		return $list;
	}

	public function findByCart(Cart $cart)
	{
		$id_cart = $cart->getId();
		$list = [];
		$request = "SELECT products.* 
					FROM products 
					INNER JOIN link_cart_product 
					ON products.id = link_cart_product.id_product
					WHERE link_cart_product.id_cart =".$id_cart;
		$res = mysqli_query($this->link, $request);
		while ($product = mysqli_fetch_object($res, "Products", [$this->link]))
			$list[] = $product;
		return $list;
	}

	public function findByUser(Users $user)
	{
		$carts = $user->getCarts();
		$list = [];
		$i = 0;
		$max = count($carts);
		$request = "SELECT *
					FROM products
					INNER JOIN link_cart_product
					ON products.id = link_cart_product.id_product
					WHERE link_cart_product.id_cart=".$carts[$i]['id'];
		while ($i < $max)
		{
			$res = mysqli_query($this->link, $request);
			while ($product = mysqli_fetch_object($res, "Products", [$this->link]))
				$list[] = $product;
			$i++;
		}
		return $list;
	}

	// autres fonctions de recherche à venir si besoin 


	public function create($data)
	{
		if (!isset($_SESSION['id']))
			throw new Exception("Vous devez être connecté");
		if (($_SESSION['id']) != "1")
			throw new Exception("Vous n'êtes pas administrateur");		 
		if (!isset($data['ref']))
			throw new Exception("Indiquez la référence");
		if (!isset($data['stock']))
			throw new Exception("Indiquez la quantité en stock");
		if (!isset($data['size']))
			throw new Exception("Indiquez la taille (S, M, L ou 0 si l'article n'en a pas)");
		if (!isset($data['price']))
			throw new Exception("Indiquez le prix (avec un . pour la virgule sans le sigle monétaire)");
		if (!isset($data['tax']))
			throw new Exception("Indiquez la TVA (avec un . pour la virgule sans le %)");
		if (!isset($data['description']))
			throw new Exception("Donnez une description du produit");
		if (!isset($data['nom']))
			throw new Exception("Donnez le nom (ou la désignation) du produit");
		if (!isset($data['weight']))
			throw new Exception("Donnez le poids du produit (avec un . pour la virgule)");
		if (!isset($data['id_sub_cat']))
			throw new Exception("Indiquez la sous-categorie du produits)");
		if (!isset($data['status']))
			throw new Exception("Indiquez le statut du produit)");

		

		$products = new Products($this->link);
				
		$products->setRef($data['ref']);
		$products->setStock($data['stock']);
		$products->setSize($data['size']);
		$products->setPrice($data['price']);
		$products->setTax($data['tax']);
		$products->setDescription($data['description']);
		$products->setName($data['name']);
		$products->setWeight($data['weight']);
		$products->setStatus($data['status']);
		$products->setPicture($data['picture']);
		
		//

		$ref = $products->getRef();
		$stock = $products->getStock();
		$size = $products->getSize();
		$price = $products->getPrice();
		$tax = $products->getTax();
		$description = $products->getDescription();
		$name = $products->getName();
		$weight = $products->getWeight();
		$status = $products->getStatus();
		$picture = $products->getPicture();
		
		//


		$request = "INSERT INTO products (ref, stock, size, price, tax, description, name, weight, status, picture) VALUES('".$ref."', '".$stock."', '".$size."', '".$price."', '".$tax."', '".$description."', '".$name."', '".$weight."', '".$statut."', '".$picture."')";
		$res = mysqli_query($this->link, $request);
		if ($res)// Si la requete s'est bien passée
		{
			$id = mysqli_insert_id($this->link);
			if ($id)// si c'est bon id > 0
			{
				$products = $this->findById($id);
				return $products;
			}
			else// Sinon
				throw new Exception("Internal server error");
		}
		else// Sinon
			throw new Exception("Internal server error");
	}

	public function update(Products $products)// type-hinting
	{
		$id = $products->getId();
		if ($id)// true si > 0
		{
			$ref = mysqli_real_escape_string($this->link, $products->getRef());
			$stock = $products->getStock();
			$size = $products->getSize();
			$price = $products->getPrice();
			$tax = $products->getTax();
			$description = mysqli_real_escape_string($this->link, $products->getDescription());
			$name = mysqli_real_escape_string($this->link, $products->getName());
			$weight = $products->getWeight();
			$id_sub_cat = $products->getSubCat();
			$statut = $products->getStatut();
			$picture = mysqli_real_escape_string($this->link, $products->getPicture());

			$request = "UPDATE products SET ref='".$ref."', stock='".$stock."', size='".$size."', price='".$price."', tax='".$tax."', description='".$description."', name='".$name."', weight='".$weight."', id_sub_cat='".$id_sub_cat."', status='".$status."', picture='".$picture."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception("Internal server error");
		}
	}

	public function delete(Category $products)
	{
		$id = $products->getId();
		// droit ? admin ? access ?
		if ($id)
		{
			$request = "DELETE FROM products 
						WHERE id='".$id."' LIMIT 1";
			$res = mysqli_query($this->link, $request);
			if($res)
				return $products;
			else
				throw new Exception("Internal server error");
		}
	}

	public function OrderByPrice($orderby)
	{
		if ($orderby == 'ASC')
		{
			$list = [];
			$request = "SELECT * FROM products ORDER BY price ASC";
			$res = mysqli_query($this->link, $request);
			if(!$res)
				throw new Exception("DB request error");
			while($product = mysqli_fetch_object($res, "Products", [$this->link]))
				$list[] = $product;
			return $list;
		
		}
		else if ($orderby == 'DESC')
		{
			$list = [];
			$request = "SELECT * FROM products ORDER BY price DESC";
			$res = mysqli_query($this->link, $request);
			if(!$res)
				throw new Exception("DB request error");
			while($product = mysqli_fetch_object($res, "Products", [$this->link]))
				$list[] = $product;
			return $list;
		}
		else 
			throw new Exception("tri invalide");
	}



}
?>