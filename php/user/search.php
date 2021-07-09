<html>
	<head>
		<title>Search Result Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/ezpapeterie/js/validate.js"></script>
		<link rel="stylesheet" href="/ezpapeterie/css/style.css">
		<link rel="shortcut icon" type="image" href="/ezpapeterie/images/ezlogo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<!-- HEADER -->
		<div class="header">
			<h1>Matches results found......</h1>
		</div>
		<!-- NAVIGATION BAR -->
		<div class="navbar">
	        <a href="/ezpapeterie/php/user/mainpage.php" class="right">Back</i></a>
	    </div>
	
	<!-- LOAD THE SEARCH RESULT -->
	<?php
		$con = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
		mysqli_select_db($con,"doubleks_myshop262530");
		
		$prname = $_POST['prname'];
		$prtype = $_POST['prtype'];
		
		if ($prtype == "noselection") {
			$sqlsearch = "SELECT * FROM tbl_products WHERE prname LIKE '%$prname%' ORDER BY prid DESC";
			} else {
			$sqlsearch = "SELECT * FROM tbl_products WHERE prtype = '$prtype' AND prname LIKE '%$prname%' ORDER BY prid DESC";
		}
		
		$sql = $con -> query($sqlsearch);
		if($sql->num_rows >0){
			while ($row = $sql->fetch_array()){
				
			?>
			<div class="column">
				<div class="flip-card">
					<div class="flip-card-inner">
						<div class="flip-card-front">
							<img src = "/ezpapeterie/images/<?php echo $row['image'];?>" style="width:100%">
						</div>
						<div class="flip-card-back">
							<h3 style="color:black"><?php echo $row['prname']; ?></h3>
							<p>Product Type: <?php echo $row['prtype']; ?></p>
							<p>Product Price (RM): <?php echo $row['prprice']; ?></p>
							<p>Quantity available: <?php echo $row['prqty']; ?></p>
							<a href='productdetails.php?prid=<?php echo $row['prid']; ?>'><i class='fa fa-cart-plus' style='font-size:24px;color:black'></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php
				
			}}
			else{
				echo "<script>alert('No matched results found.')</script>";
				echo "<script>window.location.replace('/ezpapeterie/php/user/mainpage.php')</script>";
			}
	?>
	
</body>
</html>												