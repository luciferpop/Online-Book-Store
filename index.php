<?php
  session_start();
  include "cart.php";
  $cart = new Cart;
  include_once "helper/dbconn.php";
  require_once('helper/pageclass.php');
  //$_SESSION["login_name"] = null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Home</title>
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
        <li><a href="specials.php" class="nav">Specials</a></li>
        <li class="divider"></li>
        <li><a href="myaccount.php" class="nav">My account</a></li>
        <li class="divider"></li>
        <li><a href="view_cart.php" class="nav">My Cart</a></li>
        <li class="divider"></li>
        <li><a href="signup/signup.php" class="nav">Sign up</a></li>
        <li class="divider"></li>
        <li><a href="login/login.php" class="nav">Sign in</a></li>
        <li class="divider"></li>
        <li><a href="#" class="nav">Contact us</a></li>
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
          <?php
              // select 10 categories with most books from table 'BOOK'
              $cate_sql = "SELECT Category, COUNT(ISBN) AS CNT FROM BOOK GROUP BY Category ORDER BY COUNT(ISBN) DESC LIMIT 10";
              $cate_result = mysqli_query($conn, $cate_sql);
              $index = 0;
              while ($row = $cate_result->fetch_assoc()) {
                  if ($index%2 == 0) 
                      echo '<li class="odd"><a href="display_books.php?&cate='.$row['Category'].'&pub='.$GLOBALS['pub'].'">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                  else
                      echo '<li class="even"><a href="display_books.php?&cate='.$row['Category'].'&pub='.$GLOBALS['pub'].'">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                  $index++;
              }
          ?>
      </ul>
      <div class="title_box">Special Books</div>
      <?php
        $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.ISBN = '006001315X'";
        $result = mysqli_query($conn, $sql);
        $hrefid = 0;
        while ($row = mysqli_fetch_array($result)) {
              echo '
              <div class="prod_box">
                  <div class="center_prod_box">
                    <div class="product_title"><a href="display_details.php?id='.$row['ISBN'].'">'. $row['Title'] .'</a></div>
                    <div class="product_img">
                      <a href="display_details.php?id='.$row['ISBN'].'" id="'.$hrefid.'">
                          <img id="'.$row['ISBN'].'" src="http://images.amazon.com/images/P/'.$row['ISBN'].'.01.MZZZZZZZ.jpg">
                      </a>
                      <script type="text/javascript">
                        var x = document.getElementById("'.$row['ISBN'].'");
                        //document.write(x.naturalWidth);
                        if (x.naturalWidth == 1)
                            document.getElementById("'.$hrefid.'").innerHTML = "<img src=\'images/default_cover_med.jpg\'>";
                      </script>
                    </div>
                    <div class="prod_price"><span class="reduce">'.ceil($row['Price']*1.3).'$</span> <span class="price">'.$row['Price'].'$</span></div>
                  </div>
                  <div class="prod_details_tab"> <a href="cart_action.php?action=addToCart&id='.$row['ISBN'].'" class="prod_buy">Add to Cart</a> 
                  <a target="_blank" href="display_details.php?id='.$row['ISBN'].'" class="prod_details">Details</a></div>
              </div>
              ';
              $hrefid++;
          }
      ?>
      <div class="banner_adds"> <a href="specials.php"><img src="images/special_offer.jpg" alt="" border="0" height="120" width="120"/></a> </div>
    </div>
    <!-- end of left content -->
    <div class="center_content">
      <div class="oferta"> <img src="http://images.amazon.com/images/P/000171421X.01.LZZZZZZZ.jpg" width="90" height="130" border="0" class="oferta_img" alt="" />
        <div class="oferta_details">
          <div class="oferta_title">It's Not Easy Being a Bunny (A Beginner Book)</div>
          <div class="oferta_text"> Meet P. J. Funnybunny in this humorous and touching Beginner Book by Marilyn Sadler and Roger Bollen. It’s Not Easy Being a Bunny tells the “tail” of P.J. and his quest to become something other than what he is. 
         </div>
          <a href="display_details.php?id=000171421X" class="prod_buy">details</a> </div>
      </div>
      <div class="center_title_bar">Latest Books</div>
      <!-- display six recently published books -->
      <?php
        $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND Year >= '2004' AND Year<='2016' LIMIT 6";
        $result = mysqli_query($conn, $sql);
        $hrefid = 0;
        while ($row = mysqli_fetch_array($result)) {
              echo '
              <div class="prod_box">
                  <div class="center_prod_box">
                    <div class="product_title"><a href="display_details.php?id='.$row['ISBN'].'">'. $row['Title'] .'</a></div>
                    <div class="product_img">
                      <a href="display_details.php?id='.$row['ISBN'].'" id="'.$hrefid.'">
                          <img id="'.$row['ISBN'].'" src="http://images.amazon.com/images/P/'.$row['ISBN'].'.01.MZZZZZZZ.jpg">
                      </a>
                      <script type="text/javascript">
                        var x = document.getElementById("'.$row['ISBN'].'");
                        //document.write(x.naturalWidth);
                        if (x.naturalWidth == 1)
                            document.getElementById("'.$hrefid.'").innerHTML = "<img src=\'images/default_cover_med.jpg\'>";
                      </script>
                    </div>
                    <div class="prod_price"><span class="reduce">'.ceil($row['Price']*1.3).'$</span> <span class="price">'.$row['Price'].'$</span></div>
                  </div>
                  <div class="prod_details_tab"> <a href="cart_action.php?action=addToCart&id='.$row['ISBN'].'" class="prod_buy">Add to Cart</a> 
                  <a target="_blank" href="display_details.php?id='.$row['ISBN'].'" class="prod_details">Details</a></div>
              </div>
              ';
              $hrefid++;
          }
      ?>
      <!-- three books -->
    </div>
    <!-- end of center content -->
    <div class="right_content">
      <div class="title_box">Search</div>
      <div>
        <form action="search_result.php" method="post">
          <div>
            <input type="text" name="title" class="search_input" placeholder="Search the title">
          </div>
          <input class="search_submit" type='submit' name="submit" value='Search'>
          <a target="_blank" href="advanced_search.php" class="join">Advanced</a>
        </form>
      </div>
      <div class="shopping_cart">
        <div class="title_box">Shopping cart</div>
        <div class="cart_details"> <?php echo $cart->total_items(); ?> items <br/>
          <span class="border_cart"></span> Total: <span class="price"><?php echo $cart->total(); ?>$</span> </div>
        <div class="cart_icon"><a href="view_cart.php"><img src="images/shoppingcart.png" alt="" width="35" height="35" border="0" /></a></div>
      </div>
      <div class="title_box">Publishers</div>
      <ul class="left_menu">
      <?php
          // select 8 most popular publisher from BOOK
          $sql = "SELECT PubName, COUNT(PubName) AS CNT FROM BOOK GROUP BY PubName ORDER BY CNT DESC LIMIT 8";
          $result = mysqli_query($conn, $sql);
          $index = 0;
          while ($row = $result->fetch_assoc()) {
              if ($index%2 == 0) 
                  echo '<li class="odd"><a href="display_books.php?&cate='.$GLOBALS['cate'].'&pub='.$row['PubName'].'">'.$row['PubName']. ' ('.$row['CNT'].')'.'</a></li>';
              else
                  echo '<li class="even"><a href="display_books.php?&cate='.$GLOBALS['cate'].'&pub='.$row['PubName'].'">'.$row['PubName']. ' ('.$row['CNT'].')'.'</a></li>';
              $index++;
          }
      ?>
      </ul>
      <div class="title_box">What is new</div>
      <?php 
      $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND Year >= '1990' LIMIT 1";
      $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo '
                <div class="prod_box">
                    <div class="center_prod_box">
                      <div class="product_title"><a href="display_details.php?id='.$row['ISBN'].'">'. $row['Title'] .'</a></div>
                      <div class="product_img">
                        <a href="display_details.php?id='.$row['ISBN'].'" id="'.$hrefid.'">
                            <img id="'.$row['ISBN'].'" src="http://images.amazon.com/images/P/'.$row['ISBN'].'.01.MZZZZZZZ.jpg">
                        </a>
                        <script type="text/javascript">
                          var x = document.getElementById("'.$row['ISBN'].'");
                          //document.write(x.naturalWidth);
                          if (x.naturalWidth == 1)
                              document.getElementById("'.$hrefid.'").innerHTML = "<img src=\'images/default_cover_med.jpg\'>";
                        </script>
                      </div>
                      <div class="prod_price"><span class="reduce">'.ceil($row['Price']*1.3).'$</span> <span class="price">'.$row['Price'].'$</span></div>
                    </div>
                    <div class="prod_details_tab"> <a href="cart_action.php?action=addToCart&id='.$row['ISBN'].'" class="prod_buy">Add to Cart</a> 
                    <a href="display_details.php?id='.$row['ISBN'].'" class="prod_details">Details</a></div>
                </div>
                ';
                $hrefid++;
            }
      ?>
    </div>
    <!-- end of right content -->
  </div>
  <!-- end of main content -->
  <div class="footer">
    <div class="left_footer"> <img src="images/footer_logo.png" alt="" width="89" height="42"/> </div>
    <div class="center_footer">Copyright © 2016 Book Store </br> Lihua Zhang | Yameng Sun<br/>
      <a href="http://csscreme.com"><img src="images/csscreme.jpg" alt="csscreme" title="csscreme" border="0" /></a><br />
      <img src="images/payment.gif" alt="" /> </div>
    <div class="right_footer"> <a href="#">home</a> <a href="#">about</a> <a href="#">sitemap</a> <a href="#">rss</a> <a href="#">contact us</a> </div>
  </div>
</div>
<!-- end of main_container -->
</body>
</html>
