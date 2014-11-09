<!DOCTYPE html>

<html>
	<head>
		<style>
			input {
				display: block;
			}
		</style>
		<script src="js/jquery.js"></script>
	</head> 
<body>  
	<h2>Payment</h2>

<?php 
	echo validation_errors();
	echo "<p>" . anchor ( 'store/loadCart', 'Back to my cart' ) . "</p>";
	echo form_open_multipart('store/checkCreditCard');
		
	echo form_label('Credit Card Number'); 
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
	echo form_error('creditcard_month');
	echo form_dropdown('creditcard_month', $months, set_value('creditcard_month'));
	echo form_label("  Credit Card Month <p>");
	//echo form_error('creditcard_month');
	//echo form_input('creditcard_month',set_value('creditcard_month'),"required");
	
	echo form_label('Credit Card Year');
	echo form_error('creditcard_year');
	echo form_input('creditcard_year',set_value('creditcard_year'),"required pattern='.{4}' title='4 characters'");
	echo '<p>';
	echo form_submit('submit', 'Pay');
	echo form_close();
?>	
</body>

</html>
