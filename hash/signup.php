<?php

require_once "config.php";
 

$email = $username = $password = "";
$username_err = $password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        
        $sql = "SELECT id FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
           
            $param_username = trim($_POST["username"]);
            
            
            if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "The username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

     if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        
        $sql = "SELECT id FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
           
            $param_email = trim($_POST["email"]);
            
            
            if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                	 $email_err = "The email is already taken.";
                	
                  
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
            	echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
              
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    $password = $_POST["password"];
    // Validate password strength
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 12){
    	echo "<script>alert('Password should be at least 12 characters in length and should include at least one upper case letter, one number, and one special character.!');</script>";

    } elseif(empty($email_err) && empty($username_err) && empty($password_err) ){
        
        
        $sql = "INSERT INTO user (email, username, password, salted) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssss", $param_email, $param_username, $param_password, $param_salted);
  
            function salt($email, $username) {
            $saltset = $email.$username;
            $randStringLen = 32;
            $randString = "";
            for ($x = 0;$x < $randStringLen;$x++) {
                $randString.= $saltset[mt_rand(0, strlen($saltset) - 1) ];
            }
            return $randString;
        }
        $param_salted =  salt($email, $username);
        $param_password = password_hash($pass . $salted, PASSWORD_DEFAULT);
 
             if(mysqli_stmt_execute($stmt)){
                 echo "<script>alert('Account Successfully Created');window.location.href='index.php';</script>";
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($link);
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="animate.css">
	<link rel="stylesheet" type="text/css" href="hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="select2.min.css">
	<link rel="stylesheet" type="text/css" href="util.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<style>
div {
  width: 300px;
  margin: auto;
}
.progress-bar {
  border-radius: 5px;
}
</style>
<script type="text/javascript">
    function isGood(password) {
      var password_strength = document.getElementById("password-text");

      //TextBox left blank.
      if (password.length == 0) {
        password_strength.innerHTML = "";
        return;
      }

      //Regular Expressions.
      var regex = new Array();
      regex.push("[A-Z]"); //Uppercase Alphabet.
      regex.push("[a-z]"); //Lowercase Alphabet.
      regex.push("[0-12]"); //Digit.
      regex.push("[$@$!%*#?&]"); //Special Character.

      var passed = 0;

      //Validate for each Regular Expression.
      for (var i = 0; i < regex.length; i++) {
        if (new RegExp(regex[i]).test(password)) {
          passed++;
        }
      }

      //Display status.
      var strength = "";
      switch (passed) {
        case 0:
        case 1:
        case 2:
          strength = "<h5 class='progress-bar bg-danger'><center>Weak</center></h5>";
          break;
        case 3:
          strength = "<h5 class='progress-bar bg-warning'><center>Medium</center></h5>";
          break;
        case 4:
          strength = "<h5 class='progress-bar bg-success' ><center>Strong</center></h5>";
          break;

      }
      password_strength.innerHTML = strength;

    }
</script>
<body style="background-color: gray;">
	
	<div class="limiter">
		<div style="margin-left: 33%;">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
							  <?php 
        if(!empty($username_err)){
            echo '<div class="alert alert-danger">' . $username_err . '</div>';
        }        
        ?>
        						  <?php 
        if(!empty($email_err)){
            echo '<div class="alert alert-danger">' . $email_err . '</div>';
        }        
        ?>
				 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					
					<span class="login100-form-title p-b-55">
						Register
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100 <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" type="text" name="username" value="<?php echo $username; ?>" placeholder="Username" required>
						<span class="invalid-feedback"><?php echo $username_err; ?></span>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-user"></span>
						</span>
					</div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100 <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" type="email" name="email" value="<?php echo $email; ?>" placeholder="EMAIL"/ >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" id="password" minlength="12" value="<?php echo $password; ?>" name="password" placeholder="PASSWORD" onkeyup="isGood(this.value)">
						<span class="invalid-feedback"><?php echo $password_err; ?></span>
						<small class="help-block" id="password-text"></small>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
					

					<div class="text-center w-full p-t-115"  style="padding-top: 5px;">
						<span class="txt1">
							Already have an account?
						</span></div>

						<div><a class="btn btn-primary" href="index.php" style="width: 350px;">
							Login							
						</a></div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="jquery-3.2.1.min.js"></script>
	<script src="popper.js"></script>
	<script src="bootstrap.min.js"></script>
	<script src="select2.min.js"></script>
	<script src="main.js"></script>

</body>
</html>