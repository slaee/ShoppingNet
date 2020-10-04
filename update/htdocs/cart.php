<?php
// Session Area
session_start();
// Session Variable
$email	=	$_SESSION['email'];

if(empty($_SESSION)){
$_SESSION['lg-first-error'] = '<div class="ribbon red lighten-1" ><span><i class="material-icons" >error_outline</i> You must logged in first</span></div>';
header("Location: ../../../");
}else {
// Nothing
}
?>
<?php
		// Include Database Holder
		require "database/database_lvl3.php";
					
		$sql = "SELECT SUM(subtotal), SUM(quantity) from cart_order WHERE email='".$email."';";
		$result = mysqli_query($con, $sql);
					
		if (mysqli_num_rows($result) > 0) {
			// Output Data of  each row
		while($row = mysqli_fetch_assoc($result)) {
							
		$total = $row['SUM(subtotal)'];
		$qty   = $row['SUM(quantity)'];
		$all_total = $total + 35;
		} 
	}
	mysqli_close($con);
	include 'database/database_lvl3.php';
	// Count Cart
	$query = mysqli_query($con,"SELECT COUNT(*) AS SUM FROM cart_order WHERE email='".$email."'");
	while($result = mysqli_fetch_array($query))
	$cart_ct = $result['SUM'];
	if($cart_ct == "0"){
	
	}else {
	$live_cart = '<span class="badge white-text green darken-1 notif_track_ul " >'.$cart_ct.'</span>';
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
body{background:white;margin:0;padding:0;height:100%;}.not_available {top:20px;}.not_available h2{font-size:40px;font-weight:500;}.suggested-product-image {position: relative;width: 100%; /* Depends On Size */height: 120px;overflow: hidden;border-bottom-left-radius:6px;border-bottom-right-radius:6px;border-top-left-radius:6px;border-top-right-radius:6px;}.suggested-product-image img{width:100%;height:auto;align-items:center}.suggest-card-img{border-radius:6px;border:1px solid #ddd}.ribbon{background:#5c258d;color:#fff;top:0;padding:15px}#global-fixed-img{height:120px}[data-role=popular-product-img]{position:relative;width:100%;height:120px;overflow:hidden;border-top-left-radius:6px;border-top-right-radius:6px}#popular-card[role=custom-card]{margin:0}#popular-card .card-content{padding:10px;margin-left:-10px}#popular-card .card-content #title{font-size:14px;font-weight:400}#popular-card .card-content #seller-name{font-weight:350}#popular-card .card-content #price{font-size:18px;font-weight:500;margin-top:-10px}.checked{color:#006400}[data-role=context-feature]{font-size:22px;vertical-align:middle;padding:10px}.notif_track_ul {border-radius:3em;}.container-track-content {font-size:16px;}
.nav-wrapper {
	b
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
.material-icons {
	vertical-align:middle;
}
.custom-file-upload {
	border: 1px solid #aaa;
	border-radius:4px;
	display: inline-block;
	width:100%;
	height:50px;
	padding: 15px 12px;
	cursor: pointer;
	font-size:13px;
	transition:0.5s;
}
.custom-file-upload:hover {
	border:1px solid skyblue;
}
#breadcrumbs {
	font-size:15px;
}
.active_page {
	font-weight:500;
}
.gift-input {
	width:100%;
	height:80px;
	padding:5px;
	border-radius:5px;
	border:1px solid #ddd;
	outline:none;
	font-size:16px;
	font-weight:400 ;
	text-decoration:none;
	margin-top:5px;
	transition:0.1s;
}
.gift-input::placeholder {
	font-weight:500;
}
.gift-input:hover {
	border-radius:5px;
	border:1px solid skyblue;
}.au-input {
	width:100%;
	height:70px;
	padding:5px;
	border-radius:4px;
	border:1px solid #ddd;
	outline:none;
	font-size:16px;
	text-decoration:none;
	margin-top:5px;
	transition:0.1s;
}
.au-input::placeholder {
	color:#888;
}
.au-input:hover {
	border-radius:5px;
	border:1px solid skyblue;
}
.nb_btm {
	overflow: hidden;
	position: fixed;
	bottom: 0;
	width: 100%;
	background:white;
	padding:5px;
	z-index:999;
}
.nb_btm .total-text {
	margin-left:15px;
	margin-right:7px;
	font-size:17px;
}
.nb_btm .total-price {
	font-size:19px;
	font-weight:600;
}
.nb_btm .tax-t {
	margin-top:-10px;
	font-size:12px;
	margin-left:15px;
}
.place-order-au {
	margin-top:-25px;
	margin-right:10px;
	background:#333;
}
.item-image img {
	pointer-events:none;
}
.item .title {
	font-size:16px;
}
.item .price {
	margin-right:20px;
	font-weight:600;
	font-size:15.90px;
}
#qty-op {
	width:80px;
}
#gift-package-0 {
	margin-left:25px;
}
#gift-package-1 {
	display:none;
}
#gift-message-au {
	display:none;
}
.control-item {
	padding:40px;
	margin-left:-40px;
}
.coupon_content {
	padding:10px;
	margin-left:-10px;
}
.coupon_link {
	text-decoration:underline;
	font-size:15px;
}
[type="checkbox"].filled-in:checked + span:not(.lever):after {
	border-radius:50%;
	transition:0.2s;
}
[type="checkbox"].reset-checkbox+span:not(.lever) {
	vertical-align:middle;
	padding-left:25px;
}
.payment_au .title{
	font-size:20px;
	font-weight:500;
	margin-top:-20px;
}
.payment-det .it{
	font-size:17px;
}
.h1-sx {
	color:rgba(100,100,100,0.9);
	font-family:'Helvetica Neue', sans-serif; 
	font-size:25px;
	letter-spacing:1px;
	line-height:1;
}
.ft-18px {
	font-size:18px;
}
</style>

