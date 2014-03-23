<?php
include "connect.php";
// Retrieve data from Ajax request query string and help prevent SQL Injection
$cat = mysql_real_escape_string($_GET['cat']);
$subcat = mysql_real_escape_string($_GET['subcat']);
$catlink = "?cat=" . $cat;
$subcatlink = "?subcat=" . $subcat;



// Create the query
$query = "INSERT INTO categories (label, link, parent, relevent) ";
if(!$subcat)
	$query .= "VALUES ('$cat', '$catlink', '0', '1')";
	$qry_result = mysql_query($query) or die(mysql_error());
else 
	echo "null";


//Execute query




/*// Insert a new row in the table for each person returned
while($row = mysql_fetch_array($qry_result)){
	$display_string .= "<tr>";
	$display_string .= "<td>$row[name]</td>";
	$display_string .= "<td>$row[age]</td>";
	$display_string .= "<td>$row[sex]</td>";
	$display_string .= "<td>$row[wpm]</td>";
	$display_string .= "</tr>";
	
}
echo "Query: " . $query . "<br />";
$display_string .= "</table>";
echo $display_string;*/
?>

	
