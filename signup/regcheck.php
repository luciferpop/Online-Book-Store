<?php
    include_once "../dbconn.php";

    if(isset($_POST["Submit"]) && $_POST["Submit"] == "Create Your Account")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        $psw_confirm = $_POST["confirm"];  
         
        if($psw == $psw_confirm)  
        {
            $query_sql = "SELECT Usrname FROM USER WHERE Usrname = '$_POST[username]'";
            $result = mysqli_query($conn, $query_sql);  
            if (mysqli_num_rows($result)) {
                echo "Username registered!";
            } else {
                $insert_sql = "INSERT INTO USER(Usrname, Passwd) VALUES ('$_POST[username]','$_POST[password]')";
                if ($conn->query($insert_sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }  
        else  
        {  
            echo "Passwords must match!";  
        }  
        
    }  
    else  
    {  
        echo "Submission failed!";  
    }
?> 