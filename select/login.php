<?php
   
	header('Access-Control-Allow-Methods: GET, POST, PUT');

	header('Content-Type: application/json');

     ini_set( "display_errors", true );

	include 'config.php';
  
      $email = $_POST['email'];
      $password1 = $_POST['password'];
     
	  
	  
    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
    $hashed = hash('sha256', $password1 . $salt);
   
    $result = "SELECT * FROM users where email = :email";
    $st = $con->prepare($result);
    $st->bindvalue(":email",$email,PDO::PARAM_STR);
    if($st->execute())
    {
        $row = $st->fetch();
        $check_password = hash('sha256', $password1.$row['salt']); 
        for($round = 0; $round < 65536; $round++) 
        { 
            $check_password = hash('sha256', $check_password.$row['salt']);
        }
      
        if($check_password == $row['password'])
        {
            
             $response=array(
				'message' =>'Login Successfull.','status'=>true); 
		
        }

        else
        {
             $response=array(
				'message' =>'Username and password not matched.','status'=>false); 
			
        }
    }
    else
    {
        $response=array(
			'message' =>'No registered emailid','status'=>false); 
		
    }
    echo json_encode($response);
    $con = null;
?>