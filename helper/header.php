<?php 
  session_start();
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
      <li><a href="index.php" class="nav"> Home </a></li>
      <li class="divider"></li>
      <li><a href="display_books.php" class="nav">Books</a></li>
      <li class="divider"></li>
      <li><a href="#" class="nav">Specials</a></li>
      <li class="divider"></li>
      <li><a href="myaccount.php" class="nav">My account</a></li>
      <li class="divider"></li>
      <li><a href="signup/signup.php" class="nav">Sign up</a></li>
      <li class="divider"></li>
      <li><a href="login/login.php" class="nav">Sign in</a></li>
      <li class="divider"></li>
      <li><a href="contact.php" class="nav">Contact us</a></li>
      <li class="divider"></li>
      <li><a href="details.php" class="nav">Details</a></li>
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
