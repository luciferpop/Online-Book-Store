<?php
if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Store | Order Success</title>
    <meta charset="utf-8">
    <style>
    .container{width: 100%;padding: 10px;height: 550px;}
    p{color: #34a853;font-size: 18px;}
    </style>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div id="main_container">
<?php 
require('helper/header.php');
?>
<div class="container">
    <h1>Order Status</h1>
    <li><h3>Your order has been placed. Order ID is #<?php echo $_GET['id']; ?></h3></li>
    <li>
    <div class="footBtn">
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Continue Shopping</a>
        <a href="myacc_user.php" class="btn btn-success orderBtn">View My Orders<i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
    </li>
</div>
<div class="footer">
<div class="left_footer"> <img src="../images/footer_logo.png" alt="" width="89" height="42"/> </div>
<div class="center_footer">Copyright © 2016 Book Store </br> 
  <a href="http://www.mytemplatez.com/products/index/Designed-By/csscreme"><img src="../images/csscreme.jpg" alt="csscreme" title="csscreme" border="0" /></a><br/>
  </div>
<div class="right_footer"> <a href="#">home</a> <a href="#">about</a> <a href="#">sitemap</a> <a href="#">rss</a> <a href="#">contact us</a> </div>
</div>
</div>
</body>
</html>