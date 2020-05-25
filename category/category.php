<?php

header('Content-Type: application/json');
ini_set( "display_errors", true );

include 'config.php';

// $cat_id = $_POST['cat_id'];


$result = "select * from category1 ";  
$st2 = $con->prepare($result);
// $st2->bindvalue(":cat_id",$cat_id,PDO::PARAM_STR);
$st2->execute();
$json_response = array();
    
echo '{"response":';
$row_array=array();
// fetch data in array format  
  while ($row = $st2->fetch(PDO::FETCH_ASSOC))  {  
// Fetch data of Fname Column and store in array of row_array 
     $row_array['cat_id']=$row['cat_id'];
    $row_array['cat_iimage']=$row['cat_iimg'];
    $row_array['cat_name']=$row['cat_name'];
    
    
    
    array_push($json_response,$row_array);  
}  

echo json_encode($json_response); 
echo '}';
$con = null;
?>





?>