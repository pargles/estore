<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Main</title>
	<link rel="stylesheet" href="<?php echo base_url('css/template.css'); ?>" />
</head>
<body>
<header id="header">
	<h2>Baseball Cards Store</h2>
	<img id="mlbimage" src="../../images/style/mlb.png">
	<img id="brasilimage" src="../../images/style/brasil.png">
</header>
<img id="bgimage" src="../../images/style/3.png">

	<?php
	echo "<div id='nav'>";
	echo "<p class='link'>" . anchor('store/loadAdministratorPage','Admin') . "</p>";
	echo "<p class='link'>" . anchor('store/loadCart','My Cart') . "</p>";
	echo "<p class='link'>" . anchor('store/createLoginForm','Login') . "</p>";
	echo "</div>";
	
	echo "<div id='main'>";
	echo "<h1 id='cards'>Cards Available</h1>";
	echo "<table>";
	echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
	
	
	foreach ($products as $product) {
		echo "<tr>";
		echo "<td class='product'>" . $product->name . "</td>";
		echo "<td class='product'>" . $product->description . "</td>";
		echo "<td class='product'>" . $product->price . "</td>";
		echo "<td class='product'><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
		echo "<td class='product'>" . anchor("store/buyItem/$product->id",'Buy') . "</td>";
		echo "</tr>";
	}
	echo "<table>";
	echo "</div>";
?>
</body>
</html>

