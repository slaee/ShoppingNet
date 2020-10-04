<?php
// Check existence of id parameter before processing further
if(isset($_GET["user_shop"]) && !empty($_GET["user_shop"])){

// Include Database Holder 
require_once ("database/database_lvl3.php");

	// Prepare a select statement
   $sql = "SELECT * FROM user_info WHERE shop_name = '".$_GET["user_shop"]."'";
    
	$result = mysqli_query($con, $sql);   
   	if(mysqli_num_rows($result) == 1){
    		//Since the result set contains only one row, we don't need to use while loop 
      $row = mysqli_fetch_assoc($result);
                  		
  				// Retrieve individual field value
  				$shop	= $row['shop_name'];

			} else{
       		// URL doesn't contain valid id parameter. Redirect to error page
        	// header("location: error.php");
        	//header("Location: ../");
        	echo "ga";
        	exit();
    	}  
  		// Close connection
  		mysqli_close($con);

	} else{
    		// URL doesn't contain id parameter. Redirect to error page
    		// header("location: error.php");
    		//header("location: ../");
    		echo "ha";
    		exit();
}
// ---------
?>

<?php
// Session Area w/ Logout functions
session_start();
// Empty Session 
if(empty($_SESSION['email'])) {
$abc_not_login = '<a href="cart/" class="black-text right" id="cart-icon" style="margin-right:20px;margin-top:5px" >
<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 208.955 208.955" style="enable-background:new 0 0 208.955 208.955;fill:black;width:23px" xml:space="preserve">
<path d="M190.85,200.227L178.135,58.626c-0.347-3.867-3.588-6.829-7.47-6.829h-26.221V39.971c0-22.04-17.93-39.971-39.969-39.971
	C82.437,0,64.509,17.931,64.509,39.971v11.826H38.27c-3.882,0-7.123,2.962-7.47,6.829L18.035,200.784
	c-0.188,2.098,0.514,4.177,1.935,5.731s3.43,2.439,5.535,2.439h157.926c0.006,0,0.014,0,0.02,0c4.143,0,7.5-3.358,7.5-7.5
	C190.95,201.037,190.916,200.626,190.85,200.227z M79.509,39.971c0-13.769,11.2-24.971,24.967-24.971
	c13.768,0,24.969,11.202,24.969,24.971v11.826H79.509V39.971z M33.709,193.955L45.127,66.797h19.382v13.412
	c0,4.142,3.357,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5V66.797h49.936v13.412c0,4.142,3.357,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5
	V66.797h19.364l11.418,127.158H33.709z"/>
<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
</a>
		<div class="global-login-a"><a href="login/" class="right" style="margin-right:20px;font-weight:460" >Sign in</a></div>';
}else {
$abc_logged = '<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" ><svg style="width:23px;fill:black;" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0"/><path d="m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0"/></svg></a>
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" ><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 208.955 208.955" style="enable-background:new 0 0 208.955 208.955;fill:black;width:23px;" xml:space="preserve">
		<path d="M190.85,200.227L178.135,58.626c-0.347-3.867-3.588-6.829-7.47-6.829h-26.221V39.971c0-22.04-17.93-39.971-39.969-39.971
		C82.437,0,64.509,17.931,64.509,39.971v11.826H38.27c-3.882,0-7.123,2.962-7.47,6.829L18.035,200.784
		c-0.188,2.098,0.514,4.177,1.935,5.731s3.43,2.439,5.535,2.439h157.926c0.006,0,0.014,0,0.02,0c4.143,0,7.5-3.358,7.5-7.5
		C190.95,201.037,190.916,200.626,190.85,200.227z M79.509,39.971c0-13.769,11.2-24.971,24.967-24.971
		c13.768,0,24.969,11.202,24.969,24.971v11.826H79.509V39.971z M33.709,193.955L45.127,66.797h19.382v13.412
		c0,4.142,3.357,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5V66.797h49.936v13.412c0,4.142,3.357,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5
		V66.797h19.364l11.418,127.158H33.709z"/>
		<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
		</a>
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" ><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 244.742 244.742" style="enable-background:new 0 0 244.742 244.742;fill:black;width:23px" xml:space="preserve">
		<g>
		<g>
		<g>
		<path d="M243.37,85.341l-45.651-65.307c-1.425-2.037-3.751-3.249-6.236-3.249H55.796c-2.417,0-4.689,1.146-6.122,3.092
		L1.486,85.184C0.522,86.493,0,88.075,0,89.701c0,15.062,10.987,27.581,25.359,30.039v84.546c0,13.051,10.619,23.67,23.67,23.67
		h148.58c13.051,0,23.668-10.619,23.668-23.67V119.23c12.179-3.125,21.454-13.571,22.775-26.366
		C245.17,90.421,244.919,87.558,243.37,85.341z M180.072,212.741H148.37v-64.99h31.702V212.741z M206.059,204.288
		c0.003,4.662-3.791,8.453-8.447,8.453h-2.323v-72.598c0-4.202-3.406-7.609-7.609-7.609h-46.919c-4.202,0-7.609,3.406-7.609,7.609
		v72.598H49.029c-4.662,0-8.453-3.792-8.453-8.453v-85.802c4.994-1.753,9.404-4.755,12.833-8.648
		c5.595,6.356,13.789,10.37,22.899,10.37c9.11,0,17.304-4.015,22.899-10.37c5.595,6.356,13.789,10.37,22.899,10.37
		c9.113,0,17.307-4.015,22.902-10.37c5.595,6.356,13.789,10.37,22.899,10.37c9.11,0,17.304-4.015,22.899-10.37
		c3.969,4.509,9.265,7.806,15.253,9.361V204.288z M213.709,104.992c-8.43,0-15.291-6.86-15.291-15.291
		c0-4.202-3.406-7.609-7.609-7.609c-4.202,0-7.609,3.406-7.609,7.609c0,8.433-6.86,15.291-15.291,15.291
		c-8.431,0-15.291-6.86-15.291-15.291c0-4.202-3.406-7.609-7.609-7.609c-4.202,0-7.609,3.406-7.609,7.609
		c0,8.433-6.86,15.291-15.293,15.291c-8.433,0-15.291-6.86-15.291-15.291c0-4.202-3.406-7.609-7.609-7.609
		s-7.609,3.406-7.609,7.609c0,8.433-6.86,15.291-15.291,15.291c-8.431,0-15.291-6.86-15.291-15.291
		c0-4.202-3.406-7.609-7.609-7.609s-7.609,3.406-7.609,7.609c0,8.433-6.86,15.291-15.291,15.291
		c-7.659,0-14.02-5.658-15.123-13.016l44.251-59.973H187.52l41.406,59.233C228.152,98.951,221.622,104.992,213.709,104.992z"/>
		<path d="M112.13,132.535H60.234c-4.202,0-7.609,3.406-7.609,7.609V187.7c0,4.202,3.406,7.609,7.609,7.609h51.895
		c4.202,0,7.609-3.406,7.609-7.609v-47.556C119.738,135.941,116.332,132.535,112.13,132.535z M104.521,180.091H67.843v-32.339
		h36.678V180.091z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
		</a>
		
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" >
		<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
		<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 241.061 241.061" style="enable-background:new 0 0 241.061 241.061;width:23px" xml:space="preserve">
		<g>
		<path d="M198.602,70.402l-78.063,68.789l-78.08-68.79c-3.109-2.739-7.848-2.438-10.586,0.669c-2.737,3.108-2.439,7.847,0.67,10.586
		l83.039,73.159c1.417,1.248,3.188,1.872,4.958,1.872s3.542-0.624,4.959-1.873l83.022-73.159c3.107-2.738,3.406-7.478,0.668-10.586
		C206.449,67.964,201.711,67.664,198.602,70.402z"/>
		<path d="M218.561,38.529H22.5c-12.406,0-22.5,10.093-22.5,22.5v119.002c0,12.407,10.094,22.5,22.5,22.5h196.061
		c12.406,0,22.5-10.093,22.5-22.5V61.029C241.061,48.623,230.967,38.529,218.561,38.529z M226.061,180.031
		c0,4.135-3.364,7.5-7.5,7.5H22.5c-4.136,0-7.5-3.365-7.5-7.5V61.029c0-4.135,3.364-7.5,7.5-7.5h196.061c4.136,0,7.5,3.365,7.5,7.5
		V180.031z"/>
		</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></a>';
}
require 'database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$fetch = mysqli_fetch_array($query);
// Welcome Nav & Login Nav
if(empty($_SESSION['email'])) {
$abc_not_login_sidenav = '<li><a href="login" style="font-size:18px" >Sign in & Sign up <i class="material-icons right" style="margin-right:-15px" >chevron_right</i></a></li><hr>';
}else {
$abc_logged_sidenav = '<li><a href="" style="font-size:18px" >Hi, '.$fetch['username'].'</a></li><hr>';
}

