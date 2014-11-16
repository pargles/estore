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
		echo "<p class='link'>" . anchor('store/loadOrderAdmin','Back') . "</p>";
		//echo "<p>" . anchor('store/newForm','Add New') . "</p>";
		echo "</div>";
 	  	
		echo "<div id='main'>";
		echo "<h1> Items </h1>";
		echo "<table>";
		echo "<tr><th>Card</th><th>Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";
		$sum = 0;
		foreach ($items as $item) {
			echo "<tr>";
			echo "<td class='product'><img src='" . base_url() . "images/product/" . $item->photo_url . "' width='100px' /></td>";
			echo "<td class='product'>" . $item->name . "</td>";
			echo "<td class='product'>" . $item->quantity . "</td>";
			echo "<td class='product'>$ " . $item->price . "</td>";
			echo "<td class='product'>$ " . $item->price * $item->quantity . "</td>";
			$sum = $sum + $item->price * $item->quantity; 	
			//echo "<td>" . anchor("store/test",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			//echo "<td>" . anchor("store/editForm/$item->id",'Edit') . "</td>";
			//echo "<td>" . anchor("store/read/$item->id",'View') . "</td>";
				
			echo "</tr>";
		}
		echo "</table>";
		echo "<br><br> Total = $ " .$sum;
		echo "</div>";
?>
</body>
</html>
