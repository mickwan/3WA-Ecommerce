<?php
class CartManager
{
	private $link;

	public function = $link;
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

	public function create ($data)
	{
		$cart = new Cart();
	}
	public function getById($id)
	{
		return $this->findById($id);
	}
	public function update (Cart $cart)
	{
		$id = $cart->getId();
		if ($id)
		{
			$date = mysqli_real_escape_string($this->link, $cart->getDate());
			$status = mysqli_real_escape_string($this->link, $cart->getStatus());
			$price = mysqli_real_escape_string($this->link, $cart->getPrice());
			$nb_products = mysqli_real_escape_string($this->link, $cart->getNbProducts());
			$weight = mysqli_real_escape_string($this->link, $cart->getWeight());
			$request ="UPDATE cart SET date='".$date."', status='".$status."', price='".$price."', nb_products='".$nb_products."', weight='".$weight."' WHERE id".$id;
			$res = mysqli_query($this->link, $request);
			if($res)
				return $this->findByIs($id);
			else
				throw new Exception ("Internal server error");
		}
		
	}

	public function addProduct (Cart $cart)
	{
		$id = $cart->getId();
		if ($id)
		$request = "INSERT INTO link_cart_product(id_cart, id_product,nb) VALUES ('".$price."', '".$nb_products"', '".$weight"')";
	}
	public function removeProduct (Cart $cart)
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
	public function findProduct (Cart $cart)
	{
		$id = $cart->getId();
		if ($id)
		{
			$request="SELECT id_product FROM link_cart_prouct WHERE id_cart"=.$id_cart
		}
	}


}

?>