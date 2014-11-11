<?php 
		echo "Hello " .$clientVariable->first. ",<br><br> Thank you for shopping with us. The following products will be shipped shortly to your address. <br>";
		echo "<table>";
		echo "<tr><th>Photo</th><th>Card</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
		$sum = 0;
		foreach ($automaticitemsvariable as $item) {
			echo "<tr>";
			echo "<td><img src='" . base_url() . "images/product/" . $item->photo_url . "' width='100px' /></td>";
			echo "<td> " . $item->name . "</td>";
			echo "<td>$ " . $item->price . "</td>";
			echo "<td> " .$item->quantity . "</td>";
			echo "<td>$ " . $item->price * $item->quantity . "</td>";
			$sum = $sum +  $item->price * $item->quantity;
			echo "<td></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br>Total = $ ".$sum;
		echo  "<br><br>We hope to see you again soon! <br> BestCards";
?>	

