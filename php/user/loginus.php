<?php
	session_start();
	include_once("dbconnect.php");
	
	if (isset($_POST['submit'])) {
		$email = trim($_POST['email']);
		$password = trim(sha1($_POST['password']));
		$sqllogin = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' AND otp = '1'";
		
		$select_stmt = $conn->prepare($sqllogin);
		$select_stmt->execute();
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		if ($select_stmt->rowCount() > 0) {
			$_SESSION["session_id"] = session_id();
			$_SESSION["email"] = $email;
			$_SESSION["name"] = $row['name'];
			$_SESSION["phone"] = $row['phone'];
			$_SESSION["datereg"] = $row['date_reg'];
			$_SESSION["pass"] = $row['password'];
			echo "<script> alert('Login successful. Welcome to EZ Papeteria.')</script>";
			echo "<script> window.location.replace('/ezpapeterie/php/user/mainpage.php')</script>";
			} else {
			session_unset();
			session_destroy();
			echo "<script> alert('Login failed. Please verify your account and check the details that you fill in to log in.')</script>";
			echo "<script> window.location.replace('/ezpapeterie/php/user/loginus.php')</script>";
		}
	}
	if (isset($_GET["status"])) {
		if (($_GET["status"] == "logout")) {
			session_unset();
			session_destroy();
			echo "<script> alert('Session Cleared')</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
	
	<head>
		<title>User Login Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/ezpapeterie/js/validate.js"></script>
		<link rel="stylesheet" href="/ezpapeterie/css/style.css">
		<link rel="shortcut icon" type="image" href="/ezpapeterie/images/ezlogo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	 <body onload="loadCookies()">
		<!-- HEADER -->
		<div class="header">
			<h1>User Login Page</h1>
		</div>
		<!-- NAVIGATION BAR -->
		<div class="navbar">
			<a href="/ezpapeterie/index.html" class="right">Back</a>
			<a href="/ezpapeterie/html/register.html" class="right">Register</a>
		</div>
			<!-- LOGO -->
			<center>
				<img src="/ezpapeterie/images/ezlogo.png">
			</center>
			<div class="main">
				<div class="container">
					<form name="loginForm" action="/ezpapeterie/php/user/loginus.php" onsubmit="return validateLoginForm()" method="post">
						<!-- EMAIL -->	
						<div class="row">
							<div class="col-25">
								<i class="fa fa-envelope icon"></i>
								<label for="femail">Email</label>
							</div>
							<div class="col-75">
								<input type="text" id="idemail" name="email" placeholder="Please key in your email">
							</div>
						</div>
						<!-- PASSWORD -->
						<div class="row">
							<div class="col-25">
								<i class="fa fa-key icon"></i>
								<label for="lname">Password</label>
							</div>
							<div class="col-75">
								<input type="password" id="idpass" name="password" placeholder="Please key in your password">
							</div>
						</div>
						<!-- REMEMBER ME -->
					    <div class="row">
							<div class="col-25">
								<i class="fa fa-pencil icon"></i>
								<input type="checkbox" id="idremember" name="rememberme">
								<label for="remember">Remember Me</label>
							</div>
						</div>
						<!-- FORGET PASSWORD -->
						<div class="row">
							<div class="col-75">
								<a href="/ezpapeterie/php/user/forget.php">Forgot password? Click here to reset a new password.</a>
							</div>
						</div>
						<br>
						<!-- LOGIN BUTTON -->
						<div class="row">
							<input type="submit" name="submit" value="Login">
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
