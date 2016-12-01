<?php
session_start();
include_once "../helper/dbconn.php";
if(isset($_POST["Submit"]) && $_POST["Submit"] == "Sign in") {
$user = $_POST["username"];  
$psw = $_POST["password"]; 
$chk = $_POST["checky"];
if ($chk) {
        $_SESSION['admin_chk'] = $chk;
	$sql = "SELECT Usrname FROM ADMIN WHERE Usrname = '$_POST[username]' AND Passwd = '$_POST[password]'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)) {
                $_SESSION['login_name'] = $_POST['username'];
		echo "<script>
			alert('Login successfully, click OK to continue...');
			window.location.href='../admin_index.php';
			</script>";
	} else {
		echo "<script>
			alert('Login failed, username or password does not match, click OK to continue...');
			window.location.href='login.php';
			</script>";
	}
} else {
        $sql = "SELECT ID, Usrname FROM USER WHERE Usrname = '$_POST[username]' AND Passwd = '$_POST[password]'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
                        $_SESSION['login_name'] = $row['Usrname'];
                        $_SESSION['login_id'] = $row['ID'];
                }
                echo "<script>
                        alert('Login successfully, click OK to continue...');
                        window.location.href='../index.php';
                        </script>";
        } else {
                echo "<script>
                        alert('Login failed, username or password does not match, click OK to continue...');
                        window.location.href='login.php';
                        </script>";
        }
}
} else {
	echo "Submission failed!";
}
?>