<?php
// Session Area
session_start();
?>
<?php 
// Processing form when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
// Include Database Holder
require_once "database/database_lvl3.php";
	
	$rnd			=		$_POST['rnd'];	
	$invoice		=		$_POST['invoice'];
	$image			=		$_POST['image'];
	$seller			=		$_POST['seller'];
	$product		=		$_POST['product'];
	$descript		=		$_POST['descript'];
	$price			=		$_POST['price'];
	$location		=		$_POST['location'];
	$qty			=		$_POST['quantity'];
	$preparation	=		$_POST['preparation'];
	$user_email		=		$_SESSION['email'];
	
	// Product of Quantity x Price
	$subtotal = $price * $qty;

	$select = mysqli_query($con, "SELECT * FROM cart_order WHERE email= '".$user_email."' AND rnd='".$_POST['rnd']."' ") or exit(mysqli_error($connectionID));
	if(mysqli_num_rows($select)) {
	// exit('This email is already being used');
	$_SESSION['already_added_cart'] = '<div class="ribbon red lighten-2 box" >
	Already added to your cart <i onclick="wynBox();" class="material-icons right" >cancel</i> 
	</div>';
	header("Location: ../../cart/");	
	}else {
	
	// Prepare Insert Statement in cart_order table
	$sql = "INSERT INTO cart_order (rnd, image, seller, product, description, business_day, location, price, quantity, subtotal, email) VALUES ('$rnd', '$image', '$seller', '$product', '$descript', '$preparation', '$location', '$price', '$qty', '$subtotal', '$user_email');";
			
	if(mysqli_query($con, $sql)) {
		$_SESSION['added_cart'] = '<div class="container ribbon lime lighten-4 black-text box" style="border-radius:6px" >
		Added to your cart <a href="../../../cart/" class="blue-text text-darken-4" >View Cart</a><a onclick="wynBox();" class="black-text" ><span class="right" ><i class="material-icons" >close</i></span></a>
		</div><br>';
		header("location: ../../cart_test");
	} else {
		exit('Error at Database');
	}
	mysqli_close($con);
	}
}
?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["listing"]) && !empty($_GET["listing"])){

// Include Database Holder 
require_once ("database/database_lvl3.php");

	// Prepare a select statement
   $sql = "SELECT * FROM products WHERE rnd = '".$_GET["listing"]."'";
    
	$result = mysqli_query($con, $sql);   
   	if(mysqli_num_rows($result) == 1){
    		//Since the result set contains only one row, we don't need to use while loop 
      $row = mysqli_fetch_assoc($result);
                  		
  			// Retrieve individual field value
  			
  			$id				=	$row['id'];
  			$category		=	$row['category'];
  			$product 		=	$row['product'];
  			$description	=	$row['description'];	
  			$FAQ			=	$row['FAQ'];
  			$FAQ2			=	$row['FAQ2'];
  			$FAQ3			=	$row['FAQ3'];
  			$FAQ4			=	$row['FAQ4'];
  			$material		=	$row['material'];
  			$handmade		=	$row['handmade'];
  			$return_option	=	$row['return_option'];
  			$stock			=	$row['stock'];
  			$sale_price		=	$row['sale_price'];
  			$oldprice		=	$row['oldprice'];
  			$image1			=	$row['image1'];
  			$image2			=	$row['image2'];
  			$image3			=	$row['image3'];
  			$image4			=	$row['image4'];
  			$image5			=	$row['image5'];
  			$rnd			=	$row['rnd'];
  			$seller			=	$row['seller'];
  			$business_day	=	$row['business_day'];
  			$deliver		=	$row['deliver'];
  			$location		=	$row['location'];
  			
			} else{
       		// URL doesn't contain valid id parameter. Redirect to error page
        	// header("location: error.php");
        	 header("Location: ../../");
        	// echo 'hey';
        	exit();
    	}  
  		// Close connection
  		mysqli_close($con);

	} else{
    		// URL doesn't contain id parameter. Redirect to error page
    		// header("location: error.php");
    		header("location: ../");
    		// echo 'jn';
    		exit();
}
// ---------
$output_lvl1 = $row['retail_price'];
$global_price_lvl1 = number_format( $output_lvl1 , 0 , '.' , ',' );

