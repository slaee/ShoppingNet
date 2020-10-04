<?php
// Session Area
session_start();
if(empty($_SESSION['email'])){
$_SESSION['lg-first-error'] = '<div class="ribbon red lighten-1" ><span><i class="material-icons" >error_outline</i> You must logged in first</span></div>';
header("Location: ../../../../");
}else {
// Nothing
}
?>

<?php
// Check existence of id parameter before processing further
if(isset($_GET["su6"]) && !empty($_GET["su6"])){

// Include Database Holder 
require_once ("../database/database_lvl3.php");

	// Prepare a select statement
   $sql = "SELECT * FROM booking WHERE booking_id = '".$_GET["su6"]."'";
    
	$result = mysqli_query($con, $sql);   
   	if(mysqli_num_rows($result) == 1){
    		//Since the result set contains only one row, we don't need to use while loop 
      $row = mysqli_fetch_assoc($result);
                  		
  			// Retrieve individual field value
  			
  			$driver_email		=	$row['driver_email'];
  			$user_email_au		=	$row['user_email'];
  			$booking_type		=	$row['booking_type'];
  			$booking_details	=	$row['booking_details'];
  			$booking_note		=	$row['booking_note'];
			$booking_status		=	$row['booking_status'];
			} else{
       		// URL doesn't contain valid id parameter. Redirect to error page
        	// header("location: error.php");
        	echo 'Something went wrong CODE [WYN 201]';
        	exit();
    	}  
  		// Close connection
  		mysqli_close($con);

	} else{
    		// URL doesn't contain id parameter. Redirect to error page
    		// header("location: error.php");
    		echo 'Something went wrong CODE [WYN 202]';
    		exit();
}

if($booking_status == "confirm"){
header("Location: ../");
}else {
// Nothing
}
require '../database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$driver_email' ") or die(mysqli_error());
$driver = mysqli_fetch_array($query);

require '../database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$row[user_email]'") or die(mysqli_error());
$fetch_1 = mysqli_fetch_array($query);

$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$user_email_au'") or die(mysqli_error());
$user = mysqli_fetch_array($query);

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['confirm']))
{
	$booking_status =	$_POST['booking_status'];
	$user_email		=	$user_email_au;
	$driver_email	=	$driver_email;
	$se_title		= 	"Confirm your booking";
	$se_subject		= 	"Booking from ".$driver['firstname']."";
	$se_content		=	"Hi maam & sir thanks for booking Please confirm your booking by clicking confirm button below thanks. ";
	$email_token	=	$_POST['email_token'];
	
	// update user data
	$result = mysqli_query($con, "UPDATE booking SET booking_status='$booking_status' WHERE user_email='$user_email'");
	
	$sqli = mysqli_query($con, "INSERT INTO email_notifs (email_token, sender_email, receiver_email, se_title, se_subject, se_content)
	VALUES ('$email_token', '$driver_email', '$user_email', '$se_title', '$se_subject', '$se_content')");
	
	mysqli_query($con,$sqli);
/* Dont remove all comment / comment is important backup for me */

/*	INSERT INTO email_notifs (sender_email, receiver_email, se_title, se_subject, se_content, )
	VALUES ('$driver_email', '$user_email', 'Confirm Booking', 'Booking', 'Click below if you confirm')");*/
	
	// Redirect to homepage to display updated user in list
	header("Location: ../");

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
	
	<script type="text/javascript" src="../../../assets/v1_lib/web_assets/jquery.min.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
	$('.search-box input[type="text"]').on("keyup input", function(){
	/* Get input value on change */
	var inputVal = $(this).val();
	var resultDropdown = $(this).siblings(".result");
	if(inputVal.length){
	$.get("cds.php", {term: inputVal}).done(function(data){
	// Display the returned data in browser
	resultDropdown.html(data);
	});
	} else{
	resultDropdown.empty();
	}
	});
	
	// Set search input value on click of result item
	$(document).on("click", ".result p", function(){
	$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
	$(this).parent(".result").empty();
	});
	});
	</script>
	<link rel="icon" type="image/png" sizes="64x64" href="assets/test2.png"/>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../assets/v1_lib/web_assets/materialize.css" >
