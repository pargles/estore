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
echo "<p class='link'>" . anchor ( 'store/index', 'Back to the store' ) . "</p>";
echo "<p class='link'>" . anchor ( "store/cleanCart", 'Clean my cart' ) . "</p>";
//echo "<p class='link'>" . anchor ( "store/checkout/", 'Check out' ) . "</p>";
echo "</div>";

echo "<div id='main_cart'>";
echo "<h1 id='cart'>My Cart</h1>";

$sum = 0;
if(!empty($automaticitemsvariable)){
	echo "<table>";
	echo "<tr><th>Photo</th><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";
	foreach ( $automaticitemsvariable as $item ) {
		echo "<tr>";
		echo "<td class='product'><img src='" . base_url () . "images/product/" . $item->photo_url . "' width='100px' /></td>";
		echo "<td class='product'>" . $item->name . "</td>";
		echo "<td class='product'>" . $item->quantity . "</td>";
		echo "<td class='product'>$ " . $item->price . "</td>";
		$sum = $sum +  $item->price * $item->quantity;
		echo "<td class='product'>$ " .$item->price * $item->quantity. "</td>";
		echo "<td class='product'>" . anchor ( "store/increaseProductQuantity/$item->product_id", 'Increase' ) . "</td>";
		echo "<td class='product'>" . anchor ( "store/decreaseProductQuantity/$item->product_id", 'Decrease' ) . "</td>";
		echo "<td class='product'>" . anchor ( "store/deleteItemFromSession/$item->product_id", 'Delete' ) . "</td>";
		echo "</tr>";
	}
	echo "<table>";
	
	echo "</div>";
	echo "<br>Total: $ ".$sum;	
	echo "<p class='link'>" . anchor ( "store/cleanCart", 'Clean my cart' ) . "</p>";
	echo "<p class='link'>" . anchor ( "store/checkout", 'Check out' ) . "</p>";
}else {
	echo "<img id='empty_cart_img' src='../../images/style/empty_cart.png'>";	
}
?>
</body>
</html>
