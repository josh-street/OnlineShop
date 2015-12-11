<?php
require_once '../api/connect.php';
//Get form data from JSON request
$id = mysql_real_escape_string($_REQUEST['product_id']);
$name = mysql_real_escape_string($_REQUEST['product_name']);
$price = mysql_real_escape_string($_REQUEST['price']);
$desc = mysql_real_escape_string($_REQUEST['description']);
$cat = mysql_real_escape_string($_REQUEST['category']);
$subcat = mysql_real_escape_string($_REQUEST['sub_category']);

if (!$id){
// PHP variable taking the mysql_query that selects all products that match the new one.
	$sql = mysql_query("SELECT id FROM products WHERE name='$name' AND subcategory='$subcat' LIMIT 1");
	$productClash = mysql_num_rows($sql);
// Check if the product already exists in database and sets a JSON response error.
	if ($productClash > 0) {
		$response["success"] = FALSE;
		$response["details"] = "Sorry Duplicate Product";
		echo json_encode($response);
	}
	else {
		// PHP variable containing the MySQL query for inserting the new product in database and send a response back to client with details.
		$sql = mysql_query("INSERT INTO products (name, price, colour, description, category, subcategory, stockNo) VALUES('$name','$price','$colour','$desc','$cat','$subcat', 50)") or die();
		$response["success"] = TRUE;
		$response["details"] = "Product successfully inserted to database";
		echo json_encode($response);
	}


// Only handles JPEG images for now
// Grabs image from JSON request and renames it with the same name as the product id
	$pid = mysql_insert_id();
	$newname = "$pid.jpg";
// The images are then moved to a specific folder on the server
	move_uploaded_file($_FILES['imagefile']['tmp_name'], "../assets/images/products/$newname");
// Executes the function make_thumb that creates a thumbnail for use on product lists, keeping the higher resolution for a specific request for a better quality, e.g. product view
	make_thumb("../assets/images/products/$newname", "../assets/images/products/thumbs/$newname");

	exit();
}
else {
	$sql = mysql_query("UPDATE products SET name='$name', price='$price', description='$desc', category='$cat', subcategory='$subcat', stockNo=50 WHERE id='$id'");
	$response["success"] = TRUE;
	$response["details"] = "Product Updated";
	echo json_encode($response);

}
function make_thumb($src, $dest) {

	// read the source image 
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	// finds the desired height relative to the desired width  
	$desired_width = 128;
	$desired_height = floor($height * ($desired_width / $width));
	
	// create a new "virtual" image 
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	// copy source image at a resized size 
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	// create the physical thumbnail image to its destination 
	imagejpeg($virtual_image, $dest);
}

?>
