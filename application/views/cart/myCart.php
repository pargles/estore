<h2>My Cart</h2>
<?php
echo "<p>" . anchor ( 'store/index', 'Back to the store' ) . "</p>";
echo "<table>";
echo "<tr><th>Photo</th><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";
$sum = 0;
if(!empty($automaticitemsvariable)){
	foreach ( $automaticitemsvariable as $item ) {
		echo "<tr>";
		echo "<td><img src='" . base_url () . "images/product/" . $item->photo_url . "' width='100px' /></td>";
		echo "<td>" . $item->name . "</td>";
		echo "<td>" . $item->quantity . "</td>";
		echo "<td>" . $item->price . "</td>";
		$sum = $sum +  $item->price * $item->quantity;
		echo "<td>" .$item->price * $item->quantity. "</td>";
		echo "<td>" . anchor ( "store/increaseProductQuantity/$item->product_id", 'Increase' ) . "</td>";
		echo "<td>" . anchor ( "store/decreaseProductQuantity/$item->product_id", 'Decrease' ) . "</td>";
		echo "<td>" . anchor ( "store/deleteItemFromSession/$item->product_id", 'Delete' ) . "</td>";
		echo "</tr>";
	}
	echo "<table>";
	echo "<br>Total: $ ".$sum;
	echo "<p>" . anchor ( "store/cleanCart", 'Clean my cart' ) . "</p>";
	echo "<p>" . anchor ( "store/checkout/", 'Check out' ) . "</p>";
}
 else {
	echo "<tr>";
	echo "<td>your cart is empty</td>";
	echo "</tr>";
}
?>