</head>
<body class="hide-on-med-only hide-on-large-only" >
<style type="text/css">
body {
	background:#F3F4F4;
}
.nav-wrapper {
	border-bottom:1.5px solid #ddd;
}
.nav-wrapper .brand-logo {
	font-size:17px;
}
.nav-wrapper input[type="submit"] {
	margin-top:14px;
	margin-right:10px;
	font-size:14px;
	font-weight:bold;
	border:none;
	background:transparent;
	height:30px;
}
.nav-wrapper .svg {
	margin-top:7px;
	margin-left:10px;
}
.md-bd {
	font-weight:500;
}
.title-size {
	font-size:20px;
}
.desc-size {
	font-size:16px;
}
.h1-au-9 {
	font-size:40px;
	font-weight:bolder;
}
.profile_user {
	position:relative;
	width:100px;
	height:100px;
	overflow:hidden;
	border-radius:50%;
	vertical-align:middle;
}
.profile_user img{
	width:100%;
	height:auto;
	vertical-align:middle;
}
.user_nm {
	font-size:30px;
	font-weight:500;
}
.material-icons {
	vertical-align:middle;
}
.mg-top {
	margin-top:20px;
}
.cdt-btn {
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
</style>
<div class="navbar-fixed" >
<nav class="z-depth-0 white">
	<div class="nav-wrapper center" >
		<a href="../../../../" >
			<span class="left svg" ><svg style="width:23px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,480C132.288,480,32,379.712,32,256S132.288,32,256,32s224,100.288,224,224S379.712,480,256,480z"/><path d="M292.64,116.8l-128,128c-6.204,6.241-6.204,16.319,0,22.56l128,128l22.56-22.72L198.56,256L315.2,139.36L292.64,116.8z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>
		</a>
		<a href="" class="brand-logo black-text" > Status </a>
		<span class="right" >
			<i class="material-icons black-text" style="margin-right:10px" >report</i>
    	</span>
    </div>
</nav>
</div><br>
<?php 
if($booking_status == "user_confirm"){
$booking_ct	= "Confirmed by user";
}elseif($booking_status == "confirm") {
$booking_ca	= "Not Confirmed";
}else {
$booking_us = "Not Confirm Error[3032]";
}
?>
<div class="row" >
	<div class="col s8" >
		<span class="user_nm" ><?php echo $fetch_1['firstname']. ' '. $fetch_1['lastname'];?></span><br>
	</div>
	<div class="col s12 mg-top" >
		<span class="md-bd title-size blue-grey-text text-darken-2" >Status</span><br>
		<span class="desc-size" ><?php echo $booking_ct . '' .$booking_ca. '' .$booking_us; ?></span><br><br>
<span class="md-bd title-size blue-grey-text text-darken-2" >Booking Details</span><br>
		<span class="desc-size" ><?php echo $booking_details; ?></span><br><br>
		
		<span class="md-bd title-size blue-grey-text text-darken-2" >Booking Note</span><br>
		<span class="desc-size" ><?php echo $booking_note;?></span><br><br>
		
		<span class="md-bd title-size blue-grey-text text-darken-2" >Estimated Price</span><br>
		<span class="desc-size" >&#8369;20</span><br><br>
		
		<span class="md-bd mg-top title-size blue-grey-text text-darken-2" >Distance</span><br>
		<span class="desc-size" >&mdash; 1km</span><br><br>
		
		<span class="md-bd title-size blue-grey-text text-darken-2" >Address 1</span><br>
		<span class="desc-size" ><?php echo $user['address']; ?></span><br><br>
		
		<span class="md-bd title-size blue-grey-text text-darken-2" >Address 2</span><br>
		<span class="desc-size" ><?php echo $user['address_2']; ?></span><br><br>
	</div>
	<?php
	function randomNumber($length) {
	$result = '';
	for($i = 0; $i < $length; $i++) {
	$result .= mt_rand(0, 9);
	}
	return $result;
	}
	?>
	<div class="col s6" >
	<form action="" method="POST" enctype="multiparty/form-data">
		<input type="submit" name="" class="cdt-btn red accent-2" value="Send Receipt" >
	</form>
	</div>
	<div class="col s6" >
	<form action="" method="POST" enctype="multiparty/form-data">
		<input type="submit" name="" class="cdt-btn red accent-2" value="Cancel" >
	</form>
	</div>
</div>