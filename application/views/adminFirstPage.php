<h2>Administrator page</h2>
<?php
	echo "<p>" . anchor('store/loadProductAdmin','Products') . "</p>";
	echo "<p>" . anchor('store/loadOrderAdmin','Orders') . "</p>";
	echo "<p>" . anchor('store/loadCustomerAdmin','Customers') . "</p>";
?>