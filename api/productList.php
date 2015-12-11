<?php
require "../api/connect.php";

if($_GET['filter'] == "undefined") {
	$sql1 = mysql_query("SELECT id, name, price, stockNo FROM products");
	$rows1 = array();
	while($r1 = mysql_fetch_assoc($sql1)) {
		$rows1[] = $r1;
	}
	$data1 = array('Products' => $rows1);
	$json1 = json_encode($data1);
	echo $json1;
}

else{
	$filter = $_GET["filter"];
	$sql = mysql_query("SELECT id, name, price, stockNo FROM products WHERE category='$filter' OR subcategory='$filter'");
	$rows = array();
	while($r = mysql_fetch_assoc($sql)) {
		$rows[] = $r;
	}
	$data = array('Products' => $rows);
	$json = json_encode($data);
	echo $json;
}
?>
