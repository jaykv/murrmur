<?php

require_once("connection.php");
require_once("inc.php");

function postFromSubmitID($submitID) {
    $parts =  explode(';', $submitID);
    $post = new USERpost($parts[0], $parts[1], $parts[2], $parts[3], $parts[4], $parts[5], $parts[6], $parts[7], $parts[8]);
    return $post;
}

class USERpost
{
    private $uid;
    private $id;
    private $uni_id;
    private $content;
    private $likes;
    private $dislikes;
    private $comments;
    private $time;
    private $flags;
    private $maxFlags;

    public function USERpost($user_id, $post_id, $univ_id, $post, $post_likes, $post_dislikes, $post_comments, $post_time, $flag_count)
    {
        $this->uid = $user_id;
        $this->id = $post_id;
        $this->uni_id = $univ_id;
        $this->content = $post;
        $this->likes = $post_likes;
        $this->dislikes = $post_dislikes;
        $this->comments = $post_comments;
        $this->time = $post_time;
        $this->flags = $flag_count;
        $this->maxFlags = 9;
    }

    public function printVars() {
        echo $this->uid. " ; " . $this->id. " ; " . $this->uni_id. " ; " . $this->content. " ; " . $this->likes. " ; " . $this->dislikes. " ; " . $this->comments. " ; " . $this->time. " ; " . $this->flags;
    }

    public function deletePost()
    {
        $connection = new PDOConnection();
        $connection->query("UPDATE posts SET deleted=:deleted WHERE post_id=:post_id");
        $connection->bind("deleted", 1);
        $connection->bind("post_id", $this->id);
        $connection->execute();
    }

    public function flagPost()
    {
        $this->flags++;
        if ($this->flags > $this->maxFlags)
        {
            $this->deletePost();
        }
        $connection = new PDOConnection();
        $connection->query("UPDATE posts SET flagged=:flags WHERE post_id=:post_id");
        $connection->bind("flags", $this->flags);
        $connection->bind("post_id", $this->id);
        $connection->execute();
    }

    private function likesCheck() {
        $connection = new PDOConnection();
        $connection->query("SELECT `type` FROM `likes` WHERE `post_id`=:post_id AND `user_id`=:user_id LIMIT 1");
        $connection->bind("post_id", $this->id);
        $connection->bind("user_id", $this->uid);
        $results = $connection->allResults();

        if (count($results) == 1) {
            return $results[0]['type'];
        }

        return -1;
    }

    public function likePost() {
        // check if row exists for user and post
        $rowType = $this->likesCheck();
        if ($rowType == 1) {
            echo "already liked before";
            return;
        }
        $likesToAdd = 1;

        if ($rowType == 0) {
            $likesToAdd = 2;
            $q = "UPDATE likes SET type=1 WHERE university_id=:uni_id AND post_id=:post_id AND user_id=:user_id";
        }
        else
            $q = "INSERT INTO `likes`(`university_id`, `post_id`, `user_id`, `type`) VALUES (:uni_id, :post_id, :user_id, 1)";

        $connection = new PDOConnection();
        $connection->query("UPDATE posts SET likes = likes + :addLikes WHERE post_id=:post_id");
        $connection->bind("addLikes", $likesToAdd);
        $connection->bind("post_id", $this->id);
        $connection->execute();

        $connection->query($q);
        $connection->bind("uni_id", $this->uni_id);
        $connection->bind("post_id", $this->id);
        $connection->bind("user_id", $this->uid);
        $connection->execute();
    }

    public function dislikePost() {
        // check if row exists for user and post
        $rowType = $this->likesCheck();
        if ($rowType == 0) {
            echo "already disliked before";
            return;
        }
        $likesToRemove = 1;

        if ($rowType == 1) {
            $likesToRemove = 2;
            $q = "UPDATE likes SET type=0 WHERE university_id=:uni_id AND post_id=:post_id AND user_id=:user_id";
        }
        else
            $q = "INSERT INTO `likes`(`university_id`, `post_id`, `user_id`, `type`) VALUES (:uni_id, :post_id, :user_id, 0)";

        $connection = new PDOConnection();
        $connection->query("UPDATE posts SET likes = likes - :removeLikes WHERE post_id=:post_id");
        $connection->bind("removeLikes", $likesToRemove);
        $connection->bind("post_id", $this->id);

        $connection->execute();

        $connection->query($q);
        $connection->bind("uni_id", $this->uni_id);
        $connection->bind("post_id", $this->id);
        $connection->bind("user_id", $this->uid);
        $connection->execute();
    }

    public function calculateScore()
    {
        return $this->likes - $this->dislikes;
    }

    public function incrementComments()
    {
        $this->comments++;
        $this->updateComments();
    }

    public function decrementComments()
    {
        $this->comments--;
        $this->updateComments();
    }

    private function updateComments()
    {
        $connection = new PDOConnection();
        $connection->query("UPDATE posts SET comments=:post_comments WHERE post_id=:post_id");
        $connection->bind("post_comments", $this->comments);
        $connection->bind("post_id", $this->id);
    }

    private function updateLikes()
    {
        $connection = new PDOConnection();
        $connection->query("UPDATE posts SET likes=:post_likes, dislikes=:post_dislikes WHERE post_id=:post_id");
        $connection->bind("post_likes", $this->likes);
        $connection->bind("post_dislikes", $this->dislikes);
        $connection->bind("post_id", $this->id);
    }
}

?>
