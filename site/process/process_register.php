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
        alert_danger("Enter a valid Email");
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
                alert_danger("That account already exists!");
                return;
            }
            else
            {
                $connection->query('INSERT INTO users (handle, email, password, university_id, score, notification, isViewableInTop, anonymous) VALUES (:handle, :email, :password, :university, 1, 0, 1, 0)');
                $connection->bind('handle', $handle);
                $connection->bind('email', $email);
                $options = [
                    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
                ];
                $connection->bind('password', password_hash($password, PASSWORD_BCRYPT, $options));
                $connection->bind('university', $university);
                $connection->execute();
            }
    }

    echo "Handle        =".$handle."</br>";
    echo "Email		=".$email."</br>";
    echo "Password		=".$password."</br>";
    echo "Repeat pass   =".$repeatpass."</br>";

    alert_success("Registered successfully!");
}

?>
