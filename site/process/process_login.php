<?php
session_start();
require_once("/usr/share/nginx/html/inc/inc.php");


if(!empty($_POST))
{
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    if ( !isValidEmail($email) || $email == "" ) {
        alert_danger("Enter a valid Email");
        return;
    }
	else
	{
			$connection = new PDOConnection();
			$connection->query('SELECT * FROM users WHERE email=:email AND password=:password');
			$connection->bind('email', $email);
            $connection->bind('password', $password);
            
            $rowCount = $connection->rowCount();
            if ( $rowCount == 1)
			{
				$result = $connection->oneResult();
				$_SESSION["handle"] = $result["handle"];
				$_SESSION["university_id"] = $result["university_id"];
				$_SESSION["notifications"] = $result["notification"];
				$_SESSION["topUser"] = $result["isViewableInTop"];
				$_SESSION["score"] = $result["score"];
				$_SESSION["user_id"] = $result["user_id"];
				
               alert_success("Login Successful");
			}
            else
			{
                alert_danger("Invalid Email or Password");
			}
	}
    if (isset($_POST['rememberme'])){
        echo "Remember me = 1</br>"; 
    }
    
    
}
?>