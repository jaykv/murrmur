<?php
session_start();
require_once("/usr/share/nginx/html/inc/inc.php");

if(!empty($_POST))
{
	$university = sanitize($_POST['university']);
	$notifications = sanitize($_POST['notifs']);
	$topUser = sanitize($_POST['topuser']);
	$anonymous = sanitize($_POST['anon']);
	
    if ( !empty($_POST) )
	{
			$connection = new PDOConnection();
			$connection->query('UPDATE users SET university_id=:university, notification=:notifications, isViewableInTop=:topUser, anonymous=:anon WHERE user_id=:usr_id');
			$connection->bind('university', $university);
			$connection->bind('notifications', $notifications);
			$connection->bind('topUser', $topUser);
			$connection->bind('anon', $anonymous);
			$connection->bind('usr_id', $_SESSION["user_id"]);
			$connection->execute();
            
            $_SESSION["university_id"] = $university;
            $_SESSION["notifications"] = $notifications;
            $_SESSION["topUser"] = $topUser;
			$_SESSION["anonymous"] = $anonymous;
	
            alert_success("Profile Updated!");
	} else {
        alert_danger("Something went wrong!");
        return;
    }
}

?>