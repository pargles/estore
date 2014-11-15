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
	<img id="mlbimage" src="../../../images/style/mlb.png">
	<img id="brasilimage" src="../../../images/style/brasil.png">
</header>
<img id="bgimage" src="../../../images/style/3.png">

<?php 
	echo "<div id='nav'>";
	echo "<p class='link'>" . anchor('store/index','Back to the store') . "</p>";
	echo "<p class='link'>" . anchor('store/loadProductAdmin','Back') . "</p>";
	echo "</div>";
	
	echo "<div id='main'>";
	echo "<h1 class='words'>Product Entry</h1>";
	echo "<p class='product_view'> ID = " . $product->id . "</p>";
	echo "<p class='product_view'> NAME = " . $product->name . "</p>";
	echo "<p class='product_view'> Description = " . $product->description . "</p>";
	echo "<p class='product_view'> Price = " . $product->price . "</p>";
	echo "<p class='product_view'><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px'/></p>";
	echo "</div>";	
?>	

</body>
</html>
