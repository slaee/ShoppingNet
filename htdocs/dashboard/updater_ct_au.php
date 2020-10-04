<?php
session_start();
// Empty Session
$email = $_SESSION['email'];
if(empty($_SESSION['email'])) {
header("Location: ../?ref=18176hd_0_5iq04prof_55_1dashboard");
}
?>

<?php
include '../database/database_lvl3.php';
$query = mysqli_query($con,"SELECT COUNT(*) AS SUM FROM booking WHERE driver_email='".$email."' AND booking_status='unverified'");
while($result = mysqli_fetch_array($query))
$booking_ct = $result['SUM'];

$query = mysqli_query($con,"SELECT COUNT(*) AS SUM FROM booking WHERE driver_email='".$email."' AND booking_status='confirm'");
while($result = mysqli_fetch_array($query))
$booking_cu = $result['SUM'];
?>
<?php echo $booking_ct; ?>
<!--<div class="card z-depth-0 yellow darken-2 white-text valign-wrapper" id="card-statics-1817019" >
	<div class="yellow darken-3 icon valign-wrapper" >
		<i class="material-icons medium valign" >location_on</i>
	</div>
	<div class="card-content" >
		<div class="row" >
			<h3 class="card-stats-number" ><?php echo $booking_ct; ?></h3>
			<p>Your booking task now</p>
		</div>
	</div>
</div>
<div class="card z-depth-0 yellow darken-2 white-text valign-wrapper" id="card-statics-1817019" >
	<div class="yellow darken-3 icon valign-wrapper" >
		<i class="material-icons medium valign" >check_circle</i>
	</div>
	<div class="card-content" >
		<div class="row" >
			<h3 class="card-stats-number" ><?php echo $booking_cu; ?></h3>
			<p>Confirm Booking</p>
		</div>
	</div>
</div>-->