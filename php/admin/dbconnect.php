<?php
	$servername = "localhost";
	$username = "doubleks_myshop262530admin";
	$password = "rPW7MD9LXxR8F5j";
	$dbname = "doubleks_myshop262530";
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
?>
