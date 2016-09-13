
<?php
    session_start();
    require_once('/usr/share/nginx/html/inc/inc.php');
    $connection = new PDOConnection();

    if (isset($_SESSION["handle"]))
    {
        $connection->query('SELECT * FROM posts WHERE university_id = :uni_id AND deleted=0 ORDER by time DESC LIMIT 15');
        $connection->bind('uni_id', $_SESSION["university_id"]);
    }
    else
    {
        $connection->query('SELECT *, likes - dislikes AS score FROM posts WHERE deleted=0 ORDER by score DESC LIMIT 5');
    }
    
    $results = $connection->allResults();
    
    foreach ($results as &$result)
    {
        show_message( $result['content'], $result['time'], $result['likes'], $result['dislikes'], $result['comments'] );
    }
?>