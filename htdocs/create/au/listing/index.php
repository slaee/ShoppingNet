<?php
// Session Area w/ Logout functions
session_start();
if(empty($_SESSION)){
$_SESSION['lg-first-error'] = '<div class="ribbon red lighten-1" ><span><i class="material-icons" >error_outline</i> You must logged in first</span></div>';
header("Location: ../../../../../");
}else {
// Nothing
}

// Important Variable
$email	=	$_SESSION['email'];

require '../../../database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$user = mysqli_fetch_array($query);

// Not verified
if($user['seller_status'] == "unverified"){
header("Location: ../../../set_au2/id=notvs_hls");
}else {

}

if(empty($user['global_profile'])) {
$gl_profile_no = '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS7iHlXLpEbuKcKXckB-xgwX8SgpAkkkEQiEg&usqp=CAU" alt="Profile Img" >';

}else {
$gl_profile_yes = '<img src="../../../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" alt="Profile Img"  >';
$gl_profile_yes_1 = '<div class="profile_nav_user" >
		<img src="../static/cdn/profile_5_82_9181_17/'.$user['global_profile'].'" ></div>';
}
?>
<?php
//Include Database Holder
require_once("../../../database/database_lvl3.php");

// Define variables and initialize with empty values	
$rnd = $handmade = $category = $product = $retail = $sale = $stock = $descript = $question = $question2 = $question3 = $question4 = $material = $seller = $return_option = $preparation = $deliver = $location = $photo1 = $photo2 = $photo3 = $photo4 = $photo5 = "";
$Err_category = $Err_product = $Err_retail = $Err_sale = $Err_stock = $Err_descript = $Err_question = $Err_question2 = $Err_question3 = $Err_question4 = $Err_material = $Err_seller = $Err_return_option = $Err_preparation = $Err_deliver = $Err_location = $Err_image1 = $Err_image2 = $Err_image3 = $Err_image4 = $Err_image5 = "";