// Welcome back and Title
if(empty($_SESSION['email'])){
$global_not_login_lvl1 = "Find thing's you loved";
}else {
$global_logged_lvl1 = "Welcome back ".$fetch['username']."";
// ---
$signout = '<li><a href="lgsession.php?logout" >Sign out</a></li>';
}
$email = $_SESSION['email'];
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
	
	<?php
	require 'database/database_lvl3.php';
	/*	$result = mysqli_query($con, 
	"SELECT * FROM products WHERE seller='".$row['shop_name']."' ORDER BY id DESC LIMIT 6")or die(mysqli_error());
	while ($fetch_seller = mysqli_fetch_assoc($result)) {
	
	}*/
	$result = mysqli_query($con, 
	"SELECT * FROM user_info WHERE shop_name='".$row['shop_name']."'")or die(mysqli_error());
	while ($fetch_seller = mysqli_fetch_assoc($result)) {
	
	$seller_fname = $fetch_seller['firstname'];
	$seller_lname = $fetch_seller['lastname'];
	$seller_shopname = $fetch_seller['shop_name'];
	$seller_address = $fetch_seller['address'];
	echo '<title>'.$row['shop_name'].' by '.$fetch_seller['firstname']. ' '.$fetch_seller['lastname'].'</title>';
	}
	?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
