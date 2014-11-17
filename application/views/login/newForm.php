<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login/New User</title>
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
echo validation_errors();
	echo "<div id='nav'>";
	echo "<p class='link'>" . anchor('store/index','Back to the store') . "</p>";
	echo "</div>";
	echo form_open_multipart('store/logIn');
	echo "<div id='main'>";
	echo form_label('<p class="words">Login</p>'); 
	echo form_error('login');
	echo form_input('login',set_value('login'),"required");

	echo form_label('<p class="words">Password</p>');
	echo form_error('password');
	echo form_password('password',set_value('password'),"required");
	echo form_hidden('backToTheCart', $back2cart);
	
	echo form_submit('submit', 'Login');
	echo form_close();
	echo "</div>";
?>	

<h1 id="newacount">Create a new account</h1>

<?php 

	
	echo "<div id='main'>";
	
	echo form_open_multipart('store/sigIn');

	echo form_label('<p class="words">First Name</p>');
	echo form_error('first');
	echo form_input('first',set_value('first'),"required");		
	
	echo form_label('<p class="words">Last Name</p>');
	echo form_error('last');
	echo form_input('last', set_value('last'),"required");
	
	echo form_label('<p class="words">Login</p>');
	echo form_error('login');
	echo form_input('login',set_value('login'),"required");
	////echo form_password('password',set_value('login'),"required pattern='.{6,}' required title='6 characters minimum'");

	echo form_label('<p class="words">Password</p>');
	echo form_error('password');
	echo form_password('password',set_value('password'),"required");
	
	echo form_label('<p class="words">Repeat Password</p>');
	echo form_error('repeat_password');
	echo form_password('repeat_password',set_value('repeat_password'),"required");
	
	echo form_label('<p class="words">Email</p>');
	echo form_error('email');
	echo form_input('email',set_value('email'),"required");
	
	echo form_submit('submit', 'Sigin');
	echo form_close();
	echo "</div>";
?>
</body>
</html>
