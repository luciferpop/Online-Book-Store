<?php
	session_start();
	include_once "helper/dbconn.php";
?>
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
		require('helper/header.php');
	?>
    <!-- end of menu tab -->
    <?php
        if ($_SESSION['admin_chk'] == 1) {
            header('Location: myacc_admin.php');
            die();
        }
    	else {
    		header('Location: myacc_user.php');
    		die();
    	}
    ?>
</div>
<?php
require "helper/footer.php";
?>
 </body>
</html>
