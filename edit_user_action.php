<?php 
	include_once "helper/dbconn.php";
	if(isset($_POST["submit"]) && $_POST["submit"] == "Save Changes") {
		$id = $_GET['id'];
		$sql = "UPDATE USER SET Fname = '". $_POST["first_name"] ."', Lname = '". $_POST["last_name"] ."', Email = '". $_POST["email"] ."', Addr = '". $_POST["addr"] ."' WHERE ID = '". $id ."'";
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
				window.location.href='manage_user.php';
				</script>
			";
		}
	} else {
		echo "User Account Update Failed!";
	}
?>