<body>
<style type="text/css">
<?php include 'assets/v1_lib/web_assets/v1_mobile_test.css'; ?>
body {
    margin: 0;
    padding: 0;
    height: 100%;
}
.not_available {
    top: 20px;
}
.not_available h2 {
    font-size: 40px;
    font-weight: 500;
}
.suggested-product-image {
    position: relative;
    width: 100%; /* Depends On Size */
    height: 120px;
    overflow: hidden;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}
.suggested-product-image img {
    width: 100%;
    height: auto;
    align-items: center;
}
.suggest-card-img {
    border-radius: 6px;
    border: 1px solid #ddd;
}
.ribbon {
    background: #5c258d;
    color: #fff;
    top: 0;
    padding: 15px;
}
#global-fixed-img {
    height: 120px;
}
[data-role="popular-product-img"] {
    position: relative;
    width: 100%;
    height: 120px;
    overflow: hidden;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}
#popular-card[role="custom-card"] {
    margin: 0;
}
#popular-card .card-content {
    padding: 10px;
    margin-left: -10px;
}
#popular-card .card-content #title {
    font-size: 14px;
    font-weight: 400;
}
#popular-card .card-content #seller-name {
    font-weight: 350;
}
#popular-card .card-content #price {
    font-size: 18px;
    font-weight: 500;
    margin-top: -10px;
}
.checked {
    color: #006400;
}
[data-role="context-feature"] {
    font-size: 22px;
    vertical-align: middle;
    padding: 10px;
}
.notif_track_ul {
    border-radius: 3em;
}
.container-track-content {
    font-size: 16px;
}
.search-box {
    position: relative;
}
.search-box input[type="text"] {
}
.result {
    position: absolute;
    background: white;
    font-size: 16px;
    z-index: 999;
    top: 100%;
    margin-top: 5px;
    border: none;
    left: 0;
    border-radius: 4px;
}
.search-box input[type="text"],
.result {
    width: 100%;
}
.result p {
    margin: 0;
    border: none;
    padding: 12px 10px;
    cursor: pointer;
}
.result span {
    margin: 0;
    border: none;
    padding: 12px 10px;
    cursor: pointer;
}
.result p:hover {
    background: #f2f2f2;
}
.md-bold {
	font-weight:500;
}
.rspn:hover {
    background: skyblue;
}
.top-right {
  position: absolute;
  top: 8px;
  right: 11px;
}
.tabs > .tab > a:hover {
    background-color: unset !important;
    color:black;
}

</style>
<!--MOBILE NAV-->
<div class="global-overlay hide-on-med-only hide-on-large-only" >
<div class="navbar-fixed" >
<nav class="z-depth-0 white">
	<div class="nav-wrapper" >
		<a href="#" data-target="slideout" class="white-text sidenav-trigger menu_bar" style="margin-right:10px;margin-left:5px" ><svg style="width:23px;margin-top:15px;fill:black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20,7H4C3.4,7,3,6.6,3,6s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,7,20,7z"/><path d="M15.2,13H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h11.2c0.6,0,1,0.4,1,1S15.8,13,15.2,13z"/><path d="M20,19H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,19,20,19z"/></svg></a>
    	<?php echo $abc_not_login; ?><?php echo $abc_logged; ?>
    </div>
