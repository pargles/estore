<<<<<<< HEAD
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
echo "<h1 class='words'>Order Concluded</h1>";
echo "<p class='words'> Thanks for the preference </p>";
echo "<p class='words'>" . anchor ( 'store/index', 'Back to the store' ) . "</p>";
echo '<input type="button" value="Show Receipt" onclick="openWin()" />';
echo "</div>";

echo "<div id='nav_thanks'>";
echo "<p class='link'>" . anchor ( 'store/index', 'Back to the store' ) . "</p>";
echo "<p class='link'>" . anchor ( 'store/printReceipt', 'print my receipt' ) . "</p>";
echo "</div>";
?>
<body>

<?php

$message = "Thanks for your order, " .$clientVariable->first. "<br><br>";
$message = $message."Order Details: <br><br>";
$message = $message. "email address: ".$clientVariable->email. "<br><br>";
$message = $message. "<table>";
$message = $message. "<tr><th>Card</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
$sum = 0;
foreach ($automaticitemsvariable as $item) {
	$message = $message. "<tr>";
	$message = $message. "<td><img src='" . base_url() . "images/product/" . $item->photo_url . "' width='100px' /></td>";
	$message = $message. "<td> " . $item->name . "</td>";
	$message = $message. "<td>$ " . $item->price . "</td>";
	$message = $message. "<td> " .$item->quantity . "</td>";
	$message = $message. "<td>$ " . $item->price * $item->quantity . "</td>";
	$sum = $sum +  $item->price * $item->quantity;
	$message = $message. "</tr>";
}

$message = $message. "</table>";
$message = $message. "<br>Total for this order: $ ".$sum."<br><br>";

$message = $message. "<input type='button' value='Print Receipt' onclick='print()' />";

echo "<script>
	var myWindow;
	function openWin()
	{
  		myWindow=window.open('','','width=600,height=500');
  		myWindow.document.write(\"" .$message . "\");
  		//myWindow.document.close();
		myWindow.focus();
		//myWindow.print();
		//myWindow.close();
	}
	function print(){
		myWindow.print();
		myWindow.close();
	}
	</script>";

?>


</body>

</html>
