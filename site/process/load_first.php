<?php
    require_once('/usr/share/nginx/html/inc/inc.php');
    $connection = new PDOConnection();
    if (isLoggedIn())
    {
        $connection->query("SELECT * FROM posts WHERE university_id = :uni_id AND deleted=0 ORDER BY post_id DESC LIMIT 25");
        $connection->bind('uni_id', $_SESSION["university_id"]);
    } else {
        $connection->query('SELECT *, likes - dislikes AS score FROM posts WHERE deleted=0 ORDER by score DESC LIMIT 5');
    }

    $results = $connection->allResults();
    print_messages($results);
?>
