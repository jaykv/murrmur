<?php
require_once("/usr/share/nginx/html/inc/inc.php");

if(!empty($_POST)) 
{
    $handle = sanitize($_POST['handle']);
    $repeatpass = sanitize($_POST['repeatpass']);
    $university = sanitize($_POST['university']);
    $password = sanitize($_POST['password']);
    $email = sanitize($_POST['email']);
    
    if (!isValidEmail($email) || $email == "" ) {
        echo "<center><h4><span class='label label-primary' >Enter a valid email address!</span><h4></center>";
        return;
    }
	else
	{
			$connection = new PDOConnection();
			$connection->query('SELECT * FROM users WHERE email=:email OR handle=:handle');
			$connection->bind('email', $email);
			$connection->bind('handle', $handle);
            
            $rowCount = $connection->rowCount();
            if ( $rowCount == 1)
			{
                echo "That account already exists!</br>";
				return;
			}
            else
			{
				$connection->query('INSERT INTO users (handle, email, password, university_id, score, notification, isViewableInTop) VALUES (:handle, :email, :password, :university, 1, 0, 1)');
				$connection->bind('handle', $handle);
				$connection->bind('email', $email);
				$connection->bind('password', $password);
				$connection->bind('university', $university);
				$connection->execute();
				
				// need to check to make sure it executed here
				echo "inserted into database";
			}
	}

    echo "Handle        =".$handle."</br>";
    echo "Email		=".$email."</br>"; 
    echo "Password		=".$password."</br>"; 
    echo "Repeat pass   =".$repeatpass."</br>";
    
    echo "<span class='label label-info' >Successful Login</span>";
}

?>