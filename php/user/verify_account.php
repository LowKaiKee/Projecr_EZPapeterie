<?php
    error_reporting(0);
    include_once("dbconnect.php");
    $email = $_GET['email'];
    $otp = $_GET['key'];
    
    $sql = "SELECT * FROM tbl_user WHERE email = '$email' AND otp='$otp'";
    $result = $conn->query($sql);
    try {
        $sqlupdate = "UPDATE tbl_user SET otp = '1' WHERE email = '$email' AND otp = '$otp'";
        $conn->exec($sqlupdate);
        echo 'Verify Success.Please login to your account!';
        echo "<script> window.location.replace('/ezpapeterie/php/user/loginus.php')</script>";
	} 
	catch(PDOException $e) {
        echo 'Verify Failed.Please register again!';
        echo "<script> window.location.replace('/ezpapeterie/html/register.html')</script>";
	}
?>

