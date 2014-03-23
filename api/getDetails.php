<?php
require "../inc/connect.php";
$pid = $_GET["ProductID"];
$sql = mysql_query("SELECT id, name, price, colour, description FROM products WHERE id=$pid");
$rows = array();
while($r = mysql_fetch_assoc($sql)) {
	$rows[] = $r;
}
$data = array('Product' => $rows);
$json = json_encode($data);
echo $json;
?>