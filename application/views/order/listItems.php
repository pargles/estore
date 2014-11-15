<h2> Items </h2>
<?php 
		echo "<p>" . anchor('store/loadOrderAdmin','Back') . "</p>";
		//echo "<p>" . anchor('store/newForm','Add New') . "</p>";
 	  
		echo "<table>";
		echo "<tr><th>Card</th><th>Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";
		$sum = 0;
		foreach ($items as $item) {
			echo "<tr>";
			echo "<td><img src='" . base_url() . "images/product/" . $item->photo_url . "' width='100px' /></td>";
			echo "<td>" . $item->name . "</td>";
			echo "<td>" . $item->quantity . "</td>";
			echo "<td>$ " . $item->price . "</td>";
			echo "<td>$ " . $item->price * $item->quantity . "</td>";
			$sum = $sum + $item->price * $item->quantity; 	
			//echo "<td>" . anchor("store/test",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			//echo "<td>" . anchor("store/editForm/$item->id",'Edit') . "</td>";
			//echo "<td>" . anchor("store/read/$item->id",'View') . "</td>";
				
			echo "</tr>";
		}
		echo "</table>";
		echo "<br><br> Total = $ " .$sum;
?>