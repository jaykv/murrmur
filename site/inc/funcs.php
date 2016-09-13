<?php

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
            <div class="form-group text-right">
                <button type="button" class="form-control btn btn-primary" id="submit-post">Submit</button>
                <div id="count" style="display: table-cell; display: inline; margin: 0 15px: 0 0;"></div>
            </div>
        </form>
        <?php
    }
    
    function show_message($post, $time, $likes, $dislikes, $comments) {
?>
        <div class="panel panel-default">
            <div class="panel-heading">

                <?php
                    if ( ($likes - $dislikes) >= 0)
                    {
                        echo "<div class='left-panel positive'>";
                        echo "+ " . $likes - $dislikes;
                        
                    }
                    else
                    {
                        echo "<div class='left-panel negative'>";
                        echo "+ " . $likes - $dislikes;
                    }
                    echo "</div>"
                ?>			
                <div class="right-panel text-right">
                    <?php echo niceTime($time); ?>
                    <button type="submit">
                        <span title="Report" class="fa fa-flag fa-fw fa-lg" aria-hidden="true"></span>
                    </button>
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
                    <button type="submit">
                        <span title="Like" class="fa fa-angle-up fa-fw fa-2x" aria-hidden="true"></span>
                    </button>
                    <button type="submit">
                        <span title="Dislike" class="fa fa-angle-down fa-fw fa-2x" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
<?php
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
        
        if($difference != 1) {
            $periods[$j].= "s";
        }
        return "$difference $periods[$j] {$tense}";
    }
?>
