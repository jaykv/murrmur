<?php
    session_start();
    require_once("/usr/share/nginx/html/inc/funcs.php");

    if(!empty($_POST) && isLoggedIn())
    {
        $post = sanitize($_POST['user_post']);
        if ( $post == "" ) {
            alert_danger("You can't post an empty post!");
            return;
        }
        //alert_success("Post Submitted!");
    } else {
        alert_danger("Something went wrong");
        return;
    }
?>