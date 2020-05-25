<?php
 include "config.php";
$num_files = count($_FILES['path']['name']);

for( $i=0; $i < $num_files; $i++ )
{
    $name = $_FILES["path"]["name"][$i];
    $temp_path = $_FILES['path']['tmp_name'][$i];
    $image_name = $i.'_demoimage_'.$name;


    // Set the upload folder path
    $target_path = 'www.avinformationtechnology.com/Android/vistaprint/uploads';

    
   
    $image_upload_path = $target_path.$image_name;
    if(move_uploaded_file($temp_path, $image_upload_path))
    {
        $sql1 = "INSERT INTO image (path) VALUES (:path)";
        
        $st1 = $con->prepare($sql1);
        $st1->bindvalue(":path",$image_upload_path,PDO::PARAM_STR);
        $st1->execute();
        $result = array("success" => $image_upload_path);

    echo json_encode($result, JSON_PRETTY_PRINT);
    echo ",";
        
    }
    else
    {
        echo 'failed';
    } 
}