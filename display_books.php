<?php
	session_start();
	include_once "helper/dbconn.php";
    // select 8 categories with most books from table 'BOOK'
    $cate_sql = "SELECT Category, COUNT(ISBN) AS CNT FROM BOOK GROUP BY Category ORDER BY COUNT(ISBN) DESC LIMIT 10";
    $cate_result = mysqli_query($conn, $cate_sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Books Store | Books</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
	<?php 
		require('helper/header.php');
	?>
    <div class="crumb_navigation"> Navigation: <span class="current">Browse Books</span> </div>
    <div class="left_content">
    <div class="title_box">Popular Categories</div>
      <ul class="left_menu">
        <?php
            $index = 0;
            while ($row = $cate_result->fetch_assoc()) {
                if ($index%2 == 0) 
                    echo '<li class="odd"><a href="#">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                else
                    echo '<li class="even"><a href="#">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                $index++;
            }
        ?>
      </ul>
    </div>
    <div class="center_content">
        <div class="prod_box">
            <div class="center_prod_box">
              <div class="product_title"><a href="#">Makita 156 MX-VL</a></div>
              <div class="product_img"><a href="#"><img src="http://images.amazon.com/images/P/013091830X.01.LZZZZZZZ.jpg" alt="" border="0" /></a></div>
              <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
            </div>
            <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> 
            <a href="#" class="prod_details">Details</a></div>
          </div>
    </div>
<?php
    require "helper/footer.php";
?>
 </body>
</html>
