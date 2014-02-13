<?php
// Parsing the form data from HTML to PHP variables
if (isset($_POST['product_name'])){
	$product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$colour = mysql_real_escape_string($_POST['colour']);
	$description = mysql_real_escape_string($_POST['description']);
	$category = mysql_real_escape_string($_POST['category']);
	$sub_category = mysql_real_escape_string($_POST['sub_category']);
// PHP variable taking the mysql_query that selects all products that match the new one.
	$sql = mysql_query("SELECT id FROM products WHERE name='$product_name' AND subcategory='$sub_category' LIMIT 1");
	$productClash = mysql_num_rows($sql);
// Check if the product already exists in database already and echos error.
	if ($productClash > 0) {
		echo "Sorry Duplicate Product";
		exit();
	}


// PHP variable containing the MySQL query for inserting the new product in database.
$sql = mysql_query("INSERT INTO products (name, price, colour, description, category, subcategory, stockNo) VALUES('$product_name','$price','$colour','$description','$category','$sub_category', 50)") or die (mysql_error());
// Renames the uploaded image file with the same name as the product id
$pid = mysql_insert_id();
$newname = "$pid.jpg";
// The images are then moved to a specific folder on the server
move_uploaded_file($_FILES['imagefile']['tmp_name'], "../assets/images/products/$newname");
// Redirects back to homepage adding the new product to the list and stopping it from inserting multiple times
header("Location: http://127.0.0.1/cms/admin/index.php");
exit();
}
?>