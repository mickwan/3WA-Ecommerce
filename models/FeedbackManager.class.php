<?php
	class FeedbackManager
	{
		private $link;

		public function __construct($link)
		{
			$this->link = $link;
		}

		public function findById($id)
		{
			$id = intval($id);
			$request = "SELECT * FROM feedback WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			$feedback = mysqli_fetch_object($res, "Feedback");
			return $feedback;
		}
		public function findByAuthor($id_author)
		{
			$list = [];
			$id_author = intval($id_author);
			$request = "SELECT * FROM feedback WHERE id_author=".$id_author;
			$res = mysqli_query($this->link, $request);
			while ($feedback = mysqli_fetch_object($res, "Feedback"))
				$list[] = $feedback;
			return $list;  
		}
		public function findByProduct($id_product)
		{
			$list = [];
			$id_product = intval($id_product);
			$request = "SELECT * FROM feedback WHERE id_product=".$id_product;
			$res = mysqli_query($this->link, $request);
			while ($feedback = mysqli_fetch_object($res, "Feedback"))
				$list[] = $feedback;
			return $list;
		}
		public function findByStatus($status)
		{
			$list = [];
			$status = intval($status);
			$request = "SELECT * FROM feedback WHERE status=".$status;
			$res = mysqli_query($this->link, $request);
			while ($feedback = mysqli_fetch_object($res, "Feedback"))
				$list[] = $feedback;
			return $list;
		}

		public function create($data)
		{
			if (!isset($_SESSION['id_user']))
				throw new Exception("Vous devez être connecté");
			if (!isset($data['id_product']))
				throw new Exception("Paramètre manquant : Produit");
			if (!isset($data['content']))
				throw new Exception("Paramètre manquant : Contenu");

			$feedback = new Feedback();
			$feedback->setContent($data['content']);
			$id_author = $_SESSION['id_user'];
			$id_product = $data['id_product'];
			$content = mysqli_real_escape_string($this->link, $feedback->getContent());

			$request = "INSERT INTO feedback (id_author, id_product, content) 
						VALUES (".$id_author.", ".$id_product.", '".$content."')";
			$res = mysqli_query($this->link, $request);
			if ($res) //Si la requete s'est bien passé
			{
				$id = mysqli_insert_id($this->link);
				if ($id) //Si l'id est ok
				{
					$feedback = $this->findById($id);
					return $feedback;
				}
				else //si l'id est foireux
					throw new Exception("Server Error");
			}
			else //si la requete est foireuse
				throw new Exception("Server Error");
						
		}

		public function update(Feedback $feedback)
		{
			$id = $feedback->getId();
			if ($id)
			{
				$content = mysqli_real_escape_string($this->link, $feedback->getContent());
				$status = $feedback->getStatus();
				$request = "UPDATE feedback 
							SET content='".$content."', status=".$status." 
							WHERE id=".$id;
				$res = mysqli_query($this->link, $request);
				if ($res)
					return $this->findById($id);
				else
					throw new Exception("Server Error");
					
			}
		}
		public function remove(Feedback $feedback)
		{
			$id = $feedback->getId();
			if($id)
			{
				$request = "DELETE FROM feedback 
							WHERE id=".$id;
				$res = mysqli_query($this->link, $request);
				if ($res)
					return $feedback;
				else
					throw new Exception("Server Error");
			}
		}
	}
?>