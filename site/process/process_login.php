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
            $connection->query('SELECT * FROM users WHERE email=:email');
            $connection->bind('email', $email);

            $rowCount = $connection->rowCount();
            if ( $rowCount == 1)
            {
                $result = $connection->oneResult();
                if ( password_verify($password, $result["password"]) )
                {
                    $_SESSION["handle"] = $result["handle"];
                    $_SESSION["university_id"] = $result["university_id"];
                    $_SESSION["notifications"] = $result["notification"];
                    $_SESSION["topUser"] = $result["isViewableInTop"];
                    $_SESSION["score"] = $result["score"];
                    $_SESSION["user_id"] = $result["user_id"];
                    $_SESSION["anonymous"] = $result["anonymous"];

                    alert_success("Login Successful");
                }
                else
                {
                    alert_danger("Invalid Email or Password");
                }
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