</nav>
</div>
<div class="row" >
<div class="col s12" >
	<a href="" style="vertical-align:middle" >
	<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 364.713 364.713" style="enable-background:new 0 0 364.713 364.713;fill: black;width:23px;margin-top:10px;margin-left:5px" xml:space="preserve"><g><g><g><path d="M312.969,192.261l-83.592-12.016l-37.616-75.755c-2.515-5.194-8.765-7.365-13.959-4.849c-2.116,1.025-3.825,2.733-4.849,4.849l-37.616,75.755l-83.592,12.016c-3.959,0.633-7.207,3.474-8.359,7.314c-1.016,3.7-0.026,7.662,2.612,10.449l60.604,59.037l-14.106,83.069c-0.635,3.987,0.97,8,4.18,10.449c3.161,2.405,7.413,2.81,10.971,1.045l74.71-39.706l74.71,39.706l4.702,1.045c2.288,0.194,4.555-0.562,6.269-2.09c3.209-2.449,4.815-6.462,4.18-10.449l-14.106-83.069l60.604-59.037c2.638-2.787,3.629-6.749,2.612-10.449	C320.176,195.736,316.928,192.894,312.969,192.261z M239.304,258.09c-2.138,2.43-3.094,5.681-2.612,8.882l11.494,67.918l-61.127-31.869c-2.976-1.412-6.428-1.412-9.404,0l-61.127,31.869l11.494-67.918c0.482-3.201-0.474-6.451-2.612-8.882l-49.633-48.065l68.441-9.927c3.364-0.591,6.262-2.716,7.837-5.747l30.302-61.649l30.302,61.649c1.575,3.031,4.472,5.156,7.837,5.747l68.441,9.927L239.304,258.09z"/><path d="M182.357,73.143c5.771,0,10.449-4.678,10.449-10.449V10.449C192.806,4.678,188.127,0,182.357,0s-10.449,4.678-10.449,10.449v52.245C171.908,68.465,176.586,73.143,182.357,73.143z"/><path d="M340.136,55.38c-4.617-3.463-11.166-2.527-14.629,2.09l-31.347,41.796c-3.462,4.617-2.527,11.166,2.09,14.629c1.79,1.392,4.002,2.13,6.269,2.09c3.27-0.077,6.335-1.61,8.359-4.18l31.347-41.796C345.689,65.392,344.753,58.842,340.136,55.38z"/><path d="M62.193,115.984c2.267,0.04,4.48-0.698,6.269-2.09c4.617-3.463,5.552-10.012,2.09-14.629L39.206,57.469c-3.463-4.617-10.012-5.552-14.629-2.09c-4.617,3.462-5.552,10.012-2.09,14.629l31.347,41.796C55.858,114.374,58.923,115.906,62.193,115.984z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g>	</g></svg>
	</a>
	<form action="search.php?<?php echo $search; ?>" method="POST" class="z-depth-3 search-box global-form-search" role="search" id="form">
		<input type="text" name="search" autocomplete="off" class="global-input-search browser-default" placeholder="Search for anything" arial-label="Search Something" autocomplete="off" />
		<div class="result z-depth-1"></div>
		<button type="submit" name="submit" class="global-submit-search" >
			<svg class="global-svg" viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
		</button>
	</form>
</div>
</div>
<div class="global-scrollmenu transparent z-depth-0 hide-on-med-only hide-on-large-only" style="margin-top:-15px" >
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" ><i class="material-icons" >redeem</i> Gifts & Redeem</a>
	<span class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" > | </span>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Pasugo</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Everyday finds</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Clothing & Shoes</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Art Station</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Foodbay Area</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Craft & Supplies</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Best Seller</a>
</div>
</div>

