<?php

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
