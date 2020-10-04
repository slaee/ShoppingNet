<?php
// Session Area w/ Logout functions
session_start();
	if (isset($_GET['_user_logout_10020'])) {
	session_destroy();
	unset($_SESSION['email']);
	header("Location: ../../../ ");
}
if(empty($_SESSION)){
$_SESSION['lg-first-error'] = '<div class="ribbon red lighten-1" ><span><i class="material-icons" >error_outline</i> You must logged in first</span></div>';
header("Location: ../../../");
}else {
// Nothing
}
// Important Variable
$email	=	$_SESSION['email'];

require '../database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$user = mysqli_fetch_array($query);

if(empty($user['global_profile'])) {
$gl_profile_no = '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS7iHlXLpEbuKcKXckB-xgwX8SgpAkkkEQiEg&usqp=CAU" alt="Profile Img" >';

}else {
$gl_profile_yes = '<img src="../../../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" alt="Profile Img"  >';
$gl_profile_yes_1 = '<div class="profile_nav_user" >
		<img src="../../../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" ></div>';
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
if ($time >= "12" && $time < "14") {
	$goodafternoon_au = 'Good Afternoon';
} else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
if ($time >= "14" && $time < "17") {
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
$logged_nav_yes = '<div class="navbar-fixed" ><nav class="white" style="box-shadow: 0px 3px 5px rgba(0,0,0,0.1);" >
	<div class="nav-wrapper center" >
		<div class="nav-top-au" >
			<a href="#" data-target="slideout" class="white-text sidenav-trigger menu_bar" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20,7H4C3.4,7,3,6.6,3,6s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,7,20,7z"/><path d="M15.2,13H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h11.2c0.6,0,1,0.4,1,1S15.8,13,15.2,13z"/><path d="M20,19H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,19,20,19z"/></svg></a>
			<span class="left blue-grey-text text-darken-2 md-bd" >Confirm Booking</span>
		</div>
    </div>
</nav></div><br>';

$logged_gd_yes = '<div class="row" >
	<div class="col s12" id="pptd-81817" >
		<span class="left profile_user" >
			'.$gl_profile_yes.''.$gl_profile_no.'
		</span>
		<span class="gd" >Hey <span class="gd-name" >'.$user['firstname'].'</span></span><br>
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
<li><a href="my_store/'.$user['shop_name'].'" ><i class="material-icons" >storefront</i>My store</a></li>
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
<li><a href="driver_profile/" ><i class="material-icons" >dashboard</i>My Driver Profile</a></li>
<li><a href="" ><i class="material-icons" >dashboard</i>Dashboard</a></li>
<li><a href="dashboard/" ><i class="material-icons" >near_me</i>Booking list '.$live_notif_booking.' </li></a></li>
<li><div class="divider" ></div><li>
';
}
$logged_au = '<ul id="slideout" class="sidenav white" >
<li><div class="user-view">
      <div class="background">
        <img src="../../../assets/v1_lib/web_assets/static_image/user_background2.jpg">
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
<li><a href="?_user_logout_10020" ><i class="material-icons" >logout</i>Sign Out</a></li>
</ul>
';
}
?>
<?php
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['book_now']))
{
	$booking_details	=	$_POST['booking_details'];
	$booking_note		=	$_POST['booking_note'];
	$booking_type		=	$_POST['booking_type'];
	$driver_email		=	$_POST['driver_email'];
	$booking_id			=	$_POST['booking_id'];
	$user_email			=	$_SESSION['email'];
	
	$result = mysqli_query($con, "INSERT INTO booking (booking_details, booking_note, booking_type, driver_email, booking_id, user_email)
	VALUES ('$booking_details', '$booking_note', '$booking_type', '$driver_email', '$booking_id', '$user_email')");
	
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
	
	<link rel="icon" type="image/png" sizes="64x64" href="assets/test2.png"/>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../assets/v1_lib/web_assets/materialize.css" >
</head>
<body class="hide-on-med-only hide-on-large-only" >
<style type="text/css">
<?php include '../assets/v1_lib/web_assets/v1_mobile_test.css'; ?>
body{margin:0;padding:0;height:100%}.not_available {top:20px;}.not_available h2{font-size:40px;font-weight:500;}.suggested-product-image {position: relative;width: 100%; /* Depends On Size */height: 120px;overflow: hidden;border-bottom-left-radius:6px;border-bottom-right-radius:6px;border-top-left-radius:6px;border-top-right-radius:6px;}.suggested-product-image img{width:100%;height:auto;align-items:center}.suggest-card-img{border-radius:6px;border:1px solid #ddd}.ribbon{background:#5c258d;color:#fff;top:0;padding:15px}#global-fixed-img{height:120px}[data-role=popular-product-img]{position:relative;width:100%;height:120px;overflow:hidden;border-top-left-radius:6px;border-top-right-radius:6px}#popular-card[role=custom-card]{margin:0}#popular-card .card-content{padding:10px;margin-left:-10px}#popular-card .card-content #title{font-size:14px;font-weight:400}#popular-card .card-content #seller-name{font-weight:350}#popular-card .card-content #price{font-size:18px;font-weight:500;margin-top:-10px}.checked{color:#006400}[data-role=context-feature]{font-size:22px;vertical-align:middle;padding:10px}.notif_track_ul {border-radius:3em;}.container-track-content {font-size:16px;}
.profile_nav_user {
	position:relative;
	width:85px;
	height:85px;
	overflow:hidden;
	border-radius:50%;
}
.profile_nav_user img{
	width:100%;
	height:auto;
}
.profile_user {
	position:relative;
	width:30px;
	height:30px;
	overflow:hidden;
	border-radius:50%;
	vertical-align:middle;
	margin-right:10px;
}
.profile_user img{
	width:100%;
	height:auto;
	z-index:999;
	vertical-align:middle;
}
.nav-top-au .menu_bar {
	margin-right:10px;
	margin-left:10px;
}
.nav-top-au svg {
	width:23px;
	margin-top:15px;
	fill: black;
}
.nav-top-au .login {
	margin-right:10px;
	text-align:center;
	font-weight:500;
	color:#333;
	border-radius:2em;
}
.md-bd {
	font-weight:500;
}
.md-bold {
	font-weight:bold;
}
.mg-top {
	margin-top:50px;
}
.ribbon .title {
	font-size:18px;
}
#selector-ribbon {
	border:2px solid transparent;
	border-radius:10px;
	background:#f3f4f5;
	cursor:auto;
}
#selector-ribbon:hover {
	border:2px solid #333;
}
.choose-one-text {
	font-size:20px;
	font-weight:500;
}
.material-icons {
	vertical-align:middle;
}
.collection {
	border-radius:10px;
}
.listing-is {
	box-sizing: border-box;
	padding:5px;
	width:100%;
	height:50px;
	border-radius:4px;
	border:1px solid #aaa;
	outline:none;
	font-size:16px;
	text-indent:10px;
	text-decoration:none;
	margin-top:5px;
	transition:0.1s;
}
.listing-is::placeholder {
	font-size:13px;
}
.listing-is:focus {
	border:1px solid skyblue;
}
.btm-con {
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
	border-radius:10px;
}
.bottom-sheet {
	height:300px;
	border-top-left-radius:30px;
	border-top-right-radius:30px;
}
.modal-img {
	position:relative;
	width:85px;
	height:85px;
	overflow:hidden;
	border-radius:50%;
}
.modal-img img{
	width:100%;
	height:auto;
}
</style>
<?php
// Echo Nav
echo $logged_nav_no . '' . $logged_nav_yes; 
?>

<div class="container" >
	<span style="font-size:17px" >Driver you choose: <span class="green-text text-ligthen-1" ><?php echo $_POST['driver']; ?></span> </span><br>
	<span style="font-size:17px" >Feature you choose: <span class="green-text text-ligthen-1" ><?php echo $_POST['user_picktype']; ?></span> </span><br><br>
	<span style="font-size:17px;font-weight:500;" >Enter details to driver</span>
	<form action="" method="POST" name="booking" >
	<textarea name="booking_details" class="listing-is" style="height:90px" ></textarea><br><br>
	<span style="font-size:17px;font-weight:500;" >Note</span>
	<textarea name="booking_note" class="listing-is" style="height:90px" ></textarea><br>
	<?php
	function randomNumber($length) {
	$result = '';
	for($i = 0; $i < $length; $i++) {
	$result .= mt_rand(0, 9);
	}
	return $result;
	}
	?>
	<input type="hidden" name="booking_id" value="<?php echo randomNumber(16);?>" >
	<input type="hidden" name="booking_type" value="<?php echo $_POST['user_picktype']; ?>" >
	<input type="hidden" name="driver_email" value="<?php echo $_POST['driver_email']; ?>" >
	<input type="submit" name="book_now" value="Book Now" class="btm-con red lighten-2" />
	</form>
</div>
<script type="text/javascript">
$(function() {
 $("form[name='booking']").validate({
   rules: {
     booking_details: {
       required: true
     },
   },
   messages: {
     booking_details: "Please enter a booking details",
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