<?php
   
	header('Content-Type: application/json');
    ini_set( "display_errors", true );

	include 'config1.php';
	
	$email = $_POST['email'];
	
	$result = "select * from orders where email = :email";  
	$st2 = $con->prepare($result);
	$st2->bindvalue(":email",$email,PDO::PARAM_STR);
	$st2->execute();
	$json_response = array();
		
	echo '{"response":';
	$row_array=array();
	// fetch data in array format  
	  while ($row = $st2->fetch(PDO::FETCH_ASSOC))  {  
	// Fetch data of Fname Column and store in array of row_array 
	
		$row_array['order_id']=$row['order_id'];
		$row_array['p_names']=$row['p_names'];
		$row_array['cus_name']=$row['cus_name'];
		$row_array['contact_no']=$row['contact_no'];
		$row_array['address']=$row['address'];
		$row_array['country']=$row['country'];
		$row_array['details']=$row['details'];
		$row_array['zip_code']=$row['zip_code'];
		$row_array['time']=$row['time'];
		$row_array['quantity']=$row['quantity'];
		
		
		
		array_push($json_response,$row_array);  
	}  
	
	echo json_encode($json_response); 
	echo '}';
    $con = null;
?>