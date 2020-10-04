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

}else {
header("Location: ../../setup_next1");
}
?>

<?php
include("database/database_lvl3.php");
define("MAX_SIZE", "10000");
if(isset($_POST['but_upload'])){
  $email = $_SESSION['email'];
  $temp = explode(".", $_FILES["file"]["name"]);
  $name = round(microtime(true)) . '.' . end($temp);
  $target_dir = "static/cdn/ids/cccs/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
     // Insert record
     $result = mysqli_query($con, "UPDATE user_info SET photo_id='$name' WHERE email='$email'");
     mysqli_query($con,$result);
	
     // Upload 
     move_uploaded_file($_FILES["file"]["tmp_name"], "static/cdn/ids/cccs/" . $name);
     header("Location: setup_next1");
     //move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

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
.error {
	color:red;
}
.custom-file-upload {
	border: 1px solid #aaa;
	border-radius:4px;
	display: inline-block;
	width:100%;
	height:50px;
	padding: 13px 12px;
	cursor: pointer;
	font-size:13px;
	transition:0.5s;
}
.custom-file-upload:hover {
	border:1px solid skyblue;
}
</style>
<div class="center" ><br>
	<i class="material-icons red-text text-lighten-1" style="font-size:123px;opacity:0.5" >unpublished</i><br>
	<span style="font-size:17px" >Open a store here at CebuSugo-Market is need to verify you first, Upload atleast 1 of your id.</span>
</div><br>

<div class="row" >
	<div class="col s12" >
		<form action="" method="POST" name="set" enctype="multipart/form-data">
			<span class="md-bd blue-grey-text text-darken-2" >Photo ID</span><br>
			<span class="black-text" style="font-size:13px" >ID's Include Voters Id, SSS Id, Postal Id, Pag-Ibig Id, Passport, Company Id, Make sure IDs visible Full Name and your image and more</span><br><br>
			<label for="file-upload-id" class="custom-file-upload" >
				<i class="material-icons" >insert_photo</i> Upload ID 
			</label>
			<input type="file" id="file-upload-id" name="file" accept="image/*" style="display:none" ><br><br>
			<input type="submit" value="Continue" name="but_upload" class="btm-con red lighten-2" >
		</form>
	</div>
</div>
<script type="text/javascript" src="../../assets/v1_lib/web_assets/material.js"></script>
<script type="text/javascript">
$(function() {
 $("form[name='set']").validate({
   rules: {
     file: {
       required: true,
     }
   },
   messages: {
     file: {
       required: "Please enter your photo id",
     },
   },
   
   // Make sure the form is submitted to the destination defined
   // in the "action" attribute of the form when valid
   submitHandler: function(form) {
     form.submit();
   }
 });
});
$('#file-upload-id').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-id')[0].files[0].name;
  $(this).prev('label').text(file);
});
</script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.js"></script>
<script type="text/javascript">
M.AutoInit();
</script>