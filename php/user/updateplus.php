<?php
include_once('dbconnect.php');

$conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
  mysqli_select_db($conn,"doubleks_myshop262530"); 

  $sqlupdatecart = "UPDATE tbl_cart SET qty = qty +1 WHERE prid = '$_GET[prid]'";
$result = mysqli_query($conn,$sqlupdatecart);

if($result){
    echo "<script> window.location.replace('/ezpapeterie/php/user/addtocart.php')</script>";
}
else{
    echo "<script>alert('Failed to update.')</script>";
    echo "<script> window.location.replace('/ezpapeterie/php/user/addtocart.php')</script>";
}
?>