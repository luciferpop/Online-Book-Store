<?php 
	include_once "helper/dbconn.php";
	if(isset($_POST["submit"]) && $_POST["submit"] == "Save Changes") {
		$isbn = $_GET['isbn'];
		$sql = "UPDATE BOOK SET Category = '". $_POST["cate"] ."', Year = '". $_POST["year"] ."', PubName = '". $_POST["pub"] ."' WHERE ISBN = '". $isbn ."'";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			echo("Error description: " . mysqli_error($conn));
			echo "<script>
				alert('Update Failed!');
			</script>";
		} else {		
			echo "
				<script>
				alert('Book Info Successfully Updated!');
				window.location.href='manage_book.php';
				</script>
			";
		}
	} else {
		echo "Book Info. Update Failed!";
	}
?>