$output_lvl2 = $row['sale_price'];
$global_price_lvl2 = number_format( $output_lvl2 , 0 , '.' , ',' );
// ---------

?>
<!DOCTYPE html>
<html lang="en-us" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="icon" type="image/png" sizes="64x64" href="assets/test2.png" >
	<meta name="theme-color" content="white">
	<link rel="canonical" href="<?php echo $actual_link; ?>" />
	
	<?php
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	?>
	<title><?php echo $product; ?> &mdash; <?php echo $description; ?></title>
	<meta name="og:title" content="<?php echo $product; ?>"/>
	<meta name="og:type" content="e-commerce"/>
	<meta name="og:url" content=""/>
	<meta name="og:image" content="<?php echo $image; ?>" >
	<meta name="og:site_name" content="<?php echo $product; ?>"/>
	<meta name="og:description" content="<?php echo $description; ?>" >
	<script type="text/javascript">var meta=document.createElement('meta');meta.name='viewport';meta.setAttribute('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0');document.getElementsByTagName('head')[0].appendChild(meta);</script>
	<script type="text/javascript" src="../../../assets/v1_lib/web_assets/jquery.min.js"></script>
	<script type="text/javascript" src="../../../assets/slider-au/swiper-bundle.min.js"></script>
	<script type="text/javascript" src="../../../assets/slider-au/swiper-bundle.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../../assets/v1_lib/web_assets/materialize.css" >
	<link rel="stylesheet" type="text/css" href="../../../assets/slider-au/swiper-bundle.min.css" >
	<link rel="stylesheet" type="text/css" href="../../../assets/slider-au/swiper-bundle.css" >
</head>
<body>
<style>
<?php include 'assets/v1_lib/web_assets/v1_mobile_test.css'; ?>
.swiper-container {
	width: 100%;
	height: 100%;
	margin-top:0;
}
.swiper-slide {
	text-align: center;
	font-size: 18px;
	background: #fff;
	display: -webkit-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	-webkit-box-pack: center;
	-ms-flex-pack: center;
	-webkit-justify-content: center;
	justify-content: center;
	-webkit-box-align: center;
	-ms-flex-align: center;
	-webkit-align-items: center;
	align-items: center;
}
.user-product-img {
	object-fit:contain;
}
.user-product-img img{
	object-fit: cover;
	width: 100%;
	height: 350px;
	background: white;
}
.circle {
	position:absolute;
	z-index:999;
	margin-top:10px;
	margin-left:10px;
	display: inline-block;
	border-radius: 50%;
	min-width: 15px;
	min-height: 15px;
	padding: 5px;
	background: rgba(0,0,0,0.3);
	color: white;
	text-align: center;
	line-height: 1;
	box-sizing: content-box;
	white-space: nowrap;
}
.circle:before {
	content: "";
	display: inline-block;
	vertical-align: middle;
	padding-top: 100%;
	height: 0;
}
.circle span {
	display: inline-block;
	vertical-align: middle;
}
.product-info {
	margin-left:10px;
}
.product-info .title{
	font-size:25px;
	font-weight:450;
}
.material-icons {
	vertical-align:middle;
}
#new-shop-user {
	padding:7px; 
	border-radius:2em;
	font-weight:bolder;
}
.addcart-btn {
	border:none;
	width:100%;
	padding:15px 32px;
	text-align:center;
	text-decoration:none;
	display:inline-block;
	font-size:16px;
	font-weight:bolder;
	color:white;
	border-radius:2em;
	background:#222222;
	outline:none;
}
.title_desc {
	font-size:16px;
}
.title_content {
	font-size:15px;
}
.material-icons {
	vertical-align:middle;
}
svg {
	vertical-align:middle;
}
.context-about {
	font-size:16px;
	font-family:sans-serif;
	text-align:justify;
	width:100%;
}
.tabs > .tab > a:hover {
    background-color: unset !important;
    color:black;
    text-transform:none;
}
.tabs > .tab > a {
	text-transform:none;
}
</style>
<a href="javascript:history.back()" ><div class="circle left" >
<span>
	<svg style="width:15px;margin-right:6px;fill:white" enable-background="new 0 0 477.175 477.175" version="1.1" viewBox="0 0 477.18 477.18" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"> <path d="m145.19 238.58 215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>
