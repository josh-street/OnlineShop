<? ob_start(); ?>
<?php
require "../inc/connect.php";
?>
<?php
// Deletes item using the ?deleteid from the url of delete link
$info = '<div id="center"><div id="confirmdelete"><p>Are you sure you want to delete the  product with ID of '.$_GET['deleteid'].'? <a href="index.php?yesdelete='.$_GET['deleteid'].'"></p><p>Yes </a> | <a href="index.php"> No</a></p></div></div>';
if (isset($_GET['deleteid'])){
  echo $info;
}
if(isset($_GET['yesdelete'])){
  //remove item from database and remove image.
  $deleteid = $_GET['yesdelete'];
  $sql = mysql_query("DELETE FROM products WHERE id='$deleteid' LIMIT 1") or die (mysql_error());
  $imgdelete = ("../assets/images/products/$deleteid.jpg");
  if (file_exists($imgdelete)){
    unlink($imgdelete);
    header("location: http://127.0.0.1/OnlineStore/admin/index.php");
    exit();
  }
}

?>
<?php 
// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Manage - Online Store</title>
  <meta name="author" content="Josh Street" >
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link rel="shortcut icon" href="lib/style/images/favicon.ico" >
  <link href="../lib/style/style.css" rel="stylesheet" type="text/css" />
  <link href='http://fonts.googleapis.com/css?family=Ubuntu:500|Open+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
  <script src="../lib/misc.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src='lib/productdisplay.js' type='text/javascript'></script>
</head>
<body>
  <div id="header">
    <div id="logo">
      <h1><a href="index.php">Content Management System</a></h1>
    </div>
  </div>
  <div id="adminmenuContainer" class="adminmenuContainer">
    <h3 style='text-align: center; padding:0.1em; border-bottom:1px dotted #008080'>Quick Menu</h3>
    <?php 
    $index = '2';
    $result = mysql_query("SELECT label, link FROM `categories` WHERE relevent=1");
    while($row = mysql_fetch_assoc($result)) {
      $result1 = mysql_query("SELECT label, link FROM `categories` WHERE parent=".$index."");
      echo "<div class='adminmenuTitle' onclick='runadminmenu(". $index .")'>". $row['label'] ."</div>";
      echo "<div id='adminmenu".$index."Content' class='adminmenuContent'>";
      while($row1 = mysql_fetch_assoc($result1)){
        echo "<p>
        <a href='".$row1['link']."'>". $row1['label']."</a></p>";
      }
      echo "</div>";
      $index++;
    }
    echo "<div class='adminmenuTitle'><a href='/stockcheck.php'>Stock Check</a></div>";
    ?>
  </div>
  <div class="productlist">
    <h3 style='padding-left:50%; border-bottom:1px dotted;'>Product List</h3><br>
    <?php 
    if(isset($_GET['subcat'])){
      $product_list = "";
      $sub_category = $_GET["subcat"];
      $sql = mysql_query("SELECT id, name, price, colour FROM products WHERE subcategory='$sub_category' AND stockNo > 0");
      $productCount = mysql_num_rows($sql);
      if($productCount > 0) {
        while($row = mysql_fetch_array($sql)){
          $pid = $row['id'];
          $pname = $row['name'];
          echo "<div class='productname'>
          <p>$pname &nbsp;&nbsp;&nbsp;
          <a href='../inc/edit.php?pid=$pid'>Edit</a> 
          <a href='index.php?deleteid=$pid'>Delete</a>
          </p>
          <div class='productimage'>
          <img src=../assets/images/products/$pid.jpg alt='$product_list' width='128' height='110'>
          </div>
          </div>";
        }

      } else {
        $product_list = "You have no products listed yet";
      }
    }
    else {
      $sql1 = mysql_query("SELECT id, name, price, colour FROM products");
      while($row = mysql_fetch_array($sql1)){
        $pid = $row['id'];
        $pname = $row['name'];
        $product_list = "$pname";
        echo "<div class='productname'>
        <p>$product_list &nbsp;&nbsp;&nbsp;
        <a href='../inc/edit.php?pid=$pid'>Edit</a> 
        <a href='index.php?deleteid=$pid'>Delete</a>
        </p>
        <div class='productimage'>
        <img src=../assets/images/products/$pid.jpg alt='$product_list' width='128' height='110'>
        </div>
        </div>";
      }
    }
    ?>
  </div>
  <div id="newtoggles">
    <div id="newproduct"><a>+ Add New Product</a></div>
    <script type="text/javascript">
  $(document).ready(
    function(){
      $('#newproduct').click(function () {
        $('#addproducts').toggle()
      });
    });
  </script>
  <div id="newcategory"><a>+ Add New Category</a></div>
  <script type="text/javascript">
  $(document).ready(
    function(){
      $('#newcategory').click(function () {
        $('#addcategories').toggle()
      });
    });
  </script>
</div>
<div id="addproducts" class="hidden">
 <h2 style='text-align: center; padding:0.2em; border-bottom:1px dotted #008080'>Add New Products</h2>
 <?php
 include '../inc/addproducts.php';
 ?>
 <form action="index.php" enctype="multipart/form-data" name="addproductform" id="addproductform" method="post">
  <h4><label for="product_name">Name:</label>
    <input type="text" id="product_name" name="product_name" placeholder="Product Name"/></h4>
    <h4><label for="price">Price (&#163;):</label>
      <input type="text" id="price" name="price" placeholder="Price (&#163;)"/></h4>
      <h4><label for="colour">Colour:</label>
        <input type="text" id="colour" name="colour" placeholder="Colour"/></h4>
        <h4><label for="description">Description:</label></h4>
        <textarea id="description" name="description"></textarea>
        <h4><label for="category">Category:</label>
          <input type="text" id="category" name="category" placeholder="Category"/></h4>
          <h4><label for="sub_category">Sub Category:</label>
            <input type="text" id="sub_category" name="sub_category" placeholder="Sub Category"/></h4>
            <h4><label for="imagefile">Product Image:</label>
              <input type="file" name="imagefile" id="imagefile"/></h4>
              <p class="submit"><input type="submit" name="submit" value="Submit"></p>
            </form>
          </div>

          <div id="addcategories" class="hidden">
           <h2 style='text-align: center; padding:0.2em; border-bottom:1px dotted #008080'>Add New Categories</h2>
           <form action="index.php" enctype="multipart/form-data" name="addcategoryform" id="addcategoryform" method="post">
            <h4><label for="catname">Category:</label>
              <input type="text" id="catname" name="catname" placeholder="Category Name"/></h4>
              <h4><label for="sub_catname">Sub-Category:</label>
                <input type="text" id="sub_catname" name="sub_catname" placeholder="Sub-Category"/></h4>
                <p class="submit"><input type="submit" onclick='ajaxSend()' value='Submit'></p>


              </form>
            </div>
            <div class="footer">
             Josh Street UP661688<a href="../" class="right">Back to Store</a>
           </div>
         </body>
         </html>
         <? ob_flush(); ?>