<?php
	session_start();
  //ini_set('display_errors', 'On');
	include_once "helper/dbconn.php";
  require_once('helper/pageclass.php');

  $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
  $cate = empty($_GET['cate']) ? NULL : $_GET['cate'];
  $pub = empty($_GET['pub']) ? NULL : $_GET['pub'];
  $total = 0;
  // assemble sql for counting total records
  if ($GLOBALS['cate'] == NULL && $GLOBALS['pub'] == NULL)
    $sql = "SELECT COUNT(*) AS CNT FROM BOOK"; 
  else if ($GLOBALS['pub'] == NULL)
    $sql = "SELECT COUNT(*) AS CNT FROM BOOK WHERE BOOK.Category = '".$GLOBALS['cate']."'";    
  else if ($GLOBALS['cate'] == NULL)
    $sql = "SELECT COUNT(*) AS CNT FROM BOOK WHERE BOOK.PubName = '".$GLOBALS['pub']."'";
  else 
    $sql = "SELECT COUNT(*) AS CNT FROM BOOK WHERE BOOK.Category = '".$GLOBALS['cate']."' AND BOOK.PubName = '".$pub."'";
  $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
      $total = $row['CNT'];
    } 
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
    <div class="crumb_navigation"> Navigation: <span class="current">Browse Books
    <?php 
      $start = ($GLOBALS['curpage']-1)*9+1;
      $end = $start + 8;
      echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
          \t".$start."-".$end." of ".$GLOBALS['total']." results ";
      if ($GLOBALS['cate'] != NULL && $GLOBALS['pub'] == NULL)
        echo "for <b><font color='orange'>".$GLOBALS['cate']."</font></b>";
      else if ($GLOBALS['cate'] == NULL && $GLOBALS['pub'] != NULL)
        echo "from <b><font color='orange'>".$GLOBALS['pub']."</font></b>";
      else if ($GLOBALS['cate'] != NULL && $GLOBALS['pub'] != NULL)
        echo "for <b><font color='orange'>".$GLOBALS['cate']."</font></b> from <b><font color='orange'>".$GLOBALS['pub']."</font></b>";
      echo "&nbsp&nbsp<a href='display_books.php' title='Clear Filters'>X</a>";
    ?>  
    </span> </div>
    <div class="left_content">
      <div class="title_box">Popular Categories</div>
        <ul class="left_menu">
          <?php
              // select 8 categories with most books from table 'BOOK'
              $cate_sql = "SELECT Category, COUNT(ISBN) AS CNT FROM BOOK GROUP BY Category ORDER BY COUNT(ISBN) DESC LIMIT 10";
              $cate_result = mysqli_query($conn, $cate_sql);
              $index = 0;
              while ($row = $cate_result->fetch_assoc()) {
                  if ($index%2 == 0) 
                      echo '<li class="odd"><a href="?&cate='.$row['Category'].'&pub='.$GLOBALS['pub'].'">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                  else
                      echo '<li class="odd"><a href="?&cate='.$row['Category'].'&pub='.$GLOBALS['pub'].'">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                  $index++;
              }
          ?>
        </ul>
      <div class="title_box">Popular Publishers</div>
        <ul class="left_menu">
          <?php
              // select 8 most popular publisher from BOOK
              $sql = "SELECT PubName, COUNT(PubName) AS CNT FROM BOOK GROUP BY PubName ORDER BY CNT DESC LIMIT 8";
              $result = mysqli_query($conn, $sql);
              $index = 0;
              while ($row = $result->fetch_assoc()) {
                  if ($index%2 == 0) 
                      echo '<li class="odd"><a href="?&cate='.$GLOBALS['cate'].'&pub='.$row['PubName'].'">'.$row['PubName']. ' ('.$row['CNT'].')'.'</a></li>';
                  else
                      echo '<li class="odd"><a href="?&cate='.$GLOBALS['cate'].'&pub='.$row['PubName'].'">'.$row['PubName']. ' ('.$row['CNT'].')'.'</a></li>';
                  $index++;
              }
          ?>
        </ul>
    </div>
    <div class="center_content">
    <!-- display books -->
        <?php
            $hrefid = 0;
            $showrow = 9;
            $total = 265011;
            $url = "?page={page}&cate=".$cate."&pub=".$pub.""; 
            if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
                $curpage = ceil($total_rows / $showrow);

            // assemble sql
            if ($GLOBALS['cate'] == NULL && $GLOBALS['pub'] == NULL)
              $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN LIMIT ".($curpage - 1) * $showrow ." ,$showrow;"; 
            else if ($GLOBALS['pub'] == NULL)
              $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.Category = '".$GLOBALS['cate']."' LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";    
            else if ($GLOBALS['cate'] == NULL)
              $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.PubName = '".$GLOBALS['pub']."' LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
            else 
              $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.Category = '".$GLOBALS['cate']."' AND BOOK.PubName = '".$pub."' LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
            // fetch data
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo '
                <div class="prod_box">
                    <div class="center_prod_box">
                      <div class="product_title"><a href="#">'. $row['Title'] .'</a></div>
                      <div class="product_img">
                        <a href="#" id="'.$hrefid.'">
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
                    <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> 
                    <a href="#" class="prod_details">Details</a></div>
                </div>
                ';
                $hrefid++;
            }
        ?>
      <div class="showPage" id="sp">
        <?php
        if ($total > $showrow) {
            $page = new page($total, $showrow, $curpage, $url, 2);
            echo $page->myde_write();
          }
        ?>
      </div>
    </div>
    <!-- end of center content -->
    <div class="right_content">
      <div class="title_box">Search</div>
      <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="keyword"/>
        <a href="#" class="join">search</a> </div>
      <div class="shopping_cart">
        <div class="title_box">Shopping cart</div>
        <div class="cart_details"> 3 items <br />
          <span class="border_cart"></span> Total: <span class="price">350$</span> </div>
        <div class="cart_icon"><a href="#"><img src="images/shoppingcart.png" alt="" width="35" height="35" border="0" /></a></div>
      </div>
      <div class="title_box">What is new</div>
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
<?php
    require "helper/footer.php";
?>
</body>
</html>
