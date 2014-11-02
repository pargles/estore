<h2>Main page</h2>
<?php
	echo "<p>" . anchor('store/loadAdministratorPage','Admin') . "</p>";
	echo "<p>" . anchor('store/loadCart','My Cart') . "</p>";
	echo "<p>" . anchor('store/test','Login') . "</p>";
	echo "<table>";
	echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
	
	foreach ($products as $product) {
		echo "<tr>";
		echo "<td>" . $product->name . "</td>";
		echo "<td>" . $product->description . "</td>";
		echo "<td>" . $product->price . "</td>";
		echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
		echo "</tr>";
	}
	echo "<table>";
?>