<div class="navbar-fixed" >
<nav class="white" style="box-shadow:0 0 5px 0 #c3c3c3;">
	<div class="nav-wrapper">
		<a href="../../../" ><i class="material-icons left black-text" style="margin-left:15px;width:23px" >arrow_back_ios</i>
		</a>
		<a href="" class="brand-logo black-text" >Shopping Cart</a>
		<a href="" >
			<i class="material-icons blue-grey-text text-darken-4 right" style="font-size:29px;margin-right:10px" >help_center</i>
		</a>
    </div>
</nav>
</div>
<?php 
// Added on cart
echo $_SESSION['already_added_cart']; 
unset($_SESSION['already_added_cart']);
?><br>

<center>
<div class="breadcrumbs_content" >
	<span class="active_page blue-grey-text " id="breadcrumbs" >Cart </span><span id="breadcrumbs" ><i class="material-icons" >chevron_right</i></span>
	<span class="" id="breadcrumbs" >Place Order </span><span id="breadcrumbs" ><i class="material-icons" >chevron_right</i></span>
	<span class="" id="breadcrumbs" >Payment</span><span id="breadcrumbs" ><i class="material-icons" >chevron_right</i></span>
	<span class="" id="breadcrumbs" >Shipment</span><span id="breadcrumbs" ><i class="material-icons" >chevron_right</i></span>
</div>
</center><br>
<hr style="height:10px;background:#f3f4f5;border:none;" >
<?php 
// Include Database Holder
	require "database/database_lvl3.php";
					
