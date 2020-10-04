<?php

header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");

// Session Area w/ Logout functions
session_start();
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
		<img src="../../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" ></div>';
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
$logged_nav_no= '<div class="navbar-fixed" ><nav class="white" id="nav" style="box-shadow: 0px 3px 10px rgba(0,0,0,0.1);" >
	<div class="nav-wrapper center" id="nvs" >
		<div class="nav-top-au" >
			<a href="/" ><img src="../../../assets/v1_lib/web_assets/icon/fav_nav.png" class="fav_nav left" >	</a>
			<a href="login.php" class="right blue-text md-bd" style="margin-right:20px;" >LOGIN</a>
		</div>
    </div>
</nav></div><br>';

$logged_gd_no = '<div class="row" >
	<div class="col s12" id="pptd-81817" >
		<!--<span class="left profile_user" >
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR0RztmVgzR4qoy1UK_o--ZrI18U-w7j0ji6w&usqp=CAU" >
		</span>-->
		<span class="gd" >Welcome <span class="gd-name" ></span></span><br>
		<span class="blue-grey-text gd-3" >Tell us what would you like to eat today?</span>
	</div>
</div>';

}else {
$logged_nav_yes = '<div class="navbar-fixed" ><nav class="white" style="box-shadow: 0px 3px 5px rgba(0,0,0,0.1);" >
	<div class="nav-wrapper center" >
		<div class="nav-top-au" >
			<a href="#" data-target="slideout" class="white-text sidenav-trigger menu_bar" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20,7H4C3.4,7,3,6.6,3,6s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,7,20,7z"/><path d="M15.2,13H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h11.2c0.6,0,1,0.4,1,1S15.8,13,15.2,13z"/><path d="M20,19H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,19,20,19z"/></svg></a>
			<a href="email_notif/" ><i class="material-icons right black-text" style="margin-right:5px" >shopping_cart</i></a>
			<a href="" ><i class="material-icons right black-text" style=";width:23px" >notifications_none</i></a>
			<a href="email_notif/" ><i class="material-icons right black-text" style="margin-right:5px" >'.$no_email.''.$got_email.'</i></a>
		</div>
    </div>
</nav></div><br>';

$logged_gd_yes = '<div class="row" >
	<div class="col s12" id="pptd-81817" >
		<span class="left profile_user" >
			'.$gl_profile_yes.''.$gl_profile_no.'
		</span>
		<span class="gd" >What&apos;s up <span class="gd-name" >'.$user['firstname'].'</span></span><br>
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
<li><a href="../../../driver_profile/" ><i class="material-icons " >account_circle</i>My Driver Profile</a></li>
<li><a href="" ><i class="material-icons" >dashboard</i>Dashboard</a></li>
<li><a href="../../../dashboard/" ><i class="material-icons" >near_me</i>Booking list '.$live_notif_booking.' </li></a></li>
<li><a href="../../../email_notif/" ><i class="material-icons" >email</i>Emails</a></li>
<li><div class="divider" ></div><li>
';
}
// Cart Notification
$query = mysqli_query($con,"SELECT COUNT(*) AS SUM FROM cart_order WHERE email='".$email."'");
while($result = mysqli_fetch_array($query))
$cart_ct = $result['SUM'];
if($cart_ct == "0"){

}else {
$live_notif_cart = '<span class="badge white-text green darken-1 notif_track_ul " >'.$cart_ct.'</span>';
}

// User Sidenav
$logged_au = '<ul id="slideout" class="sidenav white" >
<li><div class="user-view">
      <div class="background">
        <img src="../../../assets/v1_lib/web_assets/static_image/user_background2.jpg">
      </div>
      <a href="../../../profile/'.$user['username'].'">'.$gl_profile_yes_1.'</a>
      <a href="#name"><span class="white-text name">'.$user['username'].'</span></a>
      <a href="#email"><span class="white-text email">'.$user['email'].'</span></a>
    </div></li>
