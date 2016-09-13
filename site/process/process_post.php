<?php
    session_start();
    require_once("/usr/share/nginx/html/inc/inc.php");

    if(!empty($_POST))
    {
        $post = sanitize($_POST['user_post']);
        $time = date("Y-m-d H:i:s");
            
        if ( $post == "" ) {
            alert_danger("You can't post an empty post!");
            return;
        }
        if ( !empty($_POST)  && isset($_SESSION["handle"]) )
        {
                $connection = new PDOConnection();
                $connection->query('INSERT INTO posts (university_id, user_id, content, time, likes, dislikes, comments, FlagCount, Deleted) VALUES (:unid, :uid, :post, :time, 0, 0, 0, 0, 0)');
                $connection->bind('unid', $_SESSION["university_id"]);
                $connection->bind('uid', $_SESSION["user_id"]);
                $connection->bind('post', $post);
                $connection->bind('time', $time);
                $connection->execute();
                alert_success("Post Submitted!");
        } else {
            alert_danger("Something went wrong");
            return;
        }
    }
?>