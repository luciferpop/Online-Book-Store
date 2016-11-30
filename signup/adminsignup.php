<!-- check if password is valid -->
<script language=JavaScript>
function check() {
    var pass = document.adminform.password.value;
    var usr = document.adminform.username.value;
    var lowercase = 0;
    var uppercase = 0;
    var number = 0;
    if (!usr) {
        document.adminform.username.focus();
        window.alert("Username must not be empty!");
        return false;
    }
    if(pass.length < 6 || pass.length > 18) {
        document.adminform.password.focus();
        window.alert("Password should be 6-18 numbers or characters!");
        return false;
    } else {
        for(var i = 0; i < pass.length; i++) {
            var asciiNumber = pass.substr(i, 1).charCodeAt();
            if(asciiNumber >= 48 && asciiNumber <= 57) {
                number += 1;
            }
            if(asciiNumber >= 65 && asciiNumber <= 90) {
                uppercase += 1;
            }

        }
        if(0==uppercase) {
            document.adminform.password.focus();
            window.alert("Password should include at least 1 Uppercase character!");
            return false;
        }
        if(0==number) {
            document.adminform.password.focus();
            window.alert("Password should include at least 1 number!");
            return false;
        }
    }
}
</script>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Book Store | Registration</title>
</head>
<div class="container">
    <form id="signup" action="admincheck.php" method="post" name="adminform">

        <div class="header">
        
            <h3>Administrator Sign Up</h3>
            
        </div>
        
        <div class="sep"></div>

        <div class="inputs">
        
            <input type="text" name="username" placeholder="Username" required="" autofocus />
        
            <input type="password" name="password" placeholder="Password" required=""/>
            
            <input type="password" name="confirm" placeholder="Confirm Password" required=""/>

            <input type="password" name="pin" placeholder="Enter your PIN" value="3421" required=""/>
            
            <input id="submit" type="Submit" name="Submit" value="Create your account" onclick="return check()">
            

        </div>

    </form>

</div>
</body>
</html>