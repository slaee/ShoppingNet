<?php
// Session Area w/ Logout functions
session_start();
	if (isset($_GET['_user_logout_10020'])) {
	session_destroy();
	unset($_SESSION['email']);
	header("Location: / ");
}
if(empty($_SESSION)){
$_SESSION['lg-first-error'] = '<div class="ribbon red lighten-1" ><span><i class="material-icons" >error_outline</i> You must logged in first</span></div>';
header("Location: ../");
}else {
// Nothing
}

// Important Variable
$email	=	$_SESSION['email'];

require 'database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$user = mysqli_fetch_array($query);

// Not verified
if($user['seller_status'] == "unverified"){
header("Location: ../../set_au2/id=notvs_hls");
}else {

}

if(empty($user['global_profile'])) {
$gl_profile_no = '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS7iHlXLpEbuKcKXckB-xgwX8SgpAkkkEQiEg&usqp=CAU" alt="Profile Img" >';

}else {
$gl_profile_yes = '<img src="../../../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" alt="Profile Img"  >';
$gl_profile_yes_1 = '<div class="profile_nav_user" >
		<img src="../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" ></div>';
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
.material-icons {
	pointers-event:none;
}
#seller_cover {
    position: relative;
    width: 100%; /* Depends On Size */
    height: 120px;
    overflow: hidden;
    z-index:-1;
    border-bottom:1px solid silver;
}
#container_au {
	width: 100px;
	height: 100px;
	border-radius: 100px;
	margin-top:-50px;
	z-index:999;
}
#name {
	width: 100%;
	text-align: center;
	color: white;
	font-size: 38px;
	line-height: 100px;
}
.shopname {
	font-size:29px;
}
.title-16-px {
	font-size:16px;
}
.ribbon-error {
	padding:10px;
	border-radius:5px;
}
.placeholder-au {
	margin: 0 auto;
	max-width: 100%;
	min-height: 200px;
	background-color: #eee;
	border-radius:10px;
}
@keyframes placeHolderShimmer{
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}
.animated-background {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: darkgray;
    background: linear-gradient(to right, #eeeeee 10%, #dddddd 18%, #eeeeee 33%);
    background-size: 800px 104px;
    height: 200px;
    position: relative;
    border-radius:10px;
}
#loadingDiv {
	background:white;
	z-index: 10000;
	height:100%;
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
#mdl-btm-au-p3  {
	height:700px;
	border-top-left-radius:30px;
	border-top-right-radius:30px;
}
.modal {
	max-height:100%;
	border-top-left-radius:30px;
	border-top-right-radius:30px;
}
.nav-wrapper {
	border-bottom:1.5px solid #ddd;
}
.nav-wrapper1 .brand-logo {
	font-size:17px;
	font-weight:bolder;
	margin-left:17px;
}
.nav-wrapper1 input[type="submit"] {
	font-size:14px;
	font-weight:bold;
	border:none;
	background:transparent;
	height:30px;
}
.nav-wrapper1 .svg {
	margin-top:7px;
	margin-left:10px;
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
.listing-mg {
	margin-top:15px;
}
.listing-au-1 .title-au-b {
	font-size:19px;
	font-weight:500;
}
.listing-au-1 .desc-au-p {
	font-size:14px;
}
.card-listing-au {
	background:white;
	padding:5px 20px 15px 20px;
	border: 1px solid #ddd;
	border-radius: 6px;
}
.card-listing-au .md-bd{
	font-size:17px;
	font-weight:bold;
}
select {
	background: url(data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0Ljk1IDEwIj48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6I2ZmZjt9LmNscy0ye2ZpbGw6IzQ0NDt9PC9zdHlsZT48L2RlZnM+PHRpdGxlPmFycm93czwvdGl0bGU+PHJlY3QgY2xhc3M9ImNscy0xIiB3aWR0aD0iNC45NSIgaGVpZ2h0PSIxMCIvPjxwb2x5Z29uIGNsYXNzPSJjbHMtMiIgcG9pbnRzPSIxLjQxIDQuNjcgMi40OCAzLjE4IDMuNTQgNC42NyAxLjQxIDQuNjciLz48cG9seWdvbiBjbGFzcz0iY2xzLTIiIHBvaW50cz0iMy41NCA1LjMzIDIuNDggNi44MiAxLjQxIDUuMzMgMy41NCA1LjMzIi8+PC9zdmc+) no-repeat;
	background-position:right;
	-moz-appearance: none; 
	-webkit-appearance: none; 
	appearance: none;
	padding : 4px 20px
}
#listing-opt {
	border-radius:4px;
	outline:none;
}
.hr_au {
	margin-top:30px;
	margin-bottom:30px;
	border:0.5px solid #ddd;
}
[type="checkbox"].filled-in:checked + span:not(.lever):after {
	border-radius:50%;
	border:none;
	background:green;
	transition:0.2s;
}
[type="checkbox"].filled-in + span:not(.lever):after{
	border-radius:50%;
}
[type="checkbox"].reset-checkbox+span:not(.lever) {
	vertical-align:middle;
	padding-left:25px;
}
.top-right {
  position: absolute;
  top: 8px;
  right: 10px;
}
.modal-content nav {
	margin:0px;
	padding:0px;
}
.modal-content {
	padding:0;
}
.h1-no-result {
	font-size:26px;
	font-weight:bolder;
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
</style>

<div class="navbar-fixed" >
<nav class="z-depth-0 white" >
	<div class="nav-wrapper center" >
		<a href="../../../" >
			<span class="left svg" ><svg style="width:23px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,480C132.288,480,32,379.712,32,256S132.288,32,256,32s224,100.288,224,224S379.712,480,256,480z"/><path d="M292.64,116.8l-128,128c-6.204,6.241-6.204,16.319,0,22.56l128,128l22.56-22.72L198.56,256L315.2,139.36L292.64,116.8z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>
		</a>
		<a href="" class="brand-logo black-text" >My Store</a>
    </div>
</nav>
</div>
<div class="" id="seller_cover" >
	<img src="../assets/v1_lib/web_assets/static_image/default_cover.jpeg" >
</div>
<div class="container" >
	<div id="container_au" class="red lighten-2" >
		<div id="name" class="name" ></div>
	</div>
	<span class="shopname md-bd blue-grey-text text-darken-2" ><i class="material-icons" >storefront</i> <?php echo $user['shop_name']; ?></span><br>
	<span class="title-16-px" ><?php echo $user['address']; ?><br> <?php echo $user['phone']; ?></span>
</div>
<?php 
$bg_array = array("<blockquote>This year we have no fees for our seller's, Enjoy and happy selling.</blockquote>","	<blockquote>If you have any problem please send your feedback <a href='' >Here</a></blockquote>");
$bg = array_rand($bg_array,1);
?>
<div class="container" >
	<?php echo $bg_array[$bg];?>
</div>

<div class="row targetDiv" style="display:none" >

<?php 
	// Include Database Holder
require "database/database_lvl3.php";
					
	// Attempt Select Query Execution
	
	
	
	
	$sql = "SELECT * FROM products WHERE seller='".$user['shop_name']."' ";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result)) {
	// Output data of each row
	while ($row = mysqli_fetch_assoc($result)) 
	
	{
	// Number Format
	$output_lvl1 = $row['retail_price'];
	$global_price_lvl1 = number_format( $output_lvl1 , 0 , '.' , ',' );
	
	echo '<div class="col s6" >
	<a href="../../../listing_edit/'.$row['rnd'].'" class="black-text" ><div class="card z-depth-1 hoverable" >
	<div class="card-image" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image1'].'" class="product-cd-us" >
	<span class="btn red lighten-2 z-depth-0 top-right btn-floating btn-small" ><i class="material-icons" >edit</i></span>
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
	
	} else {
		echo '<div class="center" >
		<h1 class="h1-no-result blue-grey-text text-darken-2" >No items to show</h1>
		</div>';
	}	
	mysqli_close($con);	
?>
	
</div>

<!--<div class="row targetDiv" style="margin-top:30px;display:none" >
	<div class="col s6" >
		<div class="content-wrapper">
			<div class="placeholder-au">
				<div class="animated-background"></div>
			</div>
		</div>	
	</div>
	<div class="col s6" >
		<div class="content-wrapper">
			<div class="placeholder-au">
				<div class="animated-background"></div>
			</div>
		</div>	
	</div>
	<div class="col s6" style="margin-top:20px" >
		<div class="content-wrapper">
			<div class="placeholder-au">
				<div class="animated-background"></div>
			</div>
		</div>	
	</div>
	<div class="col s6" style="margin-top:20px" >
		<div class="content-wrapper">
			<div class="placeholder-au">
				<div class="animated-background"></div>
			</div>
		</div>	
	</div>
</div>-->
<div class="fixed-action-btn">
  <a href="../../../create/au/listing/" class="btn-floating btn-large red modal-trigger">
    <i class="large material-icons" style="font-size:40px" >add</i>
  </a>
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
<script type="text/javascript">
$(document).ready(function() {
    $(".targetDiv").delay(900).fadeIn(400);
});
</script>
<script type="text/javascript">
$('body').append('<div id="loadingDiv" class="row" style="margin-top:30px" ><div class="col s6" ><div class="content-wrapper"><div class="placeholder-au"><div class="animated-background"></div></div></div></div><div class="col s6" ><div class="content-wrapper"><div class="placeholder-au"><div class="animated-background"></div></div></div></div><div class="col s6" style="margin-top:20px" ><div class="content-wrapper"><div class="placeholder-au"><div class="animated-background"></div></div></div></div><div class="col s6" style="margin-top:20px" ><div class="content-wrapper"><div class="placeholder-au"><div class="animated-background"></div></div></div></div></div>');
$(window).on('load', function(){
  setTimeout(removeLoader,900); //wait for page load PLUS two seconds.
});
function removeLoader(){
    $( "#loadingDiv" ).fadeOut(300, function() {
      // fadeOut complete. Remove the loading div
      $( "#loadingDiv" ).remove(); //makes page more lightweight 
  });  
}
</script>
<script type="text/javascript" src="../../assets/v1_lib/web_assets/material.js"></script>
<script type="text/javascript">
var name = "<?php echo $user['shop_name']; ?>";
var lastname = "";
var initials = name.charAt(0)+""+lastname.charAt(0);
document.getElementById("name").innerHTML = initials;;

M.AutoInit();
</script>