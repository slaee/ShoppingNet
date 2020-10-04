<?php
// This is page of continue setup account.
// Session Area w/ Logout functions
session_start();
if(empty($_SESSION['email'])){
$_SESSION['lg-first-error'] = '<div class="ribbon red lighten-1" ><span><i class="material-icons" >error_outline</i> You must logged in first</span></div>';
header("Location: ../");
}else {
// Nothing
}
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
// Morning & Evening 
$date_a = date("a");
if($date_a == "am"){
$am_au = 'Goodmorning';
}elseif($date_a == "pm") {
$pm_au = 'Goodevening';
}else {
//
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
			<a href="#" data-target="slideout" class="white-text sidenav-trigger menu_bar" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20,7H4C3.4,7,3,6.6,3,6s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,7,20,7z"/><path d="M15.2,13H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h11.2c0.6,0,1,0.4,1,1S15.8,13,15.2,13z"/><path d="M20,19H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h16c0.6,0,1,0.4,1,1S20.6,19,20,19z"/></svg></a>
			<span class="left md-bd blue-grey-text" style="font-size:17px" >One time setup</span>
			<i class="material-icons right black-text" style="margin-right:10px;width:23px" >notifications_none</i>
			<i class="material-icons right black-text" style="margin-right:5px" >mail_outline</i>
		</div>
    </div>
</nav>';

$logged_gd_yes = '<div class="row" >
	<div class="col s12" id="pptd-81817" >
		<span class="left profile_user" >
			'.$gl_profile_yes.''.$gl_profile_no.'
		</span>
		<span class="gd" >'.$am_au.''.$pm_au.' <span class="gd-name" >'.$user['firstname'].'</span></span><br>
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
$seller_au_sidenav = '<li><a class="subheader">Seller Settings</a></li>
<li><a href="" ><i class="material-icons" >edit</i>Create Product</a></li>
<li><a href="" ><i class="material-icons" >dashboard </i>Dashboard</a></li>
<li><a href="" ><i class="material-icons" >account_balance_wallet</i>Shop Revenue</a></li>
<li><a href="" ><i class="material-icons" >analytics</i>Shop Analytics</a></li>';
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
';
}
$logged_au = '<ul id="slideout" class="sidenav white" >
<li><div class="user-view">
      <div class="background">
        <img src="../assets/v1_lib/web_assets/static_image/user_background2.jpg">
      </div>
      <a href="#user">'.$gl_profile_yes_1.'</a>
      <a href="#name"><span class="white-text name">'.$user['username'].'</span></a>
      <a href="#email"><span class="white-text email">'.$user['email'].'</span></a>
    </div></li>
<li><a href="" ><i class= "material-icons" >home</i>Home</a></li>
<li><a href="profile/'.$user['username'].'" ><i class="material-icons" >&#xE87C;</i>My Account</a></li>
<li><a href="order/" ><i class="material-icons" >add_shopping_cart</i>Orders</a></li>
<li><a href="" ><i class="material-icons" >launch</i>Customer Service</a></li>
<li><a href="" ><i class="material-icons" >credit_card</i>Payment Modes</a></li>
<li><a href="" ><i class="material-icons" >local_shipping</i>Track Package </a></li>
<li>
	<div class="divider" ></div>
<li>
'.$seller_au_sidenav.''.$driver_au_sidenav.'
</ul>
';
}
?>
<?php
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['submit']))
{
	$dr_online_status	=	$_POST['dr_online_status'];
	$email				=	$_SESSION['email'];
	
	// update user data
	$result = mysqli_query($con, "UPDATE user_info SET dr_online_status='$dr_online_status' WHERE email='$email'");
	
	// Redirect to homepage to display updated user in list
	header("Location: ../");
}
?>
<form method="POST" action="" >
	<select name="dr_online_status" >
		<option selected="selected" value="busy" >Busy</option>
		<option value="free" >Free</option>
		<option value="on_delivery" >On Delivery</option>
	</select><br>
	<input type="submit" name="submit" value="Submit" >
</form>