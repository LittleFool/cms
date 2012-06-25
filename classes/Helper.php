<?php

class Helper {

    /**
     * Gives the filename of the current open website
     *
     * @access	public
     * @return	string
     */
    public static function content() {
	if (isset($_GET['site']) && $_GET['site'] != '') {
	    if (Helper::isValidSite($_GET['site'], false)) {
		return Helper::isValidSite($_GET['site'], true);
	    } else {
		return '';
	    }
	} elseif (!isset($_GET['site']) || $_GET['site'] == '') {
	    return Helper::isValidSite('prolog', true);
	}
    }

    public static function removeSpecialChars($string) {
	$res = htmlentities($string);
	$res = str_replace("&lt;", "<", $res);
	$res = str_replace("&gt;", ">", $res);
	$res = str_replace("&quot;", '"', $res);
	$res = str_replace("&amp;", '&', $res);
	return $res;
    }

    public static function generatePassword($length = 8) {
	// start with a blank password
	$password = "";

	// define possible characters
	$possible = "0123456789abcdefghijklmnopqrstuvwxyz";

	// set up a counter
	$i = 0;

	// add random characters to $password until $length is reached
	while ($i < $length) {
	    // pick a random character from the possible ones
	    $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);

	    // we don't want this character if it's already in the password
	    if (!strstr($password, $char)) {
		$password .= $char;
		$i++;
	    }
	}

	// done!
	return $password;
    }

    public static function isLoggedin() {
	if (isset($_SESSION['login']) && $_SESSION['login'] === true)
	    return true;
	else
	    return false;
    }

    public static function isValidEmail($adress) {
	list($userName, $mailDomain) = split("@", $adress);
	if (checkdnsrr($mailDomain, "MX"))
	    return true;
	else
	    return false;
    }
    
    public static function isValidSite($get, $return = false) {
	$site = array();
	$site['home'] = 'home.php';

	if (!$return)
	    return array_key_exists($get, $site);
	else
	    return $site[$get];
    }
    
    public static function naviDown($name) {
	if ((!isset($_GET['site']) || $_GET['site'] == '') && $name == 'prolog')
	    echo $name . '_down';
	elseif (isset($_GET['site']) && $_GET['site'] == $name)
	    echo $name . '_down';
	elseif (isset($_GET['site']) && $_GET['site'] == 'faecher') {
	    if (isset($_GET['fach']) && $_GET['fach'] == $name)
		echo $name . '_down';
	    else
		echo $name;
	}
	else
	    echo $name;
    }

    public static function readFile($folder, $file) {
	$path = $folder . $file;

	if ($fp = @fopen($path, "r")) {
	    // Den Inhalt des Templates einlesen
	    $content = fread($fp, filesize($path));
	    fclose($fp);
	    return $content;
	} else {
	    return '';
	}
    }
}
?>