<?php
    session_start();

    include_once "../helper/dbconn.php";

    if(isset($_POST["Submit"]) && $_POST["Submit"] == "Create your account")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        $psw_confirm = $_POST["confirm"];  
         
        if($psw == $psw_confirm)  
        {
            $query_sql = "SELECT Usrname FROM USER WHERE Usrname = '$_POST[username]'";
            $result = mysqli_query($conn, $query_sql);  
            if (mysqli_num_rows($result)) {
                echo "<script>alert('Username registered!'); 
                history.go(-1);</script>";  
            } else {
                $time = date('Y-m-d H:i:s');
                $insert_sql = "INSERT INTO USER(Usrname, Passwd, Created) VALUES ('$_POST[username]', '$_POST[password]', '$time')";
                if ($conn->query($insert_sql) === TRUE) {
                        $_SESSION['login_name'] = $_POST['username'];
                        $_SESSION['login_id'] = $conn->insert_id;
                        echo "<script>
                        alert('New account created, click OK to go back to home...');
                        window.location.href='../index.php';
                        </script>"; 
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }  
        else  
        {  
            echo "<script>alert('Passwords must match!'); 
            history.go(-1);</script>"; 
        }  
        
    }  
    else  
    {  
        echo "Submission failed!";  
    }
?> 