<?php
  session_start();
  //$_SESSION["login_name"] = null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Books Shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
  <div id="header">
    <div class="top_right">
      
    </div>
    <div id="logo"> <a href="#"><img src="images/logo.png" alt="" border="0" width="182" height="85" /></a> </div>
  </div>
  <div id="main_content">
    <div id="menu_tab">
      <ul class="menu">
        <li><a href="index.php" class="nav"> Home </a></li>
        <li class="divider"></li>
        <li><a href="display_books.php" class="nav">Books</a></li>
        <li class="divider"></li>
        <li><a href="#" class="nav">Specials</a></li>
        <li class="divider"></li>
        <li><a href="myaccount.php" class="nav">My account</a></li>
        <li class="divider"></li>
        <li><a href="signup/signup.php" class="nav">Sign up</a></li>
        <li class="divider"></li>
        <li><a href="login/login.php" class="nav">Sign in</a></li>
        <li class="divider"></li>
        <li><a href="contact.php" class="nav">Contact us</a></li>
        <li class="divider"></li>
        <li><a href="details.php" class="nav">Details</a></li>
        <li class="divider"></li>
        <li>
        <?php 
          if (isset($_SESSION["login_name"])) {
            echo "<font color='white'>&nbsp&nbsp&nbsp&nbspHello
              <a href='logout.php'>
             <font color='orange' size='2'>"
             . $_SESSION["login_name"] . 
             "</font></a>
             !&nbsp&nbsp&nbsp&nbspWelcome!</font>";
          } else {
            echo "&nbsp&nbsp&nbsp<font color='white'>Hi, please <a href='login/login.php'><font color='orange'>Sign in</font></a>
                   or <a href='signup/signup.php'><font color='orange'>Sign up</font></a> !</font>";
          }
         ?>
         </li>
      </ul>
    </div>
    <!-- end of menu tab -->
    <div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
    <div class="left_content">
      <div class="title_box">Categories</div>
      <ul class="left_menu">
        <li class="odd"><a href="#">Power Tools</a></li>
        <li class="even"><a href="#">Air Tools</a></li>
        <li class="odd"><a href="#">Hand Tools</a></li>
        <li class="even"><a href="#">Accessories</a></li>
        <li class="odd"><a href="#">Workwear</a></li>
        <li class="even"><a href="#">Spare Parts</a></li>
        <li class="odd"><a href="#">Power Tools</a></li>
        <li class="even"><a href="#">Air Tools</a></li>
        <li class="odd"><a href="#">Hand Tools</a></li>
        <li class="even"><a href="#">Accessories</a></li>
        <li class="odd"><a href="#">Workwear</a></li>
        <li class="even"><a href="#">Spare Parts</a></li>
      </ul>
      <div class="title_box">Special Products</div>
      <div class="border_box">
        <div class="product_title"><a href="#">Makita 156 MX-VL</a></div>
        <div class="product_img"><a href="#"><img src="images/p1.jpg" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
      </div>
      <div class="title_box">Newsletter</div>
      <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="your email"/>
        <a href="#" class="join">subscribe</a> </div>
      <div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>
    </div>
    <!-- end of left content -->
    <div class="center_content">
      <div class="oferta"> <img src="images/p1.png" width="165" height="113" border="0" class="oferta_img" alt="" />
        <div class="oferta_details">
          <div class="oferta_title">Power Tools BST18XN Cordless</div>
          <div class="oferta_text"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </div>
          <a href="#" class="prod_buy">details</a> </div>
      </div>
      <div class="center_title_bar">Latest Products</div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Makita 156 MX-VL</a></div>
          <div class="product_img"><a href="#"><img src="images/p1.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Bosch XC</a></div>
          <div class="product_img"><a href="#"><img src="images/p2.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Lotus PP4</a></div>
          <div class="product_img"><a href="#"><img src="images/p4.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Makita 156 MX-VL</a></div>
          <div class="product_img"><a href="#"><img src="images/p3.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Bosch XC</a></div>
          <div class="product_img"><a href="#"><img src="images/p5.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Lotus PP4</a></div>
          <div class="product_img"><a href="#"><img src="images/p6.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
      <div class="center_title_bar">Recomended Products</div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Makita 156 MX-VL</a></div>
          <div class="product_img"><a href="#"><img src="images/p7.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Bosch XC</a></div>
          <div class="product_img"><a href="#"><img src="images/p1.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Lotus PP4</a></div>
          <div class="product_img"><a href="#"><img src="images/p3.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> <a href="#" class="prod_details">Details</a> </div>
      </div>
    </div>
    <!-- end of center content -->
    <div class="right_content">
      <div class="title_box">Search</div>
      <div>
        <form action="search_result.php" method="post">
          <div>
            <input type="text" name="title" class="search_input" placeholder="enter the title">
          </div>
          <input class="search_submit" type='submit' name="submit" value='Search'>
          <a target="_blank" href="advanced_search.php" class="join">Advanced</a>
        </form>
      </div>
      <div class="shopping_cart">
        <div class="title_box">Shopping cart</div>
        <div class="cart_details"> 3 items <br/>
          <span class="border_cart"></span> Total: <span class="price">350$</span> </div>
        <div class="cart_icon"><a href="#"><img src="images/shoppingcart.png" alt="" width="35" height="35" border="0" /></a></div>
      </div>
      <div class="title_box">What is new</div>
      <div class="border_box">
        <div class="product_title"><a href="#">Motorola 156 MX-VL</a></div>
        <div class="product_img"><a href="#"><img src="images/p2.jpg" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
      </div>
      <div class="title_box">Manufacturers</div>
      <ul class="left_menu">
        <li class="odd"><a href="#">Bosch</a></li>
        <li class="even"><a href="#">Samsung</a></li>
        <li class="odd"><a href="#">Makita</a></li>
        <li class="even"><a href="#">LG</a></li>
        <li class="odd"><a href="#">Fujitsu Siemens</a></li>
        <li class="even"><a href="#">Motorola</a></li>
        <li class="odd"><a href="#">Phillips</a></li>
        <li class="even"><a href="#">Beko</a></li>
      </ul>
      <div class="banner_adds"> <a href="#"><img src="images/bann1.jpg" alt="" border="0" /></a> </div>
    </div>
    <!-- end of right content -->
  </div>
  <!-- end of main content -->
  <div class="footer">
    <div class="left_footer"> <img src="images/footer_logo.png" alt="" width="89" height="42"/> </div>
    <div class="center_footer"> Template name. All Rights Reserved 2008<br />
      <a href="http://csscreme.com"><img src="images/csscreme.jpg" alt="csscreme" title="csscreme" border="0" /></a><br />
      <img src="images/payment.gif" alt="" /> </div>
    <div class="right_footer"> <a href="#">home</a> <a href="#">about</a> <a href="#">sitemap</a> <a href="#">rss</a> <a href="#">contact us</a> </div>
  </div>
</div>
<!-- end of main_container -->
</body>
</html>
