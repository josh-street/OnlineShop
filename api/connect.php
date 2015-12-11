<?php
//Try to connect to MySQL
$connect = mysql_connect("localhost","root","root") or die('Could not connect to MySQL server: '. mysql_error()); // To change the MySQL connection password edit the "" after "root".

//Check connect and return error if failed
$usedb = mysql_select_db('cms');
if(!$usedb){
	echo 'Database created refresh page';
	$create_db = "CREATE DATABASE cms";
	mysql_query($create_db);
	mysql_select_db('cms');
	$createcattable = "CREATE TABLE `categories` (
		`id` int(5) NOT NULL AUTO_INCREMENT,
		`label` varchar(50) NOT NULL DEFAULT '',
		`link` varchar(40) NOT NULL,
		`parent` int(11) DEFAULT NULL,
		`relevent` int(1) NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43";
mysql_query($createcattable)or die(mysql_error());
$createprodtable = "CREATE TABLE `products` (
	`id` int(5) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(50) DEFAULT NULL,
	`price` decimal(11,2) DEFAULT NULL,
	`colour` varchar(30) DEFAULT NULL,
	`description` text,
	`category` varchar(45) NOT NULL,
	`subcategory` varchar(45) NOT NULL,
	`stockNo` int(11) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88";
mysql_query($createprodtable) or die(mysql_error());

}
?>