<?php
	session_start();
	include_once "helper/dbconn.php";
	if(isset($_POST["submit"]) && $_POST["submit"] == "Save Changes") {
		$usrname = $_SESSION["login_name"];
		$sql = "UPDATE ADMIN SET Fname = '". $_POST["first_name"] ."', Lname = '". $_POST["last_name"] ."', Email = '". $_POST["email"] ."', Addr = '". $_POST["addr"] ."' WHERE Usrname = '". $usrname ."'";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			echo("Error description: " . mysqli_error($conn));
			echo "<script>
				alert('Update Failed!');
			</script>";
		} else {		
			echo "
				<script>
				alert('User Info Successfully Updated!');
				window.location.href='myaccount.php';
				</script>
			";
		}
	} else {
		echo "User Account Update Failed!";
	}
?>