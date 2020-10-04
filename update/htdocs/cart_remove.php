<?php
// Include config file
require_once "database/database_lvl3.php";
   
//Validate Form Data
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
		return $data;
}
 
	$id = test_input($_GET["id"]);

   // Prepare a delete statement
   $sql = "DELETE FROM cart_order WHERE id = '$id'"; 
   	if (mysqli_query($con, $sql)) { 
	 		header("location: ../../../cart/");
		} else {
	 		echo "Error: " . $sql . "<br>" . mysqli_error($con);
	} 
 	// Close connection
 	mysqli_close($con);
?>