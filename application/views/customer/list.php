<h2>Customer Table</h2>
<?php 
		echo "<p>" . anchor('store/index','Back') . "</p>";
		//echo "<p>" . anchor('store/newForm','Add New') . "</p>";
 	  
		echo "<table>";
		echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
		
		foreach ($customers as $customer) {
			echo "<tr>";
			echo "<td>" . $customer->first . "</td>";
			echo "<td>" . $customer->last . "</td>";
			echo "<td>" . $customer->email . "</td>";
							
			echo "<td>" . anchor("store/deleteCustomer/$customer->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "</tr>";
		}
		echo "<table>";
?>