<li><a href="" ><i class= "material-icons" >home</i>Home</a></li>
<li><a href="profile/'.$user['username'].'" ><i class="material-icons" >&#xE87C;</i>My Account</a></li>
<li><a href="../../../cart" ><i class="material-icons" >shopping_basket</i>My Cart '.$live_notif_cart.'</a></li>
<li><a href="../../../order/" ><i class="material-icons" >add_shopping_cart</i>Orders</a></li>
<li><div class="divider" ></div><li>
'.$seller_au_sidenav.''.$driver_au_sidenav.'
<li><a href="" ><i class="material-icons" >settings</i>Settings</a></li>
<li><a href="" ><i class="material-icons" >bug_report</i>Report a problem</a></li>
<li><a href="?_user_logout_10020" ><i class="material-icons" >logout</i>Sign Out</a></li>
</ul>
';
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
.ics {
	background:skyblue;
	width:80px;
	vertical-align:middle;
	text-align:center;
	padding:10px;
	border-radius:10px;
}
.ics .material-icons {
	align-content:center;
	font-size:30px;
	opacity:0.5;
}
.ics-content {
	align-items:center;
}
.card-content .title-au-1 {
	font-size:14px;
	font-weight:500;
}
.card-content .title-au-2 {
	font-size:30px;
	color: #7c795d;
	font-family: 'Trocchi', serif;
}
.pasugo-1716-font {
	font-size:40px;
	text-align:center;
	color: #7c795d;
	font-family: 'Trocchi', serif;
	padding-top:15px;
}
.shop_pr_user {
	position:relative;
	width:100px;
	height:100px;
	overflow:hidden;
	border: double 2px transparent;
	border-radius: 50%;
	background-image: linear-gradient(white, white), radial-gradient(circle at top left, #f00,#3020ff);
	background-origin: border-box;
	background-clip: content-box, border-box;
}
.shop_pr_user img{
	width:100%;
	height:auto;
}
.card {
	border-radius:6px;
	box-shadow: 0px 3px 15px rgba(0,0,0,0.1);
}
.card-image {
	position: relative;
	width: 100%;
	height: 120px;
	overflow: hidden;
	border-top-left-radius: 6px;
	border-top-right-radius: 6px;
	pointer-events:none;
}
.card-image img {
	width:100%;
	height:auto;
}
.card #card-content {
	padding: 10px;
	margin-top:-5px;
	margin-left: -5px;
}
#card-content .product-title {
	font-size:16px;
}
#card-content .ad-ct {
	margin-top:-5px;
}
#card-content .ad-ct .ad-17654 {
	font-size:12px;
	margin-top:-5px;
}
#card-content .price-gt span {
	font-size:19px;
	font-weight:500;
}
.browse-shop .brws {
	font-size:20px;
	font-weight:500;
	margin-left:15px;
}
.suggested-product-image {
	position: relative;
	width: 100%; /* Depends On Size */
	height: 120px;
	overflow: hidden;
	border-bottom-left-radius:6px;
	border-bottom-right-radius:6px;
	border-top-left-radius:6px;
	border-top-right-radius:6px;
}
.suggested-product-image img {
	width: 100%;
	height: auto;
	align-items:center;
}
.suggest-card-img {
	border-radius:6px;
	border:1px solid #ddd;
}
.ribbon {
	background: #5c258d;
	color: white;
	top: 0;
	padding: 15px;
}
#global-fixed-img {
	height:120px;
}
[data-role="popular-product-img"] {
	position: relative;
	width: 100%; /* Depends On Size */
	height: 120px;
	overflow: hidden;
	border-top-left-radius:6px;
	border-top-right-radius:6px;
}
#popular-card[role="custom-card"] {
	margin:0;
}
#popular-card .card-content {
	padding:10px;
}
#popular-card .card-content #title {
	font-size:14px;
	font-weight:400;
}
#popular-card .card-content #seller-name {
	font-weight:350;
}
#popular-card .card-content #price {
	font-size:18px;
	font-weight:500;
	margin-top:-10px;
}
.checked {
	color:darkgreen;
}
[data-role="context-feature"] {
	font-size:22px;
	vertical-align:middle;
	padding:10px;
}
.ics-ca {
	display: -webkit-flex;
}
.ics2 {
	background:skyblue;
	width:80px;
	vertical-align:middle;
	text-align:center;
	padding:10px;
	border-radius:10px;
	margin-right:25px;
}
.ics2 .material-icons {
	align-content:center;
	font-size:30px;
	opacity:0.5;
}
.ics-content {
	align-items:center;
}
</style>
<?php
echo $logged_nav_no . '' . $logged_nav_yes; 
?>
<div class="row" >
	<div class="col s12" >
		<form action="search.php?<?php echo $search; ?>" method="POST" class="z-depth-0 search-au-new" role="search" id="form">
		<input type="text" name="search" autocomplete="off" class="global-input-search browser-default z-depth-0" placeholder="Search for anything" arial-label="Search Something" autocomplete="off" style="width:100%" />
		<div class="result z-depth-1"></div>
		<button type="submit" name="submit" class="global-submit-search" >
		<svg class="global-svg" viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
		</button>
		</form>
	</div>
</div>

<div class="row" >
<?php
include 'database/database_lvl3.php';
$search_value=$_POST["search"];

