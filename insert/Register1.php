<?php
	header('Content-Type: application/json');
    ini_set( "display_errors", true );
    include 'config.php';
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$status = "Active";
	
	date_default_timezone_set( "Asia/Kolkata" );  // http://www.php.net/manual/en/timezones.php
	$date = date('Y-m-d h:m:s');
	
    $sql = "SELECT email FROM users where email = :email";
	$st = $con->prepare($sql);
    $st->bindvalue(":email",$email,PDO::PARAM_STR);
	$st->execute();
    $row = $st->fetch();
    if($row['email'])
    {
		echo '{"response":[';
		$response=array(
			'message' =>'Email ID already registered'); 
		echo json_encode($response);echo '],"status":false}';
	}
	else
	{
		$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
		
		$newpass1 = hash('sha256', $password. $salt);
		for($round = 0; $round < 65536; $round++) 
		{ 
			$newpass1 = hash('sha256', $newpass1 . $salt); 
		}
		
		$sql1 = "INSERT INTO users (username,email,password,salt,DMLdate,status) VALUES(:name,:email,:password,:salt,:DMLdate,:status)";
		$st1 = $con->prepare($sql1);
		$st1->bindvalue(":name",$username,PDO::PARAM_STR);
		$st1->bindvalue(":email",$email,PDO::PARAM_STR);
		$st1->bindvalue(":password",$newpass1,PDO::PARAM_STR);
		$st1->bindvalue(":salt",$salt,PDO::PARAM_STR);
		$st1->bindvalue(":status",$status,PDO::PARAM_STR);
		$st1->bindvalue(":DMLdate",$date,PDO::PARAM_STR);
		if($st1->execute())
		{									
		   $user_arr=array(
		    "status" =>true,
		    "message" =>"registeration successful!");
		    print_r(json_encode($user_arr));
		  
		}
		else
		{
			echo '{"response":[';
			$response=array(
				'message' =>'Failed to register. Try again.'); 
			echo json_encode($response);echo '],"status":false}';
		}
	}  
	
	$con = null;
?>