<?php
require_once "connect.php";
$id = $_POST["id"];
$sql = 'DELETE FROM categories WHERE id=' . $id;
mysql_query($sql) or mysql_error();
echo "Category successfully deleted";
?>