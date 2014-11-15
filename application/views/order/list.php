<h2>Order Table</h2>
<?php 
		echo "<p>" . anchor('store/loadAdministratorPage','Back') . "</p>";
 	  
		echo "<table>";
		echo "<tr><th>Order Id</th><th>Customer</th><th>Date</th><th>Time</th><th>Total</th></tr>";
		
		foreach ($orders as $order) {
			echo "<tr>";
			echo "<td>" . $order->id . "</td>";
			echo "<td>" . $order->first ." ".$order->last. "</td>";
			echo "<td>" . $order->order_date . "</td>";
			echo "<td>" . $order->order_time . "</td>";
			echo "<td>$ " . $order->total . "</td>";
			//echo "<td>" . $order->items . "</td>";
			echo "<td>" . anchor("store/listItemsFromOrder/$order->id",'Items') . "</td>";
			echo "<td>" . anchor("store/deleteOrder/$order->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "</tr>";
		}
		echo "<table>";
?>