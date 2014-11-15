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
		//echo "<p>" . anchor('store/newForm','Add New') . "</p>";
 	  	
		echo "<div id='main_customer'>";
		echo "<h1>Customer Table</h1>";
		echo "<table>";
		echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
		
		foreach ($customers as $customer) {
			echo "<tr>";
			echo "<td class='product'>" . $customer->first . "</td>";
			echo "<td class='product'>" . $customer->last . "</td>";
			echo "<td class='product'>" . $customer->email . "</td>";
							
			echo "<td class='product'>" . anchor("store/deleteCustomer/$customer->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "</tr>";
		}
		echo "<table>";
		echo "</div>";
?>

</body>
</html>
