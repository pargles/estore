<h2>My Cart</h2>
<?php
echo "<p>" . anchor ( 'store/index', 'Back to the store' ) . "</p>";
echo "<table>";
echo "<tr><th>Photo</th><th>Product</th><th>Quantity</th><th>Price</th></tr>";

if(!empty($automaticitemsvariable)){
	foreach ( $automaticitemsvariable as $item ) {
		echo "<tr>";
		echo "<td><img src='" . base_url () . "images/product/" . $item->photo_url . "' width='100px' /></td>";
		echo "<td>" . $item->name . "</td>";
		echo "<td>" . $item->price . "</td>";
		echo "<td> 1</td>";
		echo "<td>" . anchor ( "store/test/", 'Increase' ) . "</td>";
		echo "<td>" . anchor ( "store/test/", 'Decrease' ) . "</td>";
		echo "<td>" . anchor ( "store/deleteItemFromSession/$item->id", 'Delete' ) . "</td>";
		echo "</tr>";
	}
	echo "<table>";
	echo "<p>" . anchor ( "store/cleanCart", 'Clean my cart' ) . "</p>";
	echo "<p>" . anchor ( "store/checkout/", 'Check out' ) . "</p>";
}
 else {
	echo "<tr>";
	echo "<td>your cart is empty</td>";
	echo "</tr>";
}
?>