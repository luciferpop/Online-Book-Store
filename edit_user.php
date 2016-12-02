<?php 
	session_start();
	error_reporting(E_ERROR);
	include_once "helper/dbconn.php";
	$sql = "SELECT Fname, Lname, Usrname, Email, Addr FROM USER WHERE ID = '".$_GET['id']."'";
	$result = mysqli_query($conn, $sql);
	while ($row = $result->fetch_assoc()) {
		$fname = $row['Fname'];
		$lname = $row['Lname'];
		$usrname = $row['Usrname'];
		$email = $row['Email'];
		$addr = $row['Addr'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Edit User</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
<style type="text/css">
input[type=text], select {
width: 80%;
padding: 10px 10px;
margin: 0px;
display: inline-block;
border: 1px solid #666000;
border-radius: 4px;
box-sizing: border-box;
}
</style>
</head>
<body>
<div id="main_container">
  <?php
    require "helper/header_admin.php";
  ?>
  <div class="crumb_navigation"> Navigation: <span class="current">Manage User</span> </div>
  <fieldset>
  	<legend>Edit User</legend>
  		<form action="edit_user_action.php?id=<?php echo $_GET['id']; ?>" method="post">
		  	<table>
		        <tr>
		        	<td><strong>First Name: </strong></td>
			        <td><input type="text" name="first_name" value="<?php if ($fname != NULL) echo $fname; else echo 'Set Your First Name';?>"></td>
			    </tr>
			    
			    <tr>
			    	<td><strong>Last Name: </strong></td>
			        <td><input type="text" name="last_name" value="<?php if ($lname != NULL) echo $lname; else echo 'Set Your Last Name';?>"></td>
			    </tr>

			    <tr>
			    	<td><strong>User Name: </strong></td>
			        <td><input type="text" name="usrname" value="<?php echo $usrname; ?>" readonly="readonly"></td>
			    </tr>

			    <tr>
			    	<td><strong>Email: </strong></td>
			        <td><input type="text" name="email" value="<?php if ($email != NULL) echo $email; else echo 'Set Your Email Address';?>""></td>
			    </tr>
			    
			    <tr>
			    	<td><strong>Address: </strong></td>
			        <td><input type="text" name="addr" value="<?php if ($addr != NULL) echo $addr; else echo 'Set Your Address';?>"></td>
			    </tr>
			</table>

		    <input type='submit' name="submit" value='Save Changes'>
	    </form>
  </fieldset>
  <?php
  	require "helper/footer.php";
  ?>
</div>
</body>
</html>