// Attempt Select Query Execution
	$sql = "SELECT * FROM cart_order WHERE email='".$email."' ORDER BY id desc";
		$result = mysqli_query($con, $sql);
		if(mysqli_num_rows($result)) {
// Output data of each row
		while ($row = mysqli_fetch_assoc($result)) { ?>
		<?php
			$output_lvl1 = $row['price'];
			$global_price_lvl1 = number_format( $output_lvl1 , 0 , '.' , ',' );
			
			$output_lvl2 = $row['sale_price'];
			$global_price_lvl2 = number_format( $output_lvl2 , 0 , '.' , ',' );
		?>
		<div class="ribbon white" >
		<b class="black-text" style="vertical-align:middle" >
		<svg style="width:23px; vertical-align:middle" enable-background="new 0 0 244.742 244.742" fill="black" version="1.1" viewBox="0 0 244.74 244.74" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
		<path d="m243.37 85.341-45.651-65.307c-1.425-2.037-3.751-3.249-6.236-3.249h-135.69c-2.417 0-4.689 1.146-6.122 3.092l-48.188 65.307c-0.964 1.309-1.486 2.891-1.486 4.517 0 15.062 10.987 27.581 25.359 30.039v84.546c0 13.051 10.619 23.67 23.67 23.67h148.58c13.051 0 23.668-10.619 23.668-23.67v-85.056c12.179-3.125 21.454-13.571 22.775-26.366 1.118-2.443 0.867-5.306-0.682-7.523zm-63.298 127.4h-31.702v-64.99h31.702v64.99zm25.987-8.453c3e-3 4.662-3.791 8.453-8.447 8.453h-2.323v-72.598c0-4.202-3.406-7.609-7.609-7.609h-46.919c-4.202 0-7.609 3.406-7.609 7.609v72.598h-84.123c-4.662 0-8.453-3.792-8.453-8.453v-85.802c4.994-1.753 9.404-4.755 12.833-8.648 5.595 6.356 13.789 10.37 22.899 10.37s17.304-4.015 22.899-10.37c5.595 6.356 13.789 10.37 22.899 10.37 9.113 0 17.307-4.015 22.902-10.37 5.595 6.356 13.789 10.37 22.899 10.37s17.304-4.015 22.899-10.37c3.969 4.509 9.265 7.806 15.253 9.361v85.089zm7.65-99.296c-8.43 0-15.291-6.86-15.291-15.291 0-4.202-3.406-7.609-7.609-7.609-4.202 0-7.609 3.406-7.609 7.609 0 8.433-6.86 15.291-15.291 15.291s-15.291-6.86-15.291-15.291c0-4.202-3.406-7.609-7.609-7.609-4.202 0-7.609 3.406-7.609 7.609 0 8.433-6.86 15.291-15.293 15.291s-15.291-6.86-15.291-15.291c0-4.202-3.406-7.609-7.609-7.609s-7.609 3.406-7.609 7.609c0 8.433-6.86 15.291-15.291 15.291s-15.291-6.86-15.291-15.291c0-4.202-3.406-7.609-7.609-7.609s-7.609 3.406-7.609 7.609c0 8.433-6.86 15.291-15.291 15.291-7.659 0-14.02-5.658-15.123-13.016l44.251-59.973h127.88l41.406 59.233c-0.774 7.715-7.304 13.756-15.217 13.756z"/>
		<path d="m112.13 132.54h-51.896c-4.202 0-7.609 3.406-7.609 7.609v47.556c0 4.202 3.406 7.609 7.609 7.609h51.895c4.202 0 7.609-3.406 7.609-7.609v-47.556c0-4.203-3.406-7.609-7.608-7.609zm-7.609 47.556h-36.678v-32.339h36.678v32.339z"/>
		</svg>
		<?php echo $row['seller']; ?>
		</b>
		<a href="" class="right" >Edit</a>
		</div>		
<div class="row white" >
	<div class="col s4 item-image" >
		<img src="../../../static/cdn/products_new_rdr/<?php echo $row['image']; ?>" class="materialboxed">
	</div>
	<div class="col s8 left item" >
		<span class="title" ><?php echo $row['product']; ?></span><br><br>
			<span class="qty-text" >edit </span><br>
			<select type="select" id="qty-op" name="quantity" class="browser-default left z-depth-0">
			<option <?php if($row['quantity'] == '1') echo "selected"; ?>>1</option>
			<option <?php if($row['quantity'] == '2') echo "selected"; ?>>2</option>
			<option <?php if($row['quantity'] == '3') echo "selected"; ?>>3</option>
			<option <?php if($row['quantity'] == '4') echo "selected"; ?>>4</option>
			<option <?php if($row['quantity'] == '5') echo "selected"; ?>>5</option>
			<option <?php if($row['quantity'] == '6') echo "selected"; ?>>6</option>
			<option <?php if($row['quantity'] == '7') echo "selected"; ?>>7</option>
			<option <?php if($row['quantity'] == '8') echo "selected"; ?>>8</option>
			<option <?php if($row['quantity'] == '9') echo "selected"; ?>>9</option>
			<option <?php if($row['quantity'] == '10') echo "selected"; ?>>10</option>
			<option <?php if($row['quantity'] == '11') echo "selected"; ?>>11</option>
			<option <?php if($row['quantity'] == '12') echo "selected"; ?>>12</option>
			<option <?php if($row['quantity'] == '13') echo "selected"; ?>>13</option>
			<option <?php if($row['quantity'] == '14') echo "selected"; ?>>14</option>
			<option <?php if($row['quantity'] == '15') echo "selected"; ?>>15</option>
			<option <?php if($row['quantity'] == '16') echo "selected"; ?>>16</option>
			<option <?php if($row['quantity'] == '17') echo "selected"; ?>>17</option>
			<option <?php if($row['quantity'] == '18') echo "selected"; ?>>18</option>
			<option <?php if($row['quantity'] == '19') echo "selected"; ?>>19</option>
			<option <?php if($row['quantity'] == '20') echo "selected"; ?>>20</option>
			<option <?php if($row['quantity'] == '21') echo "selected"; ?>>21</option>
			<option <?php if($row['quantity'] == '22') echo "selected"; ?>>22</option>
			<option <?php if($row['quantity'] == '23') echo "selected"; ?>>23</option>
			<option <?php if($row['quantity'] == '24') echo "selected"; ?>>24</option>
			<option <?php if($row['quantity'] == '25') echo "selected"; ?>>25</option>
			<option <?php if($row['quantity'] == '26') echo "selected"; ?>>26</option>
			<option <?php if($row['quantity'] == '27') echo "selected"; ?>>27</option>
			<option <?php if($row['quantity'] == '28') echo "selected"; ?>>28</option>
			<option <?php if($row['quantity'] == '29') echo "selected"; ?>>29</option>
			<option <?php if($row['quantity'] == '30') echo "selected"; ?>>30</option>
			<select>
		<span class="right price" >PHP <?php echo $global_price_lvl1; ?></span><br><br>
		<div class="control-item" >
			<div class="left" >
				<a href="../../../listing/<?php echo $row['rnd']; ?>" class="black-text" ><i class="material-icons" >open_in_browser</i>View item</a>
			</div>
			<div class="right" style="margin-right:-30px" >
				<a href="../../../cart_remove?id=<?php echo $row['id']; ?>" class="black-text" ><i class="material-icons" >delete_outline</i>Remove item</a>
			</div>
		</div>
	</div>
</div><hr style="height:10px;background:#f3f4f5;border:none;" >

<?php }	} else {
		echo '<br><br><div class="center" >
		<span class="h1-sx" >Cart is empty</span>
		</div>';;
	}
	mysqli_close($con);	
