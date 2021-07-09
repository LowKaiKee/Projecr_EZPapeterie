<?php
   $email = $_GET["email"];
   $name = $_GET["name"];
   $phone = $_GET["phone"];
   $pickup = $_GET['pickup'];
   $remarks = $_GET['remarks'];
   $amount = $_GET['price'];
   

   $api_key = '3a65fdcb-d06a-4563-81da-a4bd619bc482';
   $collection_id = 'nbg7jke5';
   $host = 'https://billplz-staging.herokuapp.com/api/v3/bills';

   $data = array(
       'collection_id' => $collection_id,
       'email' => $email,
       'mobile' => $mobile,
       'name' => $name,
       'amount' => $amount * 100, // RM20
       'description' => 'Payment for order',
       'callback_url' => "http://doubleksc.com/ezpapeterie/php/user/mainpage.php",
       'redirect_url' => "http://doubleksc.com/ezpapeterie/php/user/payment.php?email=$email&name=$name&phone=$phone&remarks=$remarks&amount=$amount"
   );
   $process = curl_init($host);
   curl_setopt($process, CURLOPT_HEADER, 0);
   curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
   curl_setopt($process, CURLOPT_TIMEOUT, 30);
   curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data));

   $return = curl_exec($process);
   curl_close($process);

   $bill = json_decode($return, true);

   header("Location: {$bill['url']}");
?>