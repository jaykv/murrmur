<?php
    function print_messages($results) {
        foreach ($results as &$result) {
            show_message( $result['post_id'], $result['user_id'], $result['handle'], $result['content'], $result['time'], $result['likes'], $result['dislikes'], $result['comments'], $result['flag_count'] );
        }
    }

    function alert_success($msg) {
    ?>
        <div id='alert_message' class='alert alert-success alert-dismissible fade in' data-dismiss="alert" role='alert'><button type='button' class=
                        'close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span></button>
                        <strong>Success!</strong> <?php echo $msg; ?></div>
    <?php
    }

    function alert_danger($msg) {
    ?>
        <div id='alert_message' class='alert alert-danger alert-dismissible fade in' data-dismiss="alert" role='alert'><button type='button' class=
                        'close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span></button>
                        <strong>Error!</strong> <?php echo $msg; ?></div>
    <?php
    }
    function show_post_box() {
        ?>
        <form class="user-post">
            <div id="post-message"></div>
            <div class="form-group">
                <textarea id="user_post" name="user_post" class="form-control" rows="3" placeholder="Share something..." maxlength="150"></textarea>
            </div>
            <div class="form-group">
                <label class="btn btn-primary btn-file" style="float: left;">
                    <i class="fa fa-camera"></i> <input type="file" accept="image/*" style="display: none;">
                </label>
                <div class="text-right">
                    <div id="count" style="display: table-cell; display: inline; margin-right: 5px;"></div>
                    <button type="button" class="btn btn-primary" id="submit-post">Submit</button>
                </div>
            </div>
        </form>
        <?php
    }

    function printScore($likes)
    {

        if ($likes >= 0)
        {
            echo "<div class='left-panel positive'>";
            echo "+ " . $likes;
        }
        else
        {
            echo "<div class='left-panel negative'>";
            echo "- " . ($likes * -1);
        }

        echo "</div>";
    }

    function show_message($pid, $uid, $handle, $post, $time, $likes, $dislikes, $comments, $flagcount) {
?>
        <div id="<?php echo $pid; ?>" class="message_box panel panel-default">
            <div class="panel-heading">
                <?php echo printScore($likes); ?>
                <div style="float: left; margin-left: 8px;">
                    <?php echo $handle; ?>
                </div>
                <div class="right-panel text-right">
                    <?php echo niceTime($time); ?>

                        <?php
                            if(isLoggedin())
                            {
                                $submitID = $uid . ";" . $pid . ";" . $_SESSION['university_id'] . ";" . $post . ";" . $likes . ";" . $dislikes . ";" . $comments . ";" . $time . ";" . $flagcount;
                                $encryptID = encryptText($submitID);

                                if ($uid == $_SESSION["user_id"])
                                {

                        ?>
                                    <a href="#deleteModal<?php echo $pid;?>" role="button" data-toggle="modal">
                                    <span title="Delete" class="fa fa-trash fa-fw fa-lg" aria-hidden="true"></span>
                                    </a>
                                        <div id="deleteModal<?php echo $pid;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div style="background-color:#f5f5f5;" class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                     <h4 style="text-align:left;"    id="myModalLabel">Delete Post?</h4>

                                                </div>
                                                <div class="modal-body">
                                                    <p style="word-wrap: break-word;" align="left"><?php echo $post; ?></p>
                                                </div>
                                                <div style="background-color:#f5f5f5;" class="modal-footer">
                                                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                                    <button id='<?php echo $pid; ?>' onClick='doAction("delete", this.id, "<?php echo $encryptID ?>")' class="btn btn-primary btn-danger   ">Delete</button>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                        <?php
                                }
                                else
                                {
                        ?>
                                <button type="submit" id="<?php echo $pid; ?>" onClick="doAction('report', this.id, '<?php echo $encryptID ?>')">
                                <span title="Report" class="fa fa-flag fa-fw fa-lg" aria-hidden="true"></span>
                                </button>
                        <?php
                                }
                            }
                        ?>

                </div>
            </div>
            <div class="panel-body" style="padding-bottom: 5px;">
                <div class="col-xs-9">
                    <div class="row content" style="padding-left: 15px; padding-bottom: 15px;" >
                        <?php echo $post; ?>
                    </div>
                    <div class="row content text-left" style="margin-left: none; font-size:10px;">
                        <span class="fa fa-comments" aria-hidden="true"></span> <a href="#"> <?php echo $comments; ?> comments</a>
                    </div>
                </div>
                <div class="col-xs-3 text-right">
                    <?php
                    if(isLoggedin()) { ?>

                        <div class="row content" style="padding-right: 15px; padding-right: 15px;" >
                            <button class="likeButton" type="submit" id="<?php echo $pid; ?>" onClick="doAction('like', this.id, '<?php echo $encryptID ?>')">
                                <span title="Like" class="fa fa-angle-up fa-fw fa-2x" aria-hidden="true"></span>
                            </button>
                            <button class="dislikeButton" type="submit" id="<?php echo $pid; ?>" onClick="doAction('dislike', this.id, '<?php echo $encryptID ?>')">
                                <span title="Dislike" class="fa fa-angle-down fa-fw fa-2x" aria-hidden="true"></span>
                            </button>
                        </div>
                    <?php
                    } else { ?>
                        <div class="row content" style="padding-right: 15px; padding-right: 15px;" >
                            <button type="submit" id="<?php echo $pid; ?>" onClick="doAction('register')">
                                <span title="Like" class="fa fa-angle-up fa-fw fa-2x" aria-hidden="true"></span>
                            </button>
                            <button type="submit" id="<?php echo $pid; ?>" onClick="doAction('register')">
                                <span title="Dislike" class="fa fa-angle-down fa-fw fa-2x" aria-hidden="true"></span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
    }

    function show_comment($post, $time, $likes, $dislikes)
    {
?>
       <div class="panel panel-default" style="margin-right: 14px;">
            <div class="panel-heading">
                <?php echo printScore($likes); ?>
                <div class="right-panel text-right">
                    <?php echo niceTime($time); ?>
                    <button type="submit">
                        <span title="Report" class="fa fa-flag fa-fw fa-lg" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
         <div class="panel-body">
            <div class="row">
                <div class="col-xs-9">
                    <div class="row content" style="padding-left: 15px; padding-bottom: 15px;" >
                        <?php echo $post; ?>
                    </div>
                </div>
                <div class="col-xs-3 text-right">
                    <button type="submit">
                        <span title="Like" class="fa fa-angle-up fa-fw fa-2x" aria-hidden="true"></span>
                    </button>
                    <button type="submit">
                        <span title="Dislike" class="fa fa-angle-down fa-fw fa-2x" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
         </div>
       </div>
<?php
    }

    function isLoggedIn() {
        return isset( $_SESSION['handle'] );
    }

    //Generate a unique code
    function getUniqueCode($length = "")
    {
        $code = md5(uniqid(rand(), true));
        if ($length != "") return substr($code, 0, $length);
        else return $code;
    }

    //Generate an activation key
    function generateActivationToken($gen = null)
    {
        do
        {
            $gen = md5(uniqid(mt_rand(), false));
        }
        while(validateActivationToken($gen));
        return $gen;
    }

    //@ Thanks to - http://phpsec.org
    function generateHash($plainText, $salt = null)
    {
        if ($salt === null)
        {
            $salt = substr(md5(uniqid(rand(), true)), 0, 25);
        }
        else
        {
            $salt = substr($salt, 0, 25);
        }

        return $salt . sha1($salt . $plainText);
    }

    //Checks if an email is valid
    function isValidEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }

    //Checks if a string is within a min and max length
    function minMaxRange($min, $max, $what)
    {
        if(strlen(trim($what)) < $min)
            return true;
        else if(strlen(trim($what)) > $max)
            return true;
        else
        return false;
    }

    //Completely sanitizes text
    function sanitize($str)
    {
        return strtolower(strip_tags(trim(($str))));
    }
//
    function getUniversityName($id)
    {
        $connection = new PDOConnection();
        $connection->query("SELECT * FROM universities WHERE university_id=:uni_id");
        $connection->bind("uni_id", $id);
        $result = $connection->oneResult();

        return $result["Name"];
    }

    function niceTime($date)
    {

        if(empty($date)) {
            return "No date provided";
        }

        $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths         = array("60","60","24","7","4.35","12","10");

        $now             = time();
        $unix_date         = strtotime($date);

           // check validity of date
        if(empty($unix_date)) {
            return "Bad date";
        }
        // is it future date or past date
        if($now > $unix_date) {
            $difference     = $now - $unix_date;
            $tense         = "ago";

        } else {
            $difference     = $unix_date - $now;
            $tense         = "from now";
        }

        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);
        if ($difference == 0) {
            return "Now";
        }
        if($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] {$tense}";
    }

    function encryptText($text) {
        $key = "bcb04b7e103a0cd8b54763051cef";
        $encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $text, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encoded;

    }

    function decryptText($encoded) {
        $key = "bcb04b7e103a0cd8b54763051cef";
        $decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encoded), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decoded;

    }
?>
