<?php
// Session Area w/ Logout functions
session_start();
if(empty($_SESSION['email'] )){
header("Location: ../../../"); 
}else {
// Nothing 
}
// Important Variable
$email	=	$_SESSION['email'];

require 'database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$user = mysqli_fetch_array($query);

if(empty($user['global_profile'])) {
$gl_profile_no = '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS7iHlXLpEbuKcKXckB-xgwX8SgpAkkkEQiEg&usqp=CAU" alt="Profile Img" >';

}else {
$gl_profile_yes = '<img src="../../../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" alt="Profile Img"  >';
$gl_profile_yes_1 = '<div class="profile_nav_user" >
		<img src="../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" ></div>';
}

// TIME GREETING
/* This sets the $time variable to the current hour in the 24 hour clock format */
$time = date("H");
    /* Set the $timezone variable to become the current timezone */
$timezone = date("e");
    /* If the time is less than 1200 hours, show good morning */
if ($time < "12") {
	$goodmorning_au = 'Good Morning';
} else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
if ($time >= "12" && $time < "15") {
	$goodafternoon_au = 'Good Afternoon';
} else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
if ($time >= "15" && $time < "17") {
	$goodevening = 'Good Evening';
} else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
if ($time >= "17") {
	$goodnight_au = 'Sweet Dreams';
}

// Email Notifications
$query = mysqli_query($con,"SELECT COUNT(*) AS SUM FROM email_notifs WHERE receiver_email='".$email."' AND status='unread'");
while($result = mysqli_fetch_array($query))
$em_nf = $result['SUM'];
if(empty($em_nf)){
$no_email = 'mail_outline';
}else {
$got_email = 'mark_email_unread';
}

if(empty($_SESSION['email'])) {
$logged_nav_no= '<nav class="z-depth-0 white" id="nav" >
	<div class="nav-wrapper center" id="nvs" >
		<div class="nav-top-au" >
			<a href="/" ><img src="../assets/v1_lib/web_assets/icon/fav_nav.png" class="fav_nav left" >	</a>
			<a href="login/" class="right blue-text md-bd" style="margin-right:20px;" >LOGIN</a>
		</div>
    </div>
</nav><br>';

$logged_gd_no = '<div class="row" >
	<div class="col s12" id="pptd-81817" >
		<!--<span class="left profile_user" >
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR0RztmVgzR4qoy1UK_o--ZrI18U-w7j0ji6w&usqp=CAU" >
		</span>-->
		<span class="gd" >Goodmorning <span class="gd-name" ></span></span><br>
		<span class="blue-grey-text gd-3" >Tell us what would you like to eat today?</span>
	</div>
</div>';

}else {
$logged_nav_yes = '<nav class="z-depth-0 white">
	<div class="nav-wrapper center" >
		<div class="nav-top-au" >
			<a href="../" ><i class="material-icons left black-text" style="margin-left:15px;width:23px" >arrow_back_ios</i></a>
		</div>
    </div>
</nav>';

$logged_gd_yes = '<div class="row" >
	<div class="col s12" id="pptd-81817" >
		<span class="left profile_user" >
			'.$gl_profile_yes.''.$gl_profile_no.'
		</span>
		<span class="gd" >'.$goodmorning_au.''.$goodafternoon_au.''.$goodevening.''.$goodnight_au.' <span class="gd-name" >'.$user['firstname'].'</span></span><br>
		<span class="blue-grey-text gd-3" >Tell us what would you like to eat today?</span>
	</div>
</div>';
}
//

// Empty Session 
if(empty($_SESSION['email'])) {
$not_logged_au_1 = '<a href="login/" class="black-text" ><span class="right login" >Sign in</span></a>in';
$not_logged_au = '<ul id="slideout" class="sidenav white" >
<li><a class="subheader">Browse Categories</a></li>
<li><a href="" >Electronics & Devices</a></li>
<li><a href="" >Health and Household</a></li>
<li><a href="" >Foods</a></li>
<li><a href="" >Beauty Product</a></li>
<li><a href="" >Popular Now</a></li>
<li>
	<div class="divider" ></div>
</li>
</ul>';
}else {
if($user['account_type'] == "seller"){
$seller_au_sidenav = '
<li><a href="" ><i class="material-icons" >storefront</i>My store</a></li>
<li><a href="" ><i class="material-icons" >dashboard </i>Dashboard</a></li>
<li><a href="" ><i class="material-icons" >account_balance_wallet</i>Shop Revenue</a></li>
<li><a href="" ><i class="material-icons" >analytics</i>Shop Analytics</a></li>
<li><div class="divider" ></div><li>
';

}elseif($user['account_type'] == "driver"){

$query = mysqli_query($con,"SELECT COUNT(*) AS SUM FROM booking WHERE driver_email='".$email."' AND booking_status='unverified'");
while($result = mysqli_fetch_array($query))
$booking_ct = $result['SUM'];
if($booking_ct == "0"){

}else {
$live_notif_booking = '<span class="badge white-text green darken-1 notif_track_ul pulse" >'.$booking_ct.'</span>';
}
$driver_au_sidenav = '
<li><a href="" ><i class="material-icons" >dashboard</i>Dashboard</a></li>
<li><a href="dashboard/" ><i class="material-icons" >near_me</i>Booking list '.$live_notif_booking.' </li></a></li>
<li><div class="divider" ></div><li>
';
}
$logged_au = '<ul id="slideout" class="sidenav white" >
<li><div class="user-view">
      <div class="background">
        <img src="../assets/v1_lib/web_assets/static_image/user_background2.jpg">
      </div>
      <a href="profile/'.$user['username'].'">'.$gl_profile_yes_1.'</a>
      <a href="#name"><span class="white-text name">'.$user['username'].'</span></a>
      <a href="#email"><span class="white-text email">'.$user['email'].'</span></a>
    </div></li>
<li><a href="" ><i class= "material-icons" >home</i>Home</a></li>
<li><a href="profile/'.$user['username'].'" ><i class="material-icons" >&#xE87C;</i>My Account</a></li>
<li><a href="order/" ><i class="material-icons" >add_shopping_cart</i>Orders</a></li>
<li><div class="divider" ></div><li>
'.$seller_au_sidenav.''.$driver_au_sidenav.'
<li><a href="" ><i class="material-icons" >settings</i>Settings</a></li>
<li><a href="" ><i class="material-icons" >bug_report</i>Report a problem</a></li>
<li><a href="" ><i class="material-icons" >logout</i>Sign Out</a></li>
</ul>
';
}
// Confirm
if(isset($_POST['confirm']))
	{
	$confirm	=	"user_confirm";
	
	// update user data
	
	$result = mysqli_query($con, "UPDATE booking SET booking_status='$confirm' WHERE user_email='".$_SESSION['email']."'");

	mysqli_query($con,$sqli);

	header("Location: ../../../confirm_booking");
	}
