<?php
class CartManager
{
	private $link;

	public function __construct= $link;
	{
		$this->link = $link;
	}

	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM cart WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$cart = mysqli_fetch_object($res, "Cart");
		return $cart;
	}
	public function findByUser($id_user)
	{
		$id_user = intval($id_user);
		$request = "SELECT * FROM cart WHERE id=".$id_user;
		$res = mysqli_fetch_object($res, "Cart");
		return $cart;
	}
	public function findByStatus($status)
	{
		$status = mysqli_real_escape_string($this->link, $status);
		$request = "SELECT * FROM cart WHERE id=".$status;
		$res = mysqli_query($this->link, $request);
		$cart = mysqli_fetch_object($res, "Cart");
		return $cart;
	}

	public function findProduct($id_cart)
	{
		if ($id_cart)
		{
			$list = [];
			$request="SELECT id_product, nb FROM link_cart_product WHERE id_cart"=.$id;
			$res = mysqli_query($this->link, $request);
			while ($id_product = mysqli_fetch_assoc($res))
				$list[] = $id_product;
			return $list;
		}
	}
	public function create ($data)
	{
		if (!isset($_SESSION['id']))
			throw new Exception("Vous devez être connecté");
		$cart = new Cart($this->link);

		$cart->setDate($data['date']);
		$cart->setStatus($data['status']);
		$cart->setPrice($data['price']);
		$cart->setNbProducts($data['nb_products']);
		$cart->setWeight($data['weight']);

		$date = $cart->getDate();
		$status = $cart->getStatus();
		$price = $cart->getPrice();
		$nb_products = $cart->getNbProducts();
		$weight = $cart->getWeight();
		$id_user = $_SESSION['id'];
		$request = "INSERT INTO cart('date',status, price, nb_products, id_user) VALUES ('".$date."', '".$status."', '".$price."', '".$nb_products"', '".$weight."')";
		$res = mysql_query($this->link, $request);
		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if ($id)
			{
				$cart = $this->findById($id);
			return $cart
			}
			else
				throw new Exception("Internal server error");
		}
		else
			throw new Exception("Internal server error");
	}

	public function update (Cart $cart)
	{
		$id = $cart->getId();
		if ($id)
		{
			$status = $this->link, $cart->getStatus();
			$price = $this->link, $cart->getPrice();
			$nb_products = $this->link, $cart->getNbProducts();
			$weight = $this->link, $cart->getWeight();
			$request ="UPDATE cart SET status='".$status."', price='".$price."', nb_products='".$nb_products."', weight='".$weight."' WHERE id".$id;
			$res = mysqli_query($this->link, $request);
			if($res)
				return $cart;
			else
				throw new Exception ("Internal server error");
		}
		
	}

	public function removeCart (Cart $cart)
	{
		$id = $cart->getId();
		if ($id)
		{
			$request ="DELETE FROM cart WHERE id=".$id;
			$res = mysql_query($this->link, $request);
			if ($res)
				return $cart;
			else
				throw new Exception("Internal server error");
		}
	}

	public function addProduct (Cart $cart)
	{
		$id = $cart->getId();
		if ($id)
		$request = "INSERT INTO link_cart_product(id_cart, id_product,nb) VALUES ('".$price."', '".$nb_products"', '".$weight"')";
		$res = mysqli_query($this->link, $request);
		if($res)
				return $this->findById($id);
		else
			throw new Exception ("Internal server error");
	}

	public function removeProduct (Product $product, Cart $cart)
	{
		$id_cart = $cart->getId();
		$id_product = $product->getId();
		if ($id_cart && $id_product)
		{
			$request ="DELETE FROM link_cart_product WHERE id_cart ='".$id_cart."' AND id_product = '".$id_product."'";
			$res = mysql_query($this->link, $request);
			if ($res)
				return $cart;
			else
				throw new Exception("Internal server error");
		}
	}
}

?>