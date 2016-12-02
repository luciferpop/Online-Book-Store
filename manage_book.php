<?php
  session_start();
  error_reporting(E_ERROR);
  //ini_set('display_errors', 'On');
  include_once "helper/dbconn.php";
  //$_SESSION["login_name"] = null;
  if($_POST) {
  	$isbn = $_POST['isbn'];
  	$title = $_POST['title'];
  	$sql = 'SELECT ISBN, Title, Category, Year, PubName FROM BOOK WHERE ';
  	if ($isbn != null && $title != null)
  		$sql .= "ISBN LIKE '%".$isbn."%' OR Title LIKE '%".$title."%' LIMIT 3";
  	elseif ($isbn != null && $title == null)
  		$sql .= "ISBN LIKE '%".$isbn."%' LIMIT 3";
  	elseif ($isbn == null && $title != null)
  		$sql .= "Title LIKE '%".$title."%' LIMIT 3";
  	else
  		$sql .= "TRUE LIMIT 3";
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
  <div class="crumb_navigation"> Navigation: <span class="current">Manage Book</span> </div>
  <fieldset>
  	<legend>Search Book</legend>
  	<div class="search_box">
  	<form action='' method="post">
  		<div>
	        <input type="text" name="isbn" placeholder="Give an ISBN">
	    </div>
	    OR
        <div>
	        <input type="text" name="title" placeholder="Give a title">
	    </div>
	    
	    <input type='submit' name="submit" value='Search Book'>
  	</form>
  	</div>
  	<div class="result_box">
	  <table>
	  	<tr>
	  		<th>ISBN</th>
	  		<th>Title</th>
	  		<th>Category</th>
	  		<th>Year</th>
	  		<th>Publisher</th>
	  		<th></th>
	  	</tr>
	  	<?php

	  		if ($result != null) {
	  			while ($row = $result->fetch_assoc()) {
	            echo '
	                <tr>
	                  <td>'.$row['ISBN'].'</td>
	                  <td>'.$row['Title'].'</td>
	                  <td>'.$row['Category'].'</td>
	                  <td>'.$row['Year'].'</td>
	                  <td>'.$row['PubName'].'</td>
	                  <td><a href="edit_book.php?isbn='.$row['ISBN'].'">Edit</a></td>
	                </tr>
	              ';
	        	}
	        	echo '</table>';
	  		}
	  		else 
	  			echo '</table></br><li><p><font size=2 color="#666000">No book recorded.</font></p></li>';	

	  	?>
  	</div>
  </fieldset>
  <fieldset>
  <legend>Manage Book</legend>
	  <table>
	  	<tr>
	  		<th>ISBN</th>
	  		<th>Title</th>
	  		<th>Category</th>
	  		<th>Year</th>
	  		<th>Publisher</th>
	  		<th></th>
	  	</tr>
	  	<?php 
	  		$sql = "SELECT ISBN, Title, Category, Year, PubName FROM BOOK LIMIT 10";
	  		$result = mysqli_query($conn, $sql);
	  		while ($row = $result->fetch_assoc()) {
	            echo '
	                <tr>
	                  <td>'.$row['ISBN'].'</td>
	                  <td>'.$row['Title'].'</td>
	                  <td>'.$row['Category'].'</td>
	                  <td>'.$row['Year'].'</td>
	                  <td>'.$row['PubName'].'</td>
	                  <td><a href="edit_book.php?isbn='.$row['ISBN'].'">Edit</a></td>
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