//Validate form data before submitting to Database
function validate_data($data){
	$data = strip_tags($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//Processing data form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// RND of every uploading product
	$rnd = validate_data($_POST['rnd']);
	
	// If product is handmade (optional)
	$handmade = validate_data($_POST['handmade']);
   

	// Category
	$category	=	$_POST['category'];
	
	// Validate Product Name
	if (empty($_POST['product'])) {
	 	$Err_product = "Product Name is empty";
	} else {
		if (!filter_var($_POST['product'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_product = "Only letters, numbers and white spaced allowed";		
		} else {
   		$product = validate_data($_POST['product']);
		}
	}
	
	// Validate Retail Price
	if (empty($_POST['retail'])) {
   	$Err_retail = "Retail Price is empty";
  	} else {
		if (!ctype_digit($_POST['retail'])){
			$Err_retail = "Invalid Retail Price";
		} else {
   		$retail = validate_data($_POST['retail']);  	
		}
	}
	
	// Sale Price
	$sale	=	$_POST['sale'];

	// Validate Product Stock
	if (empty($_POST['stock'])) {
    $Err_stock = "Stock is empty";
	} else {
		if (!ctype_digit($_POST['stock'])) {
			$Err_stock = "Invalid Stock";
		} else {
    		$stock = validate_data($_POST['stock']);
  		}
	}
	
	// Validate Description 1
	if (empty($_POST['descript'])) {
   	$Err_descript = "Description is empty";
 	} else {
		if(!filter_var($_POST['descript'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_descript = "Invalid Description";
		} else {
			$descript = validate_data($_POST['descript']);
		}
	}
	
	// Validate Frequency Question 1
	if (empty($_POST['question'])) {
   	$Err_question = "Frequency Question is empty";
 	} else {
		if(!filter_var($_POST['question'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_question = "Invalid Frequency Question";
		} else {
			$question = validate_data($_POST['question']);
		}
	}
	
	// Validate Frequency Question 2 (optional)
	if(empty($_POST['question2'])){
		$question2 = "";
	} else {
		$question2 = validate_data($_POST['question2']);
		
		if(!filter_var($_POST['question2'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_question2 = "Invalid Frequency Question 2";
		}
	}
	
	// Validate Frequency Question 3 (optional)
	if(empty($_POST['question3'])){
		$question3 = "";
	} else {
		$question3 = validate_data($_POST['question3']);
		
		if(!filter_var($_POST['question3'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_question3 = "Invalid Frequency Question 3";
		}
	}
	
	// Validate Frequency Question 4 (optional)
	if(empty($_POST['question4'])){
		$question4 = "";
	} else {
		$question4 = validate_data($_POST['question4']);
		
		if(!filter_var($_POST['question4'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_question4 = "Invalid Frequency Question 4";
		}
	}
	
	
	// Validate Material Description (optional)
	if(empty($_POST['material'])){
		$material = "";
	} else {
		$material = validate_data($_POST['material']);
		
		if(!filter_var($_POST['material'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_material = "Invalid Material Description";
		}
	}
	
   // Validate Seller Name	
	if (empty($_POST['seller'])) {
   	$Err_seller = "Seller Name is empty";
  	} else {
		if(!filter_var($_POST['seller'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			$Err_seller = "Invalid Seller Name";
		} else {
   		$seller = validate_data($_POST['seller']);
 		}
	}
	
	// Validate Return Option	
	$select_return_option = validate_data($_POST['return_option']);
	switch ($select_return_option){
		case "Off":
			$return_option = $select_return_option;
			break;
		case "On":
			$return_option = $select_return_option;
			break;
		case "Select Option":
			$Err_return_option = "Select Options";
			break;
	}

	// Validate Preparation Day
	$preparation_option = validate_data($_POST['preparation']);
	switch ($preparation_option){
		case "Ready to ship 1 Day":
			$preparation = $preparation_option;
			break;
		case "1 - 3 Business Day":
			$preparation = $preparation_option;
			break;
		case "3 - 7 Business Day":
			$preparation = $preparation_option;
			break;
		case "7 - 10 Business Day":
			$preparation = $preparation_option;
			break;
		case "Select Business Day":
			$Err_preparation = "Select Business Day Option";
			break;
	}

	// Validate Delivery Option
	$select_deliver = validate_data($_POST['deliver']);
	switch ($select_deliver){
		case "Motor":
			$deliver = $select_deliver;
			break;
		case "Truck":
			$deliver = $select_deliver;
			break;
		case "Delivery Option":
			$Err_deliver = "Select Deliver Option";
			break;
	}

	// Location
	$location	=	$_POST['location'];
	
	//Location folder of each file that will upload
	$photo_dir = "../../../static/cdn/products_new_rdr/";
	
	// Product Image 1 ($photo1)
	$photo1 = basename($_FILES['image1']['name']);
	// File type extension will be lower case
	$imageFileType1 = strtolower(pathinfo($photo1, PATHINFO_EXTENSION));
	$uploadImg1 = 1;

	// Check if there's selected image
	if($_FILES['image1']['name'] != ""){		
		
   	//Check file size
  		if ($_FILES['image1']['size'] > 9000000) {
			$uploadImg1 = 0;
			$Err_image1 =  "Your File is too large";
  		}

		// Allow certain file format
  		if ($imageFileType1 != "jpeg" && $imageFileType1 != "jpg" && $imageFileType1 != "png") {
			$uploadImg1 = 0;
			$Err_image1 =  "Invalid File Format";
  		}

	} else {
		// Require selecting image message
		$Err_image1 = "Select Product Image";
	}
	
	// Check if $uploadImg1 is set to 0 
  	if ($uploadImg1 == 0) {
   	$Err_image1;
  	} else {
   	if (move_uploaded_file($_FILES['image1']['tmp_name'], $photo_dir . $photo1)) {
   		// Uploaded sucessfully
			$photo1;
   	} 
  	} 
	
	// Product Image 2 ($photo2)
	$photo2 = basename($_FILES['image2']['name']);
	// File type extension will be lower case
	$imageFileType2 = strtolower(pathinfo($photo2, PATHINFO_EXTENSION));
	$uploadImg2 = 1;
	
	// Check if there's selected image
	if($_FILES['image2']['name'] != ""){	 	
		
   	//Check file size
  		if ($_FILES['image2']['size'] > 9000000) {
			$uploadImg2 = 0;
			$Err_image2 =  "Your File is too large";
  		}

		// Allow certain file format
  		if ($imageFileType2 != "jpeg" && $imageFileType2 != "jpg" && $imageFileType2 != "png") {
			$uploadImg2 = 0;
			$Err_image2 =  "Invalid File Format";
  		}

	} else {
		// if none, submit default image
		$photo2 = 0;
	}

	// Check if $uploadImg2 is set to 0 
  	if ($uploadImg2 == 0) {
   	$photo2 = 0;
  	} else {
   	if (move_uploaded_file($_FILES['image2']['tmp_name'], $photo_dir . $photo2)) {
   		// Uploaded sucessfully
			$photo2;
   	} 
  	} 

	// Product Image 3 ($photo3)
	$photo3 = basename($_FILES['image3']['name']);
	// File type extension will be lower case
	$imageFileType3 = strtolower(pathinfo($photo3, PATHINFO_EXTENSION));
	$uploadImg3 = 1;

	// Check if there's selected image
	if($_FILES['image3']['name'] != ""){	 	
		
   	//Check file size
  		if ($_FILES['image3']['size'] > 9000000) {
			$uploadImg3 = 0;
			$Err_image3 =  "Your File is too large";
  		}

		// Allow certain file format
  		if ($imageFileType3 != "jpeg" && $imageFileType3 != "jpg" && $imageFileType3 != "png") {
			$uploadImg3 = 0;
			$Err_image3 =  "Invalid File Format";
  		}

	} else {
		// If none, submit default image
		$photo3 = 0;
	}
	
	// Check if $uploadImg3 is set to 0 
  	if ($uploadImg3 == 0) {
   	$photo3 = 0;
  	} else {
   	if (move_uploaded_file($_FILES['image3']['tmp_name'], $photo_dir . $photo3)) {
   		// Uploaded sucessfully
			$photo3;
   	} 
  	} 

	// Product Image 4 ($photo4)
	$photo4 = basename($_FILES['image4']['name']);
	// File type extension will be lower case
	$imageFileType4 = strtolower(pathinfo($photo4, PATHINFO_EXTENSION));
	$uploadImg4 = 1;
	
	// Check if there's selected image
	if($_FILES['image4']['name'] != ""){	 	
		
   	//Check file size
  		if ($_FILES['image4']['size'] > 9000000) {
			$uploadImg4 = 0;
			$Err_image4 =  "Your File is too large";
  		}

		// Allow certain file format
  		if ($imageFileType4 != "jpeg" && $imageFileType4 != "jpg" && $imageFileType4 != "png") {
			$uploadImg4 = 0;
			$Err_image4 =  "Invalid File Format";
  		}

	} else {
		// If none, submit default image
		$photo4 = 0;
	}
	
	// Check if $uploadImg4 is set to 0 
  	if ($uploadImg4 == 0) {
   	$photo4 = 0;
  	} else {
   	if (move_uploaded_file($_FILES['image4']['tmp_name'], $photo_dir . $photo4)) {
   		// Uploaded sucessfully
			$photo4;
   	} 
  	} 

	// Product Image 5 ($photo5)
	$photo5 = basename($_FILES['image5']['name']);
	// File type extension will be lower case
	$imageFileType5 = strtolower(pathinfo($photo5, PATHINFO_EXTENSION));
	$uploadImg5 = 1;

	// Check if there's selected image
	if($_FILES['image5']['name'] != ""){	 	
		
   	//Check file size
  		if ($_FILES['image5']['size'] > 9000000) {
			$uploadImg5 = 0;
			$Err_image5 =  "Your File is too large";
  		}

		// Allow certain file format
  		if ($imageFileType5 != "jpeg" && $imageFileType5 != "jpg" && $imageFileType5 != "png") {
			$uploadImg5 = 0;
			$Err_image5 =  "Invalid File Format";
  		}

	} else {
		// If none, submit default image
		$photo5 = 0;
	}

	// Check if $uploadImg5 is set to 0 
  	if ($uploadImg5 == 0) {
   	$photo5 = 0;
  	} else {
   	if (move_uploaded_file($_FILES['image5']['tmp_name'], $photo_dir . $photo5)) {
   		// Uploaded sucessfully
			$photo5;
   	} 
  	} 
	
	// Product Image 6 ($photo6)
	$photo6 = basename($_FILES['image6']['name']);
	// File type extension will be lower case
	$imageFileType6 = strtolower(pathinfo($photo6, PATHINFO_EXTENSION));
	$uploadImg6 = 1;
	
	// Check if there's selected file 
	if ($_FILES['image6']['name']) {
		
		// Check the file size
		if ($_FILES['image6']['size'] > 9000000) {
			$uploadImg6 = 0;
			$Err_image6 = "Your file is too large";
		}
		
		// Allow certain format 
		if ($imageFileType6 != "jpeg" && $imageFileType6 != "jpg" && $imageFileType6 != "png") {
			$uploadImg6 = 0;
			$Err_image6 = "Invalid File Format";
		}
		
	} else {
		$photo6 = 0;
	}
	
	// Check if uploadImg6 is set to 0 
	if ($uploadImg6 == 0) {
		$photo6 = 0;
	} else {
		if (move_uploaded_file($_FILES['image6']['tmp_name'], $photo_dir . $photo6)) {
			// Uploaded Successfully
		}
		
	}
	
	// Product Image 7 ($photo7)
	$photo7 = basename($_FILES['image7']['name']);
	// File Type Extension will be lowercase
	$imageFileType7 = strtolower(pathinfo($photo7, PATHINFO_EXTENSION));
	$uploadImg7 = 1;
	
	// Check if there's selected image
	if ($_FILES['image7']['name'] != "") {
		
		// Check the file size
		if ($_FILES['image7']['name'] > 9000000)  {
			$uploadImg7 = 0;
			$Err_image7 = "Your file is too large";
		}
		
		// Allow certain format
		if ($imageFileType7 != "jpeg" && $imageFileType7 != "jpg" && $imageFileType7 != "png") {
			$uploadImg7 = 0;
			$Err_image7 = "Invalid file format";
		}
		
	} else {
		$photo7 = 0;
	}
	
	// Check if $uploadImg7 is set to 0 
	if ($uploadImg7 == 0) {
		$photo7 = 0;
	} else {
		if (move_uploaded_file($_FILES['image7']['tmp_name'], $photo_dir . $photo7)) {
			// Uploaded Successfully
			$photo7;
		}
	}
	
	// Product Image 8 ($photo8)
	$photo8 = basename($_FILES['image8']['name']);
	// File type extension will be lowercase
	$imageFileType8 = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
	$uploadImg8 = 1;
	
	// Check if there's selected file 
	if ($_FILES['image8']['name'] != "") {
		
		// Check the file size
		if ($_FILES['image8']['size']) {
			$uploadImg = 0;
			$Err_image8 = "Your file is too large";
		}
		
		// Allow certain format
		if ($imageFileType8 != "" && $imageFileType8 != "" && $imageFileType8 != "") {
			$uploadImg = 0;
			$Err_image8 = "Invalid file format";
		}
		
	} else {
		$photo8 = 0;
	}
	
	// Check if $uploadimg8 is set to 0
	if ($uploadImg8 == 0) {
		$photo = 0;
	} else {
		if (move_uploaded_file($_FILES['image8']['tmp_name'], $photo_dir . $photo8)) {
			// Uploaded Successfully
			$photo8;
		}
	}
	
	//Check inputs before inserting to Database
  	if (empty($Err_category) && empty($Err_product) && empty($Err_retail) && empty($Err_sale) && empty($Err_stock) && empty($Err_descript) && empty($Err_descript2) && empty($Err_descript3) &&  empty($Err_descript4) && empty($Err_question) && empty($Err_question2) && empty($Err_question3) && empty($Err_question4) 
  	&& empty($Err_matetial) && empty($Err_return_option) &&  empty($Err_image1) && empty($Err_image2) && empty($Err_image3) && empty($Err_image4) && empty($Err_image5) && empty($Err_image6) && empty($Err_image7) && empty($Err_image8) && empty($Err_seller) && empty($Err_preparation) && empty($Err_deliver) && empty($Err_location)) {

   	//Prepare Insert Statement
   	$sql = "INSERT INTO products (category, product, description, FAQ, FAQ2, FAQ3, FAQ4, material, handmade, return_option, stock, retail_price, sale_price, image1, image2, image3, image4, image5, image6, image7, image8, rnd, seller, business_day, deliver, location) 
   			  VALUES ('$category', '$product', '$descript', '$question', '$question2', '$question3', '$question4', '$material', '$handmade', '$return_option', '$stock', '$retail', '$sale', '$photo1', '$photo2', '$photo3', '$photo4', '$photo5', '$photo6', '$photo7', '$photo8', '$rnd', '$seller', '$preparation', '$deliver', '$location')";
			if (mysqli_query($con, $sql)) { 
	 			//echo "<script>alert('Successful!');</script>";
				header("location: ../../../../my_store/?rdr=created_success_1&178");
			} else {
	 		 echo "Error: " . $sql . "<br>" . mysqli_error($con);
		} 

	} 
	//Close Connection
	mysqli_close($con);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" prefix="og: http://ogp.me/ns#" class="no-js">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="og:title" content="Find things you loved with cebusugoako"/>
	<meta name="og:type" content="e-commerce"/>
	<meta name="og:url" content=""/>
	<meta name="og:image" content="https://images.unsplash.com/photo-1562967916-eb82221dfb92?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=666&q=80"/>
	<meta name="og:site_name" content="Cebu Sugo A-Ko"/>
	<meta name="og:description" content="Cebu Sugo-A ko serves as convenience among citizens who don't wanna spend too much time under the sun or get in the middle of a crowded groceries."/>
	
	<title>Listing &mdash; Post an Items</title>
	
	<script type="text/javascript" src="../../../../assets/v1_lib/web_assets/jquery.min.js"></script>
	
	<link rel="icon" type="image/png" sizes="64x64" href="assets/test2.png"/>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../../assets/v1_lib/web_assets/materialize.css" >
</head>
<body class="hide-on-med-only hide-on-large-only" >
<style type="text/css">
body {
	background:;
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
</style>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" name="create" >
<div class="navbar-fixed" >
<nav class="z-depth-0 white">
	<div class="nav-wrapper center" >
		<a href="" >
			<span class="left svg" ><svg style="width:23px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,480C132.288,480,32,379.712,32,256S132.288,32,256,32s224,100.288,224,224S379.712,480,256,480z"/><path d="M292.64,116.8l-128,128c-6.204,6.241-6.204,16.319,0,22.56l128,128l22.56-22.72L198.56,256L315.2,139.36L292.64,116.8z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>
		</a>
		<a href="" class="brand-logo black-text" >Create Product</a>
    	<input type="submit" class="right green-text text-darken-4" value="SUBMIT" />
    	<input type="text" name="rnd" value="<?php echo uniqId();?>" style="display:none" />
    	<input type="text" name="seller" value="<?php echo $user['shop_name']; ?>" style="display:none" />
    </div>
</nav>
</div>

<!--	Create Product Form		-->
<div class="row listing-mg" >
	<div class="col s12" >
		<div class="card-listing-au" >
		<div class="listing-au-1" >
		<span class="title-au-b" ><i class="material-icons" >title</i> Listing Details</span><br>
		<span class="desc-au-p blue-grey-text text-darken-3" >Tell to your customer all about your item and why they'll love it.</span>
		</div><br>
		<span class="md-bd blue-grey-text text-darken-4" >Title *</span>
		<input type="text" name="product" class="browser-default listing-is" value="<?php echo $product; ?>" /><br>
		<span class="red-text"><?php echo $Err_product; ?></span><br>
		<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Description *</span>
		<textarea name="descript" class="browser-default listing-is" style="height:100px;padding-top:10px" valign="" ><?php echo $descript; ?></textarea><br>
		<span class="red-text"><?php echo $Err_descript; ?></span><br><br>

		<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Category *</span>
		<select id="listing-opt" name="category" class="browser-default listing-is transparent" >
		<option selected="selected" disabled="disabled" <?php if(isset($category)&&$category=='Select Category') echo "selected"; ?>>Select Category</option>
		<optgroup label="--- Home & Pets ---"></optgroup>
		<option <?php if(isset($category)&&$category=='furniture') echo "selected"; ?>>Furniture</option>
		<option <?php if(isset($category)&&$category=='kitchen_dining') echo "selected"; ?>>Kitchen & Dining</option>
		<option <?php if(isset($category)&&$category=='bed_bath') echo "selected"; ?>>Bed & Bath</option>
		<option <?php if(isset($category)&&$category=='pet_supplies') echo "selected"; ?>>Pet Supplies</option>
		<option <?php if(isset($category)&&$category=='power_hand_tools') echo "selected"; ?>>Power & Hand Tools</option>
		<option <?php if(isset($category)&&$category=='Appliances') echo "selected"; ?>>Appliances</option>
		<optgroup label="--- Electronics ---"></optgroup>
		<option <?php if(isset($category)&&$category=='Electronics_devices') echo "selected"; ?>>Electronics & Devices</option>
		<option <?php if(isset($category)&&$category=='tv_video') echo "selected"; ?>>TV & Video</option>
		<option <?php if(isset($category)&&$category=='home_audio') echo "selected"; ?>>Home Audio</option>
		<option <?php if(isset($category)&&$category=='cellphone') echo "selected"; ?>>Cellphone</option>
		<option <?php if(isset($category)&&$category=='cellphone_accessories') echo "selected"; ?>>Cellphone Accessories</option>
		<option <?php if(isset($category)&&$category=='Video Games') echo "selected"; ?>Video Games</option>
		<optgroup label="--- Toy & Kids ---"></optgroup>
		<option <?php if(isset($category)&&$category=='toy_games') echo "selected"; ?>>Toy & Games</option>
		<option <?php if(isset($category)&&$category=='milk_for_kids') echo "selected"; ?>>Milk for kids</option>
		<option <?php if(isset($category)&&$category=='diapering') echo "selected"; ?>>Diapering</option>
		<optgroup label="--- Office & Supplies --- "></optgroup>
		<option <?php if(isset($category)&&$category=='office_supplies') echo "selected"; ?>>Office Supplies</option>
		<option <?php if(isset($category)&&$category=='school_supplies') echo "selected"; ?>>School Supplies</option>
		<option <?php if(isset($category)&&$category=='craft_supplies') echo "selected"; ?>>Craft Supplies</option>
		<optgroup label="--- Foods & Beverages ---"></optgroup>
		<option <?php if(isset($category)&&$category=='mcdonald') echo "selected"; ?>>McDonald</option>
		<option <?php if(isset($category)&&$category=='jollibee') echo "selected"; ?>>Jollibee</option>
		<option <?php if(isset($category)&&$category=='jco') echo "selected"; ?>>J.CO</option>
		<option <?php if(isset($category)&&$category=='more') echo "selected"; ?>>More</option>
		</select>
		</select><br>
		<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Type *</span><br>
		<div class="listing-mg" >
		<label>
		<input type="checkbox" name="" class="filled-in reset-checkbox" >
		<span class="blue-grey-text text-darken-4" >PHYSICAL &mdash; A tangible item that you will ship to buyers</span>
		</label><br><br><br>
		<label>
		<input type="checkbox" name="" class="filled-in reset-checkbox listing-mg" disabled="disabled" >
		<span class="blue-grey-text text-darken-4" >DIGITAL &mdash; A digital file that buyers will download</span>
		</label>
		</div><br><br>
		<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Handmade *</span> Optional<br>
		<div class="listing-mg" >
			<label>
				<input type="checkbox" name="" class="filled-in reset-checkbox" >
				<span class="blue-grey-text text-darken-4" >Check this if your item is Handmade</span>
			</label><br><br>
		</div>	
		</div>
	</div>
	<div class="col s12 listing-mg" >
		<div class="card-listing-au" >
			<div class="listing-au-1" >
				<span class="title-au-b" ><i class="material-icons" >add_photo_alternate</i> Product Images</span><br>
				<span class="desc-au-p" >Set up your product image</span>
			</div><br>
			<label for="file-upload-1" class="custom-file-upload">
			<i class="fa fa-cloud-upload"></i> Upload Image 1
			</label>
			<input type="file" id="file-upload-1" name="image1" accept="image/*" style="display:none" value="<?php echo $image1; ?>" ><br>
			<span class="red-text"><?php echo $Err_image1;?></span><br>
			
			<label for="file-upload-2" class="custom-file-upload">
			<i class="fa fa-cloud-upload"></i> Upload Image 2
			</label>
			<input type="file" id="file-upload-2" name="image2" accept="image/*" style="display:none" value="<?php echo $image2; ?>" ><br>
			<span class="red-text"><?php echo $Err_image2;?></span><br>
			
			<label for="file-upload-3" class="custom-file-upload">
			<i class="fa fa-cloud-upload"></i> Upload Image 3
			</label>
			<input type="file" id="file-upload-3" name="image3" accept="image/*" style="display:none" value="<?php echo $image3; ?>" ><br>
			<span class="red-text"><?php echo $Err_image3;?></span><br>
			
			<label for="file-upload-4" class="custom-file-upload">
			<i class="fa fa-cloud-upload"></i> Upload Image 4
			</label>
			<input type="file" id="file-upload-4" name="image4" accept="image/*" style="display:none" value="<?php echo $image4; ?>" ><br>
			<span class="red-text"><?php echo $Err_image4;?></span><br>
			
			<label for="file-upload-5" class="custom-file-upload">
			<i class="fa fa-cloud-upload"></i> Upload Image 5
			</label>
			<input type="file" id="file-upload-5" name="image5" accept="image/*" style="display:none" value="<?php echo $image5; ?>" ><br>
			<span class="red-text"><?php echo $Err_image5;?></span><br>
			
			<label for="file-upload-6" class="custom-file-upload">
			<i class="fa fa-cloud-upload"></i> Upload Image 6
			</label>
			<input type="file" id="file-upload-6" name="image6" accept="image/*" style="display:none" value="<?php echo $image6; ?>" ><br>
			<span class="red-text"><?php echo $Err_image6;?></span><br>
			
			<label for="file-upload-7" class="custom-file-upload">
			<i class="fa fa-cloud-upload"></i> Upload Image 7
			</label>
			<input type="file" id="file-upload-7" name="image7" accept="image/*" style="display:none" value="<?php echo $image7; ?>" ><br>
			<span class="red-text"><?php echo $Err_image7;?></span><br>
			
			<label for="file-upload-8" class="custom-file-upload">
			<i class="fa fa-cloud-upload"></i> Upload Image 8
			</label>
			<input type="file" id="file-upload-8" name="image8" accept="image/*" style="display:none" value="<?php echo $image8; ?>" ><br>
			<span class="red-text"><?php echo $Err_image8;?></span><br>
			
		</div>
	</div>
	<div class="col s12 listing-mg" >
	<div class="card-listing-au" >
	<div class="listing-au-1" >
	<span class="title-au-b" ><i class="material-icons" >monetization_on</i> Inventory and Pricing</span>
	</div><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Retail Price *</span><br>
	<input type="text" name="retail" placeholder="PHP" class="browser-default listing-is" value="<?php echo $retail; ?>" style="width:130px" /><br>
	<span class="red-text"><?php echo $Err_retail; ?></span><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Sale Price *</span> Optional<br>
	<input type="text" name="sale" placeholder="PHP" class="browser-default listing-is" value="<?php echo $sale; ?>" style="width:130px" /><br>
	<span class="red-text"><?php echo $Err_sale; ?></span><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Quantity *</span><br>
	<input type="text" name="stock" class="browser-default listing-is" value="<?php echo $stock; ?>" style="width:130px" /><br>
	<span class="red-text"><?php echo $Err_stock; ?></span><br>
	<hr class="hr_au" >
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Variations *</span><br>
	<span>Add variation options like color or size. Buyer will choose from these during checkout</span>
	<input type="text" name="" class="browser-default listing-is" value="" disabled="disabled" /><br><br>
	</div>
	</div>
	
	<div class="col s12 listing-mg" >
	<div class="card-listing-au" >
	<div class="listing-au-1" >
	<span class="title-au-b" ><i class="material-icons" >sticky_note_2</i> FAQ Section *</span><br>
	<span class="desc-au-p" >Set up your FAQ content here.</span>
	</div><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >FAQ 1 *</span> Optional
	<input type="text" name="question" placeholder="FAQ 1 Content" class="browser-default listing-is" value="<?php echo $question; ?>" /><br>
	<span class="red-text"><?php echo $Err_question; ?></span><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >FAQ 2 *</span> Optional
	<input type="text" name="question2" placeholder="FAQ 2 Content" class="browser-default listing-is" value="<?php echo $question2; ?>"/><br>
	<span class="red-text"><?php echo $Err_question2; ?></span><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >FAQ 3 *</span> Optional
	<input type="text" name="question3" placeholder="FAQ 3 Content" class="browser-default listing-is" value="<?php echo $question3; ?>" /><br>
	<span class="red-text"><?php echo $Err_question3; ?></span><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >FAQ 4 *</span> Optional
	<input type="text" name="question4" placeholder="FAQ 4 Content" class="browser-default listing-is" value="<?php echo $question4; ?>" /><br>
	<span class="red-text"><?php echo $Err_question4; ?></span><br><br>
	</div>
	</div>
	
	<div class="col s12 listing-mg" >
	<div class="card-listing-au" >
	<div class="listing-au-1" >
	<span class="title-au-b" ><i class="material-icons" >cancel</i> Returning Items</span><br>
	<span class="desc-au-p" >Set up your return options here</span>
	</div><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Return Items *</span><br>
	<div class="listing-mg" >
	<select type="select" name="return_option" class="browser-default listing-is" >
	<option disabled="disabled" selected="selected" value="" <?php if(isset($return_option)&&$return_option=='Select Option') echo "selected"; ?>>Select Option</option>
	<option <?php if(isset($return_option)&&$return_option=='Off') echo "selected"; ?>>Off</option>
	<option <?php if(isset($return_option)&&$return_option=='On') echo "selected"; ?>>On</option>
	</select><br>
	</div>	
	</div>
	</div>
	
	<div class="col s12 listing-mg" >
	<div class="card-listing-au" >
	<div class="listing-au-1" >
	<span class="title-au-b" ><i class="material-icons" >local_shipping</i> Shipping</span><br>
	<span class="desc-au-p" >Setup your shipping carrier and preparation date.</span>
	</div><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Shipping Carrier *</span>
	<select id="listing-opt" class="browser-default listing-is transparent" >
	<option selected="selected" value="cebusugocarrier" >CebuSugo Carrier</option>
	</select>
	<span class="desc-au-p" >You can choose your own driver for your parcel to next page</span><br><br>
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Processing time *</span>
	<select id="listing-opt" name="preparation" class="browser-default listing-is transparent" >
	<option <?php if(isset($preparation)&&$preparation=='Select Business Day') echo "selected"; ?>>Select Business Day</option>
	<option <?php if(isset($preparation)&&$preparation=='Ready to ship 1 Day') echo "selected"; ?>>Ready to ship 1 Day</option>
	<option <?php if(isset($preparation)&&$preparation=='1 - 3 Business Day') echo "selected"; ?>>1 - 3 Business Day</option>
	<option <?php if(isset($preparation)&&$preparation=='3 - 7 Business Day') echo "selected"; ?>>3 - 7 Business Day</option>
	<option <?php if(isset($preparation)&&$preparation=='7 - 10 Business Day') echo "selected"; ?>>7 - 10 Business Day</option>
	</select>
	<span class="red-text"><?php echo $Err_preparation; ?></span><br>
	<span class="desc-au-p" >Once the item purchase how long does it take you to ship an item.</span><br><br>
	
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Delivery Vehicle *</span>
	<select id="listing-opt" name="deliver" class="browser-default listing-is transparent">
	<option <?php if(isset($deliver)&&$deliver=='Delivery Option') echo "selected"; ?>>Delivery Option</option>
	<option <?php if(isset($deliver)&&$deliver=='Motor') echo "selected"; ?>>Motor</option>
	<option <?php if(isset($deliver)&&$deliver=='Truck') echo "selected"; ?>>Truck</option>
	</select>
	<span class="red-text"><?php echo $Err_deliver; ?></span><br>
	
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >Delivery Location *</span>	
	<select id="listing-opt" name="location" class="browser-default listing-is transparent">
	<option value="" >Select Location</option>
	<option value="cebu_only" >Only at Cebu</option>
	<option disabled="disabled" >Outside Cebu</option>
	</select>
	<span class="red-text"><?php echo $Err_location; ?></span><br>	
	<span class="md-bd blue-grey-text text-darken-4 listing-mg" >What you'll charge *</span>
	<select id="listing-opt" class="browser-default listing-is transparent" >
	<option disabled="disabled" value="free" >Free Shipping</option>
	<option selected="selected" value="35" >&#8369;35 Shipping Fee</option>
	<option value="65" >&#8369;65 Shipping Fee</option>
	</select>
	<span>Free shipping will be available at your shop soon.</span><br>
	</div>
	</div>
	
	<div class="col s12 listing-mg" >
	<div class="card-listing-au" >
	<div class="listing-au-1" >
	<span class="title-au-b" ><i class="material-icons" >campaign</i> Boost your engagement</span><br>
	<span class="desc-au-p" >Setup your items Ads here.</span>
	</div><br>
	<span class="red-text text-darken-4" >Your account doesn't meet ads setting</span><br>
	</div>
	</div>
	</div><br>
	</div>
	</form>
<script type="text/javascript">

$(function() {
$("form[name='create']").validate({
	rules: {
		product: {
			required: true,
			minlength: 15,
			maxlength: 50
		},
		descript: {
			required: true,
			minlength: 15,
			maxlength: 150
		},
		category: {
			required: true,
		},
		location: {
			required: true,
		},
		image1: {
			required: true,
		},
		retail: {
			required: true,
			maxlength: 9
		},
		stock: {
			required: true,
		},
		question: {
			minlength: 15,
			maxlength: 100
		},
		return_option: {
			required: true
		},
	},
	messages: {
		product: {
			required: "Please enter your product name",
			minlength: "Please enter atleast 15 characters",
			maxlength: "Your title is too long"
		},
		descript: {
			required: "Please enter your products description",
			minlength: "Please enter atleast 15 characters",
			maxlength: "Your description is too long"
		},
		category: {
			required: "Please enter your product category",
		},
		location: {
			required: "Please choose Location Delivery",
		},
		image1: {
			required: "Please enter atleast 1 image"
		},
		retail: {
			required: "Please enter your retail price",
			minlength: "You reached maximum price"
		},
		stock: {
			required: "Please enter your item stock"
		},
		question: {
			minlength: "Please enter atleast 15 characters",
			maxlength: "Your FAQ Content is too long"
		},
		return_option: "Please choose return option"
	},
   
   // Make sure the form is submitted to the destination defined
   // in the "action" attribute of the form when valid
   submitHandler: function(form) {
     form.submit();
   }
 });
});
</script>
<script>
x=false;
function Check(){
    if(x){    
document.getElementById("desc-off").style.display='inline';
document.getElementById("desc-on").style.display='none';
x=false;
    }
    else{
 document.getElementById("desc-off").style.display='none'; 
     document.getElementById("desc-on").style.display='inline';   
x=true;    
    }

}
// File Upload File Name
$('#file-upload-1').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-1')[0].files[0].name;
  $(this).prev('label').text(file);
});
$('#file-upload-2').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-2')[0].files[0].name;
  $(this).prev('label').text(file);
});
$('#file-upload-3').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-3')[0].files[0].name;
  $(this).prev('label').text(file);
});
$('#file-upload-4').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-4')[0].files[0].name;
  $(this).prev('label').text(file);
});
$('#file-upload-5').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-5')[0].files[0].name;
  $(this).prev('label').text(file);
});
$('#file-upload-6').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-6')[0].files[0].name;
  $(this).prev('label').text(file);
});
$('#file-upload-7').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-7')[0].files[0].name;
  $(this).prev('label').text(file);
});
$('#file-upload-8').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload-8')[0].files[0].name;
  $(this).prev('label').text(file);
});
</script>
<script type="text/javascript" src="../../../../assets/v1_lib/web_assets/material.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.js"></script>