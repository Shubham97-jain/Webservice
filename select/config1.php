<?php
	$servername = "localhost";
	$username = "avinform_ecommvista1";
	$password = "ecommvista1";
	$dbname = "avinform_ecommvista1";
	$con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if($con)
	{

		echo "hi";
	}



?>