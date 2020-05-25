<?php

    header('Content-Type: application/json');
    ini_set( "display_errors", true );
    
    include 'config.php';
    
    $email = $_POST['email'];
	$status = "Active";
    
    $sql = "SELECT email FROM users where email = :email and status = :status";
	$st = $con->prepare($sql);
    $st->bindvalue(":email",$email,PDO::PARAM_STR);
    $st->bindvalue(":status",$status,PDO::PARAM_STR);
	$st->execute();
    $row = $st->fetch();
     
    if($row['email'])
    {
        
        $result = "select * from users where email = :email";
        $st = $con->prepare($result);
        $st->bindvalue(":email",$email,PDO::PARAM_STR);
        $st->execute();
    	$row4 = $st->fetch();
    				
	
        $newpass = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $newpass1 = hash('sha256', $newpass. $salt);
            
    
        for($round = 0; $round < 65536; $round++) 
        { 
            $newpass1 = hash('sha256', $newpass1 . $salt); 
        }
    	
    	$sql1 = "update users set salt=:salt ,password = :password where email= :email";
        $st = $con->prepare($sql1);
        $st->bindvalue(":salt",$salt,PDO::PARAM_STR);
        $st->bindvalue(":password",$newpass1,PDO::PARAM_STR);
        $st->bindvalue(":email",$email,PDO::PARAM_STR);
       
        if($st->execute())
        {
            $to = $email;
            $subject = "Password Reset";
        
            $htmlContent = '
                <html>
                <head>
                    <title>Welcome to Car Pooling.</title>
                </head>
                <body>
                    <h1>Thank you for joining with us!</h1>
                    <h3>We had reset your password. Please find below details to get your new password.</h3>
                    <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">
                        
                        <tr style="background-color: #e0e0e0;">
                            <th>Email:</th><td>'.$email.'</td>
                        </tr>
                        <tr>
                            <th>Password:</th><td>'.$newpass.'</td>
                        </tr>
                    </table>
                </body>
                </html>';
            
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // Additional headers
            $headers .= 'From: shubhampitliya36@gmail.com' . "\r\n";
            $headers .= '' . "\r\n";
            $headers .= '' . "\r\n";
            
            // Send email
            if(mail($to,$subject,$htmlContent,$headers)):
                $successMsg = 'Email has sent successfully.';
            else:
                $errorMsg = 'Email sending fail.';
            endif;
            
           $user_arr=array(
		    "status" =>true,
		    "message" =>"registeration successful!");
		    print_r(json_encode($user_arr));
        }
	}
	else
	{
	    echo '{"response":[';
		$response=array(
			'message' =>'No registered email / you are deactivated'); 
		echo json_encode($response);echo '],"status":false}';
	}
	$con = null;
?>