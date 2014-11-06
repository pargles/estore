<h2>Payment</h2>

<style>
	input { display: block;}
	
</style>

<?php 	
	echo "<p>" . anchor ( 'store/loadCart', 'Back to my cart' ) . "</p>";
	echo form_open_multipart('store/checkCreditCard');
		
	echo form_label('Credit Card Number'); 
	echo form_error('credit_number');
	echo form_input('credit_number',set_value('credit_number'),"required");

	echo form_label('Credit Card Month');
	echo form_error('credit_month');
	echo form_input('credit_month',set_value('credit_month'),"required");
	
	echo form_label('Credit Card Year');
	echo form_error('credit_year');
	echo form_input('credit_year',set_value('credit_year'),"required");
		
	echo form_submit('submit', 'Pay');
	echo form_close();
?>	

