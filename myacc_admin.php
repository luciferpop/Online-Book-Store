<?php
	// session_start();
	include_once "helper/dbconn.php";
	if (isset($_SESSION["login_name"])) {
		$sql = "SELECT ID, Usrname, Fname, Lname, Email, Addr FROM ADMIN WHERE Usrname = '".$_SESSION["login_name"]."'";
		$result = mysqli_query($conn, $sql);
		//var_dump($result);
		while ($row = $result->fetch_assoc()) {
				$fname = $row['Fname'];
				$lname = $row['Lname'];
				$email = $row['Email'];
				$addr = $row['Addr'];
	    	}
	    $result->close();
	    $conn->close();
	} else {
		echo "
			<script>
				alert('Please login first! Redirecting...');
				window.location.href='index.php';
			</script>
		";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My Account | Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
  <?php
      require "helper/header_admin.php";
  ?>
<div class="crumb_navigation"> Navigation: <span class="current">My Account</span> </div>
<fieldset>
<legend><?php echo $_SESSION["login_name"];?> 's account</legend>
<div>
  <form action='myacc_admin_update.php' method="post">
        <div>
	        <input type="text" name="first_name" class="user_input" value="<?php if ($fname != NULL) echo $fname; else echo 'Set Your First Name';?>">
	    </div>
	    
	    <div>
	        <input type="text" name="last_name" class="user_input" value="<?php if ($lname != NULL) echo $lname; else echo 'Set Your Last Name';?>">
	    </div>

	    <div>
	        <input type="text" name="email" class="user_input" value="<?php if ($email != NULL) echo $email; else echo 'Set Your Email Address';?>"">
	    </div>
	    
	    <div>
	        <input type="text" name="addr" class="user_input" value="<?php if ($addr != NULL) echo $addr; else echo 'Set Your Address';?>">
	    </div>

	    <input type='submit' name="submit" value='Save Changes'>
  </form>
</div>
</fieldset>
<fieldset>
	<legend>Recent Activities</legend>
	<div>
		<p><font size=2 color="#666000">No recent activities recorded.</font></p>
	</div>
</fieldset>
<?php
	require "helper/footer.php";
?>
</div>
</body>
</html>