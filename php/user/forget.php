<!DOCTYPE html>
<html>
	<head>
		<title>Reset User Password Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/ezpapeterie/js/validate.js"></script>
		<link rel="stylesheet" href="/ezpapeterie/css/style.css">
		<link rel="shortcut icon" type="image" href="/ezpapeterie/images/ezlogo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<!-- HEADER -->
		<div class="header">
			<h1>Reset User Pasword Page</h1>
		</div>
		<!-- NAVIGATION BAR -->
		<div class="navbar">
			<a href="/ezpapeterie/index.html" class="right">Back</a>
		</div>
		<!-- REQUIRED FIELDS FOR FORGOT PASSWORD -->
		<div class="main">
			<div class="container">
				<form name="forgetForm" action="/ezpapeterie/php/user/forget.php" onsubmit="return validateForgetForm()" method="post">
					<!-- EMAIL -->
					<div class="row">
						<div class="col-25">
							<i class="fa fa-envelope icon"></i>
							<label for="email">Email</label>
						</div>
						<div class="col-75">
							<input type="text" id="idemail" name="email" placeholder="Please key in your email">
						</div>
					</div>
					<!-- NEW PASSWORD -->
					<div class="row">
						<div class="col-25">
							<i class="fa fa-key icon"></i>
							<label for="password">New Password</label>
						</div>
						<div class="col-75">
							<input type="password" id="idpass" name="password" placeholder="Please key in your new password">
						</div>
					</div>
					<br>
					<!-- RESET PASSWORD BUTTON -->
					<div class="row">
						<input name="submit" type="submit" value="Reset My Password">
					</div>
				</form>
			</div>
		</div>
		<!-- FOOTER -->
		<div class="footer">
			<p><b>Copyright 2021 <span>&#169;</span> EZ Papeterie. All rights reserved.</b></p>
		</div>
		
		<?php
			$conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
			mysqli_select_db($conn,"doubleks_myshop262530");
			
			if(isset($_POST['submit'])){
				$email = trim($_POST['email']);
				$password = trim(sha1($_POST['password']));
				if(mysqli_query($conn,"UPDATE tbl_user SET password='$password' WHERE email='$email'")){
					
				?>
				<?php
					echo '<script type="text/javascript"> alert("Your password has been successfully reset!")</script>';
					header("refresh:1; url=/ezpapeterie/html/loginus.html");
				?>
				<?php
					}else{
					echo 'no result';
				}
			}
		?>
	</body>
</html>							