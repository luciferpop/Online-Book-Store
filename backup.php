<?php
  session_start();
  error_reporting(E_ERROR);
  include_once "helper/dbconn.php";
  //$_SESSION["login_name"] = null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
  <?php
    require "helper/header_admin.php";
  ?>
  <div class="crumb_navigation"> Navigation: <span class="current">Backup & Restore</span> </div>
    <fieldset>
      <legend>Backup & Restore</legend>
      <li><p><font size=2 color="#666000">Default backup path /home/lihuaz/Desktop/.</font></p></li><br>
      <table>
        <tr>
          <th>Table to Backup & Restore</th>
          <th>Backup</th>
          <th>Restore</th>
        </tr>
        <tr>
          <td>ADMIN</td>
          <td><a href="backup_action.php?table=ADMIN">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>AUTHOR</td>
          <td><a href="backup_action.php?table=AUTHOR">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>BOOK</td>
          <td><a href="backup_action.php?table=BOOK">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>BOOK_STOCK</td>
          <td><a href="backup_action.php?table=BOOK_STOCK">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>ORDERS</td>
          <td><a href="backup_action.php?table=ORDERS">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>ORDER_ITEM</td>
          <td><a href="backup_action.php?table=ORDER_ITEM">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>PIN</td>
          <td><a href="backup_action.php?table=PIN">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>PRICE</td>
          <td><a href="backup_action.php?table=PRICE">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>PUBLISHER</td>
          <td><a href="backup_action.php?table=PUBLISHER">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
        <tr>
          <td>USER</td>
          <td><a href="backup_action.php?table=USER">Backup</a></td>
          <td><a href="#">Restore</a></td>
        </tr>
      </table>
    </fieldset>
  <?php
  require "helper/footer.php";
  ?>
  </div>
</body>
</html>