<!--DESKTOP NAV-->
<div class="global-overlay hide-on-small-only" >
<nav class="z-depth-0 white">
	<div class="nav-wrapper" >
		<a href="#" data-target="slideout" class="white-text sidenav-trigger menu_bar" style="vertical-align:middle;margin-right:10px;margin-left:5px" ><svg style="width:23px;margin-top:15px;fill:black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20,7H4C3.4,7,3,6.6,3,6s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,7,20,7z"/><path d="M15.2,13H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h11.2c0.6,0,1,0.4,1,1S15.8,13,15.2,13z"/><path d="M20,19H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,19,20,19z"/></svg></a>
		<div class="global-login-a"><a href="login/" class="left" style="margin-right:20px;margin-top:-5px;font-weight:350" >My orders</a></div>
		<div class="global-login-a"><a href="login/" class="left" style="margin-right:20px;margin-top:-5px;font-weight:350" >Return</a></div>
		<?php echo $abc_not_login; ?><?php echo $abc_logged;?>
		<form action="search.php?<?php echo $search; ?>" method="POST" class="z-depth-3 global-form-search-desk" role="search" id="form" style="margin-top:10px;margin-right:10px" >
		<input type="text" name="search" autocomplete="off" class="global-input-search-desk browser-default" placeholder="Search for anything" arial-label="Search Something" autocomplete="off" />
		<div class="result z-depth-1"></div>
		<button type="submit" name="submit" style="padding:5px;margin-right:10px;background:transparent;border:none" >
			<i class="material-icons" >search</i>
		</button>
		</form>
	</div>
</nav>

<div class="global-scrollmenu-desk transparent z-depth-0" style="margin-top:-15px" >
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Pasugo</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Everyday finds</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Clothing & Shoes</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Art Station</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Foodbay Area</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Craft & Supplies</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" >Best Seller</a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" > | </a>
	<a href="" class="black-text" style="font-weight:400;font-family: 'Noto Sans JP', sans-serif;" ><i class="material-icons" >redeem</i> Gifts & Redeem</a>
</div>
</div>

<!--SIDENAV-->
<ul id="slideout" class="sidenav" style="background:aliceblue">
<?php echo $abc_not_login_sidenav; ?><?php echo $abc_logged_sidenav; ?>
<li><a href="" ><i class= "material-icons" >home</i>Home</a></li>
<li><a href="profile.php" ><i class="material-icons" >&#xE87C;</i>My Account</a></li>
<li><a href="orders.php" ><i class="material-icons" >add_shopping_cart</i>Orders</a></li>
<li><a href="" ><i class="material-icons" >launch</i>Customer Service</a></li>
<li><a href="" ><i class="material-icons" >credit_card</i>Payment Modes</a></li>
<li><a href="" ><i class="material-icons" >local_shipping</i>Track Package <span class="badge white-text green darken-1 notif_track_ul" >100</span></a></li>
<li>
	<div class="divider" ></div>
</li>
<li><a class="subheader">Browse Categories</a></li>
<li><a href="" >Electronics & Devices</a></li>
<li><a href="" >Health and Household</a></li>
<li><a href="" >Foods</a></li>
<li><a href="" >Beauty Product</a></li>
<li><a href="" >Popular Now</a></li>
<li>
	<div class="divider" ></div>
</li>
<?php echo $signout; ?>
</ul>
<div class="center hide-on-small-only" >
	<h1 class="home_title" style="font-size:30px" >Coming Soon</h1>
	<p>PLEASE STAY TUNED FOR NEW UPDATE</p>
</div>
<style type="text/css">
#seller_cover {
    position: relative;
    width: 100%; /* Depends On Size */
    height: 120px;
    overflow: hidden;
    z-index:-1;
    border-bottom:1px solid silver;
}
#seller_cover img {
    width: 100%;
    height: auto;
    align-items: center;
    z-index:-1;
}
#seller-profile {
	width: 100px;
	height: 100px;
	border-radius: 100px;
	background: #FFE77AFF;
	border: 1px solid silver;
	margin-top:-50px;
	z-index:999;
}
#seller-name {
	font-size:25px;
	font-weight:500;
	margin-left:10px;
}
#seller-address {
	font-size:13px;
	margin-left:10px;
	color:#595959;
}
#shoplike {
	font-size:16px;
	margin-top:10px;
	margin-right:5px;
}
#seller-sold {
	font-size:14px;
	margin-left:10px;
	font-family:Tahoma,Arial,sans-serif;
}
.favorite-button {
	margin-top:-10px;
	box-shadow: 0px 3px 15px rgba(0,0,0,0.2);
	border-radius:50%;
}
.product-content-1 {
	padding:5px;
}
.product-content-1 #seller-name {
	font-size:13px;
}
.small {
    height: 50px;
    overflow:hidden;
}
.big {
    height: auto;
}
#description-content {
	text-align:left;
}
#description-content #desc-content-p {
	margin-top:5px;
}

