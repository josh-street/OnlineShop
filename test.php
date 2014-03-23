<?php 
require "inc/connect.php";
include_once "inc/functions.php";
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<title>Online Store</title>
	<meta name="author" content="Josh Street" >
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<link rel="shortcut icon" href="lib/style/images/favicon.ico" >
	<link href="lib/style/style.css" rel="stylesheet" type="text/css" />	
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:500|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<script src='lib/productdisplay.js' type='text/javascript'></script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="logo">
				<p>Link to <a href="http://localhost/MAMP/?language=English">phpMyAdmin</a></p>
				<h1><a href="#"> Content Management System </a></h1>
			</div>

			<div id="menu">				
				<?php
				mainmenudropdown(0, 1);
				?>
			</div>
		</div>
		<!-- end of header -->
	</div>
	<div id="content" class="visible">


	</div>
	<div class="footer">
		<p class="center">&copy; Josh Street UP661688 <a class="right" href="admin">Admin Area</a></p>
	</div>	
</body>
</html>
