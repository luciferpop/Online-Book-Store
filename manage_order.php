<?php
  session_start();
  error_reporting(E_ERROR);
  //ini_set('display_errors', 'On');
  include_once "helper/dbconn.php";
  //$_SESSION["login_name"] = null;
  if($_POST) {
  	$id = $_POST['id'];
  	$usrname = $_POST['usrname'];
  	$sql = 'SELECT ODR_ID, CUS_ID, Usrname, Total, Created FROM ORDERS WHERE ';
  	if ($id != null && $usrname != null)
  		$sql .= "ODR_ID LIKE '%".$id."%' OR Usrname LIKE '%".$usrname."%'";
  	elseif ($id != null && $usrname == null)
  		$sql .= "ODR_ID LIKE '%".$id."%'";
  	elseif ($id == null && $usrname != null)
  		$sql .= "Usrname LIKE '%".$usrname."%'";
  	else
  		$sql .= "TRUE";
  	$sql .= " LIMIT 3";
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
  <div class="crumb_navigation"> Navigation: <span class="current">Manage Order</span> </div>
  <fieldset>
  	<legend>Search Order</legend>
  	<div class="search_box">
  	<form action='' method="post">
  		<div>
	        <input type="text" name="id" placeholder="Give an order ID">
	    </div>
	    OR
        <div>
	        <input type="text" name="usrname" placeholder="Give an user name">
	    </div>
	    
	    <input type='submit' name="submit" value='Search Order'>
  	</form>
  	</div>
  	<div class="result_box">
	  <table>
	  	<tr>
	  		<th>Order Id</th>
	  		<th>Customer Id</th>
	  		<th>User Name</th>
	  		<th>Total Charged</th>
	  		<th>Created Time</th>
	  	</tr>
	  	<?php

	  		if ($result != null) {
	  			while ($row = $result->fetch_assoc()) {
	            echo '
	                <tr>
	                  <td>'.$row['ODR_ID'].'</td>
	                  <td>'.$row['CUS_ID'].'</td>
	                  <td>'.$row['Usrname'].'</td>
	                  <td>'.$row['Total'].' $</td>
	                  <td>'.$row['Created'].'</td>
	                </tr>
	              ';
	        	}
	        	echo '</table>';
	  		}
	  		else 
	  			echo '</table></br><li><p><font size=2 color="#666000">No order recorded.</font></p></li>';	

	  	?>
  	</div>
  </fieldset>
	<fieldset>
      <legend>Recent Orders</legend>
        <?php 
        $sql = "SELECT ODR_ID, Usrname, Total, Created FROM ORDERS ORDER BY Created DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);
        echo '<table>
          <tr>
            <th>Order Id</th>
            <th>User Name</th>
            <th>Total Charged</th>
            <th>Time Created</th>
          </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '
                <tr>
                  <td>'.$row['ODR_ID'].'</td>
                  <td>'.$row['Usrname'].'</td>
                  <td>'.$row['Total'].' $</td>
                  <td>'.$row['Created'].'</td>
                </tr>
              ';
        }
        echo '</table>';
      ?>
    </fieldset>
    <fieldset>
      <legend>Recent Order Items</legend>
      <?php 
        $sql_items = "SELECT ORDERS.Usrname, ORDERS.Created, ORDER_ITEMS.ISBN, ORDER_ITEMS.Quantity FROM ORDERS, ORDER_ITEMS        WHERE ORDERS.ODR_ID = ORDER_ITEMS.ORD_ID ORDER BY ORDERS.Created DESC LIMIT 5";
        $result = mysqli_query($conn, $sql_items);
        echo '<table>
            <tr>
              <th>Username</th>
              <th>Order Created</th>
              <th>Book ISBN</th>
              <th>Quantity</th>
            </tr>';
        while ($row = $result->fetch_assoc()) {
          echo '
            <tr>
              <td>'.$row['Usrname'].'</td>
              <td>'.$row['Created'].'</td>
              <td>'.$row['ISBN'].'</td>
              <td>'.$row['Quantity'].'</td>
            </tr>
          ';
        }
        echo '</table>';
      ?>
    </fieldset>
  <?php
  	require "helper/footer.php";
  ?>
</div>
</body>
</html>