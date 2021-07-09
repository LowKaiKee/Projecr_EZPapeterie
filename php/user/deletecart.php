<?php
    include_once('dbconnect.php');

    $conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
    mysqli_select_db($conn,"doubleks_myshop262530");

    $sql="DELETE FROM tbl_cart WHERE prid='$_GET[prid]'";
    $result = mysqli_query($conn,$sql);

    if($result){
        echo '<script type="text/javascript"> alert("Are you sure to delete the product your add to cart?")</script>';
        echo "<script>window.location.replace('/ezpapeterie/php/user/addtocart.php')</script>";
    }else{
        echo "Error";
    }
?>