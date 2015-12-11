<?php 
// Includes the php file to connect to the database
require "api/connect.php";
include_once "api/popMenus.php";
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<title>Online Store</title>
	<meta name="author" content="Josh Street" >
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<link rel="shortcut icon" href="lib/style/images/favicon.ico" >
	<link href="lib/style/style.css" rel="stylesheet" type="text/css" />	
	<link href="http://fonts.googleapis.com/css?family=Ubuntu:500|Open+Sans|Open+Sans+Condensed:300" rel="stylesheet" type="text/css">
	<script src='lib/productdisplay.js' type='text/javascript'></script>
</head>
<body>
	<div id="header">
		<div id="logo">
			<h1><a href="#"> Content Management System </a></h1>
		</div>
		<div id="menu">	
			<ul><li><a href='index.php'>Home</a></li>
			<!-- PHP function called within this page -->
				<?php
				mainmenu(0, 1);
				?>
				<div id="searchbar"><input type="text" name="searchvalue" placeholder="Search">
				</div>
				<!-- Special div used to display products within the users basket -->
				<li id="basketlink"><div id="basket">Current Items <br><br>
				</div><a href='#'>Your Basket</a></li></ul>
			</div>
		</div>
		<div id="content" class="visible">
			<!-- Div to be populated later by Javascript functions -->
			<div id="products"></div>
			<!-- NOT WORKING --> 
			<!-- <div id="checkout">
				<div id="userForm">
					<h3>Basket Checkout</h3>
					<form id="addproductform">
						<p><label for="title">Title:</label><select id="title">
							<option value="mr">Mr.</option>
							<option value="mrs">Mrs.</option>
							<option value="ms">Ms.</option>
							<option value="miss">Miss.</option>
							<option value="dr">Dr.</option>
						</select></p>
						<p><label for="user_name">Full Name:</label><input type="text" id="user_name" name="user_name"/></p>
						<p><label for="address1">Address Line 1:</label><input type="text" id="address1" name="address1"/></p>
						<p><label for="address2">Address Line 2:</label><input type="text" id="address2" name="address2"/></p>
						<p><label for="address3">Address Line 3:</label><input type="text" id="address3" name="address3"/></p>
						<p><label for="town">Town/ City:</label><input type="text" id="town" name="town"/></p>
						<p><label for="region">Region:</label><input type="text" id="region" name="region"/></p>
						<p><label for="country">Country:</label><input type="text" id="country" name="country"/></p>
						<p class="checkoutsubmit"><input type="button" id="checkoutsubmit" value="Submit"></p>
					</form>
				</div>
			</div> -->
			<!-- Div gets populated when individual products are clicked -->
			<div id="details"><div id="detailImg"></div></div>
			<!-- beginning of footer -->
			<div class="footer">
				<p class='center'>Josh Street<a class="right" href="cms">Content Management System</a></p>
			</div>	
		</body>
		</html>
