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
            $query1_sql = "SELECT Usrname FROM ADMIN WHERE Usrname = '$_POST[username]'";
            $result1 = mysqli_query($conn, $query1_sql);
            $query2_sql = "SELECT Pin FROM PIN WHERE Pin = '$_POST[pin]'";
            $result2 = mysqli_query($conn, $query2_sql);   
            
            if (mysqli_num_rows($result1)) {
                echo "<script>alert('Username registered!'); 
                history.go(-1);</script>"; 
            }
            else if (mysqli_num_rows($result2)){
                $insert_sql = "INSERT INTO ADMIN(Usrname, Passwd) VALUES ('$_POST[username]','$_POST[password]')";
                if ($conn->query($insert_sql) === TRUE) {
                        $_SESSION['login_name'] = $_POST['username'];
                        echo "<script>
                        alert('New account created, click OK to go back to home...');
                        window.location.href='../admin_index.php';
                        </script>"; 
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Invalid PIN!'); 
                history.go(-1);</script>";
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