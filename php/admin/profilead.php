<?php
	include 'dbconnect.php';
	session_start();
	$email=$_SESSION['email'];
	
	$conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
    mysqli_select_db($conn,"doubleks_myshop262530");
    
	$query=mysqli_query($conn,"SELECT * FROM tbl_admin where email='$email'")or die(mysqli_error());
	$row=mysqli_fetch_array($query)
?>

<?php  
	if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $query = "UPDATE tbl_admin SET name = '$name', phone = '$phone' WHERE email = '$email'";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	?>
	<script type="text/javascript">
		alert("Your profile has been successfully updated!");
		window.location = "/ezpapeterie/php/admin/profilead.php";
	</script>
	<?php
	}              
?>				

<!DOCTYPE html>
<html>
	
	<head>
		<title>Admin Profile Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/ezpapeterie/js/validate.js"></script>
		<link rel="stylesheet" href="/ezpapeterie/css/style.css">
		<link rel="shortcut icon" type="image" href="/ezpapeterie/images/ezlogo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<!-- HEADER -->
		<div class="header">
			<h1>Admin Profile Page</h1>
		</div>
		<!-- NAVIGATION BAR -->
        <div class="navbar">
		<a href="/ezpapeterie/php/admin/mainpage.php" class="right">Back</i></a>
	</div>
	
	<!-- EDITABLE DETAILS FOR ADMIN -->
	<div class="main">
		<div class="container">
            <?php
				$email=$_SESSION ["email"];
				
				$conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
				mysqli_select_db($conn,"doubleks_myshop262530");
				
				$sql ="SELECT * FROM tbl_admin WHERE email=".$email++;
				
				$result = mysqli_query($conn,$sql);
				if($result ==true){
					$row= mysqli_fetch_assoc($result);
					$name=$row['name'];
					$phone = $row['phone'];
				}
			?>
			
			<form name="registerForm" action="/ezpapeterie/php/admin/profilead.php" onsubmit="return validateRegForm()"
			method="post">	
				<!-- HIDDEN-EMAIL -->
				<input type="hidden" id="idemail" name="email" placeholder="Please key in your email" value="<?php echo $row['email'];?>">
				<!-- NAME -->
				<div class="row">
					<div class="col-25">
						<i class="fa fa-user icon"></i>
						<label for="fname">Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="idname" name="name" placeholder="Please key in your name" value="<?php echo $row['name'];?>">
					</div>
				</div>
				<!-- PHONE NUMBER-->
				<div class="row">
					<div class="col-25">
						<i class="fa fa-phone icon"></i>
						<label for="lphone">Phone number</label>
					</div>
					<div class="col-75">
						<input type="tel" id="idphone" name="phone" placeholder="Please key in your phone number" value="<?php echo $row['phone'];?>">
					</div>
				</div>
				<!-- UPDATE PROFILE BUTTON -->
				<div class="row">
					<div><input type="submit" name="submit" value="Update Profile"></div>
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
