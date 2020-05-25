<?php

header('Content-Type: application/json');
    ini_set( "display_errors", true );

    include 'config.php';

    $id = $_POST['id'];
    $status = $_POST['status'];

	$sql3 = "Update user set status = '".$status."' where id = '".$id."'";
	$st3 = $con->prepare($sql3);

	if($st3->execute())
	{
		
		 $response=array(
				'message' =>'Updated','status'=>true); 
			
	}
	else
	{
		 $response=array(
				'message' =>'Failed to update.','status'=>false); 
			
	}
	echo json_encode($response);
	$con = null;

?>