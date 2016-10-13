<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
<?php
	require "helper/header.php";
?>
<style>
	.center {
	    margin: auto;
	    padding: 50px;
	    padding-bottom: 470px;
	    width: 55%;
	}
	</style>
<div class='center'>
  <div class='oferta'> 
    <div class='oferta_details'>
      <div class='oferta_title'>You are not signin! Please signin first!</div>
      <div class='oferta_text'> Do you know. You can search either based on book's title or author's name. Also, try advanced serach, there are plenty of options for you to find a interesting book.</div>
      </div>
  </div>
</div>
<?php
	require "helper/footer.php";
?>
</div>
</body>
</html>