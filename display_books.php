<?php
	session_start();
  ini_set('display_errors', 'On');
	include_once "helper/dbconn.php";
  require_once('helper/pageclass.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Books Store | Books</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
  <style type="text/css">
      p{margin:0}
      #page{
          height:40px;
          padding:20px 0px;
      }
      #page a{
          display:block;
          float:left;
          margin-right:10px;
          padding:2px 12px;
          height:24px;
          border:1px #cccccc solid;
          background:#fff;
          text-decoration:none;
          color:#808080;
          font-size:12px;
          line-height:24px;
      }
      #page a:hover{
          color:#077ee3;
          border:1px #077ee3 solid;
      }
      #page a.cur{
          border:none;
          background:#077ee3;
          color:#fff;
      }
      #page p{
          float:left;
          padding:2px 12px;
          font-size:12px;
          height:24px;
          line-height:24px;
          color:#bbb;
          border:1px #ccc solid;
          background:#fcfcfc;
          margin-right:8px;

      }
      #page p.pageRemark{
          border-style:none;
          background:none;
          margin-right:0px;
          padding:4px 0px;
          color:#666;
      }
      #page p.pageRemark b{
          color:red;
      }
      #page p.pageEllipsis{
          border-style:none;
          background:none;
          padding:4px 0px;
          color:#808080;
      }

      #sp { 
        margin-left: 80px; 
      }

      .dates li {font-size: 14px;margin:20px 0}
      .dates li span{float:right}
  </style>
</head>
<body>

<div id="main_container">
	<?php 
		require('helper/header.php');
	?>
    <div class="crumb_navigation"> Navigation: <span class="current">Browse Books </span> </div>
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
                      echo '<li class="odd"><a href="?page=0&cate='.$row['Category'].'">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                  else
                      echo '<li class="even"><a href="?page=0&cate='.$row['Category'].'">'.$row['Category']. ' ('.$row['CNT'].')'.'</a></li>';
                  $index++;
              }
          ?>
        </ul>
      <div class="title_box">Popular Publishers</div>
        <ul class="left_menu">
        </ul>
    </div>
    <div class="center_content">
    <!-- randomly display books -->
        <?php
            $showrow = 9; 
            $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
            $cate = empty($_GET['cate']) ? NULL : $_GET['cate'];
            $url = "?page={page}&cate=".$cate.""; 
            //$sql = "SELECT * FROM userinfo";
            $total = 265011;
            if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
                $curpage = ceil($total_rows / $showrow); 
            // fetch data
            $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.Category = '".$cate."' LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
            $result = mysqli_query($conn, $sql);
            $hrefid = 0;
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
