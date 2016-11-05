<?php
	include_once "helper/dbconn.php";
  	require_once('helper/pageclass.php');
	$id = empty($_GET['id']) ? NULL : $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Books Store | Details</title>
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
		<div class="prod_box">
        <div class="center_prod_box">
          <?php echo "<img id='first' src='http://images.amazon.com/images/P/".$id.".01.MZZZZZZZ.jpg' style='visibility: hidden;'>" ?>
          <div class="product_title"><a href="#">Makita 156 MX-VL</a></div>
          <div class="product_img"><a href="#"><img src="images/p1.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
        </div>
      </div>
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
	</div>
	<!-- end of center contents-->
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
    <!-- end of right contents-->
</div>
<?php 
		require('helper/footer.php');
?>
</body>
</html>