<?php
// Parsing the form data from HTML to PHP variables
if (isset($_POST['catname'])){
	$catname = mysql_real_escape_string($_POST['catname']);
	$subcatname = mysql_real_escape_string($_POST['sub_catname']);
// PHP variable taking the mysql_query that selects all products that match the new one.
	$sql = mysql_query("INSERT INTO categories (label, link, parent, relevent) VALUES('$sub_category', '#', '4', '0')") or die (mysql_error());
	$productClash = mysql_num_rows($sql);
// Check if the product already exists in database already and echos error.
	if ($productClash > 0) {
		echo "Sorry Duplicate Product";
		exit();
	}


// PHP variable containing the MySQL query for inserting the new product in database.
header("Location: http://127.0.0.1/cms/admin/index.php");
exit();
}
?>
