<?php
include "../api/connect.php";
// Retrieve data from Ajax request query string and help prevent SQL Injection
if (isset($_REQUEST)){
	$catname = mysql_real_escape_string($_REQUEST['catname']);
	$subcatname = mysql_real_escape_string($_REQUEST['sub_catname']);
	$catlink = "?filter=" . $catname;
	$subcatlink = "?filter=" . $subcatname;



// Create the query
	$query = "INSERT INTO categories (label, link, parent, relevent) ";
	if(!$subcatname){
		$query .= "VALUES ('$catname', '$catlink', '0', '1')";
		$qry_result = mysql_query($query) or die(mysql_error());
		$response["success"] = TRUE;
		$response["details"] = "Category successfully inserted to database";
		echo json_encode($response);
	}
	else {
		$i = 0;
		$sql = mysql_query("SELECT id FROM categories WHERE label = '$catname'");
		$rows = mysql_num_rows($sql); 
		while ($i < $rows) {
			$id = mysql_result($sql, $i, "id");
			$i++;
		}
		//not working
		$query .= "VALUES ('$subcatname', '$subcatlink', '$id', '0')";
		$qry_result = mysql_query($query) or die(mysql_error());
		header('../admin/index.php');
		$response["success"] = TRUE;
		$response["details"] = "Sub-Category successfully inserted to database";
		echo json_encode($response);
	}
}
exit();
?>