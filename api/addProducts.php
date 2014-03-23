<?php
require_once ("../inc/connect.php");
$submit = intval($_GET['sub']);

$sql = "SELECT category FROM products";
$sql1 = "SELECT sub_category FROM products";

$cat = mysqli_query($sql);
$subcat = mysqli_query($sql1);

echo "<select name='category'>";
while($row = mysqli_fetch_array($sql))
  {
  echo "<option value=" . $row['category'] . ">" . $row['category'] . "</option>";
  }
?>
