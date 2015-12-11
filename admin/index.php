<!-- Page hidden as it is not complete. -->
<?php 
// Including the MySQL connection php file and the php file containing the menu function
require "../api/connect.php";
include_once "../api/popMenus.php";
?>
<!-- Set HTML 5 standard -->
<!DOCTYPE html>
<html lang="en-GB">
<head>
  <title>Online Store</title>
  <meta name="author" content="Josh Street" >
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link rel="shortcut icon" href="lib/style/images/favicon.ico" >
  <link href="../lib/style/style.css" rel="stylesheet" type="text/css" />  
  <!-- Google font stylesheet -->
  <link href="http://fonts.googleapis.com/css?family=Ubuntu:500|Open+Sans|Open+Sans+Condensed:300" rel="stylesheet" type="text/css">
  <script src='../lib/productdisplayadmin.js' type='text/javascript'></script>
  <script src='../lib/misc.js' type='text/javascript'></script>
</head>
<body>
<!-- beginning of header -->
  <div id="header">
    <div id="logo">
      <h1><a href="./"> Administration Area </a></h1>
    </div>
  </div>
  <!-- end of header -->
  <div id="productlist">
  </div>
 <div class="footer">
  <p class='center'><a class="left" href="../">Back to Store</a>Josh Street<a class="right" href="../cms">Content Management System</a></p>
</div>  
</body>
</html>
