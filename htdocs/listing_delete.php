<?php
//Validate Form Data
function validate_data($data){
	$data = strip_tags($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
include 'database/database_lvl3.php';
// Process delete operation after confirmation
	if(isset($_POST["id"]) && !empty($_POST["id"])){

	$id = validate_data($_POST['id']);
	// Prepare a delete statement
	// Fetching Select
	$sql = "SELECT * FROM products WHERE rnd = '".$_POST['id']."'";
	
	$result = mysqli_query($con, $sql);   
	if(mysqli_num_rows($result) == 1){
		//Since the result set contains only one row, we don't need to use while loop 
	$row = mysqli_fetch_assoc($result);
		// Variable here
		//Nothing
	}
	$sql = "DELETE FROM products WHERE rnd= '$id'";
	// Delete File
	unlink("static/cdn/products_new_rdr/".$row['image1']."");
    unlink("static/cdn/products_new_rdr/".$row['image2']."");
    unlink("static/cdn/products_new_rdr/".$row['image3']."");
    unlink("static/cdn/products_new_rdr/".$row['image4']."");
    unlink("static/cdn/products_new_rdr/".$row['image5']."");
    unlink("static/cdn/products_new_rdr/".$row['image6']."");
    unlink("static/cdn/products_new_rdr/".$row['image7']."");
    unlink("static/cdn/products_new_rdr/".$row['image8']."");
	
	
    if (mysqli_query($con, $sql)) {
		// Redirect to My Store page
		header("location: ../../../my_store/");
	} else {
		// Mysql Error | Delete Error
	    echo "Error deleting record: " . mysqli_error($con);
	    }
	mysqli_close($con);
} else {

	// Check existence of id parameter
   if(empty($_GET["id"])){
   	// URL doesn't contain id parameter. Redirect to error page
   	header("location: error.php");
   	exit();
   }

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
</style>

<div class="navbar-fixed" >
<nav class="z-depth-0 white">
	<div class="nav-wrapper center" >
		<a href="../../../my_store/" >
			<span class="left svg" ><svg style="width:23px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M256,480C132.288,480,32,379.712,32,256S132.288,32,256,32s224,100.288,224,224S379.712,480,256,480z"/><path d="M292.64,116.8l-128,128c-6.204,6.241-6.204,16.319,0,22.56l128,128l22.56-22.72L198.56,256L315.2,139.36L292.64,116.8z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>
		</a>
		<a href="" class="brand-logo black-text" >Delete an item</a>
    </div>
</nav>
</div>
<div class="container" >
	<p style="font-size:16px" >Are you sure want to delete this item?</p>
<form action="<?php echo validate_data($_SERVER["PHP_SELF"]); ?>" method="post" >
	<input type="hidden" name="id" value="<?php echo validate_data($_GET["id"]); ?>">
	<button type="submit" class="btn red lighten-2 z-depth-0">Yes</button>
   	<a href="../product/seller-product.php" class="btn z-depth-0">No</a>
</form>
</div>