<?php
$db = new mysqli('localhost','root','','id20063826_haltsaltpepper');
if($db->connect_error){
   die("Connection Failed: " . $db->connect_error);
}


    if(isset($_POST['email']) && isset($_POST['pass'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        
        $query = mysqli_query($db, "SELECT * FROM `user` WHERE `email` = '$email'");
        $res = $query->fetch_array(MYSQLI_ASSOC);
        $row_cnt = $query->num_rows;
        if($row_cnt == 1){
            $salt = $res['salted'];
            $password = $res['password'];
            $name = $res['username'];
            $passwodrver = password_verify($pass . $salt, $password);
            if($passwodrver){
                echo '<script language="javascript">';
                echo 'alert("Welcome, '.$name.'!")';
                echo '</script>';
            }else{
               echo '<script language="javascript">';
                echo 'alert("Welcome, '.$name.'!")';
                echo '</script>';
            }
        }   else{
                echo '<script language="javascript">';
                echo 'alert("Try Again! Invalid username and password!")';
                echo '</script>';
        } 

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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
		<div style="margin-left: 33%; padding-top: 10px;">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form class="login100-form validate-form" method="POST" action="#">
					
					<span class="login100-form-title p-b-55">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="EMAIL">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" minlength="12" id="password" name="pass" placeholder="PASSWORD" onkeyup="isGood(this.value)" required />
						<small class="help-block" id="password-text"></small>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<button class="btn btn-danger" style="width: 350px; " >
							Login
						</button>
					</div>


					

					<div class="text-center w-full p-t-115" style="padding-top: 5px;">
						<span class="txt1">
							Doesn't have an account?
						</span>
					</div> <br>
						
						<div ><a class="btn btn-success" href="signup.php" style="width: 350px;" >
							Register							
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