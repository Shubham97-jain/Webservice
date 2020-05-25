<?php


header('Content-Type: application/json');
ini_set( "display_errors", true );

include 'config.php';

$product_id = $_POST['product_id'];


$result = "select * from product  where  product_id = :product_id";  
$st2 = $con->prepare($result);
$st2->bindvalue(":product_id",$product_id,PDO::PARAM_STR);
$st2->execute();
$json_response = array();
    
echo '{"response":';
$row_array=array();
// fetch data in array format  
  while ($row = $st2->fetch(PDO::FETCH_ASSOC))  {  
// Fetch data of Fname Column and store in array of row_array 
    $row_array['sub_cat_id']=$row['sub_cat_id'];
    $row_array['product_image']=$row['product_image'];
    $row_array['product_name']=$row['product_name'];
    $row_array['price']=$row['price'];

    array_push($json_response,$row_array);  
}  

echo json_encode($json_response); 
echo '}';
$con = null;
?>