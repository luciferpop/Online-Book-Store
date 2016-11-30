<?php
  session_start();
  include 'cart.php';
  $cart = new Cart;
  //ini_set('display_errors', 'On');
  include_once "helper/dbconn.php";
  require_once('helper/pageclass.php');
  $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
  $cate = empty($_GET['cate']) ? $_POST['cate'] : $_GET['cate'];
  $pub = empty($_GET['pub']) ? $_POST['pub'] : $_GET['pub'];
  // sort options
  $odr_price = empty($_GET['odr_price']) ? FALSE : $_GET['odr_price'];
  $odr_title = empty($_GET['odr_title']) ? FALSE : $_GET['odr_title'];
  $total = 0;
  // assemble sql for counting total records
  $global_sql = "SELECT * FROM BOOK WHERE Title LIKE '%'";
  if ($cate != null)
    $global_sql .= " AND Category='".$cate."'";
  if ($pub != null)
    $global_sql .= " AND PubName='".$pub."'";
  $total = 0;
  // assemble sql for counting total records
  if ($GLOBALS['cate'] == NULL && $GLOBALS['pub'] == NULL)
    $sql = "SELECT COUNT(*) AS CNT FROM (".$global_sql.") T"; 
  else if ($GLOBALS['pub'] == NULL)
    $sql = "SELECT COUNT(*) AS CNT FROM (".$global_sql.") T WHERE T.Category = '".$GLOBALS['cate']."'";    
  else if ($GLOBALS['cate'] == NULL)
    $sql = "SELECT COUNT(*) AS CNT FROM (".$global_sql.") T WHERE T.PubName = '".$GLOBALS['pub']."'";
  else 
    $sql = "SELECT COUNT(*) AS CNT FROM (".$global_sql.") T WHERE T.Category = '".$GLOBALS['cate']."' AND T.PubName = '".$pub."'";
  $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
      $total = $row['CNT'];
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Show Books</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
  <?php 
    require('helper/header.php');
  ?>
    <div class="crumb_navigation"> Navigation: <span class="current">Search Results
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
      if ($odr_price) echo " Ordered by <b><font color='orange'>Price</font></b>";
      else if ($odr_title) echo " Ordered by <b><font color='orange'>Title</font></b>";
      echo "&nbsp&nbsp<a href='display_books.php' title='Clear Filters'>X</a>";
    ?>  
    </span> </div>
    <div class="left_content">
      <div class="title_box">Categories</div>
        <ul class="left_menu">
          <?php
              // select 10 categories with most books from table 'BOOK'
              $cate_sql = "SELECT Category, COUNT(ISBN) AS CNT FROM (".$global_sql.") T GROUP BY T.Category ORDER BY COUNT(T.ISBN) DESC LIMIT 10";
              $cate_result = mysqli_query($conn, $cate_sql);
              $index = 0;
              while ($row = $cate_result->fetch_assoc()) {
                  if ($index%2 == 0) 
                      echo '<li class="odd"><a href="?&cate='.$row['Category'].'&pub='.$GLOBALS['pub'].'">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                  else
                      echo '<li class="even"><a href="?&cate='.$row['Category'].'&pub='.$GLOBALS['pub'].'">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                  $index++;
              }
          ?>
        </ul>
      <div class="title_box">Publishers</div>
        <ul class="left_menu">
          <?php
              // select 8 most popular publisher from BOOK
              $sql = "SELECT PubName, COUNT(PubName) AS CNT FROM (".$global_sql.") T GROUP BY T.PubName ORDER BY CNT DESC LIMIT 8";
              $result = mysqli_query($conn, $sql);
              $index = 0;
              while ($row = $result->fetch_assoc()) {
                  if ($index%2 == 0) 
                      echo '<li class="odd"><a href="?&cate='.$GLOBALS['cate'].'&pub='.$row['PubName'].'">'.$row['PubName']. ' ('.$row['CNT'].')'.'</a></li>';
                  else
                      echo '<li class="even"><a href="?&cate='.$GLOBALS['cate'].'&pub='.$row['PubName'].'">'.$row['PubName']. ' ('.$row['CNT'].')'.'</a></li>';
                  $index++;
              }
          ?>
        </ul>
      <div class="title_box">Sort By</div>
      <ul class="left_menu">
        <li class="odd"><?php echo '<a href="?&cate='.$GLOBALS['cate'].'&pub='.$GLOBALS['pub'].'&odr_price=TRUE">Price</a>';?></li>
        <li class="even"><?php echo '<a href="?&cate='.$GLOBALS['cate'].'&pub='.$GLOBALS['pub'].'&odr_title=TRUE">Title</a>';?></li>
      </ul>
    </div>
    <div class="center_content">
    <!-- display books -->
        <?php
            $hrefid = 0;
            $showrow = 9;
            $url = "?page={page}&cate=".$cate."&pub=".$pub."&odr_price=".$odr_price."&odr_title=".$odr_title.""; 
            if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
                $curpage = ceil($total_rows / $showrow);

            // assemble sql
            if ($GLOBALS['cate'] == NULL && $GLOBALS['pub'] == NULL)
              $sql = "SELECT T.ISBN, Title, Price FROM (".$global_sql.") T, PRICE WHERE T.ISBN = PRICE.ISBN LIMIT ".($curpage - 1) * $showrow ." ,$showrow"; 
            else if ($GLOBALS['pub'] == NULL)
              $sql = "SELECT T.ISBN, Title, Price FROM (".$global_sql.") T, PRICE WHERE T.ISBN = PRICE.ISBN AND T.Category = '".$GLOBALS['cate']."' LIMIT " . ($curpage - 1) * $showrow . ",$showrow";    
            else if ($GLOBALS['cate'] == NULL)
              $sql = "SELECT T.ISBN, Title, Price FROM (".$global_sql.") T, PRICE WHERE T.ISBN = PRICE.ISBN AND T.PubName = '".$GLOBALS['pub']."' LIMIT " . ($curpage - 1) * $showrow . ",$showrow";
            else 
              $sql = "SELECT T.ISBN, Title, Price FROM (".$global_sql.") T, PRICE WHERE T.ISBN = PRICE.ISBN AND T.Category = '".$GLOBALS['cate']."' AND T.PubName = '".$GLOBALS['pub']."' LIMIT " . ($curpage - 1) * $showrow . ",$showrow";
        
            if ($odr_price)
              $sql = "SELECT * FROM (".$sql.") TMP ORDER BY TMP.Price";
            if ($odr_title)
              $sql = "SELECT * FROM (".$sql.") TMP ORDER BY TMP.Title";
            // fetch data
            //echo $sql;
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($GLOBALS['result'])) {
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
        <div class="cart_details"> <?php echo $cart->total_items(); ?> items <br />
          <span class="border_cart"></span> Total: <span class="price"><?php echo $cart->total(); ?> $</span> </div>
        <div class="cart_icon"><a href="view_cart.php"><img src="images/shoppingcart.png" alt="" width="35" height="35" border="0" /></a></div>
      </div>
      <div class="title_box">What is new</div>
      <?php 
      $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND Year >= '2005' AND Year<='2016' LIMIT 2";
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
<?php
    require "helper/footer.php";
?>
</body>
</html>
