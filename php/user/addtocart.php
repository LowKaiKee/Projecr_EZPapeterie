<?php
	session_start();
	$email=$_SESSION ["email"];
	include_once("dbconnect.php");
	
	$sqlloadcart = "SELECT * FROM tbl_cart INNER JOIN tbl_products ON tbl_cart.prid = tbl_products.prid WHERE tbl_cart.email = '$email'";
	$stmt = $conn->prepare($sqlloadcart);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Cart Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/ezpapeterie/js/validate.js"></script>
		<link rel="stylesheet" href="/ezpapeterie/css/style.css">
		<link rel="shortcut icon" type="image" href="/ezpapeterie/images/ezlogo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<!-- HEADER -->
		<div class="header">
			<h1>My Cart</h1>
		</div>
		<!-- NAVIGATION BAR -->
		<div class="navbar">
			<a href="/ezpapeterie/php/user/mainpage.php" class="right">Cancel</a>
		</div>
		<!-- LOAD THE CART -->
		<div class="row">
			<?php
				$sumtotal = 0.0;
				foreach ($rows as $carts) {
					echo "<div class='column'>";
					$prid = $carts['prid'];
					$qty = $carts['qty'];
					$total = 0.0;
					$total = $carts['prprice'] * $carts['qty'];
					$imgurl = "/ezpapeterie/images/".$carts['image'];
				?>
				<div class='card'>
					<p align='right' style='margin-top:-5%;'><a href='deletecart.php?prid=<?php echo $carts['prid']; ?>' class='fa fa-remove' style='font-size:20px;text-decoration:none;color:black'></a></p>
					<?php
						echo "<img src='$imgurl' class='image' style='margin-left:-4%;'>";
					?>
					<h3 align='center' ><?php echo $carts['prname']; ?>  </h3>
					<p align='center'> RM <?php echo number_format($carts['prprice'],2) ?><br></p>
					<table class='center' style='margin-left:25%;'><tr><td><a href='updateminus.php?prid=<?php echo $carts['prid'];?>&qty=<?php echo $carts['qty'];?>'><i class='fa fa-minus' style='font-size:24px;color:black'></i></a></td>
						<td>Qty: <?php echo $carts['qty']; ?></td>
					<td>&nbsp<a href='updateplus.php?prid=<?php echo $carts['prid'];?>'><i class='fa fa-plus' style='font-size:24px;color:black'></i></a></td></tr></table><br>
					<td>Total Price: RM <?php echo number_format($total,2) ?></td><br>
					
			</div>
		</div>
		<?php
            $sumtotal = $total + $sumtotal;
		}
        echo "</div>";
        
        echo "<div class='container-src'>
        <center><h1>Total Payment: RM " . number_format($sumtotal, 2) . "</h1></center></div>";
	?>
</div>
<!-- PAYMENT FORM -->
<div class="container">
	<h3>Payment Form</h3>
	<form action="/ezpapeterie/php/user/cartprocess.php" method="get">
		<div class="row">
			<div class="col-25">
				<i class="fa fa-envelope icon"></i>
				<label for="lblemail">Your Email</label>
			</div>
			<div class="col-75">
				<input type="text" id="idemail" name="email" value="<?php echo $email ?>" disabled>
			</div>
		</div>
		<div class="row">
			<div class="col-25">
				<i class="fa fa-user icon"></i>
				<label for="lblname">Your Name</label>
			</div>
			<div class="col-75">
				<input type="text" id="idname" name="name" placeholder="Your Name" required>
			</div>
		</div>
		
		<div class="row">
			<div class="col-25">
				<i class="fa fa-phone icon"></i>
				<label for="lphone">Phone Number</label>
			</div>
			<div class="col-75">
				<input type="text" id="idphone" name="phone" placeholder="Your phone" required>
			</div>
		</div>
		<div class="row">
			<div class="col-25">
				<i class="fa fa-pencil icon"></i>
				<label for="remarks">Remarks</label>
			</div>
			<div class="col-75">
				<input type="text" id="idremarks" name="remarks" placeholder="Your remarks" required>
			</div>
		</div>
		<div class="row">
			<div class="col-25">
				<i class="fa fa-clock-o icon"></i>
				<label for="ltime">Pickup Time</label>
			</div>
			<div class="col-75">
				<input type="time" id="idtime" name="pickup" min="09:00" max="18:00" required>
			</div>
		</div>
		<input type="hidden" id="idprice" name="price" value="<?php echo $sumtotal ?>">
		<input type="hidden" id="idemail" name="email" value="<?php echo $email ?>">
		<div class="row">
			<div class="col-25">
			</div>
			<br>
			<div class="col-75">
				<input type="submit" name="submit" value="Make Payment">
			</div>
		</div>
	</form>
</div>
<br>
<!-- FOOTER -->
<div class="footer">
	<p><b>Copyright 2021 <span>&#169;</span> EZ Papeterie. All rights reserved.</b></p>
</div>
</body>
</html>