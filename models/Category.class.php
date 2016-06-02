<?php
// Category.class.php -> PascalCase
class Category
{
	// Déclaration des propriétés privées
	private $id;
	private $name;
	private $description;
	private $subCategories;

	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	// Getter/Setter | Accesseur/Mutateur | Accessor/Mutator
	public function getId()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setName($name)
	{
		if (strlen($name) < 4)
			throw new Exception ("Nom trop court (< 4)");
		else if (strlen($name) > 31)
			throw new Exception ("Nom trop long (> 31)");
		$this->name = $name;
	}

	public function setDescription($description)
	{
		if (strlen($description) < 4)
			throw new Exception ("Description trop courte (< 4)");
		else if (strlen($description) > 123)
			throw new Exception ("Description trop longue (> 123)");
		$this->description = $description;
	}

	public function getSubCategories()
	{
		if($this->subCategories == NULL)
		{
			$subCategoryManager = new SubCategoryManager($this->link);
			$this->subCategories = $subCategoryManager->findByCategory($this);
		}
		return $this->subCategories;
	}

	public function getProducts()
	{		
		if($this->products == NULL)
		{
			$productsManager = new ProductsManager($this->link);
			$this->products = $productsManager->findByCategory($this);
		}
		return $this->products;
	}
}
?>