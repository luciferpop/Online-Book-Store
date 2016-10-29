<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
	$index = 0;
	echo '
	<div class="prod_box">
	    <div class="center_prod_box">
	      <div class="product_title"><a href="#">'. $row['Title'] .'</a></div>
	      <div class="product_img">
	          <a href="#" id="href">
	          <img id="img" src="http://images.amazon.com/images/P/000123207X.01.MZZZZZZZ.jpg" />
	          	<script type="text/javascript">
	          		var x = document.getElementsByTagName("img");
	          		document.write(x[$index].naturalWidth);
	          		if (x[$index].naturalWidth == 1)
	          			document.getElementById("href").innerHTML = "<img src=\'images/bann2.jpg\'>";
				</script>
	        </a>
	      </div>
	      <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
	    </div>
	    <div class="prod_details_tab"> <a href="#" class="prod_buy">Add to Cart</a> 
	    <a href="#" class="prod_details">Details</a></div>
    </div>
	';
?>
</body>
</html>