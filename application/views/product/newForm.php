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
	echo "<div id='nav'>";
	echo "<p class='link'>" . anchor('store/index','Back to the store') . "</p>";
	echo "<p class='link'>" . anchor('store/loadProductAdmin','Back') . "</p>";
	echo "</div>";
	
	echo "<div id='main'>";
	echo "<h1 class='words'>New Product</h1>";
	echo form_open_multipart('store/create');
		
	echo form_label('<p class="words">Name</p>'); 
	echo form_error('name');
	echo form_input('name',set_value('name'),"required");

	echo form_label('<p class="words">Description</p>');
	echo form_error('description');
	echo form_input('description',set_value('description'),"required");
	
	echo form_label('<p class="words">Price</p>');
	echo form_error('price');
	echo form_input('price',set_value('price'),"required");
	
	echo form_label('<p class="words">Photo</p>');
	
	if(isset($fileerror))
		echo $fileerror;	
?>	
	<input type="file" name="userfile" size="20" />
	
<?php 	
	
	echo form_submit('submit', 'Create');
	echo form_close();
	echo "</div>";
?>	
</body>
</html>

