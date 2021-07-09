<!-- SESSION -->
<?php
session_start();
$email=$_SESSION ["email"];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>EZ Papeterie</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/ezpapeterie/js/validate.js"></script>
		<link rel="stylesheet" href="/ezpapeterie/css/style.css">
		<link rel="shortcut icon" type="image" href="/ezpapeterie/images/ezlogo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<!-- HEADER -->
		<div class="header">
			<h1>EZ Papeterie</h1>
			<p><b>Your best stationery partner</b></p>
		</div>
		<!-- NAVIGATION BAR -->
		<div class="navbar">
			<!-- LOG OUT -->
		<a href="/ezpapeterie/php/user/loginus.php" class="right">Log out</i></a>
		<a href="/ezpapeterie/php/user/addtocart.php" class="right">My Cart</i></a>
		<a href="/ezpapeterie/php/user/profileus.php" class="right">Profile</i></a>
	</div>
	<center>
		<div class="main">
			<!-- LOGO -->
			<center>
				<img src="/ezpapeterie/images/ezlogo.png">
				<h3>Welcome <?php echo $email?>.</h3>
				<p>We are always ready to serve you.</p>
			</center>
			<center>
				<h1>Products List</h1>
			</center>
		</div>
	
		<!-- SEARCH FUNCTION -->
		<form action="search.php" method="POST" align="center">
			<div class="row">
				<div class="column">
					<input type="text" id="idprname" name="prname" placeholder="Search" />
				</div>
				<div class="column">
					<select name="prtype" id="idprtype">
						<option value="noselection">Please select the product type</option>
						<option value="Stationery">Stationery</option>
						<option value="Book">Book</option>
						<option value="Accessories">Accessories</option>
					</select>
				</div>
				<div class="column">
					<button type="submit" name="button" value="search"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</form>
		
		<!-- LOAD THE DATABASE FOR LIST OF THE PRODUCT -->
		<div class="row">
			<?php
				$conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
				mysqli_select_db($conn,"doubleks_myshop262530");
				
				$sql ="SELECT * FROM tbl_products ORDER BY prid DESC";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
					?>
					
					<div class="column">
						  <div class="card">
							<img src = "/ezpapeterie/images/<?php echo $row['image'];?>" style="width:100%">
							<h3 style="color:black"><?php echo $row['prname']; ?></h3>	
									<!--<p class="category">Product type: <?php echo $row['prtype']; ?></p>-->
									<!--<p class="category">Product price (RM): <?php echo $row['prprice']; ?></p>-->
									<!--<p class="category">Quantity available: <?php echo $row['prqty']; ?></p>-->
									<a href='productdetails.php?prid=<?php echo $row['prid']; ?>'><i class='fa fa-cart-plus'  style='font-size:24px;color:black'></i></a>
						</div> 
					</div>
					<?php
					}
				}
			?>
		</div>
	</body>
</html>																																						