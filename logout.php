<?php
  session_start();
  unset($_SESSION["login_name"]);
  session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.center {
    margin: auto;
    padding: 50px;
    padding-bottom: 470px;
    width: 55%;
}
</style>
<title>Logout Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
  <?php 
    require "helper/header.php";
  ?>
  <!-- end of menu tab -->
  <div class="crumb_navigation"> Navigation: <span class="current">Logout</span> </div>
  <div class="center">
      <div class="oferta"> 
        <div class="oferta_details">
          <div class="oferta_title">Logout successfully!</div>
          <div class="oferta_text"> Do you know. You can search either based on book's title or author's name. Also, try advanced serach, there are plenty of options for you to find a interesting book.</div>
          <a href="index.php" class="prod_buy">back to home</a> </div>
      </div>
  </div>
</div>
  <?php
    require "helper/footer.php";
  ?>
</body>
</html> 