<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../../");
    exit;
}
?>
<?php
// Include Database Holder
require_once "database/database_lvl1.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $fname = $lname = $email = $account_type = $address = "";
$username_err = $password_err = $confirm_password_err =  $fname_err = $lname = $email = $account_type = $address = "";
 
//Validate Form Data
function validate_data($data){
	$data = strip_tags($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
	// Validate username
   if(empty(trim($_POST["username"]))){
   	$username_err = "Please enter a username.";
	} elseif (!filter_var($_POST['username'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")))){
		$username_err = "Only letters and numbers are allowed";
	} else{
			// Prepare a select statement
     	$sql = "SELECT id FROM users WHERE username = ?";
        
			if($stmt = mysqli_prepare($conn, $sql)){
     		// Bind variables to the prepared statement as parameters
       mysqli_stmt_bind_param($stmt, "s", $param_username);
            
      	// Set parameters
       $param_username = validate_data($_POST["username"]);
            
       // Attempt to execute the prepared statement
       if(mysqli_stmt_execute($stmt)){
      		/* store result */
        	mysqli_stmt_store_result($stmt);
                
        	if(mysqli_stmt_num_rows($stmt) == 1){
        		$username_err = "This username is already taken.";
        	} else{
          	$username = validate_data($_POST["username"]);
							$username_accept = "Walang katulad ang username mo";
					}

      	} else{
         	echo "Oops! Something went wrong. Please try again later.";
     		}

       // Close statement
       mysqli_stmt_close($stmt);

       }

    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
       $confirm_password = trim($_POST["confirm_password"]);
       if(empty($password_err) && ($password != $confirm_password)){
      		$confirm_password_err = "Password did not match.";
       }
    }	
    	
    // Account Type
	if(empty($_POST["account_type"])){
		$acc_type_err = "Please select account type";
	} else {
		if(!filter_var($_POST['account_type'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		$acc_type_err = "Only letters and white spaced allowed";
	} else {
		$account_type = validate_data($_POST["account_type"]);
	}
		
	}
	
	// Firstname
	if(empty($_POST["fname"])){
		$fname_err = "Firstname is empty";
	} else {
		if(!filter_var($_POST['fname'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			$fname_err = "Only letters and white spaced allowed";
		} else {
			$fname = validate_data($_POST["fname"]);
		}
	}

	// Lastname
	if(empty($_POST["lname"])){
		$lname_err = "Lastname is empty";
	} else {
		if(!filter_var($_POST['lname'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			$lname_err = "Only letters and white spaced allowed";
		} else {
			$lname = validate_data($_POST["lname"]);
		}
	}
		
	// Address
	if(empty($_POST["address"])){
		$address_err = "error";
	} else {
		$address = $_POST["address"];
	}

	// Email	
	if(empty($_POST["email"])){
		$email_err = "Email is empty";
	} else {
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$email_err = "Invalid Email Format";
	} else {
		$email = validate_data($_POST["email"]);
	}
	}	
	
	// Prepare a select statement
		$sql = "SELECT id FROM users WHERE email = ?";
		
		if($stmt = mysqli_prepare($conn, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "s", $param_email);
		
		// Set parameters
		$param_email = validate_data($_POST["email"]);
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
		/* store result */
		mysqli_stmt_store_result($stmt);
		
		if(mysqli_stmt_num_rows($stmt) == 1){
		$email_err = "This email already use";
		} else{
		$email = validate_data($_POST["email"]);
		$email_accept = "";
		}
		
		} else{
		echo "Oops! Something went wrong. Please try again later.";
		}
		}
		     		
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($fname_err) && empty($lname_err) && empty($email_err)){
        
    		// Prepare an insert statement to users table
     	$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
         
     		if($stmt = mysqli_prepare($conn, $sql)){
       		// Bind variables to the prepared statement as parameters
        	mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            
        	// Set parameters
       		$param_username = $username;
       		$param_email = $email;
        	$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
 							
					mysqli_stmt_execute($stmt);

				}

		// Prepare an insert statement to user_info table
    	$sql = "INSERT INTO user_info (username, firstname, lastname, email, account_type, address) VALUES (?, ?, ?, ?, ?, ?)";
         
    		if($stmt = mysqli_prepare($conn, $sql)){
      	// Bind variables to the prepared statement as parameters
       mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_firstname, $param_lastname, $param_email, $param_account_type, $param_address,);
            
       		// Set parameters
					$param_username 	= $username;
					$param_firstname	= $fname;
					$param_lastname		= $lname;
					$param_email 		= $email;
					$param_account_type = $account_type;
					$param_address		= $address;
					
					
					
        	// Attempt to execute the prepared statement
        	if(mysqli_stmt_execute($stmt)){
        		// Redirect to login page
        		$ui_d = uniqId();
          header("location: ../../login/?account_status=created&new_ref_subject=".$ui_d."_st_mp");
     		} else {
         	echo "Something went wrong. Please try again later.";
    		}
     	// Close statement
     	mysqli_stmt_close($stmt);
   	}
 
	}   
   // Close connection
	mysqli_close($conn);
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
.join-is {
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
.join-is:focus {
	border:2px solid skyblue;
}
.join-is::placeholder {
	color:#888;
}
.join-is-mg {
	margin-top:15px;
}
.join {
	margin-top:20px;
}
.join a{
	color:darkgreen;
}
.join-now {
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
.nb_btm {
	clear: both;
    position: relative;
    height: 90px;
    margin-top: 190px;
}
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
}
.label-form-au {
	font-weight:500;
	font-size:15px;
	letter-spacing:0.6px;
}
.footer-text-1 {
	font-size:12px;
	color:rgba(100,100,100,0.5);
}
.ribbon-error {
	padding:10px;
	border-radius:5px;
}
#account_selector {
	border-radius:4px;
	outline:none;
}
#account_selector:hover {
	border:2px solid skyblue;
	color:#888;
}
#account_selector {
	color:#888;
}
.hr_au {
	margin-top:30px;
	margin-bottom:30px;
	border:0.5px solid #ddd;
}
#svg_au_x1 {
	z-index:-1;
	position:absolute;
	top:0;
}
#svg_au_b1 {
	width:30px;
}
[type="checkbox"].filled-in:checked + span:not(.lever):after {
	transition:0.2s;
}
#seller {
	margin-top:20px;
}
.seller_agree {
	background:#F3F4F5;
	border-radius:4px;
	border:1px solid #ddd;
	overflow:scroll;
	height:200px;
	padding:15px;
	text-align:justify;
}
.seller_agree .rules {
	text-align:left;
}
.error {
	color:red;
}
</style>
<div class="hide-on-med-only hide-on-large-only" id="nvs" >
<nav class="z-depth-0 transparent">
	<div class="nav-wrapper" >
		<img src="../assets/v1_lib/web_assets/icon/fav_nav.png" class="fav_nav" >
		<span class="right cookies" >Cookies</span>
    	<span class="right help" >Help Center</span>
    </div>
</nav>
</div>
<svg id="svg_au_x1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#F3F4F5" fill-opacity="1" d="M0,224L80,202.7C160,181,320,139,480,149.3C640,160,800,224,960,229.3C1120,235,1280,181,1360,154.7L1440,128L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
<div class="center" >
	<h2 class="h2_q" >Create Account</h2>
</div><br>
<div class="row" >
<div class="container" >
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" name="join" >
		<input type="text" name="fname" id="firstname" placeholder="First name" class="browser-default join-is" value="<?php echo $fname; ?>" />
		<div class="error" ></div><span class="error"><?php echo $fname_err; ?></span>
		<input type="text" name="lname" id="lastname" placeholder="Last name" class="browser-default join-is join-is-mg" value="<?php echo $lname; ?>" >
		<div class="error" ></div><span class="error"><?php echo $lname_err; ?></span><br><br><br>
		
		<span class="label-form-au blue-grey-text text-darken-1" >Address</span>
		<input type="text" name="address" class="browser-default join-is" placeholder="Address" value="<?php echo $address; ?>" >
		<div class="error" ></div><span class="error"><?php echo $address_err; ?></span><hr class="hr_au" >
		<input type="email" name="email" id="email" placeholder="name@example.com" class="browser-default join-is" value="<?php echo $email; ?>" />
		<div class="error" ></div><span class="error"><?php echo $email_err; ?></span>
		<input type="text" name="username" id="username" placeholder="Username" class="browser-default join-is join-is-mg" style="text-transform:lowercase" value="<?php echo $username; ?>" />
		<div class="error" ></div><span class="error"><?php echo $username_err; ?></span>
		<input type="password" name="password" id="password" placeholder="Enter your password" class="browser-default join-is join-is-mg" value="<?php echo $password; ?>" />
		<div class="error" ></div><span class="error"><?php echo $password_err; ?></span>
		<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" class="browser-default join-is join-is-mg" />
		<div class="error" ></div><span class="error"><?php echo $confirm_password_err; ?></span><br>
		<hr class="hr_au" >
		<input type="hidden" name="refurl" value="<?php echo base64_encode($_SERVER['HTTP_REFERER']); ?>" />
		
		<select id="account_selector" name="account_type" class="browser-default join-is" >
			<option selected="selected" value="user">User (default)</option>
			<option value="seller" >Seller &mdash; Shop Account</option>
			<option value="driver" >Driver &mdash; Driver's Account</option>
		</select>
		<label>This is your Account type</label><br>
		<div id="seller" class="acc_selected" style="display:none" >
			<b>&#9432; Shop Account</b>
			<div class="seller_agree" >
				<p>Before you start selling, make sure that your mobile number and email address is verified. Also, check if the product you intend to sell is not under our <a href="" >Prohibited Items</a> List. You can see below the steps how to create your own shop.<br><br>
				<b>A.</b> Create an account, Complete the form make sure your details you provide is correct.<br>
				<b>B.</b> After you complete the registration form you will redirect at homepage before you start uploading items you need to verified your account.<br>
				<b>C.</b> Upload atleast 1 valid IDs and proof of selling, this process will be take up to 1-2 business day.<br>
				<b>D.</b> Wait until your account is verified, Happy Selling</p><br><br>
				<b>Selling code and conduct</b>
				<p>CebuSugoMarket enables you to reach thousand of customer around Cebu Region, We strive to ensure a fair and trustworthy buyer and seller experience. You can see below the Violation of the code of conduct principles may result in the loss of your selling privileges and removal from CebuSugo Market Place</p>
				<span class="rules" >
					• Maintain current account information.<br>
					• Always act in a manner that ensures a trustworthy experience for CebuSugo customers.<br>
					• Never list products that may cause harm to CebuSugo customers.
				</span><br><br>
				<b>Suspended & Disabled Accounts</b>
				<p>
				Suspended &mdash; your account will be suspended if we detect your account have a unusual activity in short your account will be lock, you will receive an email how to unlock your account.<br>
				Disabled &mdash; if your account is disabled, you won't be able to log in. Please keep in mind that there are many reasons why an account might be disabled.<br>
				• Fake account information<br>
				• Listing prohibited items<br>
				• Violating Rules and Regulations<br>
				• Non-sense seller<br>
				</p>
			</div>
		</div><hr class="hr_au" >
		
		<label class="black-text" >
			<input type="checkbox" name="agree" class="filled-in" checked="checked" required="required" />
			<span>Get announcement, recommendations, trending products, and updates.</span>
		</label>
		<div class="join-is-mg" >
		<label class="black-text " >
			<input type="checkbox" name="agree" class="filled-in" checked="checked" required="required" />
			<span>Check here to indicate that you have read and agree to the terms of the <a href="" >CebuSugoMarket Customer Agreement</a></span>
		</label>
		</div>
		<hr class="hr_au" >
		<div class="center" >
		<svg id="svg_au_b1" viewBox="0 -9 418.94 418" xmlns="http://www.w3.org/2000/svg">
		<path d="m208.07 400.23c-14.594 0-29.18-2.9414-42.688-8.8164l-64.59-28.078c-23.367-10.164-48.074-16.602-73.434-19.137l-21.211-2.1211c-3.4922-0.34766-6.1484-3.2852-6.1484-6.793v-66.535c0-1.4766 0.48047-2.9141 1.3672-4.0938 1.5859-2.1211 39.602-51.785 97.672-38.863 32.66 7.2578 58.957 20.84 75.266 30.957 11.84 7.3438 25.719 11.223 40.137 11.223h64.59c11.133 0 20.918 5.8906 26.391 14.727l55.629-64.09c10.785-14.402 28.43-23.223 46.902-23.223h4.1562c2.3086 0 4.457 1.1641 5.7148 3.0938 1.2617 1.9297 1.4609 4.3711 0.53516 6.4805l-50.312 114.34c-11 25.008-33.398 43.898-59.91 50.527l-8.8516 2.2109-51.492 20.598c-12.672 5.0664-26.199 7.5898-39.723 7.5898zm-194.41-71.125 15.062 1.5078c26.77 2.6758 52.852 9.4766 77.523 20.203l64.586 28.078c22.711 9.875 48.902 10.262 71.898 1.0625l51.914-20.766c0.28906-0.11328 0.58203-0.20703 0.88281-0.28125l9.3008-2.3281c22.449-5.6133 41.414-21.605 50.723-42.777l45.891-104.29c-11.75 1.7305-22.562 8.0625-29.766 17.664l-61.625 71.023c0.007813 0.26563 0.011719 0.52734 0.011719 0.79688 0 17.105-13.918 31.023-31.023 31.023h-90.117c-11.715 0-23.293 1.8789-34.406 5.582l-2.5078-6.3672-2.1211-6.4883 0.34766-0.11328c12.473-4.1562 25.5-6.2695 38.688-6.2695h90.117c9.5742 0 17.371-7.793 17.371-17.371s-7.793-17.371-17.371-17.371h-64.59c-16.965 0-33.332-4.5898-47.332-13.273-15.406-9.5586-40.242-22.383-71.027-29.23-43.977-9.7539-75.621 23.996-82.426 32.047v57.941z"/>
		<path d="m268.87 193.84c-10.5 0-22.273-3.2422-35.234-9.7227-1.5703-0.78906-2.7812-2.1562-3.375-3.8086-0.52734-1.4805-12.727-36.57 6.6602-62.52 14.09-18.863 40.582-27.359 78.785-25.23 3.4844 0.19141 6.2617 2.9844 6.4336 6.4766 0.13672 2.7109 2.9531 66.699-29.676 88.004-6.9375 4.5352-14.82 6.8008-23.594 6.8008zm-26.527-20.68c17.934 8.4102 32.27 9.2344 42.66 2.4492 19.348-12.637 23.531-50.148 23.633-69.672-29.934-0.73047-50.312 6.0156-60.777 20.02-12.453 16.676-7.6133 39.613-5.5156 47.203z"/>
		<path d="m164.46 104.39c-12.105 0-26.07-2.5938-38.258-11.52-20.672-15.148-30.172-43.988-28.242-85.715 0.16406-3.4883 2.9297-6.293 6.418-6.5 2.9531-0.16797 72.852-3.8984 96.371 31.406 10.953 16.434 10.055 37.957-2.6602 63.984-0.77344 1.582-2.125 2.8047-3.7773 3.4102-0.91797 0.33984-13.734 4.9336-29.852 4.9336zm27.496-11.34h0.066407zm-80.559-78.961c-0.58984 33.422 7.0938 56.203 22.871 67.766 18.891 13.84 44.684 7.957 52.793 5.5938 9.2773-20.133 10.062-36.207 2.3281-47.816-14.375-21.578-56.531-25.797-77.992-25.543z"/>
		<path d="m217.78 279.22c-0.21484 0-0.42969-0.011719-0.64844-0.03125-3.6367-0.34375-6.3594-3.4883-6.1758-7.1406 0.40234-8.0312 1.0898-15.648 2.0234-22.867 2.8398-48.312 1.375-160.82-69.758-191.95-3.4531-1.5117-5.0312-5.5352-3.5195-8.9922 1.5078-3.4492 5.543-5.0234 8.9922-3.5156 41.918 18.34 68.289 64 76.246 132.04 0.71484 6.0977 1.25 12.109 1.6484 17.965 18.734-47.34 47.395-64.066 49.102-65.023 3.2812-1.8555 7.4453-0.67578 9.2969 2.6016 1.8398 3.2812 0.68359 7.4336-2.5859 9.2852-0.72266 0.42188-44.672 26.797-55.703 108.13-0.83984 13.914-2.0508 22.785-2.1641 23.598-0.47266 3.4062-3.3828 5.8906-6.7539 5.8906z"/>
		</svg>
		<p style="font-size:11px" >Your account information is used to allow you to sign in securely and access your data anywhere. CebusugoMarket collecting certain data for security, support, and reporting purposes.<br><a href="" >Learn more about collecting data</a></p>
		</div><br>
		<input type="submit" name="join" class="join-now red accent-2" value="Sign up" >
	</form>
</div>
</div>
<script type="text/javascript" src="../assets/v1_lib/web_assets/material.js" ></script>
<script type="text/javascript">
M.AutoInit()
</script>
<script type="text/javascript">
    $(function() {
        $('#account_selector').change(function(){
            $('.acc_selected').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>

<script type="text/javascript">
$(function() {
$("form[name='join']").validate({
	rules: {
	username: {
		required: true,
		minlength: 8
	},
	fname: "required",
	lname: "required",
	account_type: "required",
	shopname: "required",
	address: {
		required: true,
		minlength: 10
	},
	email: {
		required: true,
		email: true
	},
	password: {
		required: true,
		minlength: 8
	},
	confirm_password: {
		required: true,
		equalTo: "#password"
	},
	},
messages: {
	username: {
		required: "Please enter your username",
		minlength: "Please enter atleast 8 characters"
	},
     fname: "Please enter your firstname",
     lname: "Please enter your lastname",
     account_type: "Please select option",
     shopname: "Please enter your shopname",
     address: {
		required: "Please enter your home address",
		minlength: "Please correct your home address"
     },
     password: {
       required: "Please provide a password",
     },
     confirm_password: {
     	required: "Please confirm your password",
     	equalTo: "Your password not match"
     },
     email: {
     	required: "Please enter your email address",
     	email: "Please enter valid email address"
     }
   },
   // Make sure the form is submitted to the destination defined
   // in the "action" attribute of the form when valid
   submitHandler: function(form) {
     form.submit();
   }
 });
});
</script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.js"></script>