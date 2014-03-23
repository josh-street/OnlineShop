<?php
require "../inc/connect.php";
if(isset($_GET['filter'])){
	$filter = $_GET["filter"];
	$sql = mysql_query("SELECT id, name, price, colour FROM products WHERE category='$filter' OR subcategory='$filter'");
	$rows = array();
	while($r = mysql_fetch_assoc($sql)) {
		$rows[] = $r;
	}
	$data = array('Products' => $rows);
	$json = json_encode($data);
	echo $json;
}
else {
	echo "No Products";
}
?>
