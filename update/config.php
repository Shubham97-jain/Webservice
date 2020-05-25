<?php
	$servername = "localhost";
	$username = "avinform_vistaprint";
	$password = "root";
	$dbname = "avinform_vistaprint";
	$con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(!$con){
        echo "not";
    }
?>