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
function createRandomNumber() {
	$chars = "0000000111111122222223333333444444455555556666666777777788888889999999";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '';
	while ($i <= 10) {
		$num  = rand() % 33;
		$tmp  = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$trackcode='CB'.createRandomNumber();

?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<link rel="stylesheet" href="../css/framework.css">
<style type="text/css">
	input[type='text'] {border: none; outline: none; box-shadow: none;}
</style>
</head>
<body>
<div class="w3-container">
<div class="w3-center w3-margin w3-padding w3-border w3-round w3-border-purple w3-text-purple">
	<h5>CHECKOUT</h5>
	<input type="text" name="code" value="<?php echo $trackcode; ?>" class="w3-border w3-round w3-center">
</div>
<div class="w3-margin w3-padding" style="width:100%;white-space:nowrap;">
<form method="post" action="">
	<div class="w3-row-padding">
		<div class="w3-col m6">
			<label>First Name</label>
			<input type="text" name="fname" value="" class="w3-input w3-border w3-round">
			<span></span>
		</div>
		<div class="w3-col m6">
			<label>Last Name</label>
			<input type="text" name="lname" value="" class="w3-input w3-border w3-round">
			<span></span>
		</div>
		<div class="w3-col m6">
			<label>Street Address</label>
			<input type="text" name="address" value="" class="w3-input w3-border w3-round">
			<span></span>
		</div>
		<div class="w3-col m6">
			<label>Town/City</label>
			<input type="text" name="place" value="" class="w3-input w3-border w3-round"> 
			<span></span>
		</div>
		<div class="w3-col m6">
			<label>Phone</label>
			<input type="number" name="phone" value="" class="w3-input w3-border w3-round">
			<span></span>
		</div>
		<div class="w3-col m6">
			<label>Email Address</label>
			<input type="text" name="email" value="" class="w3-input w3-border w3-round">
			<span></span>
		</div>
	</div>
	<h4 style="letter-spacing:1px;"><b>YOUR ORDER</b></h4>
	<table border="1" class="w3-centered w3-table w3-small w3-content"  style="white-space:wrap;">
		<thead>
			<tr>
				<th>RND</th>
				<th>Category</th>
				<th>Product Image</th>
				<th>Product Name</th>
				<th>Description</th>
				<th>Seller</th>
				<th>Stocks</th>	
				<th>Price</th>
				<th>Quantity</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
	<?php
	// Include Database file
   require ("database/database_lvl3.php");
   
   // Attempt select query execution
  	$sql = "SELECT * FROM cart_order WHERE email='".$email."' ORDER BY id DESC";
   	$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) {
		 		// output data of each row
		   while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
						echo "<td><input type='text' name='rnd' value='".$row["rnd"]."' readonly></td>";
						echo "<td><input type='text' name='category' value='".$row["category"]."' readonly></td>";
						echo "<td><input type='hidden' name='image' value='".$row["image"]."'><img src='../product/".$row["image"]."' width='50' height='30'></td>";
		    		echo "<td><input type='text' name='product' value='".$row["product"]."' style='border:none;' readonly></td>";
		   	 	echo "<td><input type='text' name='descript' value='".$row["description"]."' style='border:none;' readonly></td>";
						echo "<td><input type='text' name='seller' value='".$row["seller"]."' readonly></td>";
		   	 	echo "<td><input type='text' name='stock' value='".$row["stock"]."' style='border:none;' readonly></td>";
						echo "<td> &#8369; <input type='text' name='price' value='".number_format($row["price"],2)."' style='border:none;' readonly></td>";
		   	 	echo "<td><input type='number' name='qty'value='".$row['qty']."' style='border:none;' readonly></td>";
						echo "<td> &#8369;<input type='text' name='amount' value='".number_format($row["amount"],2)."' readonly></td>";		   	
		 			echo "</tr>";                         
     		}

			} else {
			// No Result
			echo "<p class='w3-center w3-padding-16 w3-border w3-border-red'><em class='w3-text-red'>No Item List</em></p>";
	}

  	// Close connection
  	mysqli_close($con);
  	?>
	</tbody>
	<tfoot>
	<?php
	//Include Database Holder
	require('database/database_lvl3.php');

  	$sql = "SELECT * FROM cart_order WHERE email='".$email."' ";
   	$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) {
		 		// output data of each row
		   while($row = mysqli_fetch_assoc($result)) {
					$total = number_format($row["SUM(amount)"],2);
						
				}

			} 		
 			// Close connection
  			mysqli_close($con);
			?>
			<tr>
				<td colspan="9"><b>Total:</b></td>
				<td> &#8369; <?php echo $total ?></td>
			</tr>
		</tfoot>
	</table>
	<div class="w3-container" style="padding-top: 16px;max-width:900px;">
	<h4 style="letter-spacing:1px;"><b>PAYMENT METHOD</b></h4>
	<div class="w3-row-padding">
		<div class="w3-col l4">
			<div class="w3-content">
				<label><input type="radio" name="payment" value="Cash on Delivery"> Cash on Delivery</label>
				<p style="font-size:11px;">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
			</div>
		</div>
		<div class="w3-col l4">
			<div class="w3-content">
				<label><input type="radio" name="payment" value="Paypal"> GCash</label>
				<p style="font-size:11px;">Pay via GCash: you can pay with your credit card if you don't have a GCash account.</p>
			</div>
		</div>
		<div class="w3-col l4" style="padding-top: 16px;">
			<div class="w3-content">
	 			<label><input type="checkbox" id="remember" name="remember" onclick="if(this.checked){undisabled()}else{disabledTrue()}"> I've read and accept the <a href="" class="w3-text-red">terms & conditions</a></label>
			</div>
			<div class="w3-content"><button type="submit" name="submit" id="submit" class="w3-btn w3-border w3-round w3-block w3-purple"><b>PLACE ORDER</b></button></div>
		</div>
	</div>
</form>
</div>

<script type="text/javascript">
	var submit  = document.getElementById("submit").disabled = true;

	function undisabled() {
		var submit  = document.getElementById("submit").disabled = false;;
	}
	function disabledTrue() {
		var submit  = document.getElementById("submit").disabled = true;
	}
</script>
</body>
</html>