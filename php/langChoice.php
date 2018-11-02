<?php	


if(isset($getPrefs))
{
	if($getPrefs['lng'] == "fr" 
		|| $getPrefs['lng'] == "en" 
		)
	{
		$language = $getPrefs['lng'];		
	}		
}

//var_dump($language);
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


$authenticate->updateLang($lang);





?>	