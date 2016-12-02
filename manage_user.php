<?php
  session_start();
  error_reporting(E_ERROR);
  //ini_set('display_errors', 'On');
  include_once "helper/dbconn.php";
  //$_SESSION["login_name"] = null;
  if($_POST) {
  	$id = $_POST['id'];
  	$usrname = $_POST['usrname'];
  	$sql = 'SELECT ID, Fname, Lname, Usrname, Email, Addr FROM USER WHERE ';
  	if ($id != null && $usrname != null)
  		$sql .= "ID LIKE '%".$id."%' OR Usrname LIKE '%".$usrname."%'";
  	elseif ($id != null && $usrname == null)
  		$sql .= "ID LIKE '%".$id."%'";
  	elseif ($id == null && $usrname != null)
  		$sql .= "Usrname LIKE '%".$usrname."%'";
  	else
  		$sql .= "TRUE";
  	$result = mysqli_query($conn, $sql);
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
<style>
.search_box {width:300px;height:150px;float:left;}
.result_box {width:600px;height:150px;float:left;}
input[type=text], select {
    width: 80%;
    padding: 10px 10px;
    margin: 5px;
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
  	<legend>Search User</legend>
  	<div class="search_box">
  	<form action='' method="post">
  		<div>
	        <input type="text" name="id" placeholder="Give a user id">
	    </div>
	    OR
        <div>
	        <input type="text" name="usrname" placeholder="Give a user name">
	    </div>
	    
	    <input type='submit' name="submit" value='Search User'>
  	</form>
  	</div>
  	<div class="result_box">
	  <table>
	  	<tr>
	  		<th>ID</th>
	  		<th>First Name</th>
	  		<th>Last Name</th>
	  		<th>User Name</th>
	  		<th>Email</th>
	  		<th>Address</th>
	  		<th></th>
	  	</tr>
	  	<?php

	  		if ($result != null) {
	  			while ($row = $result->fetch_assoc()) {
	            echo '
	                <tr>
	                  <td>'.$row['ID'].'</td>
	                  <td>'.$row['Fname'].'</td>
	                  <td>'.$row['Lname'].'</td>
	                  <td>'.$row['Usrname'].'</td>
	                  <td>'.$row['Email'].'</td>
	                  <td>'.$row['Addr'].'</td>
	                  <td><a href="edit_user.php?id='.$row['ID'].'">Edit</a></td>
	                </tr>
	              ';
	        	}
	        	echo '</table>';
	  		}
	  		else 
	  			echo '</table></br><li><p><font size=2 color="#666000">No user recorded.</font></p></li>';	

	  	?>
  	</div>
  </fieldset>
  <fieldset>
  <legend>Manage User</legend>
	  <table>
	  	<tr>
	  		<th>ID</th>
	  		<th>First Name</th>
	  		<th>Last Name</th>
	  		<th>User Name</th>
	  		<th>Email</th>
	  		<th>Address</th>
	  		<th></th>
	  	</tr>
	  	<?php 
	  		$sql = "SELECT ID, Fname, Lname, Usrname, Email, Addr FROM USER LIMIT 10";
	  		$result = mysqli_query($conn, $sql);
	  		while ($row = $result->fetch_assoc()) {
	            echo '
	                <tr>
	                  <td>'.$row['ID'].'</td>
	                  <td>'.$row['Fname'].'</td>
	                  <td>'.$row['Lname'].'</td>
	                  <td>'.$row['Usrname'].'</td>
	                  <td>'.$row['Email'].'</td>
	                  <td>'.$row['Addr'].'</td>
	                  <td><a href="edit_user.php?id='.$row['ID'].'">Edit</a></td>
	                </tr>
	              ';
	  		}
	  	?>
	  </table>
  </fieldset>
  <?php
  	require "helper/footer.php";
  ?>
</div>
</body>
</html>