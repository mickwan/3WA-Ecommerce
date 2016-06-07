<?php
class CartManager
{
	private $link;

	public function __construct($link)
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
	public function findByUser(Users $user)
	{
		$id_user = $user->getId();
		$list = [];
		$request = "SELECT * 
					FROM cart 
					WHERE id_user=".$id_user;
		$res = mysqli_query($this->link, $request);
		while ($cart = mysqli_fetch_object($res, "Cart", [$this->link]))
			$list[] = $cart;
		return $list;
	}
	public function findCurrentCart(Users $user)
	{
		$id_user = $user->getId();
		$cartsManager = new CartManager($this->link);
		$carts = $cartsManager->findByUser($user);
		if (!isset($carts[1]))
		{
			if (isset($carts[0]))
				return $carts[0];
			else
				return $this->create();
		}
		else
		{
			$i = 0;
			$saveDate = $carts[0]->getDate();
			while ($i < count($carts))
			{
				if ($carts[$i]->getDate() > $saveDate && $carts[$i]->getStatus() == 0)
				{
					$saveDate = $carts[$i]->getDate();
					$currentCart = $carts[$i];
				}
				$i++;
			}
			return $currentCart[0];
		}
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
	public function getQuantity(Products $product, Cart $cart)
	{
		$id_product = $product->getId();
		$id_cart = $cart->getId();
		$list = [];
		$request = "SELECT * FROM link_cart_product WHERE id_product =".$id_product." AND id_cart=".$id_cart;
		$res = mysqli_query($this->link, $request);
		while ($product = mysqli_fetch_object($res, "Products", [$this->link]))
			$list[] = $product;
		return count($list);
	}
	public function create()
	{
		if (!isset($_SESSION['id_user']))
			throw new Exception("Vous devez être connecté");
		$id_user = $_SESSION['id_user'];
		$request = "INSERT INTO cart(id_user) 
					VALUES (".$id_user.")";
		$res = mysqli_query($this->link, $request);
		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if ($id)
			{
				$cart = $this->findById($id);
				return $cart;
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
		$products = $cart->getUpdateProducts();
		$request = "DELETE FROM link_cart_product 
					WHERE id_cart =".$id_cart;
		$res = mysqli_query($this->link, $request);
		if (!$res)
			throw new Exception("Error Processing Request");


		$i=0; 
		while ($i < count($products))
		{
			$request = "INSERT INTO link_cart_product(id_cart, id_product)
					VALUES ('".$id_cart."', '".$products[$i]->getId()."')";
			$res = mysqli_query($this->link, $request);
			if (!$res)
				throw new Exception("Error Processing Request");
			$i++;
		}

		$request = "UPDATE cart 
					SET status = '".$status."', price = '".$price."', nb_products = '".$nb_products."', weight = '".$weight."'";
		$res = mysqli_query($this->link, $request);
		if ($res)
				return $this->findById($id_cart);
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
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $cart;
			else
				throw new Exception("Internal server error");
		}
	}
}
?>