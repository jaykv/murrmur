<?php

    require_once('inc/inc.php');
    require_once('inc/auth.php');
    
    $date = date("Y-m-d H:i:s");
    $content = "text here";
    
    $connection = new PDOConnection();
    $connection->prepare('INSERT INTO posts(university_id, user_id, content, time, likes, dislikes, comments, FlagCount, Deleted) VALUES(?,?,?,?,?,?,?,?)');
    $connection->execute( array( 21, 5, $content, $date, 0, 0, 0, 0, 0 ) );
?>