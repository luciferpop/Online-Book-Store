<?php
// include database configuration file
include 'helper/dbconn.php';

// initializ shopping cart class
include 'cart.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: index.php");
}
if (!$_SESSION['login_id'])
    echo '<script type="text/javascript">
            alert("You haven\'t login! Please login first!");
            window.location.href="login/login.php";
          </script>';
else {
    // find out user's address
    $sql = "SELECT Addr FROM USER WHERE ID = '".$_SESSION['login_id']."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Store | Checkout</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 10px; height: 550px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    </style>
</head>
<body>
<div id="main_container">
<?php 
require('helper/header.php');
?>
<div class="container">
    <h1>Order Preview</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo '$'.$item["price"].' USD'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No items in your cart......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.$cart->total().' USD'; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Shipping Details</h4>
        <p><?php echo $row['Addr']; ?></p>
    </div>
    <div class="footBtn">
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Continue Shopping</a>
        <a href="cart_action.php?action=placeOrder" class="btn btn-success orderBtn">Place Order<i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
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