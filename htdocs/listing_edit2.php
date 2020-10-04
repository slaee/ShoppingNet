<?php
// Session Area
session_start();
// Session Variable
$email	=	$_SESSION['email'];
// Fetching
require 'database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$user = mysqli_fetch_array($query);
if($user['seller_status'] == "unverified"){
	// Redirect to homepage
	header("Location: ../../../../");
}else {
	// Nothing if user already verified
} 
?>
<?php
// Include Database Holder
require_once ("database/database_lvl3.php");
 
// Define variables and initialize with empty values
$id = $rnd = $handmade = $category = $product = $retail = $sale = $stock = $descript = $descript2 = $descript3 = $descript4 = $question = $question2 = $question3 = $question4 = $material = $seller = $return_option = $preparation = $deliver = $location = $photo1 = $photo2 = $photo3 = $photo4 = $photo5 = "";
$Err_category = $Err_product = $Err_retail = $Err_sale = $Err_stock = $Err_descript = $Err_descript2 = $Err_descript3 = $Err_descript4 = $Err_question = $Err_question2 = $Err_question3 = $Err_question4 = $Err_material = $Err_seller = $Err_return_option = $Err_preparation = $Err_deliver = $Err_location = $Err_image1 = $Err_image2 = $Err_image3 = $Err_image4 = $Err_image5 = "";
 
