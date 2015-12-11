<?php 
require "../api/connect.php";
include_once "../inc/functions.php";
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
  <title>Online Store</title>
  <meta name="author" content="Josh Street" >
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link rel="shortcut icon" href="lib/style/images/favicon.ico" >
  <link href="../lib/style/style.css" rel="stylesheet" type="text/css" />  
  <link href="http://fonts.googleapis.com/css?family=Ubuntu:500|Open+Sans|Open+Sans+Condensed:300" rel="stylesheet" type="text/css">
  <script src='../lib/cms.js' type='text/javascript'></script>
</head>
<body>
  <div id="header">
    <div id="logo">
      <h1><a href="./"> Content Management System </a></h1>
    </div>
  </div>
    <div id="cmsmenu">
    <h4>Select / Delete a Category</h4>
      <?php
      cmsmenu(0, 1);
      ?>
    </div>
  <div id="productlist">
  </div>
  <div id="newtoggles">
    <div id="newproduct"><a>+ Add New Product</a></div>
    <div id="newcategory"><a>+ Add Categories</a></div>
  </div>
  <div id="addproducts">
   <h2>Add New Products</h2>
   <form id="addproductform">
     <p><label for="product_name">Name:</label><input type="text" id="product_name" name="product_name" placeholder="Product Name"/></p>
     <p><label for="price">Price (&#163;):</label><input type="text" id="price" name="price" placeholder="Price (&#163;)"/></p>
     <p><label for="description">Description:</label><textarea id="description" name="description"></textarea></p>
     <p><label for="category">Category:</label><input type="text" id="category" name="category" placeholder="Category"/></p>
     <p><label for="sub_category">Sub Category:</label><input type="text" id="sub_category" name="sub_category" placeholder="Sub Category"/></p>
     <p><label for="imagefile">Product Image (JPEG):</label><input type="file" name="imagefile" id="imagefile"/></p>
     <p><label for="product_id"></label><input type="text" id="product_id" name="product_id"/></p>
     <progress id="fileprogress" max="100"></progress>
     <p class="submit"><input type="button" id="psubmit" value="Add"></p>
     <p class="update"><input type="button" id="pupdate" value="Update"></p>
   </form>
 </div>

 <div id="addcategory">
   <h2>Add New Categories</h2>
   <form id="addcategoryform">
     <p><label for="catname">Category:</label><input type="text" id="catname" name="catname" placeholder="Category Name"/></p>
     <p><label for="sub_catname">Sub-Category:</label><input type="text" id="sub_catname" name="sub_catname" placeholder="Sub-Category"/></p>
     <p class="submit"><input type="button" id="csubmit" value='Add'></p>
   </form>
 </div>
 <div class="footer">
  <p class="center">Josh Street <a class="right" href="../">Back to Store</a></p>
</div>  
</body>
</html>
