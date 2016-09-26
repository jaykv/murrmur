<?php
    require_once('/usr/share/nginx/html/inc/inc.php');
    $last_msg_id = $_GET ['last_msg_id'];
    //echo "last msg: " . $last_msg_id;
    $connection = new PDOConnection();
    if (isLoggedIn()) {
        $connection->query("SELECT * FROM posts WHERE deleted=0 AND post_id < :last_msg_id AND university_id = :uni_id ORDER BY post_id DESC LIMIT 15");
        $connection->bind('last_msg_id', $last_msg_id);
        $connection->bind('uni_id', $_SESSION["university_id"]);
    } else {
        $connection->query('SELECT *, likes - dislikes AS score FROM posts WHERE deleted=0 AND post_id < :last_msg_id AND deleted=0 ORDER by score DESC LIMIT 5');
        $connection->bind('last_msg_id', $last_msg_id);
    }
    $last_msg_id = " ";
    $results = $connection->allResults();

    print_messages($results);
?>
