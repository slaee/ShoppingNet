<?php
session_start();
// Empty Session 
if(empty($_SESSION['email'])) {
header("Location: ../index");
}else {
$abc_logged = '
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" ><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 208.955 208.955" style="enable-background:new 0 0 208.955 208.955;fill:white;width:23px;" xml:space="preserve">
		<path d="M190.85,200.227L178.135,58.626c-0.347-3.867-3.588-6.829-7.47-6.829h-26.221V39.971c0-22.04-17.93-39.971-39.969-39.971
		C82.437,0,64.509,17.931,64.509,39.971v11.826H38.27c-3.882,0-7.123,2.962-7.47,6.829L18.035,200.784
		c-0.188,2.098,0.514,4.177,1.935,5.731s3.43,2.439,5.535,2.439h157.926c0.006,0,0.014,0,0.02,0c4.143,0,7.5-3.358,7.5-7.5
		C190.95,201.037,190.916,200.626,190.85,200.227z M79.509,39.971c0-13.769,11.2-24.971,24.967-24.971
		c13.768,0,24.969,11.202,24.969,24.971v11.826H79.509V39.971z M33.709,193.955L45.127,66.797h19.382v13.412
		c0,4.142,3.357,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5V66.797h49.936v13.412c0,4.142,3.357,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5
		V66.797h19.364l11.418,127.158H33.709z"/>
		<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
		</a>
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" >
		<?xml version="1.0" encoding="UTF-8"?>
		<svg style="width:23px;fill:white" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
		<path d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z"/>
		<path d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z"/>
		</svg>	
		</a>
		
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" >
		<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
		<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 241.061 241.061" style="enable-background:new 0 0 241.061 241.061;width:23px;fill:white" xml:space="preserve">
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

if(empty($fetch['global_profile'])) {
$profile_default = '<div id="container" class="red lighten-2" >
	<div id="name" class="name" >	
	</div>
</div>';

}else {
$profile_change = '<div class="profile_nav_user" >
	<img src="../../../static/cdn/profile_5_82_9181_17/'.$fetch['global_profile'].'" alt="Profile Img" class="profile-pic" '.$firstname.'" >
</div>';

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
	<link rel="stylesheet" type="text/css" href="../../../assets/v1_lib/web_assets/materialize.css" >
</head>
<body>
<style type="text/css">
<?php include 'assets/v1_lib/web_assets/v1_mobile_test.css'; ?>
body{margin:0;padding:0;height:100%}.not_available {top:20px;}.not_available h2{font-size:40px;font-weight:500;}.suggested-product-image {position: relative;width: 100%; /* Depends On Size */height: 120px;overflow: hidden;border-bottom-left-radius:6px;border-bottom-right-radius:6px;border-top-left-radius:6px;border-top-right-radius:6px;}.suggested-product-image img{width:100%;height:auto;align-items:center}.suggest-card-img{border-radius:6px;border:1px solid #ddd}.ribbon{background:#5c258d;color:#fff;top:0;padding:15px}#global-fixed-img{height:120px}[data-role=popular-product-img]{position:relative;width:100%;height:120px;overflow:hidden;border-top-left-radius:6px;border-top-right-radius:6px}#popular-card[role=custom-card]{margin:0}#popular-card .card-content{padding:10px;margin-left:-10px}#popular-card .card-content #title{font-size:14px;font-weight:400}#popular-card .card-content #seller-name{font-weight:350}#popular-card .card-content #price{font-size:18px;font-weight:500;margin-top:-10px}.checked{color:#006400}[data-role=context-feature]{font-size:22px;vertical-align:middle;padding:10px}.notif_track_ul {border-radius:3em;}.container-track-content {font-size:16px;}.search-box{position: relative;}.search-box input[type="text"]{}.result{position: absolute; background:white;font-size:16px;z-index: 999;top:100%;margin-top:5px;border:none;left: 0;border-radius:4px;}.search-box input[type="text"], .result{width: 100%;}.result p{margin: 0;border:none;padding: 12px 10px;cursor:pointer;}.result span{margin: 0;border:none;padding: 12px 10px;cursor:pointer;}.result p:hover{background: #f2f2f2;}.rspn:hover {background:skyblue;}
#container {
  width: 60px;
  height: 60px;
  border-radius: 100px;
}
#name {
  width: 100%;
  text-align: center;
  color: white;
  font-size: 28px;
  line-height: 60px;
}
.user-name {
	font-size:26px;
}
[data-role="user_info_1"] .name {
	font-size:22px;
	font-weight:600;
	color:white;
}
[data-role="user_info_1"] .ffcontent {
	font-size:15px;
	color:white;
}
.tabs > .tab > a:hover {
    background-color: unset !important;
    color:black;
    text-transform:none;
}
.tabs > .tab > a {
	text-transform:none;
}
.profile_nav_user {
	position:relative;
	width:70px;
	height:70px;
	overflow:hidden;
	border-radius:50%;
}
.profile_nav_user img{
	width:100%;
	height:auto;
}
#map {
	height:100%;
}
.firstname {
	text-transform:capitalize;
}
.lastname {
	text-transform:capitalize;
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
</style>

<!--MOBILE NAV-->
<div class="user-cover hide-on-med-only hide-on-large-only" >
<nav class="z-depth-0 transparent">
	<div class="nav-wrapper" >
		<a href="#" data-target="slideout" class="white-text sidenav-trigger menu_bar" style="margin-right:10px;margin-left:5px" >
		<svg style="width:23px;margin-top:15px;fill:white" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
		<path d="m174 240h-108c-36.393 0-66-29.607-66-66v-108c0-36.393 29.607-66 66-66h108c36.393 0 66 29.607 66 66v108c0 36.393-29.607 66-66 66zm-108-208c-18.748 0-34 15.252-34 34v108c0 18.748 15.252 34 34 34h108c18.748 0 34-15.252 34-34v-108c0-18.748-15.252-34-34-34z"/>
		<path d="m446 240h-108c-36.393 0-66-29.607-66-66v-108c0-36.393 29.607-66 66-66h108c36.393 0 66 29.607 66 66v108c0 36.393-29.607 66-66 66zm-108-208c-18.748 0-34 15.252-34 34v108c0 18.748 15.252 34 34 34h108c18.748 0 34-15.252 34-34v-108c0-18.748-15.252-34-34-34z"/>
		<path d="m392 512c-66.168 0-120-53.832-120-120s53.832-120 120-120 120 53.832 120 120-53.832 120-120 120zm0-208c-48.523 0-88 39.477-88 88s39.477 88 88 88 88-39.477 88-88-39.477-88-88-88z"/>
		<path d="m174 512h-108c-36.393 0-66-29.607-66-66v-108c0-36.393 29.607-66 66-66h108c36.393 0 66 29.607 66 66v108c0 36.393-29.607 66-66 66zm-108-208c-18.748 0-34 15.252-34 34v108c0 18.748 15.252 34 34 34h108c18.748 0 34-15.252 34-34v-108c0-18.748-15.252-34-34-34z"/>
		</svg>
		</a>
    	<?php echo $abc_not_login; ?><?php echo $abc_logged; ?>
    </div>
</nav>

<div class="row" >
<a href="../edit" class="white-text" >
	<div class="col s3" >
	<?php echo $profile_default . $profile_change; ?>
	</div>
	<div class="col s9 left" data-role="user_info_1" >
		<span class="name" ><span class="firstname" ><?php echo $fetch['firstname']; ?></span><span class="lastname" ><?php echo $fetch['lastname']; ?></span></span><br>
		<span class="ffcontent" >Followers 0 <span style="margin-left:5px;margin-right:5px" >|</span> Following 2</span>
	</div>
</a>
</div>
</div>
	

<ul class="tabs" id="tabs-content" >
	<li class="tab col s3"><a href="#" class="active red-text text-lighten-2 md-bold" >Home</a></li>
	<li class="tab col s3"><a href="#" class="red-text text-lighten-2 md-bold" >Favourite</a></li>
</ul><br>
<?php
$word = $fetch['firstname'];
$mystring = "Elwyn";
 
// Test if string contains the word 
if(strpos($mystring, $word) !== false){
    echo "Word Found!";
} else{
    echo "Word Not Found!";
}
?>
<script type="text/javascript">
$('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
$(window).on('load', function(){
  setTimeout(removeLoader,2000); //wait for page load PLUS two seconds.
});
function removeLoader(){
    $( "#loadingDiv" ).fadeOut(200, function() {
      // fadeOut complete. Remove the loading div
      $( "#loadingDiv" ).remove(); //makes page more lightweight 
  });  
}
var name = "<?php echo $fetch['firstname']; ?>";
var lastname = "";
var initials = name.charAt(0)+""+lastname.charAt(0);
document.getElementById("name").innerHTML = initials;;
</script>
<script type="text/javascript" src="../../../assets/v1_lib/web_assets/material.js"></script>
<script type="text/javascript">
M.AutoInit()
</script>