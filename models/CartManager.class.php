<?php
class CartManager
{
	private $link;

	public function __construct($link);
	{
		$this->link = $link;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * 
					FROM cart 
					WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$cart = mysqli_fetch_object($res, "Cart", [$this->link]);
		return $cart;
	}
	public function findByUser($id_user)
	{
		$id_user = intval($id_user);
		$request = "SELECT * 
					FROM cart 
					WHERE id_user=".$id_user;
		$res = mysqli_fetch_object($res, "Cart", [$this->link]);
		return $cart;
	}
	public function findByStatus($status)
	{
		$list = [];
		$status = mysqli_real_escape_string($this->link, $status);
		$request = "SELECT * 
					FROM cart 
					WHERE id=".$status;

		$res = mysqli_query($this->link, $request);
		while ($cart = mysqli_fetch_object($res, "Cart", [$this->link]))
			$list[] = $cart;
		return $list;
	}
	public function create()
	{
		if (!isset($_SESSION['id']))
			throw new Exception("Vous devez être connecté");
		$id_user = $_SESSION['id'];
		$request = "INSERT INTO cart('id_user') 
					VALUES ('".$id_user."')";
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
		$id_cart = $cart->getId();
		$status = $cart->getStatus();
		$price = $cart->getPrice();
		$nb_products = $cart->getNbProducts();
		$weight = $cart->getWeight();
		$products = $cart->getProducts();
		
		$request = "DELETE FROM link_cart_product 
					WHERE id_cart =".$id_cart;
		$res = mysqli_query($this->link, $request);
		if (!$res)
			throw new Exception("Error Processing Request");

		$request = "INSERT INTO link_cart_product(id_cart, id_product)
					VALUES ('".$id_cart."', '".$products['id']."')";				
		while ($products[])
		{
			$res = mysqli_query($this->link, $request);
			if (!$res)
				throw new Exception("Error Processing Request");
		}

		$request = "UPDATE cart 
					SET status = '".$status."', price = '".$price."', nb_products = '".$nb_products."', weight = '".$weight;
		$res = mysql_query($this->link, $request);
		if ($res)
				return $this->findById($id);
		else
			throw new Exception("Error Processing Request");
	}
	public function removeCart (Cart $cart)
	{
		$id = $cart->getId();
		if ($id)
		{
			$request ="DELETE FROM cart 
					   WHERE id='".$id."' LIMIT 1";
			$res = mysql_query($this->link, $request);
			if ($res)
				return $cart;
			else
				throw new Exception("Internal server error");
		}
	}
}
?>