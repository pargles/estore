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
 	  	echo "</div>";
		
		echo "<div id='main'>";
 	  	echo "<h1 class='words'>Order Table</h1>";
		echo "<table>";
		echo "<tr><th>Order Id</th><th>Customer</th><th>Date</th><th>Time</th><th>Total</th></tr>";
		
		foreach ($orders as $order) {
			echo "<tr>";
			echo "<td class='product'>" . $order->customer_id . "</td>";
			echo "<td class='product'>" . $order->order_date . "</td>";
			echo "<td class='product'>" . $order->order_time . "</td>";
			echo "<td class='product'>" . $order->total . "</td>";
			//echo "<td>" . $order->items . "</td>";
			echo "<td>" . anchor("store/listItemsFromOrder/$order->id",'Items') . "</td>";
			echo "<td class='product'>" . anchor("store/deleteOrder/$order->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "</tr>";
		}
		echo "<table>";
		echo "</div>";
?>
</body>
</html>

