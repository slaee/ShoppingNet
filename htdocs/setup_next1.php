<?php
// This is page of continue setup account.
// Session Area w/ Logout functions
session_start();
if(empty($_SESSION['email'])){
$_SESSION['lg-first-error'] = '<div class="ribbon red lighten-1" ><span><i class="material-icons" >error_outline</i> You must logged in first</span></div>';
header("Location: ../../");
}else {
// Nothing
}
require 'database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$user = mysqli_fetch_array($query);

if($user['seller_status'] == "verified"){
header("Location: ../../");
}else {
// Nothing
}
if(empty($user['photo_id'])){
header("Location: ../../../set_au2");
}elseif(empty($user['shop_name'])) {
// Nothing
}else {
header("Location: ../../../setup_done_seller/");
}
?>
<?php
// Updating user info
include 'database/database_lvl3.php'; 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['setup_done']))
{
	
	$shop_name	=	$_POST['shop_name'];
	$email = $_SESSION['email'];
	
	$select = mysqli_query($con, "SELECT * FROM user_info WHERE shop_name= '".$_POST['shop_name']."'") or exit(mysqli_error($connectionID));
	if(mysqli_num_rows($select)) {
	// exit('This shopname is already being used');
	$_SESSION['already_used_sn'] = '<div class="container ribbon lime lighten-4 black-text box" style="border-radius:6px" >
	Your shop name is already used<a onclick="wynBox();" class="black-text" ><span class="right" ><i class="material-icons" >close</i></span></a>
	</div><br>';
	}else {
	// update user data
	$result = mysqli_query($con, "UPDATE user_info SET shop_name='$shop_name' WHERE email='$email'");
	
	// Redirect to homepage to display updated user in list
	header("Location: ../../../setup_done_seller/");
	}
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
<?php include 'assets/v1_lib/web_assets/v1_mobile_test.css'; ?>
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
.global-scrollmenu {
	border-bottom:1px solid #ddd;
}
.global-scrollmenu-rest {
	border:none;
}
.listing-ca {
	margin-bottom:4px;
}
.h1-sx {
	color:rgba(100,100,100,0.9);
	font-family:'Helvetica Neue', sans-serif; 
	font-size:25px;
	letter-spacing:1px;
	line-height:1;
}
.browse-shop .brws {
	font-size:20px;
	font-weight:500;
	margin-left:15px;
}
.checked {
	color:darkgreen;
}
[data-role="context-feature"] {
	font-size:22px;
	vertical-align:middle;
	padding:10px;
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
    cursor:auto;
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
.h1-au-9 {
	font-size:40px;
	font-weight:bolder;
}
.search-au-new {
    background:#F2F3F8;
    width:100%;
    height:50px;
    font-size:17px;
    border-radius:10px;
    border:none;
    display:flex;
    flex-direction:row;
    align-items:center;
    vertical-align:middle;
}
.search-au-new input::placeholder {
	color:#777;
}
.global-scrollmenu {
	border:none;
}
#pptd-81817 {
	margin-top:-10px;
}
#pptd-81817 .gd {
	font-size:25px;
	font-weight:600;
	font-family:-apple-system;
	color:#333;
}
#pptd-81817 .gd-name {
	color:darkgreen;
}
#pptd-81817 .gd-3 {
	font-size:17px;
}
#nvs .fav_nav {
	width:40px;
	margin-top:10px;
}
#card-image {
	position: relative;
	width: 100%;
	height: 130px;
	overflow: hidden;
	border-radius:10px;
	pointer-events:none;
}
#card-image img {
	width:100%;
	height:auto;
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
	border-radius:6px;
}
#mdl-btm-au-p1  {
	height:300px;
	border-top-left-radius:30px;
	border-top-right-radius:30px;
}
#mdl-btm-au-p2  {
	height:300px;
	border-top-left-radius:30px;
	border-top-right-radius:30px;
}
#mdl-btm-au-p3  {
	height:300px;
	border-top-left-radius:30px;
	border-top-right-radius:30px;
}
#mdl-btm-au-sss {
	height:300px;
	border-top-left-radius:30px;
	border-top-right-radius:30px;
}
.input-is {
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
.input-is:focus {
	border:2px solid skyblue;
}
.input-texta-is {
	box-sizing: border-box;
	padding:5px;
	width:100%;
	height:70px;
	border-radius:4px;
	border:1px solid #ddd;
	outline:none;
	font-size:16px;
	text-decoration:none;
	margin-top:5px;
	transition:0.1s;
}
.input-texta-is:focus {
	border:2px solid skyblue;
}
.error {
	color:red;
}
</style>
<div class="center container" ><br>
	<i class="material-icons red-text text-lighten-1" style="font-size:123px;opacity:0.5" >unpublished</i><br>
	<span style="font-size:17px" >Set up your Shop Name, Your shop name will be see by anyone.</span>
</div><br>
<?php 
// Added on cart
echo $_SESSION['already_used_sn']; 
unset($_SESSION['already_used_sn']);
?>
<div class="row" >
	<div class="col s12" >
		<form action="" method="POST" name="set" enctype="multipart/form-data">
			<span class="md-bd blue-grey-text text-darken-2" >Shop Name</span><br>
			<input type="text" name="shop_name" placeholder="Flower Shop" class="browser-default input-is" value="<?php echo $shop_name; ?>" ><br><br>
			<input type="submit" name="setup_done" class="btm-con red lighten-2" >
		</form>
	</div>
</div>
<script type="text/javascript" src="../../assets/v1_lib/web_assets/material.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
}, "No space allowed, please enter valid shop name");


$("form[name='set']").validate({
   rules: {
      shop_name: {
  	    required: true,
 	     minlength: 7,
          noSpace: true
      }
   },
   messages: {
   shop_name: {
   required: "Please enter your Shop Name",
   minlength: "Enter atleast 7 characters"
   },
   },
  });
})
function wynBox() {
    document.getElementsByClassName("box")[0].style.display = 'none';
} 
</script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.js"></script>