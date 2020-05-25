<?php
	$servername = "localhost";
	$username = "avinform_ecommvista";
	$password = "admin";
	$dbname = "avinform_ecommvista";
	$con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(!$con)
	{

		echo "db not connected";
	}
	
?>