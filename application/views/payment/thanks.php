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
echo "</div>";

echo "<div id='nav_thanks'>";
echo "<p class='link'>" . anchor ( 'store/index', 'Back to the store' ) . "</p>";
echo "<p class='link'>" . anchor ( 'store/printReceipt', 'print my receipt' ) . "</p>";
echo "</div>";
?>
</body>
</html>
