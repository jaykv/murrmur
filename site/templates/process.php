<?php

require_once("/usr/share/nginx/html/inc/inc.php");

if(!empty($_POST))
{
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    if ( !isValidEmail($email) || $email == "" ) {
        echo "<div class='alert alert-danger'><strong>Error!</strong> Enter a valid Email</div>";
        //echo "<center><h4><span class='label label-primary' >Enter a valid email address!</span><h4></center>";
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
                session_start();
				$_SESSION["handle"] = $result["handle"];
				$_SESSION["university_id"] = $result["university_id"];
				$_SESSION["score"] = $result["score"];
				$_SESSION["user_id"] = $result["user_id"];
				
                echo "<div class='alert alert-success'><strong>Success!</strong> Login Successful..</div>";
                $secondsWait = 1;
                echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
			}
            else
			{
                echo "<div class='alert alert-danger'><strong>Error!</strong> Invalid Email or Password</div>";
			}
	}
    if (isset($_POST['rememberme'])){
        echo "Remember me = 1</br>"; 
    }
    
    
}
?>