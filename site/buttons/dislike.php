<?php
    require_once('/usr/share/nginx/html/inc/post.php');
    require_once('/usr/share/nginx/html/inc/funcs.php');
    if(!isset($_POST['pid']) || empty($_POST['pid']))
        return;
    $encoded = $_POST['pid'];
    $submitID = decryptText($encoded);
    $post = postFromSubmitID($submitID);
    $post->dislikePost();
    echo "disliked";
?>
