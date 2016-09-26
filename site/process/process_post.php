<?php
    session_start();
    require_once("/usr/share/nginx/html/inc/inc.php");
    if(!empty($_POST) && isLoggedIn())
    {
        $post = sanitize($_POST['user_post']);
        if ($post == "")
            return;
        $time = date("Y-m-d H:i:s");
        $connection = new PDOConnection();
        $connection->query('INSERT INTO posts (university_id, user_id, content, handle, time, likes, dislikes, comments, flag_count, Deleted) VALUES (:unid, :uid, :post, :handle, :time, 0, 0, 0, 0, 0)');
        $connection->bind('unid', $_SESSION["university_id"]);
        $connection->bind('uid', $_SESSION["user_id"]);
        $connection->bind('handle', $_SESSION["handle"]);
        $connection->bind('post', $post);
        $connection->bind('time', $time);
        $connection->execute();
        $pid = $connection->lastInsertId();

        show_message($pid, $_SESSION["user_id"], $_SESSION["handle"], $post, $time, 0, 0, 0, 0);
    }
?>
