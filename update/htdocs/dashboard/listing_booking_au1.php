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
$result = mysqli_query($con,"SELECT * FROM booking WHERE driver_email='".$email."' AND booking_status='confirm' ");
while($list_booking = mysqli_fetch_array($result)) {
	echo '<li class="collection-item transparent"><div>'.$list_booking['user_email'].'</div></li>';
}
?>
</ul>