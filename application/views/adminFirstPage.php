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
	echo "<div id='main'>";
	echo "<h1 class='words'>Administrator page</h1>";
		echo "<p class='link_admin'>" . anchor('store/index','Back to the store') . "</p>";
	echo "<p class='link_admin'>" . anchor('store/loadProductAdmin','Products') . "</p>";
	echo "<p class='link_admin'>" . anchor('store/loadOrderAdmin','Orders') . "</p>";
	echo "<p class='link_admin'>" . anchor('store/loadCustomerAdmin','Customers') . "</p>";
	echo "</div>";
?>

</body>
</html>
