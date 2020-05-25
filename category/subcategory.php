<?php


header('Content-Type: application/json');
ini_set( "display_errors", true );

include 'config.php';

$sub_cat_id = $_POST['sub_cat_id'];


$result = "select * from sub_category  where  sub_cat_id = :sub_cat_id";  
$st2 = $con->prepare($result);
$st2->bindvalue(":sub_cat_id",$sub_cat_id,PDO::PARAM_STR);
$st2->execute();
$json_response = array();
    
echo '{"response":';
$row_array=array();
// fetch data in array format  
  while ($row = $st2->fetch(PDO::FETCH_ASSOC))  {  
// Fetch data of Fname Column and store in array of row_array 
    $row_array['cat_id']=$row['cat_id'];
    $row_array['sub_cat_img']=$row['sub_cat_img'];
    $row_array['sub_cat_name']=$row['sub_cat_name'];
    

    array_push($json_response,$row_array);  
}  

echo json_encode($json_response); 
echo '}';
$con = null;
?>

