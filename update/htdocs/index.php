<?php
// Session Area w/ Logout functions
session_start();
	if (isset($_GET['_user_logout_10020'])) {
	session_destroy();
	unset($_SESSION['email']);
	header("Location: / ");
}
// Important Variable
$email	=	$_SESSION['email'];

require 'database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$user = mysqli_fetch_array($query);

if(empty($user['global_profile'])) {
$gl_profile_no = '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS7iHlXLpEbuKcKXckB-xgwX8SgpAkkkEQiEg&usqp=CAU" alt="Profile Img" >';

} else {
$gl_profile_yes = '<img src="../../../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" alt="Profile Img"  >';
$gl_profile_yes_1 = '<div class="profile_nav_user" >
		<img src="../../../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" ></div>';
}

// Email Notifications
$query = mysqli_query($con,"SELECT COUNT(*) AS SUM FROM email_notifs WHERE receiver_email='".$email."' AND status='unread'");
while($result = mysqli_fetch_array($query))
$em_nf = $result['SUM'];

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
} else {
$logged_nav_yes = empty($em_nf) ? '<div class="navbar-fixed" ><nav class="white" style="box-shadow: 0px 3px 5px rgba(0,0,0,0.1);" >
	<div class="nav-wrapper center" >
		<div class="nav-top-au" >
			<a href="#" data-target="slideout" class="white-text sidenav-trigger menu_bar" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20,7H4C3.4,7,3,6.6,3,6s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,7,20,7z"/><path d="M15.2,13H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h11.2c0.6,0,1,0.4,1,1S15.8,13,15.2,13z"/><path d="M20,19H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,19,20,19z"/></svg></a>
			<a href="../../../cart/" ><i class="material-icons right black-text" style="margin-right:5px" >shopping_cart</i></a>
			<a href="../../email_notif/" ><i class="material-icons right black-text text-lighten-4" style="margin-right:5px" >mail_outline</i></a>
		</div>
    </div>
</nav></div><br>' : '<div class="navbar-fixed" ><nav class="white" style="box-shadow: 0px 3px 5px rgba(0,0,0,0.1);" >
	<div class="nav-wrapper center" >
		<div class="nav-top-au" >
			<a href="#" data-target="slideout" class="white-text sidenav-trigger menu_bar" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20,7H4C3.4,7,3,6.6,3,6s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,7,20,7z"/><path d="M15.2,13H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h11.2c0.6,0,1,0.4,1,1S15.8,13,15.2,13z"/><path d="M20,19H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,19,20,19z"/></svg></a>
			<a href="../../../cart/" ><i class="material-icons right black-text" style="margin-right:5px" >shopping_cart</i></a>
			<a href="../../email_notif/" ><i class="material-icons right red-text" style="margin-right:5px" >mark_email_unread</i></a>
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
} else {
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

} else {
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
// Error - Login First if someone try to go page required login
echo $_SESSION['lg-first-error']; 
unset($_SESSION['lg-first-error']);
// Echo Nav
echo $logged_nav_no . '' . $logged_nav_yes; 
// Echo Goodmorning
echo $logged_gd_no . '' . $logged_gd_yes;
?>
<div class="row" >
	<div class="col s12" >
		<form action="?<?php echo $search; ?>" method="GET " class="z-depth-0 search-au-new" role="search" id="form">
		<input type="text" name="search" autocomplete="off" class="global-input-search browser-default z-depth-0" placeholder="Search for anything" arial-label="Search Something" autocomplete="off" style="width:100%" />
		<div class="result z-depth-1"></div>
		<button type="submit" class="global-submit-search" >
		<svg class="global-svg" viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
		</button>
		</form>
	</div>
</div>

<div class="global-scrollmenu-au transparent z-depth-0 hide-on-med-only hide-on-large-only" style="margin-top:-15px" >
	<div class="listing-ca" >
		<a href="../../../features_top/" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Top Services</a>
		<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Promo</a>
		<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Foods</a>
		<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Sales</a>
		<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Hot Deals</a>
		<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Get Voucher</a>
	</div>
</div><br>

<?php echo $logged_au .''. $not_logged_au;;?>
<?php 
// Added on cart
echo $_SESSION['added_cart']; 
unset($_SESSION['added_cart']);
?>
<div class="row" >
	<div class="col s12 center" >
		<span class="h1-sx md-bd left" >Market Place</span>
	</div><br>
</div>
<div class="row" >
<?php
// Search Result
include 'database/database_lvl3.php';
$search_value=$_GET["search"];
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

<div class="browse-shop" >
	<span class="brws" >Browse Shops</span>
</div>
<div class="global-scrollmenu global-scrollmenu-rest" >
	<a href="" ><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcT56DbU8a5cN4i0xpN9WPXOBJ6_lAIrAw2-eA&usqp=CAU" class="shop_pr_user" ></a>
	<a href="" ><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQoEfw_39cXNd0ZKlUb47T8ENvn9pCN11xuGA&usqp=CAU" class="shop_pr_user" ></a>
	<a href="" ><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQovPT-BPoMbPqwJ60nPqfFkGQYTOyYv3AvFY-m-rBVyMKCsKY4z1FTEpKI&s=10" class="shop_pr_user" ></a>
</div><br>
<div class="row" >
<?php
include 'database/database_lvl3.php';
$result = mysqli_query($con,"SELECT * FROM products ORDER BY RAND() limit 8");
while($row = mysqli_fetch_array($result)) {
	$output_lvl1 = $row['retail_price'];
	$global_price_lvl1 = number_format( $output_lvl1 , 0 , '.' , ',' );
	if($row['ads_status'] == "on"){
	$ad_lvs = '<i class="fas fa-ad"></i> ';
	}else {
	}

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
?>
</div>
<?php 
if(empty($_SESSION['email'])){
// Nothing For Now
}else {
$bottom_modal = '<div id="mdl-btm-au-p1" class="modal bottom-sheet center btm-ct" >
	<i class="material-icons" style="font-size:123px;opacity:0.5" >local_shipping</i><br>
	<div class="container" >
		<span class="left" style="font-size:17px" ><span class="md-bd" >PICK UP &mdash;</span> To anyone who is having difficulty with a ride for their big boxes or cargos from Piers, no need to worry! Cebu Sugo-A Ko will do the lifting for you.</span>
		<a href="../../features_top/" class="btm-con red lighten-2" >Continue</a>
	</div>
</div>
<div id="mdl-btm-au-p2" class="modal bottom-sheet center btm-ct" >
	<i class="material-icons" style="font-size:123px;opacity:0.5" >local_pizza</i><br>
	<div class="container" >
		<span class="left" style="font-size:17px" ><span class="md-bd" >PASUGO &mdash;</span> Driver buy your needs like grocery, pay bills and more without struggling go to grocery or convenience store.</span>
		<a href="../../features_top/" class="btm-con red lighten-2" >Continue</a>
	</div>
</div>

<div id="mdl-btm-au-p3" class="modal bottom-sheet center btm-ct" >
	<i class="material-icons" style="font-size:123px;opacity:0.5" >store</i><br>
	<div class="container" >
		<span class="left" style="font-size:17px" ><span class="md-bd" >PARCEL &mdash;</span> To anyone who is having difficulty with a ride for their big boxes or cargos from Piers, no need to worry! Cebu Sugo-A Ko will do the lifting for you.</span>
		<a href="../../features_top/" class="btm-con red lighten-2" >Continue</a>
	</div>
</div>';
}
if(empty($_SESSION['email'])){

}else {
// Setup phone number first
if(empty($user['phone'])){
echo '<div id="mdl-btm-au-sss" class="modal bottom-sheet center btm-ct" >
	<i class="material-icons red-text text-lighten-1" style="font-size:123px;opacity:0.5" >contacts</i><br>
	<div class="container" >
		<span class="left " style="font-size:17px" >Your account is not completely setup please setup your phone number and profile picture by clicking continue.<br><br></span>
		<a href="../../setup_au1" class="btm-con red lighten-2" >Continue</a>
	</div>
</div>';
}else {

}
}
?>
<!--Bottom Modal Content View-->
<?php echo $bottom_modal; ?>
<!--/End Bottom Content-->

<script type="text/javascript" src="../../assets/v1_lib/web_assets/material.js"></script>
<script type="text/javascript">
M.AutoInit();
function wynBox() {
    document.getElementsByClassName("box")[0].style.display = 'none';
}
$(document).ready(function(){
    $('#mdl-btm-au-sss').modal();
    $('#mdl-btm-au-sss').modal('open'); 
 });
</script>