?><br>
<div class="container" >
	<span class="light left ft-18px" >Shipping Fee</span>
	<span class="light right ft-18px" >&#8369;35</span>
	</div><br><br>
	<div class="container" >
	<span class="light left ft-18px" >Tax</span>
	<span class="light right ft-18px" >&#8369;0.00</span>
	</div><br><br>
	<div class="container" >
	<span class="light left ft-18px" >Subtotal</span>
	<span class="light right ft-18px" >&#8369;<?php echo number_format($total); ?></span>
	</div><br><br>
	<div class="container" >
	<span class="light left ft-18px" >total</span>
	<span class="md-bd right ft-18px" >&#8369;<?php echo number_format($all_total); ?></span>
	</div><br><br><br><br><br>

<div class="z-depth-4 nb_btm hide-on-med-only hide-on-large-only" >
	<div class="nav-wrapper" >
		<span class="total-text black-text" >total(<?php echo $cart_ct; ?> item)</span> <span class="total-price black-text" >&#8369;<?php echo number_format($all_total); ?></span><br>
		<span class="tax-t blue-grey-text text-lighten-2 style="" >TAX included, Where applicable</span>
		<a href="../../../place_order" class="btn z-depth-0 red lighten-2 right place-order-au" >Next <i class="material-icons" >chevron_right</i></a>
    </div>
</div>

<script type="text/javascript">
function wynBox() {
    document.getElementsByClassName("box")[0].style.display = 'none';
}
</script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
</script>
<script type="text/javascript" src="../../../assets/v1_lib/web_assets/material.js"></script>