</span>
</div></a>
<div class="swiper-container">
	<div class="swiper-wrapper">
	<?php 
	if($row['image1'] == "0"){
	echo '<div class="swiper-slide" style="display:none" >
	<div class="user-product-img" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image1'].'" >
	</div>
	</div>';
	}else {
	echo '<div class="swiper-slide">
	<div class="user-product-img swiper-zoom-container" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image1'].'" >
	</div>
	</div>';
	}
	if($row['image2'] == "0"){
	echo '<div class="swiper-slide" style="display:none" >
	<div class="user-product-img" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image2'].'" >
	</div>
	</div>';
	}else {
	echo '<div class="swiper-slide">
	<div class="user-product-img swiper-zoom-container" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image2'].'" >
	</div>
	</div>';
	}
	if($row['image3'] == "0"){
	echo '<div class="swiper-slide" style="display:none" >
	<div class="user-product-img" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image3'].'" >
	</div>
	</div>';
	}else {
	echo '<div class="swiper-slide">
	<div class="user-product-img swiper-zoom-container" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image3'].'" >
	</div>
	</div>';
	}
	if($row['image4'] == "0"){
	echo '<div class="swiper-slide" style="display:none" >
	<div class="user-product-img" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image4'].'" >
	</div>
	</div>';
	}else {
	echo '<div class="swiper-slide">
	<div class="user-product-img swiper-zoom-container" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image4'].'" >
	</div>
	</div>';
	}
	if($row['image5'] == "0"){
	echo '<div class="swiper-slide" style="display:none" >
	<div class="user-product-img" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image5'].'" >
	</div>
	</div>';
	}else {
	echo '<div class="swiper-slide">
	<div class="user-product-img swiper-zoom-container" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image5'].'" >
	</div>
	</div>';
	}
	if($row['image6'] == "0"){
	echo '<div class="swiper-slide" style="display:none" >
	<div class="user-product-img" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image6'].'" >
	</div>
	</div>';
	}else {
	echo '<div class="swiper-slide">
	<div class="user-product-img swiper-zoom-container" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image6'].'" >
	</div>
	</div>';
	}
	if($row['image7'] == "0"){
	echo '<div class="swiper-slide" style="display:none" >
	<div class="user-product-img" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image7'].'" >
	</div>
	</div>';
	}else {
	echo '<div class="swiper-slide">
	<div class="user-product-img swiper-zoom-container" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image7'].'" >
	</div>
	</div>';
	}
	if($row['image8'] == "0"){
	echo '<div class="swiper-slide" style="display:none" >
	<div class="user-product-img" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image8'].'" >
	</div>
	</div>';
	}else {
	echo '<div class="swiper-slide">
	<div class="user-product-img swiper-zoom-container" >
	<img src="../../../static/cdn/products_new_rdr/'.$row['image8'].'" >
	</div>
	</div>';
	}
	?>
	<?php 
	// Cart required login
	if(empty($_SESSION['email'])){
	$need_login_cart = '<a href="../../../login/" class="addcart-btn" >Add to cart</a>';
	}else {
	$add_cart_user = '<input type="submit" value="Add to cart" class="addcart-btn" >';
	}
	// Stock Messages
	if($stock == "0") {
	$out_stock = "Out stock";
	}elseif($stock == "10") {
	$stock10 = "Last 10 stocks";
	}elseif($stock == "9") {
	$stock9 = "Last 9 stocks";
	}elseif($stock == "8") {
	$stock8 = "Last 8 stocks";
	}elseif($stock == "7") {
	$stock7 = "Last 7 stocks";
	}elseif($stock == "6") {
	$stock6 = "Last 6 stocks";
	}elseif($stock == "5") {
	$stock5 = "Last 5 stocks";
	}elseif($stock == "4") {
	$stock4 = "Last 4 stocks";
	}elseif($stock == "3") {
	$stock3 = "Last 3 stocks";
	}elseif($stock == "2") {
	$stock2 = "Last 2 stocks";
	}elseif($stock == "1") {
	$stock1 = "Last stock buy now";
	}
	else {
	$in_stock = "<i class='material-icons'>check</i> In stock";
	}
	if($stock == "0") {
	// Nothing for now
	$outstockbtn = '<input type="submit" value="Out of stock" class="addcart-btn" disabled>';
	}else {
	$onstockbtn_add_cart = ''.$need_login_cart.''.$add_cart_user.'';
	}
	?>
    </div>
	<div class="swiper-pagination"></div>
