<?php
class Cart
{
	private $id;
	private $id_user;
	private $date;
	private $status;
	private $price;
	private $nb_products;
	private $weight;


	public function getId()
	{
		return $this->id;
	}
	public function getIdUser()
	{
		return $this->id_user;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getStatus()
	{
		return $this->status;
	}
	public function getPrice()
	{
		return $this->price;
	}
	public function getNbProducts()
	{
		return $this->nb_products;
	}
	public function getWeight()
	{
		return $this->weight;
	}

	public function setStatus($status)
	{
		if ($status != 0 && $status != 1)
			return 'Status invalide';
		$this->status = $status;
	}
	public function setPrice($price)
	{
		$price=floatval($price);
		if ($price <=0)
			return "Prix invalide";
		$this->price = $price;
	}
	public function setNbProducts($nb_products)
	{
		$nb_products=intval($nb_products);
		if ($nb_products<=0)
			return "Quantité invalide";
		$this->nb_products = $nb_products;
	}
	public function setWeight($weight)
	{
		$weight=floatval($weight);
		if ($weight<=0)
			return "Poids invalide";
		$this->weight = $weight;
	}



}

?>