?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["su7"]) && !empty($_GET["su7"])){

// Include Database Holder 
require_once ("database/database_lvl3.php");

	// Prepare a select statement
   $sql = "SELECT * FROM email_notifs WHERE email_token = '".$_GET["su7"]."'";
    
	$result = mysqli_query($con, $sql);   
   	if(mysqli_num_rows($result) == 1){
    		//Since the result set contains only one row, we don't need to use while loop 
      $row = mysqli_fetch_assoc($result);
                  		
  			// Retrieve individual field value
  			
  			$se_subject		=	$row['se_subject'];
			$se_title		=	$row['se_title'];
			$se_content		=	$row['se_content'];
			$se_date		=	$row['se_date'];
			$email_token	=	$row['email_token'];
			$receiver_email =	$row['receiver_email'];
			
			
			} else{
       		// URL doesn't contain valid id parameter. Redirect to error page
        	// header("location: error.php");
        	echo 'heheh';
        	exit();
    	}  
  		// Close connection
  		mysqli_close($con);

	} else{
    		// URL doesn't contain id parameter. Redirect to error page
    		// header("location: error.php");
    		echo 'geheh';
    		exit();
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
.dashboard {
    width: 85%;
    margin: auto;
}
@media (max-width: 1280px) {
    .dashboard {
        width: 100%;
    }
}
.dashboard .card {
    cursor:auto;
    border-radius:10px;
}
.dashboard .card .row {
    margin-bottom: 0;
}
.dashboard .card-stats-number {
    margin: 0;
    font-weight: bold;
}
.dashboard .icon {
    height: 140px;
    width:100px;
    border-bottom-left-radius:10px;
    border-top-left-radius:10px;
}
.dashboard .icon i {
    width: 100%;
    text-align: center;
    color: rgba(0,0,0,.25)
}
#loadingDiv {
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	width: 100%;
	background: rgba(0,0,0,0.75) url(../../../assets/v1_lib/web_assets/static_image/ios_preload.gif) no-repeat center center;
	background-size:15%;
	z-index: 10000;
}
.h1-au-9 {
	font-size:40px;
	font-weight:bolder;
}
.material-icons {
	vertical-align:middle;
}
</style>
<?php
include 'database/database_lvl4.php';
	
	$user_email		=	$_SESSION['email'];
	$status_now		=	"read";
    $sql = "UPDATE email_notifs SET status='$status_now' WHERE receiver_email='$user_email'";
    
    $conn->query($sql);
?>
<nav class="z-depth-0 white">
	<div class="nav-wrapper center" >
		<a href="../../email_notif/" >
			<span class="left svg" ><svg style="width:23px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,480C132.288,480,32,379.712,32,256S132.288,32,256,32s224,100.288,224,224S379.712,480,256,480z"/><path d="M292.64,116.8l-128,128c-6.204,6.241-6.204,16.319,0,22.56l128,128l22.56-22.72L198.56,256L315.2,139.36L292.64,116.8z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>
		</a>
		<a href="" class="brand-logo black-text" >Email</a>
    </div>
</nav><br>

<div class="container" >
	<span class="" style="font-size:20px" ><?php echo $se_title; ?></span><br>
	<span class="truncate" ><i class="material-icons" >subject</i> <?php echo $se_subject; ?></span><br>
	<span style="font-size:16px" ><?php echo $se_content; ?><br>
	
	<form action="" method="POST" >
		<input type="submit" value="Confirm" name="confirm" class="btn yellow darken-2 z-depth-0" >
	</form>
	<span class="truncate" >&mdash; <?php echo $se_date; ?></span>
</div>
</body>
</html>