#popular-card .card-content #title {
    font-size: 14px;
    font-weight: 400;
}
#popular-card .card-content #seller-name {
    font-weight: 350;
}
#popular-card .card-content #price {
    font-size: 18px;
    font-weight: 500;
    margin-top: -10px;
}
.checked {
    color: #006400;
}
[data-role="context-feature"] {
    font-size: 22px;
    vertical-align: middle;
    padding: 10px;
}
.card-content .pdt-title {
	margin-top:-15px;
	margin-left:-20px;
	font-size:13px;
}
.card-content .pdt-price {
	font-size:18px;
	font-weight:500;
	margin-left:-20px;
}
.card-image {
    position: relative;
    width: 100%; /* Depends On Size */
    height: 120px;
    overflow: hidden;
    border-top-left-radius:6px;
    border-top-right-radius:6px;
}
.card-image img {
    width: 100%;
    height: auto;
    align-items: center;
    background:#ddd;
}
.card-content .pdt-sold {
	font-size:12px;
}
#card-view-div {
	background:white;
	height:200px;
	border-radius:6px;
	box-shadow: 0px 3px 15px rgba(0,0,0,0.2);
}
</style>
<div class="" id="seller_cover" >
	<img src="../assets/v1_lib/web_assets/static_image/default_cover.jpeg" >
</div>
<div class="container" >
	<img id="seller-profile" class="left" src="../assets/v1_lib/web_assets/static_image/default_avatar.png" >
	<div class="favorite-button right" >
		<a class="btn-floating btn-large white lighten-1">
		<i class="large material-icons black-text">favorite_border</i>
		</a>
	</div>
		<span class="right light" id="shoplike" >3.1k shop likes</span>
</div><br><br><br>
<span id="seller-name" ><?php echo $seller_shopname; ?></span><br>
<span class="light" id="seller-address" ><i class="material-icons" >location_on</i><?php echo $seller_address; ?></span><br>
<div class="product-content-1" >
<span id="seller-name" >17,654 Sold </span>|
	<span class="fa fa-star fa-sm"></span>
	<span class="fa fa-star fa-sm "></span>
	<span class="fa fa-star fa-sm "></span>
	<span class="fa fa-star fa-sm"></span>
	<span class="fa fa-star fa-sm"></span><br>
</div>
<ul class="tabs">
	<li class="tab col s3"><a href="#homepage_sell" class="active red-text text-lighten-2 md-bold" >Homepage</a></li>
	<li class="tab col s3"><a href="#test2" class="red-text text-lighten-2 md-bold" >All Products</a></li>
	<li class="tab col s3"><a href="#test4" class="red-text text-lighten-2 md-bold" >About</a></li>
</ul>

<div id="homepage_sell" class="">
<div class="row" >
<?php
	require 'database/database_lvl3.php';
	$result = mysqli_query($con, 
	"SELECT * FROM products WHERE seller='".$seller_shopname."' ORDER BY id DESC LIMIT 6")or die(mysqli_error());
	while ($row_new = mysqli_fetch_assoc($result)) {
	//echo ''.$row_new['product'].'';
	$rr_price = $row_new['retail_price'];
	$rr_price2 = number_format( $rr_price , 0 , '.' , ',' );
	echo '<div class="col s6" >
		<a href="../listing/'.$row_new['rnd'].'" class="black-text"><div class="card" id="card-view-div" >
			<div class="card-image" >
				<img src="'.$row_new['image'].'" >
			</div>
			<div class="card-content" >
				<span class="light truncate pdt-title" >'.$row_new['product'].'</span>
				<span class="truncate pdt-price" >&#8369;'.$rr_price2.'</span>
				<div class="truncate" style="margin-left:-20px" >
					<span class="fa fa-star fa-sm"></span>
					<span class="fa fa-star fa-sm "></span>
					<span class="fa fa-star fa-sm "></span>
					<span class="fa fa-star fa-sm"></span>
					<span class="fa fa-star fa-sm"></span> (299)
			</div>
			</div>
		</div>
	</div></a>';
	
}
?>
</div>
</div>
<div id="test2" class="col s12">Test 2</div>
<div id="test4" class="col s12">Test 4</div>

  <script>
    var el = document.querySelector('.tabs');
    var instance = M.Tabs.init(el, {});
  </script>
<script type="text/javascript">
$('.wrapper').find('a[href="#"]').on('click', function (e) {
    e.preventDefault();
    this.expand = !this.expand;
    $(this).text(this.expand?"Click to collapse":"Click to read more");
    $(this).closest('.wrapper').find('.small, .big').toggleClass('small big');
});
</script>
<script type="text/javascript">
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
</script>