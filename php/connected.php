<?php
include("business/User.php");
include("db/FxmDbAccessor.php");

function getIp()
{
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		return $_SERVER['REMOTE_ADDR'];
	}
}

if(getIp() == "127.0.0.1")
{
	$dbh = new PDO('mysql:host=localhost;dbname=musicianpnmb', 'musicianpnmb', 'Leserpent0');	
}
else
{
	$dbh = new PDO('mysql:host=musicianpnmb.mysql.db;dbname=musicianpnmb', 'musicianpnmb', 'Leserpent0');	
}
$config = new Config($dbh);
$authenticate = new Auth($dbh,$config,$lang);
setlocale (LC_TIME, 'fr_FR.utf8','fra');
$connected = false;	
$connectedAs = "";

if(isset($_COOKIE[$config->cookie_name]) && $authenticate->checkSession($_COOKIE[$config->cookie_name])) {	

	$uid = $authenticate->getSessionUID($_COOKIE[$config->cookie_name]);
	if(isset($uid))
	{
		$user = $authenticate->getUser($uid);
		//var_dump($user);
		if(isset($user))
		{
			$connected = true;
			$connectedAs = $user['email'];
			$date_signup = $user['date_signup'];

			$subscriptions = $authenticate->getSubscriptions($uid, $global_subscriptionName);

			$hasSubscribed = false;
			$validSubscription = $authenticate->validSubscription($subscriptions, $global_subscriptionName);
			if($validSubscription != null) $hasSubscribed = true;

			$getPrefs = $authenticate->getPrefs($uid);
			if(!$getPrefs)
			{
				$getPrefs['note']="sheet";
				$getPrefs['duration']="120";
				$getPrefs['nextDayTime']="0000";					
				$getPrefs['mobileMenu']= "right";
				if(isset($_COOKIE["datalang"])) $getPrefs['lng'] = $_COOKIE["datalang"];
				else $getPrefs['lng'] = "en";

				if($getPrefs['lng'] == "fr")
				{
					$getPrefs['system'] = "fr";
				}
				else
				{
					$getPrefs['system']= "en";
				}		
			}

			$user = new User($dbh, $uid, $user['email'], $user['date_signup'], $user['rs_brand'], $user['rs_name'], $user['wizard']);

			//Si le personnage n'existe pas encore
			$firstConnection = false;

			if(isset($_GET['page']) && ($_GET['page'] == "splash" || $_GET['page'] == "login" ))
			{
				header( 'Location: fxm.php?page=dashboard' );
				die();
			}
		}		
	}	
}	

if(!$connected)
{
	if(isset($_GET['page']) && ($_GET['page'] == "dashboard"))
	{
		header( 'Location: fxm.php?page=login' );
		die();
	}

	

}
else
{
	if(isset($_GET['page']) && (($_GET['page'] == "splash") || ($_GET['page'] == "login")))
	{
		header( 'Location: fxm.php?page=dashboard' );
		die();
	}

/*
	if(!isset($_GET['page']))
	{
		header( 'Location: fxm.php?page=dashboard' );
		die();
	}*/
}

?>






