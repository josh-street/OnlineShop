<?php
// Try to connect to MySQL
$connect = mysql_connect('localhost','root', 'root');
// Check connect and return error if failed
$use_db = mysql_select_db('cms');

$create_db = "CREATE DATABASE cms";
if(!$use_db) {
	echo mysql_error();
	mysql_query($create_db);
	mysql_select_db('cms');
}


?>