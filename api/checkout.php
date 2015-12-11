<?php
require_once '../api/connect.php';
//Get form data from JSON request
$title = mysql_real_escape_string($_REQUEST['title']);
$name = mysql_real_escape_string($_REQUEST['user_name']);
$address1 = mysql_real_escape_string($_REQUEST['address1']);
$address2 = mysql_real_escape_string($_REQUEST['address2']);
$address3 = mysql_real_escape_string($_REQUEST['address3']);
$town = mysql_real_escape_string($_REQUEST['town']);
$region = mysql_real_escape_string($_REQUEST['region']);
$country = mysql_real_escape_string($_REQUEST['country']);

echo $title;
echo $name;
echo $address1;
echo $address2;
echo $address3;
echo $town;
echo $region;
echo $country;
?>
