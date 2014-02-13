<?php 
require "inc/connect.php";
include_once "inc/functions.php";
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<link href="lib/style/style.css" rel="stylesheet" type="text/css" />	
	<title>Content Management System</title>

</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="logo">
				<p>Link to <a href="http://localhost/MAMP/?language=English">phpMyAdmin</a></p>
				<h1><a href="#"> Content Management System </a></h1>
			</div>

			<div id="menu">				
				<?php 
				mainmenudropdown(0, 1);
				?>
			</div>
		</div>
		<!-- end of header -->
	</div>
	<div id="content">
		<?php 
		$product_list = "";
		$sub_category = $_GET["subcat"];
		$category = $_GET["cat"];
		$sql = mysql_query("SELECT id, name, price, colour FROM products WHERE category='$category' OR subcategory='$sub_category' AND stockNo > 0");
		$productCount = mysql_num_rows($sql);
		$lnk = $_GET['subcat'] || $_GET['cat'];
		if(isset($lnk)){
			if($productCount > 0) {
				while($row = mysql_fetch_array($sql)){
					$pid = $row['id'];
					$pname = $row['name'];
					$product_list = "$pname";
					echo "<div class='productname'>
					<p>$product_list &nbsp;&nbsp;&nbsp;
					<a href='/inc/edit.php?pid=$pid'>Edit</a> 
					<a href='index.php?deleteid=$pid'>Delete</a>
					</p>
					<div class='productimage'>
					<img src='assets/images/products/$pid.jpg' alt='$product_list' width='128' height='110'>
					</div>
					</div>";
				}

			} else {
				$product_list = "You have no products listed yet";
			}
		}
		else 
			echo "No Products"
		?>
	</div>
	<div class="footer">
		<p class="center">&copy; Josh Street UP661688 <a class="right" href="admin">Admin Area</a></p>
	</div>	
</body>
</html>
