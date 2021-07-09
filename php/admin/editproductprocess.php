<?php
 $primage = uniqid() . '.png';
 $prid=$_POST['prid'];
 $prname=$_POST['prname'];
 $prtype = $_POST['prtype'];
 $prprice = $_POST['prprice'];
 $prqty = $_POST['prqty'];

 $conn = mysqli_connect("localhost","doubleks_myshop262530admin","rPW7MD9LXxR8F5j") or die("Unable to connect");
  mysqli_select_db($conn,"doubleks_myshop262530"); 
  
  
  $sql="UPDATE tbl_products SET  
  -- image ='$primage',
                        prname='$prname',
                        prtype = '$prtype',
                        prprice = '$prprice',
                        prqty = '$prqty'
                        WHERE prid='$prid'";

   $result= mysqli_query($conn,$sql) or die(mysqli_error());
   if($result == true){
        echo '<script type="text/javascript"> alert("Are you sure you want to save your edit?")</script>';
        echo "<script>window.location.replace('/ezpapeterie/php/admin/mainpage.php')</script>";
   }else{
           echo "Error";
   }
?>