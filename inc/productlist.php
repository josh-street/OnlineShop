<?php 
$product_list = "";
$sql = mysql_query("SELECT * FROM products");
$productcount = mysql_num_row($sql);
if($productcount > 0) {
	while($row = mysql_fetch_array($sql)){
		$id = $row['id'];
		$product_list = "$id<br>";
	}

} else {
	$product_list = "You have no products listed yet";
}


?>