<?php
	include_once "helper/dbconn.php";
 	require_once('helper/pageclass.php');
 	// ini_set('display_errors', 'On');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Low Prices</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
	<?php 
		require('helper/header.php');
	?>
	<div class="crumb_navigation"> Navigation: <span class="current">Special Lists</span></div>
	<div class="title_box">Drama</div>
	<div class="show_specials">
	    <?php
        $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.Category='Drama' AND Price < 10 LIMIT 5";
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
    </div>
    <div class="title_box">Self Help</div>
	<div class="show_specials">
	    <?php
        $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.Category='Self help' AND Price < 10 LIMIT 5";
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
    </div>
    <div class="title_box">History</div>
	<div class="show_specials">
	    <?php
        $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.Category='History' AND Price < 10 LIMIT 5";
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
    </div>
</div>
<?php 
	require('helper/footer.php');
?>
</body>
</html>

