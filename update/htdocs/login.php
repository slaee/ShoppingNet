<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../");
    exit;
}
 
// Include config file
require_once "database/database_lvl2.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = '<div class="container" >
        <div class="ribbon-error red lighten-4 red-text" >
        <i class="material-icons red-text" style="vertical-align:middle" >error_outline</i> Please enter your email
        </div></div><br>';
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = '<div class="container" >
        <div class="ribbon-error red lighten-4 red-text" >
        <i class="material-icons red-text" style="vertical-align:middle" >error_outline</i> Please enter your password
        </div></div><br>';
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if email exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            
                            $refurl = isset($_POST['refurl']) ? base64_decode($_POST['refurl']) : '';
                            if (!empty($refurl)) {
                            header("Location:$refurl");
                            }else {
                            header("Location: ../");
                            }
                            
                            // Redirect user to welcome page
                            // header("location: ../");
                        } else{
                            // Display an error message if password is not valid
                            $notfound_top1 = '<div class="container" >
                            <div class="ribbon-error red lighten-4 red-text" >
                            <i class="material-icons red-text" style="vertical-align:middle" >error_outline</i> Incorrect Password
                            </div></div>';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $notfound_top2 = '<div class="container" >
                    <div class="ribbon-error red lighten-4 red-text" >
                    <i class="material-icons red-text" style="vertical-align:middle" >error_outline</i> No Account found with that email
                    </div></div>';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" prefix="og: http://ogp.me/ns#" class="no-js">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, initial-scale=1, user-scalable=no, shrink-to-fit=no"/>
	
	<meta name="og:title" content="Find things you loved with cebusugoako"/>
	<meta name="og:type" content="e-commerce"/>
	<meta name="og:url" content=""/>
	<meta name="og:image" content="https://images.unsplash.com/photo-1562967916-eb82221dfb92?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=666&q=80"/>
	<meta name="og:site_name" content="Cebu Sugo A-Ko"/>
	<meta name="og:description" content="Cebu Sugo-A ko serves as convenience among citizens who don't wanna spend too much time under the sun or get in the middle of a crowded groceries."/>
	
	<title>Find thing's you loved with Cebu Sugo A-Ko</title>
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<link rel="icon" type="image/png" sizes="64x64" href="assets/test2.png"/>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/v1_lib/web_assets/materialize.css" >
</head>
<body>
<style type="text/css">
.login-is {
	box-sizing: border-box;
	padding:5px;
	width:100%;
	height:55px;
	border-radius:4px;
	border:1px solid #ddd;
	outline:none;
	font-size:16px;
	text-indent:10px;
	text-decoration:none;
	margin-top:5px;
	transition:0.1s;
}
.login-is:focus {
	border:2px solid skyblue;
}
.password-is {
	position:relative;
	width:auto;
}
.toggle-password {
    position:absolute;
    display:inline;
    right:15px;
    transform:translate(0,-50%);
    top:50%;
    cursor:auto;
    background:#F7F7F7;
}
.signin-is {
	border:none;
	width:100%;
	padding:15px 32px;
	text-align:center;
	text-decoration:none;
	outline:none;
	display:inline-block;
	font-size:16px;
	font-weight:bolder;
	color:white;
	border-radius:6px;
}
.join {
	margin-top:20px;
}
.join a{
	color:darkgreen;
}
#nvs .fav_nav {
	width:40px;
	margin-top:10px;
}
#nvs .help {
	margin-right:15px;
	color:rgba(100,100,100,0.9);
}
#nvs .cookies {
	margin-right:15px;
	color:rgba(100,100,100,0.9);
}
.h2_q {	
	color:#333;
	font-weight:bolder;
	font-size:30px;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}
.ribbon-error {
	padding:10px;
	border-radius:5px;
}
</style>
<div class="navbar-fixed hide-on-med-only hide-on-large-only" id="nvs" >
<nav class="z-depth-0 white">
	<div class="nav-wrapper" >
		<img src="../assets/v1_lib/web_assets/icon/fav_nav.png" class="fav_nav" >
		<span class="right cookies" >Cookies</span>
    	<span class="right help" >Help Center</span>
    </div>
</nav>
</div>
<div class="center" >
	<h2 class="h2_q" >Account Login</h2>
</div><br>
<div class="container" >
<?php echo $notfound_top1; ?><?php echo $notfound_top2; ?>
<?php echo $account_created; ?><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" name="login" >
		<input type="hidden" name="refurl" value="<?php echo base64_encode($_SERVER['HTTP_REFERER']); ?>" />	
			<div class="errx" >
				<?php echo $email_err; ?>
				<?php echo $password_err; ?> 
			</div>
			<input type="email" name="email" placeholder="Enter your username" class="browser-default login-is" value="<?php echo $email; ?>" /><br><br>
			<span class="right" ><a href="" >Forgot Password</a></span><br>
			<div class="password-is" >
				<i toggle="#password-field" class="field-icon toggle-password far fa-eye-slash"></i>
				<input type="password" id="password-field" name="password" placeholder="Enter your password" class="browser-default login-is" name="password" value="" >
			</div><br><br>
			<input type="submit" name="login" value="Sign in" class="signin-is red accent-2" />
			<div class="center join" >
				<a href="../join/" >Registration an account</a>
			</div>
	</form>
</div>
<script type="text/javascript">
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<script type="text/javascript">
$(function() {
 $("form[name='login']").validate({
   rules: {
     email: {
       required: true,
       email: true
     },
     password: {
       required: true,
     }
   },
   messages: {
     password: {
       required: "Please provide a password",
	   errorClass:'error1',
     },
     email: "Please enter a valid email address",
   },
   
   // Make sure the form is submitted to the destination defined
   // in the "action" attribute of the form when valid
   submitHandler: function(form) {
     form.submit();
   }
 });
});
</script>
<script src="https://kit.fontawesome.com/ed7b051a0c.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.js"></script>