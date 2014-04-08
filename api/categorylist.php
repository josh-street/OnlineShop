<?php
require "../inc/connect.php";
$query = "SELECT id, label FROM categories";
$sql = mysql_query($query);
$rows = array();
while($r = mysql_fetch_assoc($sql)) {
	$rows[] = $r;
}
$data = array( 'Categories' => $rows);
$json = json_encode($data);
echo $json;
?>