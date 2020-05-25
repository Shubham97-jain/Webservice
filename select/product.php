<?php
   
	header('Content-Type: application/json');
    ini_set( "display_errors", true );

	include 'config1.php';
	
	$product_id = $_POST['product_id'];
	
	
	$result = "select * from products where product_id = :product_id";  
	$st2 = $con->prepare($result);
	$st2->bindvalue(":product_id",$product_id,PDO::PARAM_STR);
	$st2->execute();
	$json_response = array();
		
	echo '{"response":';
	$row_array=array();
	// fetch data in array format  
	  while ($row = $st2->fetch(PDO::FETCH_ASSOC))  {  
	// Fetch data of Fname Column and store in array of row_array 
	
		$row_array['product_name']=$row['product_name'];
		$row_array['details']=$row['details'];
		$row_array['image']=$row['image'];
		$row_array['product_type']=$row['product_type'];
		$row_array['price']=$row['price'];
		$row_array['c_price']=$row['c_price'];
		$row_array['brand']=$row['brand'];
		$row_array['tags']=$row['tags'];
		$row_array['time']=$row['time'];
		$row_array['id_item_category']=$row['id_item_category'];
		
		
		
		array_push($json_response,$row_array);  
	}  
	
	echo json_encode($json_response); 
	echo '}';
    $con = null;
?>