<?php
	$list = [];
	$request = "SELECT id, picture FROM products";
	$res = mysqli_query($this->link, $request);
	while ($picture = mysqli_fetch_assoc($res))
		$list[] = $picture;

	$i = 0;
	$max = count($list);
	while($i < $max)
	{
?>
	<img src="<?=$list[$i]?>" alt="prout" />
<?php
	$i++;
	}
?>
