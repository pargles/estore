<?php
	//echo "<p>" . anchor('store/loadAdministratorPage','Admin') . "</p>";
	if($clientVariable){
		echo "<h2>Main page - ". $clientVariable->first."</h2>";
	}else{
		echo "<h2>Main page - Client</h2>";
	}
	echo "<p>" . anchor('store/loadCart','My Cart') . "</p>";
	echo "<p>" . anchor('store/createLoginForm','Login') . "</p>";
	echo "<p>" . anchor('store/logOut','Logout') . "</p>";
	echo "<table>";
	echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
	
	foreach ($products as $product) {
		echo "<tr>";
		echo "<td>" . $product->name . "</td>";
		echo "<td>" . $product->description . "</td>";
		echo "<td>" . $product->price . "</td>";
		echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
		echo "<td>" . anchor("store/buyItem/$product->id",'Buy') . "</td>";
		echo "</tr>";
	}
	echo "<table>";
?>