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
		echo "<p class='link'>" . anchor('store/index','Back to the store') . "</p>";
		echo "<p class='link'>" . anchor('store/loadAdministratorPage','Back') . "</p>";
		echo "<p class='link'>" . anchor('store/newForm','Add New') . "</p>";
 	  	echo "</div>";
 	  	
 	  	echo "<div id='main_cart'>";
 	  	echo "<h1 class='words'>Product Table</h1>";
		echo "<table>";
		echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
		
		foreach ($products as $product) {
			echo "<tr>";
			echo "<td class='product'>" . $product->name . "</td>";
			echo "<td class='product'>" . $product->description . "</td>";
			echo "<td class='product'>" . $product->price . "</td>";
			echo "<td class='product'><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
				
			echo "<td class='product'>" . anchor("store/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "<td class='product'>" . anchor("store/editForm/$product->id",'Edit') . "</td>";
			echo "<td class='product'>" . anchor("store/read/$product->id",'View') . "</td>";
				
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
?>	

</body>
</html>