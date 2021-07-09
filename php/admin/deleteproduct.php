<?php
include_once('dbconnect.php');

$conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
mysqli_select_db($conn,"doubleks_myshop262530");

$sql="DELETE FROM tbl_products WHERE prid='$_GET[prid]'";
$result = mysqli_query($conn,$sql);

if($result){
echo '<script type="text/javascript"> alert("Your product has been successfully deleted!")</script>';
header("refresh:1; url=/ezpapeterie/php/admin/mainpage.php");
}
else{
echo "Error";
}
?>