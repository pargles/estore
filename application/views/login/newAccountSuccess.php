<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Success</title>
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
echo "<div id='main_success'>";
echo "<img id='successimg' src='../../images/style/success.png'>";
echo "<p id='acount_created'> New Account Created with success !!! </p>";
echo "<img id='success_babyimg' src='../../images/style/success_baby.png'>";
echo "</div>";

echo "<div id='back_main_page'>";
echo "<p class='link'>" . anchor ( 'store/index', 'Back to the store' ) . "</p>";
echo "<p class='link'>" . anchor ( 'store/createLoginForm', 'Back to the login page' ) . "</p>";
echo "</div>";
?>

</body>
</html>

