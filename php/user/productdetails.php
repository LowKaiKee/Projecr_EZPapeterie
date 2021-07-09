<?php
session_start();
$email=$_SESSION ["email"];

	include_once("dbconnect.php");

       if (isset($_POST['submit'])) {
        $prid = $_POST['prid'];
        $qty = $_POST['qty'];
          
              $sqlinsertcart =  "INSERT INTO tbl_cart(email,prid,qty) VALUES('$email','$prid','$qty')";
              if ($conn->exec($sqlinsertcart)) {
                  echo "<script>alert('The product is successfully added to your cart.')</script>";
                  echo "<script>window.location.replace('/ezpapeterie/php/user/mainpage.php')</script>";
              } else {
                  echo "<script>alert('The product is failed to add to your cart.')</script>";
                  echo "<script>window.location.replace('/ezpapeterie/php/user/productdetails.php')</script>";
                  return;
              }
       }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Product Details Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/ezpapeterie/js/validate.js"></script>
		<link rel="stylesheet" href="/ezpapeterie/css/style.css">
		<link rel="shortcut icon" type="image" href="/ezpapeterie/images/ezlogo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<!-- HEADER -->
		<div class="header">
			<h1>Product Details Page</h1>
		</div>
		<!-- NAVIGATION BAR -->
		<div class="navbar">
			<a href="/ezpapeterie/php/user/mainpage.php" class="right">Cancel</a>
		</div>
		<div class="main">
			<div class="container1">
				<?php
					$prid=$_GET['prid'];
					
					$conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
					mysqli_select_db($conn,"doubleks_myshop262530");
					
					$sql ="SELECT * FROM tbl_products WHERE prid=".$prid++;
					
                    $result = mysqli_query($conn,$sql);
                    if($result ==true){
						$row= mysqli_fetch_assoc($result);
						$prname=$row['prname'];
						$prtype = $row['prtype'];
						$prprice = $row['prprice'];
						$prqty = $row['prqty'];
					}
				?>
				
				<form name="newForm" action="/ezpapeterie/php/user/productdetails.php" onsubmit="return validateNewForm()" method="post" enctype="multipart/form-data">
					<div class="row" align="center">
						<img class="imgselection" src="/ezpapeterie/images/<?php echo $row ['image'];?>"><br>
					</div>
					<!-- PRODUCT NAME -->
					<div class="row">
						<div class="col-25">
							<i class="fa fa-pencil-square-o"></i>
							<label for="prname">Product Name: <?php echo $row['prname']; ?></label>
						</div>
					</div>
					<!-- PRODUCT TYPE -->
					<div class="row">
						<div class="col-25">
							<i class="fa fa-suitcase"></i>
							<label for="prtype">Product Type: <?php echo $row['prtype']; ?></label>
						</div>
					</div>
					<!-- PRODUCT PRICE -->
					<div class="row">
						<div class="col-25">
							<i class="fa fa-money icon"></i>
							<label for="prprice">Product Price: <?php echo $row['prprice']; ?></label>
						</div>
					</div>
					<!-- QUANTITY AVAILABLE -->
					<div class="row">
						<div class="col-25">
							<i class="fa fa-check icon"></i>
							<label for="prprice">Quantity available: <?php echo $row['prqty']; ?></label>
						</div>
					</div>
					<!-- PRODUCT QUANTITY -->
					<div class="row">
						<div class="col-25">
							<i class="fa fa-sort-numeric-asc icon"></i>
							<label for="prqty">Product Quantity</label>
						</div>
						<div class="col-75">
							<input type="number" id="idqtyslc" name="qty" placeholder="Please key in the product quantity" min="1" max="<?php echo $row['prqty'];?>">
						</div>
					</div>
					<!-- HIDDEN-PRODUCT ID -->
					<input type="hidden" name="prid" value="<?php echo $row["prid"]; ?>"/><br>
					<div class="row">
						<div><input type="submit" name="submit" value="Add to My Cart"></div>
					</div>
				</form>
			</div>
		</div>
		<!-- FOOTER -->
		<div class="footer">
			<p><b>Copyright 2021 <span>&#169;</span> EZ Papeterie. All rights reserved.</b></p>
		</div>
	</body>
</html>