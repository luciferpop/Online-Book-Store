<?php 
	session_start();
	error_reporting(E_ERROR);
	include_once "helper/dbconn.php";
	$sql = "SELECT ISBN, Title, Category, Year, PubName FROM BOOK WHERE ISBN = '".$_GET['isbn']."'";
	$result = mysqli_query($conn, $sql);
	while ($row = $result->fetch_assoc()) {
		$title = $row['Title'];
		$cate = $row['Category'];
		$year = $row['Year'];
		$pub = $row['PubName'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Edit Book</title>
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
  <div class="crumb_navigation"> Navigation: <span class="current">Manage Book</span> </div>
  <fieldset>
  	<legend>Edit Book</legend>
  		<form action="edit_book_action.php?isbn=<?php echo $_GET['isbn']; ?>" method="post">
  		<table>
		  	<tr>
			    <td><strong>Title: </strong></td>
			    <td><input type="text" name="title" readonly="readonly" value="<?php echo $title; ?>"></td>
		    </tr>
		    
		    <tr>
		        <td><strong>Category: </strong></td>
		        <td><input type="text" name="cate" value="<?php echo $cate; ?>""></td>
		    </tr>

		    <tr>
		        <td><strong>Year: </strong></td>
		        <td><input type="text" name="year" value="<?php echo $year; ?>""></td>
		    </tr>

		    <tr>
		        <td><strong>Publisher: </strong></td>
		        <td><input type="text" name="pub" value="<?php echo $pub;?>""></td>
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