//Validate form data before submitting to database
function validate_data($data){
	$data = strip_tags($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
	// Get hidden input value
	$id = validate_data($_POST["id"]);
    
   // RND of every uploading product
	$rnd = validate_data($_POST['rnd']);
	
	// If product is handmade (optional)
	$handmade = validate_data($_POST['handmade']);

	// Validate Category
	$select_category = validate_data($_POST['category']);
	switch ($select_category){
		case "Electronics":
			$category = $select_category;
			break;
		case "Beauty Products":
			$category = $select_category;
			break;
		case "Mens Apparel":
			$category = $select_category;
			break;
		case "Woman Apparel":
			$category = $select_category;
			break;
		case "Others":
			$category = $select_category;
			break;	
		case "Select Category":
			$Err_category = "Select Category";
			break;
	}
	
	// Validate Product Name
	if(empty($_POST['product'])){
	 	$Err_product = "Product Name is empty";
	} else {
		if (!filter_var($_POST['product'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_product = "Only letters, numbers and white spaced allowed";		
		} else {
   		$product = validate_data($_POST['product']);
		}
	}
	
	// Validate Retail Price
	if(empty($_POST['retail'])){
   	$Err_retail = "Retail Price is empty";
  	} else {
		if(!ctype_digit($_POST['retail'])){
			$Err_retail = "Invalid Retail Price";
		} else {
   		$retail = validate_data($_POST['retail']);  	
		}
	}
	
	// Validate Sale Price
	if(empty($_POST['sale'])){
   	$Err_sale = "Sale Price is empty";
  	} else {
		if(!ctype_digit($_POST['sale'])){
			$Err_sale = "Invalid Sale Price";
		} else {
    		$sale = validate_data($_POST['sale']);
		}
  	}

	// Validate Product Stock 
	if(empty($_POST['stock'])){
    $Err_stock = "Stock is empty";
	} else {
		if(!ctype_digit($_POST['stock'])) {
			$Err_stock = "Invalid Stock";
		} else {
    		$stock = validate_data($_POST['stock']);
  		}
	}

	// Validate Description 1
	if(empty($_POST['descript'])){
   	$Err_descript = "Description is empty";
 	} else {
		if(!filter_var($_POST['descript'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_descript = "Invalid Description";
		} else {
			$descript = validate_data($_POST['descript']);
		}
	}
   
   	// Validate Description 2 (optional)
	if(empty($_POST['descript2'])){
		$descript2 = "";
	} else {
		$descript2 = validate_data($_POST['descript2']);
		
		if(!filter_var($_POST['descript2'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_descript2 = "Invalid Description 2";
		}
	}
	
	// Validate Description 3 (optional)
	if(empty($_POST['descript3'])){
		$descript3 = "";
	} else {
		$descript3 = validate_data($_POST['descript3']);
		
		if(!filter_var($_POST['descript3'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_descript3 = "Invalid Description 3";
		}
	}
	
	// Validate Description 4 (optional)
	if(empty($_POST['descript4'])){
		$descript4 = "";
	} else {
		$descript4 = validate_data($_POST['descript4']);
		
		if(!filter_var($_POST['descript4'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s?@=$*#]+$/")))){
			$Err_descript4 = "Invalid Description 4";
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
	if (empty($_POST['seller'])){
   	$Err_seller = "Seller Name is empty";
  	} else {
		if(!filter_var($_POST['seller'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			$Err_seller = "Invalid Seller Name";
		} else {
   		$seller = validate_data($_POST['seller']);
 		}
	}
	
	// Validate Return Product Option	
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

	$select_location = validate_data($_POST['location']);
	switch ($select_location){
		case "Cebu Only":
			$location = $select_location;
			break;
		case "Cebu Outside":
			$location = $select_location;
			break;
		case "Select Location":
			$Err_location = "Select Location";
			break;
	}

	// Location folder of each file that will upload
	$photo_dir = "product_image/";

	// Product Image 1 ($photo1)
	$photo1 = basename($_FILES['image1']['name']);
	// File type extension will be lower case
	$imageFileType1 = strtolower(pathinfo($photo1, PATHINFO_EXTENSION));
	$uploadImg1 = 1;	
	
		//Check file size
		if($_FILES['image1']['size'] > 9000000){
			$uploadImg1 = 0;
			$photo1 = $_POST['file_path1'];
		}

		// Allow certain file format
		if($imageFileType1 != "jpeg" && $imageFileType1 != "jpg" && $imageFileType1 != "png"){
			$photo1 = $_POST['file_path1'];
		}

		// Check if $uploadImg1 is set to 0 
		if($uploadImg1 == 0){
			$photo1 = $_POST['file_path1'];
		} else {
			if(move_uploaded_file($_FILES['image1']['tmp_name'], $photo_dir . $photo1)){
				// Uploaded sucessfully
				$photo1;
			}		
		}

	// Product Image 2 ($photo2)
	$photo2 = basename($_FILES['image2']['name']);
	// File type extension will be lower case
	$imageFileType2 = strtolower(pathinfo($photo2, PATHINFO_EXTENSION));
	$uploadImg2 = 1;		

		//Check file size
		if($_FILES['image2']['size'] > 9000000){
			$uploadImg2 = 0;
			$photo2 = $_POST['file_path2'];
		}

		// Allow certain file format
		if($imageFileType2 != "jpeg" && $imageFileType2 != "jpg" && $imageFileType2 != "png" ){
			$uploadImg2 = 0;
			$photo2 = $_POST['file_path2'];
		}

		// Check if $uploadImg2 is set to 0 
		if($uploadImg2 == 0){
			$photo2 = $_POST['file_path2'];
		} else {
			if(move_uploaded_file($_FILES['image2']['tmp_name'], $photo_dir . $photo2)){
				// Uploaded sucessfully
				$photo2;
			}
		}
	
 	// Product Image 3 ($photo3)
	$photo3 = basename($_FILES['image3']['name']);
	// File type extension will be lower case
	$imageFileType3 = strtolower(pathinfo($photo3, PATHINFO_EXTENSION));
	$uploadImg3 = 1;
			
		//Check file size
		if($_FILES['image3']['size'] > 9000000){
			$uploadImg3 = 0;
			$photo3 = $_POST['file_path3'];
		}

		// Allow certain file format
		if($imageFileType3 != "jpeg" && $imageFileType3 != "jpg" && $imageFileType3 != "png"){
			$uploadImg3 = 0;
			$photo3 = $_POST['file_path3'];
		}

		// Check if $uploadImg3 is set to 0 
		if($uploadImg3 == 0){
			$photo3 = $_POST['file_path3'];
		} else {
			if(move_uploaded_file($_FILES['image3']['tmp_name'], $photo_dir . $photo3)){
				// Uploaded sucessfully
				$photo3;
			}		
		}

	// Product Image 4 ($photo4)
	$photo4 = basename($_FILES['image4']['name']);
	// File type extension will be lower case
	$imageFileType4 = strtolower(pathinfo($photo4, PATHINFO_EXTENSION));
	$uploadImg4 = 1;		
	
		//Check file size
		if($_FILES['image4']['size'] > 9000000){
			$uploadImg4 = 0;
			$photo4 = $_POST['file_path4'];
		}

		// Allow certain file format
		if($imageFileType4 != "jpeg" && $imageFileType4 != "jpg" && $imageFileType4 != "png"){
			$uploadImg4 = 0;
			$photo4 = $_POST['file_path4'];
		}

		// Check if $uploadImg4 is set to 0 
		if($uploadImg4 == 0){
			$photo4 = $_POST['file_path4'];
		} else {
			if(move_uploaded_file($_FILES['image4']['tmp_name'], $photo_dir . $photo4)){
				// Uploaded sucessfully
				$photo4;
			}		
		}

	// Product Image 5 ($photo5)
	$photo5 = basename($_FILES['image5']['name']);
	// File type extension will be lower case
	$imageFileType5 = strtolower(pathinfo($photo5, PATHINFO_EXTENSION));
	$uploadImg5 = 1;		
	
		//Check file size
		if($_FILES['image5']['size'] > 9000000){
			$uploadImg5 = 0;
			$photo5 = $_POST['file_path5'];
		}

		// Allow certain file format
		if($imageFileType5 != "jpeg" && $imageFileType5 != "jpg" && $imageFileType5 != "png"){
			$uploadImg5 = 0;
			$photo5 = $_POST['file_path5'];
		}

		// Check if $uploadImg5 is set to 0 
		if($uploadImg5 == 0){
			$photo5 = $_POST['file_path5'];
		} else {
			if(move_uploaded_file($_FILES['image5']['tmp_name'], $photo_dir . $photo5)){
				// Uploaded sucessfully
				$photo5;
			}
		}
		
	// Product Image 6 ($photo6)
	$photo6 = basename($_FILES['image6']['name']);
	// File type extension will be lower case	
	$imageFileType6 = strtolower(pathinfo($photo6, PATHINFO_EXTENSION));
	$uploadImg6 = 1;		
	
		//Check file size
		if($_FILES['image6']['size'] > 9000000){
			$uploadImg6 = 0;
			$photo6 = $_POST['file_path6'];
		}

		// Allow certain file format
		if($imageFileType6 != "jpeg" && $imageFileType6 != "jpg" && $imageFileType6 != "png"){
			$uploadImg6 = 0;
			$photo6 = $_POST['file_path6'];
		}

		// Check if $uploadImg5 is set to 0 
		if($uploadImg6 == 0){
			$photo6 = $_POST['file_path6'];
		} else {
			if(move_uploaded_file($_FILES['image6']['tmp_name'], $photo_dir . $photo6)){
				// Uploaded sucessfully
				$photo6;
			}
		}
		
	// Product Image 7 ($photo7)
	$photo7 = basename($_FILES['image7']['name']);
	// File type extension will be lower case
	$imageFileType7 = strtolower(pathinfo($photo7, PATHINFO_EXTENSION));
	$uploadImg7 = 1;		
	
		//Check file size
		if($_FILES['image7']['size'] > 9000000){
			$uploadImg7 = 0;
			$photo7 = $_POST['file_path7'];
		}

		// Allow certain file format
		if($imageFileType7 != "jpeg" && $imageFileType7 != "jpg" && $imageFileType7 != "png"){
			$uploadImg7 = 0;
			$photo7 = $_POST['file_path7'];
		}

		// Check if $uploadImg5 is set to 0 
		if($uploadImg7 == 0){
			$photo7 = $_POST['file_path7'];
		} else {
			if(move_uploaded_file($_FILES['image7']['tmp_name'], $photo_dir . $photo7)){
				// Uploaded sucessfully
				$photo7;
			}
		}
		
	// Product Image 8 ($photo8)
	$photo8 = basename($_FILES['image8']['name']);
	// File type extension will be lower case	
	$imageFileType8 = strtolower(pathinfo($photo8, PATHINFO_EXTENSION));
	$uploadImg8 = 1;		
	
		//Check file size
		if($_FILES['image8']['size'] > 9000000){
			$uploadImg8 = 0;
			$photo8 = $_POST['file_path8'];
		}

		// Allow certain file format
		if($imageFileType8 != "jpeg" && $imageFileType8 != "jpg" && $imageFileType8 != "png"){
			$uploadImg8 = 0;
			$photo8 = $_POST['file_path8'];
		}

		// Check if $uploadImg5 is set to 0 
		if($uploadImg8 == 0){
			$photo8 = $_POST['file_path8'];
		} else {
			if(move_uploaded_file($_FILES['image8']['tmp_name'], $photo_dir . $photo8)){
				// Uploaded sucessfully
				$photo8;
			}
		}
	//Check inputs before inserting to Database
	if(empty($Err_category) && empty($Err_product) && empty($Err_retail) && empty($Err_sale) && empty($Err_stock) && empty($Err_descript) && empty($Err_descript2) && empty($Err_descript3) && empty($Err_descript4) && empty($Err_question) && empty($Err_question2) && empty($Err_question3) && empty($Err_question4) && empty($Err_material) && empty($Err_seller) && empty($Err_return_option) && empty($Err_preparation) && empty($Err_deliver) && empty($Err_location)){

   	// Prepare an update statement
  	 $sql = "UPDATE products SET category='$category', product='$product', description='$descript', description2='$descript2', description3='$descript3', description4='$descript4', FAQ='$question', FAQ2='$question2', FAQ3='$question3', FAQ4='$question4', material='$material', handmade='$handmade', return_option='$return_option', stock='$stock', retail_price='$retail', sale_price='$sale', image1='$photo1', image2='$photo2', image3='$photo3', image4='$photo4', image5='$photo5', image6='$photo6', image7='$photo7', image8='$photo8', rnd='$rnd', seller='$seller', business_day='$preparation', deliver='$deliver', location='$location' WHERE id='$id'";
     	
   	if (mysqli_query($conn, $sql)) { 
	 			header("Location: seller-product.php");
			} else {
	 		 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

  }
  // Close connection
  mysqli_close($conn);
} 
?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["listing_au"]) && !empty($_GET["listing_au"])){

// Include Database Holder 
require_once ("database/database_lvl3.php");

	// Prepare a select statement
   $sql = "SELECT * FROM products WHERE rnd = '".$_GET["listing_au"]."' AND seller='".$user['shop_name']."'";
    
	$result = mysqli_query($con, $sql);   
   	if(mysqli_num_rows($result) == 1){
    		//Since the result set contains only one row, we don't need to use while loop 
      $row = mysqli_fetch_assoc($result);
                  		
  			// Retrieve individual field value
  			
  			$id					=		$row['id'];
  			$category			=		$row['category'];
  			$product 			=		$row['product'];
  			$description		=		$row['description'];	
  			$FAQ				=		$row['FAQ'];
  			$FAQ2				=		$row['FAQ2'];
  			$FAQ3				=		$row['FAQ3'];
  			$FAQ4				=		$row['FAQ4'];
  			$material			=		$row['material'];
  			$handmade			=		$row['handmade'];
  			$return_option		=		$row['return_option'];
  			$stock				=		$row['stock'];
  			$sale_price			=		$row['sale_price'];
  			$oldprice			=		$row['oldprice'];
  			$image1				=		$row['image1'];
  			$image2				=		$row['image2'];
  			$image3				=		$row['image3'];
  			$image4				=		$row['image4'];
  			$image5				=		$row['image5'];
  			$rnd				=		$row['rnd'];
  			$seller				=		$row['seller'];
  			$business_day		=		$row['business_day'];
  			$deliver			=		$row['deliver'];
  			$location			=		$row['location'];
  			
			} else{
       		// URL doesn't contain valid id parameter. Redirect to error page
        	// header("location: error.php");
        	 header("Location: ../../../");
        	// echo 'hey';
        	exit();
    	}  
  		// Close connection
  		mysqli_close($con);

	} else{
    		// URL doesn't contain id parameter. Redirect to error page
    		// header("location: error.php");
    		header("location: ../../../");
    		// echo 'jn';
    		exit();
}
// --------- Price Format
$output_lvl1 = $row['retail_price'];
$global_price_lvl1 = number_format( $output_lvl1 , 0 , '.' , ',' );

$output_lvl2 = $row['sale_price'];
$global_price_lvl2 = number_format( $output_lvl2 , 0 , '.' , ',' );
// ---------

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
		<a href="" class="brand-logo black-text" >Edit Product</a>
    	<input type="submit" class="right green-text text-darken-4" value="UPDATE" disabled="disabled" />
    </div>
</nav>
</div>
</form><br>
