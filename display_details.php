<?php
  include 'cart.php';
  $cart = new Cart;
	include_once "helper/dbconn.php";
  require_once('helper/pageclass.php');
	$id = empty($_GET['id']) ? NULL : $_GET['id'];
	$sql = "SELECT Title, Price, PubName, Category, Year FROM BOOK NATURAL JOIN PRICE WHERE ISBN = '".$id."'";
	$result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    	$title = $row['Title'];
    	$price = $row['Price'];
    	$pub = $row['PubName'];
    	$cate = $row['Category'];
    	$year = $row['Year'];
    }
    $stock_sql = "SELECT Copies FROM BOOK_STOCK WHERE ISBN = '".$id."'";
    $stock_rst = mysqli_query($conn, $stock_sql);
    while ($row = mysqli_fetch_array($stock_rst)) {
    	$copies = $row['Copies'];
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
	<?php 
		require('helper/header.php');
	?>
	<div class="crumb_navigation"> Navigation: <span class="current">Books Details</span></div>
	<div class="left_content">
		<div class="title_box">Recommand for You</div>
		<?php 
			$sql = "SELECT * FROM (SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.Category = '".$GLOBALS['cate']."' AND BOOK.PubName = '".$GLOBALS['pub']."' LIMIT 10) TMP ORDER BY RAND() LIMIT 2";
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
              <a href="display_details.php?id='.$row['ISBN'].'" class="prod_details">Details</a></div>
          </div>
          ';
          $hrefid++;
      }
		?>
		<?php echo "<img id='first' src='http://images.amazon.com/images/P/".$id.".01.MZZZZZZZ.jpg' style='visibility: hidden;'>" ?>
	</div>
	<!-- end of left contents-->
	<div class="center_content">
		<div class="detail_prod_box" id="prod">
			<?php echo "
						<script>
							x = document.getElementById('first');
							if (x.naturalWidth == 1)
								document.getElementById('prod').innerHTML='<img src=\'images/default_cover_big.jpg\' width=\'250\' height=\'350\'>';
							else 
								document.getElementById('prod').innerHTML = '<img src=\'http://images.amazon.com/images/P/".$id.".01.LZZZZZZZ.jpg\' width=\'250\' height=\'350\'>';
						</script>
						"; ?> 
		</div>
		<div class="desc_prod_box">
		<fieldset>
			<legend>Book Details</legend>
			<div>
				<p><font size=5 color="#000000"><?php echo $title; ?></font></p>
				<p></p>
				<p><font size=4 color="#000000"><?php echo $pub."\tPress"."\t".$year; ?></font></p>
				<p></p>
				<p><font size=4 color="#000000"><?php echo $cate; ?></font></p>
				<p></p>
				<span class="reduce">&nbspList Price: <?php echo ceil($price*1.3); ?>$</span>
				<p><font size=3 color="red">Now: <?php echo $price; ?>$</font></p>
				<p><font size=2 color="red">You Saved: <?php echo ceil($price*1.3)-$price; ?>$</font></p>
				<p></p>
				<p><font size=2 color="green">In Stock.</font></p>
				<p><font size=3 color="green"><?php echo $copies; ?>&nbspLeft.</font></p>
				<p></p>
				<p></p>
				<font size=3><li>The Wasteland</li></font>
				<font size=3><li>The Hollow Men</li></font>
				<p></p>
				<p></p>
				<p></p>
				<p></p>
        <?php 
          echo '
          <a href="cart_action.php?action=addToCart&id='.$id.'" class="prod_buy">Add to Cart</a>
          <a href="cart_action.php?action=addToCart&id='.$id.'" class="prod_buy">Buy now</a>
          ';
        ?>
			</div>
		</fieldset>
		</div>
    <div class="desc_box">
    <div class="center_title_bar">Book Description</div>
    <div class="desc_text">
      <h3>Title</h3>
      <p><?php echo $title; ?></p>
      <h3>Description</h3>
      <p>This the description</p>
    </div>
    </div>
	</div>
	<!-- end of center contents-->
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
        $hrefid = 0;
        while ($row = mysqli_fetch_array($result)) {
            echo '
            <div class="prod_box">
                <div class="center_prod_box">
                  <div class="product_title"><a href="#display_details.php?id='.$row['ISBN'].'>'. $row['Title'] .'</a></div>
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
    <!-- end of right contents-->
</div>
<?php 
		require('helper/footer.php');
?>
<script type="text/javascript">
</script>
</body>
</html>