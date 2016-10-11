<!-- check if password is valid -->
<script language=JavaScript>
function check() {
    var pass = document.signupform.password.value;
    var usr = document.signupform.username.value;
    var lowercase = 0;
    var uppercase = 0;
    var number = 0;
    if (!usr) {
        document.signupform.username.focus();
        window.alert("Username must not be empty!");
        return false;
    }
    if(pass.length < 4 || pass.length > 16) {
        document.signupform.password.focus();
        window.alert("Password should be 4-16 numbers or characters!");
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
            document.signupform.password.focus();
            window.alert("Password should include at least 1 Uppercase character!");
            return false;
        }
        if(0==number) {
            document.signupform.password.focus();
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
<title>Books Store Registration</title>
</head>
<div class="container">
    <form id="signup" action="regcheck.php" method="post" name="signupform">

        <div class="header">
        
            <h3>Sign Up</h3>
            
        </div>
        
        <div class="sep"></div>

        <div class="inputs">
        
            <input type="text" name="username" placeholder="Username" required="" autofocus />
        
            <input type="password" name="password" placeholder="Password" required=""/>
            
            <input type="password" name="confirm" placeholder="Confirm Password" required=""/>
            
            <input id="submit" type="Submit" name="Submit" value="Create your account" onclick="return check()">

            <a href="adminsignup.php" id="href">Admin?</a>

        </div>
    </form>
</div>
</body>
</html>

