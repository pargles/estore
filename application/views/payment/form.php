<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Main</title>
	<link rel="stylesheet" href="<?php echo base_url('css/template.css'); ?>" />
	<script src="js/jquery.js"></script>
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
	echo validation_errors();
	echo "<p class='link'>" . anchor ( 'store/index', 'Back to the store' ) . "</p>";
	echo "<p class='link'>" . anchor ( 'store/loadCart', 'Back to my cart' ) . "</p>";
	echo "</div>";
	
	echo "<div id='main'>";
	echo "<h1 id='payment'>Payment</h1>";
	echo form_open_multipart('store/checkCreditCard');
		
	echo form_label('<p class="words">Credit Card Number</p>'); 
	echo form_error('creditcard_number');
	echo form_input('creditcard_number',set_value('creditcard_number'),"required pattern='.{16}' title='16 characters'");
	echo '<p>';
	
	$months = array(
			'01'    => '01',
			'02'  => '02',
			'03'  => '03',
			'04' => '04',
			'05' => '05',
			'06' => '06',
			'07'    => '07',
			'08'  => '08',
			'09'  => '09',
			'10' => '10',
			'11' => '11',
			'12' => '12'
	);
	echo form_label(" <p class='words'> Credit Card Month </p>");
	echo form_error('creditcard_month');
	echo form_dropdown('creditcard_month', $months, set_value('creditcard_month'));
	
	//echo form_error('creditcard_month');
	//echo form_input('creditcard_month',set_value('creditcard_month'),"required");
	
	echo form_label('<p class="words">Credit Card Year</p>');
	echo form_error('creditcard_year');
	echo form_input('creditcard_year',set_value('creditcard_year'),"required pattern='.{4}' title='4 characters'");
	echo '<p>';
	echo form_submit('submit', 'Pay');
	echo form_close();
	echo "</div>";
?>	
</body>

</html>
