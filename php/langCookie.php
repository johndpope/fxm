<?php	

if(isset($_POST['lang']))
{
	setcookie("datalang", $_POST['lang'], time() + 365*24*3600, null, null, false, true); 
	$language = $_POST['lang'];
}
else
{
	if(isset($_COOKIE["datalang"]))
	{
		$language = $_COOKIE["datalang"];
			//	echo $language;
			//$language = "en";	
	}
	else
	{
		if (!isset($language)) {
			$language = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
			$language = strtolower(substr(chop($language[0]),0,2));
			//$language = "en";	
			setcookie("datalang", $language, time() + 365*24*3600, null, null, false, true); 
		}
	}
}

switch ($language) {
	case "en":
	include("auth/PHPAuth-master/languages/en.php");
	break;
	case "fr":
	include("auth/PHPAuth-master/languages/fr.php");
	break;
	default:
	include("auth/PHPAuth-master/languages/en.php");
	break;
}


?>