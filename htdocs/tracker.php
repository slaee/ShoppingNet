<?php
// Session Area w/ Logout functions
session_start();
if(empty($_SESSION['email'] )){
header("Location: ../../../"); 
}else {
// Nothing 
}
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
		<img src="../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" ></div>';
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
if ($time >= "12" && $time < "15") {
	$goodafternoon_au = 'Good Afternoon';
} else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
if ($time >= "15" && $time < "17") {
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
			<a href="../" ><i class="material-icons left black-text" style="margin-left:15px;width:23px" >arrow_back_ios</i></a>
		</div>
    </div>
</nav>';

$logged_gd_yes = '<div class="row" >
	<div class="col s12" id="pptd-81817" >
		<span class="left profile_user" >
			'.$gl_profile_yes.''.$gl_profile_no.'
		</span>
		<span class="gd" >'.$goodmorning_au.''.$goodafternoon_au.''.$goodevening.''.$goodnight_au.' <span class="gd-name" >'.$user['firstname'].'</span></span><br>
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
<li><a href="" ><i class="material-icons" >storefront</i>My store</a></li>
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
<li><a href="" ><i class="material-icons" >dashboard</i>Dashboard</a></li>
<li><a href="dashboard/" ><i class="material-icons" >near_me</i>Booking list '.$live_notif_booking.' </li></a></li>
<li><div class="divider" ></div><li>
';
}
$logged_au = '<ul id="slideout" class="sidenav white" >
<li><div class="user-view">
      <div class="background">
        <img src="../assets/v1_lib/web_assets/static_image/user_background2.jpg">
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
<li><a href="" ><i class="material-icons" >logout</i>Sign Out</a></li>
</ul>
';
}
?>
<?php
    //tol create ka lang table every account tas yung variable function  return value eh execute mo sa database sa longitude and latitude  table ng account 
    
    //variable function to return a value itself para eh pasok sa database
    $getLongitude = function() {
        //initialize curl function
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://freegeoip.app/json/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $array = json_decode($response, true);

        curl_close($curl);


        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //return value ng variable
            return (string)$array['longitude'];
        }
    };
    
    $getLatitude = function() {
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://freegeoip.app/json/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $array = json_decode($response, true);

        curl_close($curl);


        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //return value ng variable
            return (string)$array['latitude'];
        }
    };
    
    //invoke variable function to get the returned value
   // $getLongitude();
    //output will be your longitude and latidude
   // $getLatitude();
?>

<?php
include 'database/database_lvl4.php';
	
	$user_email		=	$_SESSION['email'];
	$user_long		= 	$getLongitude();
	$user_lat		=	$getLatitude();
    $sql = "UPDATE user_info SET user_long='$user_long', user_lat='$user_lat' WHERE email='$user_email'";
    
    $conn->query($sql);
?>