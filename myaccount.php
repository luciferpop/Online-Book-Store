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
    <div class="crumb_navigation"> Navigation: <span class="current">My Account</span> </div>
    <?php
    	if (isset($_SESSION["login_name"])) {
    		$sql = "SELECT Fname, Lname, Email FROM USER WHERE Usrname = '".$_SESSION["login_name"]."'";
    		$result = mysqli_query($conn, $sql);
    		var_dump($result);
    		while ($row = $result->fetch_assoc()) {
    			$fname = $row['Fname'];
    			$lname = $row['Lname'];
    			$email = $row['Email'];
    		}
    		echo "
    		<div class='myaccount_title'>
    		<div class='title_box'>".$_SESSION["login_name"]." 's account</div>
            <style>
			input[type=text], select {
			    width: 350px;
			    padding: 5px 10px;
			    margin: 8px 0;
			    display: inline-block;
			    border: 1px solid #ccc;
			    border-radius: 4px;
			    box-sizing: border-box;
			}

			input[type=submit] {
			    width: 350px;
			    background-color: #4CAF50;
			    color: white;
			    padding: 10px 10px;
			    margin: 8px 0;
			    border: none;
			    border-radius: 4px;
			    cursor: pointer;
			}

			input[type=submit]:hover {
			    background-color: #45a049;
			}

			.info {
				border-radius: 5px;
    			background-color: #f2f2f2;
				padding: 10px 10px 5px 10px;
				display: table-cell; 
			}
			</style>
            <div class='info'>
			  <form action='action.php'>
			  	<label for='name'>Username</label>
            	<input id='name' type='text' placeholder='".$_SESSION["login_name"]."'>

			    <label for='fname'>First Name
				<input type='text' id='fname' name='firstname' placeholder='". $fname ."'>
			    </label>
			    
			    <label for='lname'>Last Name
			    <input type='text' id='lname' name='lastname'>
			    </label>
			   	
			    <label for='email'>E-mail
			    <input type='text' id='email' name='email'>
			    </label>

			    <input type='submit' value='Save Change'>
			  </form>
			</div>
    		<div class='title_box'>Recent Order</div>
    		<div class='title_box'>Recently Purchased Products</div>
    		</div>
    		";
    	} else {
    		echo "
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
			";
    	}
    ?>
</div>
<?php
require "helper/footer.php";
?>
 </body>
</html>
