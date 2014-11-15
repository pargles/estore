<h2>Login</h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('store/index','Back to the main page') . "</p>";
	
	echo form_open_multipart('store/logIn');
		
	echo form_label('Login'); 
	echo form_error('login');
	echo form_input('login',set_value('login'),"required");

	echo form_label('Password');
	echo form_error('password');
	echo form_password('password',set_value('password'),"required");
	echo form_hidden('backToTheCart', $back2cart);
	echo form_submit('submit', 'Login');
	echo form_close();
?>	

<h2>Create a new account</h2>

<?php 
	echo form_open_multipart('store/sigIn');

	echo form_label('First Name');
	echo form_error('first');
	echo form_input('first',set_value('first'),"required");		
	
	echo form_label('Last Name');
	echo form_error('last');
	echo form_input('last', set_value('last'),"required");
	
	echo form_label('Login');
	echo form_error('login');
	echo form_input('login',set_value('login'),"required");

	echo form_label('Password');
	echo form_error('password');
	echo form_password('password',set_value('password'),"required");
	
	echo form_label('Repeat Password');
	echo form_error('password');
	echo form_input('password',set_value('password'),"required");
	
	echo form_label('Email');
	echo form_error('email');
	echo form_input('email',set_value('email'),"required");
	
	echo form_submit('submit', 'Sigin');
	echo form_close();
?>