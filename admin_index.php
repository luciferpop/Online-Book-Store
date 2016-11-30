<?php
  session_start();
  include_once "helper/dbconn.php";
  require_once('helper/pageclass.php');
  //$_SESSION["login_name"] = null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<!--
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
-->
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
<style>
  .city {display:none;}
</style>
</head>
<body>
<div id="main_container">
  <?php
    require "helper/header_admin.php";
  ?>
  <div class="crumb_navigation"> Navigation: <span class="current">Administrator</span> </div>
  <div class="w3-container">
  <h2>Tabs in a Grid</h2>

  <div class="w3-row">
    <a href="javascript:void(0)" onclick="openCity(event, 'London');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">London</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Paris');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Paris</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Tokyo</div>
    </a>
  </div>

  <div id="London" class="w3-container city">
    <h2>London</h2>
    <p>London is the capital city of England.</p>
  </div>

  <div id="Paris" class="w3-container city">
    <h2>Paris</h2>
    <p>Paris is the capital of France.</p>
  </div>

  <div id="Tokyo" class="w3-container city">
    <h2>Tokyo</h2>
    <p>Tokyo is the capital of Japan.</p>
  </div>
</div>

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}
</script>
</div>
<?php
    require "helper/footer.php";
?>
</body>
</html>
