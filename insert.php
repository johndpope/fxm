<?php
include("php/incl.php");	
include("php/drillTools.php");	

if(!$connected)
{
	header( 'Location: login.php' );
	die();
}

if(isset($_GET['characterBase']))
{
	$user->_character->setCharacter($_GET['characterBase']);
}
else
{
	if(isset($_GET['speed'])) $speed=$_GET['speed']; 
	else $speed="400";
	
	if(isset($_GET['code'])) $code=$_GET['code'];
	else $code="AAA";
	
	if(isset($_GET['note'])) $note=$_GET['note'];	
	else $note="2";	
	
	if(isset($_GET['next'])) $next=$_GET['next'];	
	else $next="1";
	
	$current_note=$note;	
	
	$previous_repetition = getClientCurrentDate();
	$daysDifStr2 = ' + '.$next.' days';
	$next_repetition = date('Y-m-d', strtotime($previous_repetition . $daysDifStr2));	


	if(isset($_GET['drillAchievementOut']) && isset($_GET['points']) && isset($_GET['pointsLvl']) && isset($_GET['levelAfter']) && isset($_GET['money']))
	{		
		$drillAchievementOut = $_GET['drillAchievementOut'];
		$points = $_GET['points'];
		$pointsLvl = $_GET['pointsLvl'];
		$levelAfter = $_GET['levelAfter'];
		$money = $_GET['money'];
		$result = $_GET['result'];

		$upd = $authenticate->giveAmarkAndUpdateDrillAchievement($uid, $code, $next_repetition,  $current_note, $previous_repetition, $speed, $drillAchievementOut, $result);
		$upd = $user->_character->updateCharacterXP($points, $pointsLvl, $levelAfter, $money);
		//$upd = $user->_character->updateDayXP($points, $pointsLvl, $levelAfter, $money);
	}

	if(isset($_GET['life']))
	{

		$life = $_GET['life'];
		$result = $_GET['result'];
		$invent = $user->_character->getInventory();
		$toDump = "";

		if($life <= 0) //Si perdu
		{
			//$life = 10;
			$money = 0;//money à 0

			$toDump = "0";
			//lose un objet au hasard
			$objectTab = explode("|", $invent);
			//var_dump($objectTab);

			$tabsize = count($objectTab);

			//echo $tabsize." ";
			//echo $invent." ";
			if(($invent != "" || $tabsize >= 2))
			{
			//echo $tabsize." ";
				$objectToDump = rand(1, $tabsize-1); 
			//echo $objectToDump." ";
				$toDump = $objectTab[$objectToDump];
				$invent = str_replace("|".$toDump,"", $invent);

			//echo $invent;

 			//rand(5, 15);
			}

		}

		$upd = $authenticate->giveAmark($uid, $code, $next_repetition,  $current_note, $previous_repetition, $speed, $result);
		//$upd = $authenticate->giveAmarkAndUpdateDrillAchievement($uid, $code, $next_repetition,  $current_note, $previous_repetition, $speed, $drillAchievementOut);

		$guitar = $user->_character->getGuitarBase(); 
		$amp = $user->_character->getAmp();
		$background = $user->_character->getBackground();
		
		if($toDump == $guitar) $guitar = "g00";
		if($toDump == $amp) $amp = "a00";
		if($toDump == $background) $background = "b00";

		$upd = $user->_character->updateCharacterLife($life, $invent, $guitar, $amp, $background);
		$upd["lost"] = $toDump;
		echo json_encode($upd);
		//
	}	
}





































if(isset($_GET['characterBase']))
{
	$user->_character->setCharacter($_GET['characterBase']);
}
else
{
	if(isset($_POST['speed'])) $speed=$_POST['speed']; 
	else $speed="400";
	
	if(isset($_POST['code'])) $code=$_POST['code'];
	else $code="AAA";
	
	if(isset($_POST['note'])) $note=$_POST['note'];	
	else $note="2";	
	
	if(isset($_POST['next'])) $next=$_POST['next'];	
	else $next="1";
	
	$current_note=$note;	
	
	$previous_repetition = getClientCurrentDate();
	$daysDifStr2 = ' + '.$next.' days';
	$next_repetition = date('Y-m-d', strtotime($previous_repetition . $daysDifStr2));	


	if(isset($_POST['drillAchievementOut']) && isset($_POST['points']) && isset($_POST['pointsLvl']) && isset($_POST['levelAfter']) && isset($_POST['money']))
	{		
		$drillAchievementOut = $_POST['drillAchievementOut'];
		$points = $_POST['points'];
		$pointsLvl = $_POST['pointsLvl'];
		$levelAfter = $_POST['levelAfter'];
		$money = $_POST['money'];
		$result = $_POST['result'];

		$upd = $authenticate->giveAmarkAndUpdateDrillAchievement($uid, $code, $next_repetition,  $current_note, $previous_repetition, $speed, $drillAchievementOut, $result);
		$upd = $user->_character->updateCharacterXP($points, $pointsLvl, $levelAfter, $money);
		//$upd = $user->_character->updateDayXP($points, $pointsLvl, $levelAfter, $money);
	}

	if(isset($_POST['life']))
	{

		$life = $_POST['life'];
		$result = $_POST['result'];
		$invent = $user->_character->getInventory();
		$toDump = "";

		if($life <= 0) //Si perdu
		{
			//$life = 10;
			$money = 0;//money à 0

			$toDump = "0";
			//lose un objet au hasard
			$objectTab = explode("|", $invent);
			//var_dump($objectTab);

			$tabsize = count($objectTab);

			//echo $tabsize." ";
			//echo $invent." ";
			if(($invent != "" || $tabsize >= 2))
			{
			//echo $tabsize." ";
				$objectToDump = rand(1, $tabsize-1); 
			//echo $objectToDump." ";
				$toDump = $objectTab[$objectToDump];
				$invent = str_replace("|".$toDump,"", $invent);

			//echo $invent;

 			//rand(5, 15);
			}

		}

		$upd = $authenticate->giveAmark($uid, $code, $next_repetition,  $current_note, $previous_repetition, $speed, $result);
		//$upd = $authenticate->giveAmarkAndUpdateDrillAchievement($uid, $code, $next_repetition,  $current_note, $previous_repetition, $speed, $drillAchievementOut);

		$guitar = $user->_character->getGuitarBase(); 
		$amp = $user->_character->getAmp();
		$background = $user->_character->getBackground();
		
		if($toDump == $guitar) $guitar = "g00";
		if($toDump == $amp) $amp = "a00";
		if($toDump == $background) $background = "b00";

		$upd = $user->_character->updateCharacterLife($life, $invent, $guitar, $amp, $background);
		$upd["lost"] = $toDump;
		echo json_encode($upd);
		//
	}

	/*
	else
	{
		$upd = $authenticate->giveAmark($uid, $code, $next_repetition,  $current_note, $previous_repetition, $speed);
	}
*/
}

?>


