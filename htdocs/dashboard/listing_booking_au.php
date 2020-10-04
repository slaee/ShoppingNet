<?php
session_start();
// Empty Session
$email = $_SESSION['email'];
if(empty($_SESSION['email'])) {
header("Location: ../?ref=18176hd_0_5iq04prof_55_1dashboard");
}
?>
<ul class="collection">
<?php
include '../database/database_lvl3.php';
$result = mysqli_query($con,"SELECT * FROM booking WHERE driver_email='".$email."' AND booking_status='unverified' ");
while($list_booking = mysqli_fetch_array($result)) {
	echo '<li class="collection-item transparent"><div>'.$list_booking['user_email'].'<a href="details_bk_au/?su6='.$list_booking['booking_id'].'" class="secondary-content"><i class="material-icons">arrow_forward</i></a></div></li>';
}
?>
</ul>