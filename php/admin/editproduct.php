<?php
   include_once("dbconnect.php");
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Edit Product Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="/ezpapeterie/js/validate.js"></script>
      <link rel="stylesheet" href="/ezpapeterie/css/style.css">
      <link rel="shortcut icon" type="image" href="/ezpapeterie/images/ezlogo.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   
   <body>
	  <!-- HEADER -->
      <div class="header">
         <h1>Edit Product Details</h1>
      </div>
	  <!-- NAVIGATION BAR -->
      <div class="navbar">
         <a href="/ezpapeterie/php/admin/mainpage.php" class="right">Cancel</a>
      </div>
	  <!-- EDITABLE DETAILS FOR PRODUCTS -->
      <div class="main">
         <div class="container">
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

            <form name="newForm" action="/ezpapeterie/php/admin/editproductprocess.php" onsubmit="return validateNewForm()" method="post" enctype="multipart/form-data">
               <!-- PRODUCT IMAGE -->
			   <div class="row" align="center">
                  <img class="imgselection" src="/ezpapeterie/images/<?php echo $row ['image'];?>"><br>
               </div>
			   <!-- PRODUCT NAME -->
               <div class="row">
                  <div class="col-25">
                     <i class="fa fa-pencil-square-o"></i>
                     <label for="prname">Product Name</label>
                  </div>
                  <div class="col-75">
					 <input type="text" id="idname" name="prname" placeholder="Please key in the product name" value="<?php echo $row['prname'];?>">
                  </div>
               </div>
			   <!-- PRODUCT TYPE -->
               <div class="row">
                  <div class="col-25">
                     <i class="fa fa-suitcase"></i>
                     <label for="prtype">Product Type</label>
                  </div>
                  <div class="col-75">
                     <select name="prtype" id="idtype" >
                        <option value="noselection">Please select the product type</option>
                        <option value="Stationery" <?php if($prtype == 'Stationery') echo "selected"; ?>>Stationery</option>
                        <option value="Book" <?php if($prtype == 'Book') echo "selected"; ?>>Book</option>
                        <option value="Accessories" <?php if($prtype == 'Accessories') echo "selected"; ?>>Accessories</option>
                    </select>
                  </div>
               </div>
			   <!-- PRODUCT PRICE -->
               <div class="row">
                  <div class="col-25">
                     <i class="fa fa-money icon"></i>
                     <label for="prprice">Product Price</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="idprice" name="prprice" placeholder="Please key in the product unit price(RM)" value="<?php echo $row['prprice'];?>">
                  </div>
               </div>
               <!-- PRODUCT QUANTITY -->
               <div class="row">
                  <div class="col-25">
                     <i class="fa fa-sort-numeric-asc icon"></i>
                     <label for="prqty">Product Quantity</label>
                  </div>
                  <div class="col-75">
                     <input type="number" id="idqty" name="prqty" placeholder="Please key in the product quantity" value="<?php echo $row['prqty'];?>" min="1" max="100">
                  </div>
               </div>
               <!-- HIDDEN- PRODUCT ID -->
               <input type="hidden" name="prid" value="<?php echo $row["prid"]; ?>"/><br>
               <!-- SAVE MY EDIT BUTTON -->
			   <div class="row">
                  <div>
					  <input type="submit" name="update" value="Save My Edit">
				  </div>
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

