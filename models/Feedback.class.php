<?php
	class Feedback
	{
		private $id;
		private $id_author;
		private $id_product;
		private $content;
		private $date;

		private $author;
		private $product;

		public function __construct($link)
		{
			$this->link = $link;
		}
		//GETTERS 
		public function getId()
		{
			return $this->id;
		}
		public function getIdAuthor()
		{
			return $this->id_author;
		}
		public function getProduct()
		{
			return $this->id_product;
		}
		public function getContent()
		{
			return $this->content;
		}
		public function getDate()
		{
			return $this->date;
		}
		public function getStatus()
		{
			return $this->status;
		}
		public function getAuthor()
		{
			if ($this->author == null)
			{
				$usersManager = new usersManager($this->link);
				$this->author = $usersManager->findById($this->id_author);
			}
			return $this->author;
		}
		public function getProduct()
		{
			if ($this->product)
			{
				$productsManager = new ProductsManager($this->link);
				$this->product = $usersManager->findById($this->id_author);
			}
			return $this->product;
		}

		//SETTERS
		public function setContent($content)
		{
			if (strlen($content) < 10)
				throw new Exception("Le contenu de votre avis est trop court!");
			if (strlen($content) > 255)
				throw new Exception("Le contenu de votre avis est trop long!");
			$this->content = $content;
		}
		public function setStatus($status)
		{
			if ($status >= 0 || $status <= 2)
				$this->status = $status;
			else
				throw new Exception("Mauvais Statut");
		}
	}
?>