if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }else {
        $sql="select * from products where product like '%$search_value%'";

        $res=$con->query($sql);

        while($row=$res->fetch_assoc()){
        
        $output_lvl1 = $row['retail_price'];
        $global_price_lvl1 = number_format( $output_lvl1 , 0 , '.' , ',' );
        
        echo '<div class="col s6" >
        <a href="listing/'.$row['rnd'].'" class="black-text" ><div class="card z-depth-1 hoverable" >
        <div class="card-image" >
        <img src="../../../static/cdn/products_new_rdr/'.$row['image1'].'" class="product-cd-us" >
        </div>
        <div class="card-content" id="card-content" >
        <div class="truncate" >
        <span class="blue-grey-text text-darken-4 product-title" >'.$row['product'].'</span>
        </div>
        <div class="ad-ct" >
        <span class="ad-17654 truncrate blue-grey-text text-lighten-1" >'.$ad_lvs.' '.$row['seller'].'</span>
        </div>
        <div class="price-gt" >
        <span>&#8369; '.$global_price_lvl1.'</span>
        </div>
        </div>
        </div></a>
        </div>';
        
      }
    }
?>
</div>
<?php 
$row = mysqli_num_rows($res); 
if ($row) 
{ 
$row;
}
?>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
  
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);
  });

  // Or with jQuery

  $('.dropdown-trigger').dropdown();
</script>
<script type="text/javascript">
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
   
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
 
     $('html, body').animate({scrollTop:0}, 'fast');
}
document.addEventListener('DOMContentLoaded', function() {
  var lazyImages = [].slice.call(document.querySelectorAll('img.lazy'));

  if ('IntersectionObserver' in window) {
    let lazyImageObserver = new IntersectionObserver(
      function(entries, observer) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            let lazyImage = entry.target;
            lazyImage.src = lazyImage.dataset.src;
            lazyImageObserver.unobserve(lazyImage);
          }
        });
    });

    lazyImages.forEach(function(lazyImage) {
      lazyImageObserver.observe(lazyImage);
    });
  }
  else {
    // For browsers that don't support IntersectionObserver yet,
    // load all the images now:
    lazyImages.forEach(function(lazyImage) {
      lazyImage.src = lazyImage.dataset.src;
    });
  }
});
var a0_0x2ac3=['style','.modal','length','carousel','getElementsByClassName','display','init','querySelectorAll','mySlides','ready','DOMContentLoaded','.carousel','left','.sidenav','addEventListener','Modal','none','Carousel','modal','Sidenav','block'];(function(_0x4e5f19,_0x2ac309){var _0x56604a=function(_0x5c7a4e){while(--_0x5c7a4e){_0x4e5f19['push'](_0x4e5f19['shift']());}};_0x56604a(++_0x2ac309);}(a0_0x2ac3,0x1ad));var a0_0x5660=function(_0x4e5f19,_0x2ac309){_0x4e5f19=_0x4e5f19-0x0;var _0x56604a=a0_0x2ac3[_0x4e5f19];return _0x56604a;};document[a0_0x5660('0x5')]('DOMContentLoaded',function(){var _0x2aa9ea=document['querySelectorAll'](a0_0x5660('0x4'));var _0x488e11=M[a0_0x5660('0xa')][a0_0x5660('0x12')](_0x2aa9ea,{'edge':a0_0x5660('0x3')});});document[a0_0x5660('0x5')](a0_0x5660('0x1'),function(){var _0x59e378=document['querySelectorAll'](a0_0x5660('0x2'));var _0x4645ec=M[a0_0x5660('0x8')][a0_0x5660('0x12')](_0x59e378,options);});$(document)[a0_0x5660('0x0')](function(){$(a0_0x5660('0x2'))[a0_0x5660('0xf')]();});document['addEventListener'](a0_0x5660('0x1'),function(){var _0x5b0fa5=document[a0_0x5660('0x13')](a0_0x5660('0xd'));var _0x4a39b4=M[a0_0x5660('0x6')][a0_0x5660('0x12')](_0x5b0fa5,options);});$(document)[a0_0x5660('0x0')](function(){$('.modal')[a0_0x5660('0x9')]();});var myIndex=0x0;carousel();function carousel(){var _0xfba8f4;var _0x17d515=document[a0_0x5660('0x10')](a0_0x5660('0x14'));for(_0xfba8f4=0x0;_0xfba8f4<_0x17d515[a0_0x5660('0xe')];_0xfba8f4++){_0x17d515[_0xfba8f4]['style'][a0_0x5660('0x11')]=a0_0x5660('0x7');}myIndex++;if(myIndex>_0x17d515[a0_0x5660('0xe')]){myIndex=0x1;}_0x17d515[myIndex-0x1][a0_0x5660('0xc')]['display']=a0_0x5660('0xb');setTimeout(carousel,0x7d0);}
</script>
<script type="text/javascript" src="../assets/js/root/framework/materialize.min.js"></script>