</div>
<div class="product-info" >
	<span style="font-size:16px" ><i class="material-icons" >storefront</i> <a href="../../shop/<?php echo $seller; ?>" class="black-text" >Elwyn Shop</a> </span><br>
	<span class="title blue-grey-text text-darken-4" ><?php echo $row['product']; ?></span><br>
	<span class="green lighten-4" id="new-shop-user" >
	<?php echo $stock10 . $stock9 . $stock8 . $stock7 . $stock6 . $stock5 . $stock4 . $stock3 . $stock2 . $stock1 . $in_stock . $out_stock;?>
	</span><br><br>
	<?php
	if($sale_price == "0"){
	echo '<span style="font-size:30px" >&#8369;'.$global_price_lvl1.'</span>';
	}else {
	echo '<span style="font-size:30px" >&#8369;'.$global_price_lvl2.'<span style="margin-left:10px;font-size:17px" ><del>&#8369;'.$global_price_lvl1.'</del></span></span>';
	}
	?><br>
	<?php
	// Count Cart
	include 'database/database_lvl3.php';
	$query = mysqli_query($con,"SELECT COUNT(*) AS SUM FROM cart_order WHERE rnd='".$rnd."' ");
	while($result = mysqli_fetch_array($query))
	$cart_nf = $result['SUM'];
	if($cart_nf == "20"){
	echo '<span class="green-text" ><i class="material-icons" >insights</i> Over 20 people have this in their carts right now</span>';
	}else {
	
	}
	?>
</div>
<div class="container" >
	<form method="post" action="?listing" enctype="multipart/form-data" name="cart" >
	<p class="light" style="margin-bottom:4px" >Quantity</p>
	<?php
	// Sale & Retail Function 
	if($sale_price == "0"){
	$not_sale = $row['retail_price'];
	}else {
	$on_sale = $sale_price;
	}
	?>
	<input type="hidden" name="product" value="<?php echo $product ?>" >
	<input type="hidden" name="image" value="<?php echo $image1; ?>" >
	<input type="hidden" name="rnd" value="<?php echo $rnd; ?>" >
	<input type="hidden" name="price" value="<?php echo ''.$on_sale.''.$not_sale.''; ?>" >
	<input type="hidden" name="descript" value="<?php echo $descript; ?>" >
	<input type="hidden" name="preparation" value="<?php echo $business_day; ?>" >
	<input type="hidden" name="seller" value="<?php echo $seller; ?>" >
	<input type="hidden" name="location" value="<?php echo $location; ?>" >
	<select id="selects" name="quantity" class="browser-default" >
		<option selected="selected" disabled="disabled" <?php if(isset($qty)&&$qty=='1'); ?>>Select an option</option>
		<option <?php if(isset($qty)&&$qty=='1') echo "selected"; ?>>1</option>
		<option <?php if(isset($qty)&&$qty=='2') echo "selected"; ?>>2</option>
		<option <?php if(isset($qty)&&$qty=='3') echo "selected"; ?>>3</option>
		<option <?php if(isset($qty)&&$qty=='4') echo "selected"; ?>>4</option>
		<option <?php if(isset($qty)&&$qty=='5') echo "selected"; ?>>5</option>
		<option <?php if(isset($qty)&&$qty=='6') echo "selected"; ?>>6</option>
		<option <?php if(isset($qty)&&$qty=='7') echo "selected"; ?>>7</option>
		<option <?php if(isset($qty)&&$qty=='8') echo "selected"; ?>>8</option>
		<option <?php if(isset($qty)&&$qty=='9') echo "selected"; ?>>9</option>
		<option <?php if(isset($qty)&&$qty=='10') echo "selected"; ?>>10</option>
		<option <?php if(isset($qty)&&$qty=='11') echo "selected"; ?>>11</option>
		<option <?php if(isset($qty)&&$qty=='12') echo "selected"; ?>>12</option>
		<option <?php if(isset($qty)&&$qty=='13') echo "selected"; ?>>13</option>
		<option <?php if(isset($qty)&&$qty=='14') echo "selected"; ?>>14</option>
		<option <?php if(isset($qty)&&$qty=='15') echo "selected"; ?>>15</option>
		<option <?php if(isset($qty)&&$qty=='16') echo "selected"; ?>>16</option>
		<option <?php if(isset($qty)&&$qty=='17') echo "selected"; ?>>17</option>
		<option <?php if(isset($qty)&&$qty=='18') echo "selected"; ?>>18</option>
		<option <?php if(isset($qty)&&$qty=='19') echo "selected"; ?>>19</option>
		<option <?php if(isset($qty)&&$qty=='20') echo "selected"; ?>>20</option>
		<option <?php if(isset($qty)&&$qty=='21') echo "selected"; ?>>21</option>
		<option <?php if(isset($qty)&&$qty=='22') echo "selected"; ?>>22</option>
		<option <?php if(isset($qty)&&$qty=='23') echo "selected"; ?>>23</option>
		<option <?php if(isset($qty)&&$qty=='24') echo "selected"; ?>>24</option>
		<option <?php if(isset($qty)&&$qty=='25') echo "selected"; ?>>25</option>
		<option <?php if(isset($qty)&&$qty=='26') echo "selected"; ?>>26</option>
		<option <?php if(isset($qty)&&$qty=='27') echo "selected"; ?>>27</option>
		<option <?php if(isset($qty)&&$qty=='28') echo "selected"; ?>>28</option>
		<option <?php if(isset($qty)&&$qty=='29') echo "selected"; ?>>29</option>
		<option <?php if(isset($qty)&&$qty=='30') echo "selected"; ?>>30</option>
	</select>
	<?php echo $onstockbtn_add_cart; ?>
	<?php echo $onstockbtn; ?><?php echo $outstockbtn; ?>
	</form>
