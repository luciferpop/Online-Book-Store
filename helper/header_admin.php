<?php 
  session_start();
  include_once "helper/dbconn.php";
  require_once('helper/pageclass.php');
?>
<div id="main_container">
<div id="header">
  <div class="top_right">
  </div>
  <div id="logo"> <a href="#"><img src="images/logo.png" alt="" border="0" width="182" height="85" /></a> </div>
</div>
<div id="main_content">
  <div id="menu_tab">
    <ul class="menu">
      <li><a href="admin_index.php" class="nav"> Home </a></li>
        <li class="divider"></li>
        <li><a href="myacc_admin.php" class="nav">My Account</a></li>
        <li class="divider"></li>
        <li><a href="manage_user.php" class="nav">Manage User</a></li>
        <li class="divider"></li>
        <li><a href="manage_book.php" class="nav">Mange Book</a></li>
        <li class="divider"></li>
        <li><a href="manage_order.php" class="nav">Manage Order</a></li>
        <li class="divider"></li>
        <li><a href="backup.php" class="nav">Backup Database</a></li>
        <li class="divider"></li>
        <li><a href="logout.php" class="nav">Logout</a></li>
        <li class="divider"></li>
        <li>
      <?php 
        if (isset($_SESSION["login_name"])) {
          echo "<font color='white'>&nbsp&nbsp&nbsp&nbspHello
            <a href='logout.php'>
           <font color='orange' size='2'>"
           . $_SESSION["login_name"] . 
           "</font></a>
           !&nbsp&nbsp&nbsp&nbspWelcome!</font>";
        } else {
          echo "&nbsp&nbsp&nbsp<font color='white'>Hi, please <a href='login/login.php'><font color='orange'>Sign in</font></a>
                 or <a href='signup/signup.php'><font color='orange'>Sign up</font></a> !</font>";
        }
       ?>
       </li>
  </ul>
 </div>
 </div>
</div>
