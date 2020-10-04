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
		<a href="../" >
			<span class="left svg" ><svg style="width:23px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,480C132.288,480,32,379.712,32,256S132.288,32,256,32s224,100.288,224,224S379.712,480,256,480z"/><path d="M292.64,116.8l-128,128c-6.204,6.241-6.204,16.319,0,22.56l128,128l22.56-22.72L198.56,256L315.2,139.36L292.64,116.8z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>
		</a>
		<a href="" class="brand-logo black-text" >Confirmation</a>
		<span class="right svg" >
			<svg style="width:23px;margin-right:10px;fill:black" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z"/><path d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z"/></svg>	
    	</span>
    </div>
</nav>
</div><br>

<div class="row" >
	<div class="col s4" >
		<div class="profile_user" >
			<img src="../../../static/cdn/profile_5_82_9181_17/<?php echo $fetch_1['global_profile']; ?>" >
		</div>
	</div>
	<div class="col s8" >
		<span class="user_nm" ><?php echo $fetch_1['firstname']. ' '. $fetch_1['lastname'];?></span><br>
		<span class="red-text text-lighten-1" ><i class="material-icons" >report</i> This user is not verified, before you confirm this booking please call this user</span>
	</div>
	<div class="col s12 mg-top" >
		<span class="md-bd title-size blue-grey-text text-darken-2" >Booking Type</span><br>
		<span class="desc-size" ><?php echo $booking_type; ?></span><br><br>
		
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
		<input type="hidden" name="email_token" value="<?php echo randomNumber(16);?>" >
		<input type="hidden" name="booking_status" value="confirm" >
		<input type="submit" name="confirm" class="cdt-btn red accent-2" value="Confirm" >
	</form>
	</div>
	<div class="col s6" >
		<?php
			echo '<a href="tel:'.$user['phone'].'" ><button class="cdt-btn red accent-2" >Call</button></a>';
		?>
	</div>
</div>