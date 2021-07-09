<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require '/home8/doubleks/public_html/PHPMailer/src/Exception.php';
	require '/home8/doubleks/public_html/PHPMailer/src/PHPMailer.php';
	require '/home8/doubleks/public_html/PHPMailer/src/SMTP.php';
	
    include_once("dbconnect.php");
    
	$name = $_POST["name"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$passa = $_POST["passworda"];
	$passb = $_POST["passwordb"];
	$shapass = sha1($passa);  
	$otp = rand(1000,9999);
	
    if (!(isset($name) || isset($email) || isset($phone) || isset($passa) || isset($passb))){
		echo "<script>alert('Please fill in all required information')</script>";
		echo "<script>window.location.replace('../php/user/register.php')</script>";
		}else{
        $sqlregister = "INSERT INTO tbl_user(email,phone,name,password,otp) VALUES('$email','$phone','$name','$shapass','$otp')";
        try{
            $conn->exec($sqlregister);
            echo "<script> alert('Registration successful. An email has been sent to your registered email. Please check your email for verification.')</script>";
            echo "<script> window.location.replace('../user/loginus.php')</script>";
           sendEmail($otp,$email);
       }catch(PDOException $e){
           echo "<script> alert('Registration Failed')</script>";
           echo "<script> window.location.replace('../html/register.html')</script>";
       }
    } 
    function sendEmail($otp,$email){
		$mail = new PHPMailer(true);
		$mail->SMTPDebug = 0;                                               //Disable verbose debug output
		$mail->isSMTP();                                                    //Send using SMTP
		$mail->Host       = 'mail.doubleksc.com';                          //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                           //Enable SMTP authentication
		$mail->Username   = 'ezpapeterie@doubleksc.com';                  //SMTP username
		$mail->Password   = '$NQOIh7.Vx~f';                                 //SMTP password
		$mail->SMTPSecure = 'tls';         
		$mail->Port       = 587;
		
		$from = "ezpapeterie@doubleksc.com";
		$to = $email;
		$subject = "Welcome to EZ Papeterie!";
		$message = "<p>Click the following link to verify your account!<br><br><a href='https://doubleksc.com/ezpapeterie/php/user/verify_account.php?email=".$email."&key=".$otp."'>Verify Account</a>";
		
		$mail->setFrom($from,"EZ Papeterie");
		$mail->addAddress($to);                                             //Add a recipient
		
		//Content
		$mail->isHTML(true);                                                //Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->send();
	}
?>