</div><br>
<div class="row" >
	<span class="col s12 title_desc blue-grey-text text-darken-2 light" >Description</span><br>
	<span class="col s12title_content" ><?php echo $description; ?></span><br><br>
	
	
	<div class="col s6" >
		<span class="title_desc blue-grey-text text-darken-2 light" >Delivery</span><br>
		<span class="title_content" ><?php echo $business_day; ?></span><br><br>
	</div>
	<div class="col s6" >
		<span class="title_desc blue-grey-text text-darken-2 light" >Delivery Fee</span><br>
		<span class="title_content" >&#8369;35 (standard)</span><br><br>
	</div><br>
	
	<span class="col s12 title_desc blue-grey-text text-darken-2 light" >Delivery Location</span><br>
	<span class="col s12 title_content" ><i class="material-icons" >not_listed_location</i> This item is available only at Cebu City</span><br><br><br><br>
	
	<?php 
	// Material 
	if(empty($material)){
	// Nothing
	}else {
	echo '<br><span class="col s12 title_desc blue-grey-text text-darken-2 light" >Material</span><br>
	<span class="col s12 title_content" >'.$material.'</span><br><br>';
	}
	// Handmade 
	if(empty($handmade)){
	// Nothing	
	}else {
	echo '<span class="col s12" > <svg style="width:30px" viewBox="-64 0 485 486" width="486pt" xmlns="http://www.w3.org/2000/svg"><path d="m91.320312 486h98.019532c32.964844 0 63.371094-18.976562 79.351562-49.675781l87.394532-167.847657c1.738281-3.335937.910156-7.433593-1.988282-9.828124l-8.984375-7.4375c-10.375-9.644532-24.28125-14.5625-38.410156-13.589844-14.425781 1.058594-27.761719 8.066406-36.816406 19.34375l-10.289063 12.527344-.125-182.511719c-.015625-22.222657-17.332031-40.300781-38.378906-40.300781-8.257812 0-15.351562 2.785156-22.351562 7.507812v-14.054688c0-22.234374-16.753907-40.132812-37.808594-40.132812h-.707032c-19.132812 0-35.023437 14.847656-37.765624 34.261719-6.433594-5.089844-14.394532-7.871094-22.601563-7.898438-21.054687-.003906-38.117187 18.042969-38.117187 40.28125v40.457031c-6-4.734374-14.054688-7.101562-22.316407-7.101562h-.671875c-21 0-38.132812 17.835938-38.183594 40.011719-.132812 57.515625-.050781 158.941406.035157 249.679687.050781 53.214844 40.746093 96.308594 90.714843 96.308594zm-74.75-345.949219c.03125-13.378906 9.984376-24.050781 22.183594-24.050781h.671875c12.230469 0 22.316407 10.492188 22.316407 23.910156v105.199219c0 4.417969 3.582031 8 8 8 4.421874 0 8-3.582031 8-8v-178.464844c0-13.414062 9.734374-24.332031 22.035156-24.332031 12.234375 0 21.964844 10.917969 21.964844 24.332031v178.472657c0 4.417968 3.582031 8 8 8 4.421874 0 8-3.582032 8-8v-204.972657c0-13.417969 10.25-24.144531 22.484374-24.144531h.707032c12.230468 0 22.183594 10.816406 22.183594 24.226562v45.613282c-.011719.402344-.015626.789062-.015626 1.199218 0 .175782 0 .339844.015626.511719 0 20.273438-.007813 42.230469-.011719 63.140625-.011719 48.496094-.019531 90.371094 0 94.457032.015625 4.417968 3.609375 7.988281 8.027343 7.972656 4.417969-.015625 7.988282-3.609375 7.972657-8.027344-.015625-4.058594-.007813-45.925781 0-94.402344 0-21.425781.007812-43.949218.011719-64.636718.464843-12.972657 10.230468-23.367188 22.175781-23.367188 12.21875 0 22.171875 10.90625 22.179687 24.3125l.144532 204.828125c.003906 3.378906 2.125 6.390625 5.304687 7.527344 3.179687 1.140625 6.730469.15625 8.875-2.453125l24.457031-29.769532c6.277344-7.867187 15.535156-12.769531 25.570313-13.539062 9.816406-.648438 19.460937 2.8125 26.621093 9.554688.101563.09375.203126.183593.308594.269531l4.160156 3.449219-84.414062 162.070312c-13.214844 25.386719-38.183594 41.0625-65.160156 41.0625h-98.019532c-41.15625 0-74.671874-35.921875-74.714843-80.324219-.085938-90.726562-.167969-192.136719-.035157-249.625zm0 0"/></svg>
	<span class="title_desc blue-grey-text text-darken-4" >Handmade</span></span><br><br>';
	}
	// Return Option
	if($return_option == "On"){
	echo '<span class="col s12 context-about" >
	<svg style="width:50px;margin-right:5px;vertical-align:middle" width="511pt" viewBox="0 1 512 511" xmlns="http://www.w3.org/2000/svg">
	<path d="m506.81 111.23-199.41-109.5c-2.9961-1.6445-6.6289-1.6445-9.625 0l-75.16 41.27c-1.5859 0.41797-3.0664 1.2148-4.293 2.3594l-119.95 65.867c-3.1992 1.7539-5.1875 5.1133-5.1875 8.7656v132.43c-20.234 6.3281-38.777 17.488-54.195 32.91-40.188 40.184-50.434 101.47-25.496 152.51 2.4219 4.9609 8.4102 7.0195 13.371 4.5938 4.9648-2.4258 7.0195-8.4141 4.5977-13.375-21.188-43.363-12.48-95.438 21.668-129.59 21.355-21.355 49.746-33.117 79.945-33.117s58.59 11.762 79.945 33.117c21.352 21.352 33.113 49.742 33.113 79.941s-11.762 58.59-33.117 79.945c-34.148 34.148-86.223 42.855-129.59 21.668-4.9609-2.4258-10.949-0.36719-13.371 4.5938-2.4258 4.9648-0.37109 10.953 4.5938 13.375 18.59 9.0859 38.535 13.5 58.336 13.5 34.543-0.003906 68.625-13.449 94.172-38.996 11.715-11.715 20.973-25.23 27.523-39.922l43.09 23.66c1.5 0.82422 3.1562 1.2344 4.8125 1.2344s3.3164-0.41016 4.8125-1.2344l199.41-109.49c3.1992-1.7578 5.1875-5.1172 5.1875-8.7656v-69.496c0-5.5234-4.4766-10-10-10s-10 4.4766-10 10v63.578l-179.38 98.496v-196.17l59.199-32.508v51.531c0 3.5391 1.8672 6.8125 4.9102 8.6094 1.5703 0.92578 3.3281 1.3906 5.0898 1.3906 1.6562 0 3.3164-0.41016 4.8203-1.2383l42.73-23.52c3.1953-1.7578 5.1758-5.1133 5.1758-8.7578v-62.461l57.449-31.543v52.598c0 5.5234 4.4766 10 10 10s10-4.4766 10-10v-69.496c0-3.6484-1.9883-7.0117-5.1875-8.7656zm-204.22-89.324 178.63 98.09-56.348 30.941-178.63-98.09zm0 196.18-178.63-98.086 58.414-32.078 178.63 98.086zm79.191-43.484-178.63-98.086 22.312-12.254 178.63 98.086zm-154.62 110.74c-25.133-25.133-58.547-38.973-94.086-38.973-6.7227 0-13.363 0.49609-19.891 1.4688v-110.94l179.44 98.531v196.17l-31.145-17.102c3.0664-11.289 4.6523-23.062 4.6523-35.078 0-35.539-13.84-68.953-38.969-94.082zm187.39-60.348-22.73 12.512v-45.598l22.73-12.48z"/>
	<path d="m502 219.44c-2.6289 0-5.2109 1.0703-7.0703 2.9297-1.8594 1.8594-2.9297 4.4375-2.9297 7.0703 0 2.6289 1.0703 5.207 2.9297 7.0664 1.8594 1.8633 4.4414 2.9297 7.0703 2.9297s5.2109-1.0664 7.0703-2.9297c1.8594-1.8594 2.9297-4.4375 2.9297-7.0664 0-2.6328-1.0703-5.2109-2.9297-7.0703-1.8594-1.8594-4.4414-2.9297-7.0703-2.9297z"/>
	<path d="m99.457 389.42c2.5586 0 5.1211-0.97656 7.0703-2.9258 3.9062-3.9062 3.9062-10.238 0-14.145l-6.9258-6.9297h59.102c14.336 0 26 11.664 26 26 0 14.336-11.664 26-26 26h-35.02c-5.5234 0-10 4.4766-10 10 0 5.5195 4.4766 9.9961 10 9.9961h35.02c25.363 0 46-20.633 46-45.996s-20.637-45.996-46-45.996h-59.102l6.9258-6.9297c3.9062-3.9062 3.9062-10.238 0-14.145-3.9023-3.9023-10.234-3.9023-14.141 0l-24 24c-3.9023 3.9062-3.9023 10.238 0 14.145l24 23.996c1.9531 1.9531 4.5117 2.9297 7.0703 2.9297z"/>
	<path d="m46.074 476.45c-2.8438 0-5.668-1.2109-7.6406-3.5586l-0.019532-0.023437c-3.5547-4.2266-3.0078-10.531 1.2188-14.086 4.2266-3.5586 10.535-3.0117 14.09 1.2148 3.5508 4.2305 3.0156 10.547-1.2109 14.102-1.8789 1.5781-4.1641 2.3516-6.4375 2.3516z"/>
	</svg> Accepted | Exception may apply
	</span><br><br><br>
	';
	}else {
	echo '<br><span class="col s12 title_desc light" > <b>*</b> This seller not accepting return items</span><br><br><br>';
	}
	// Faq Content 
	if(empty($FAQ)){
	// Nothing 
	}else {
	echo '<span class="col s12 title_desc blue-grey-text text-darken-2 light" >Frequency ask questions</span><br>
	<span class="col s12 title_content" >'.$FAQ.'<br><br>'.$FAQ2.'<br><br>'.$FAQ3.'<br><br>'.$FAQ4.' </span><br><br>';
	}
	?>
</div>
<ul class="tabs" id="tabs-content" >
	<li class="tab col s3"><a href="#" class="active red-text text-lighten-2 md-bold" >Comments (0)</a></li>
	<li class="tab col s3"><a href="#" class="red-text text-lighten-2 md-bold" >Reviews (0)</a></li>
</ul><br>
<script>
    var swiper = new Swiper('.swiper-container', {
      zoom: true,
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
      },
    });
</script>
<script type="text/javascript">
$(function() {
 $("form[name='cart']").validate({
   rules: {
     quantity: {
       required: true,
     }
   },
   messages: {
     quantity: {
       required: "Please select quantity",

     },
   },
   
   // Make sure the form is submitted to the destination defined
   // in the "action" attribute of the form when valid
   submitHandler: function(form) {
     form.submit();
   }
 });
});
</script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.js"></script>
<script type="text/javascript" src="../../../assets/v1_lib/web_assets/material.js"></script>
<script type="text/javascript">
M.AutoInit();
</script>
</body>
</html>