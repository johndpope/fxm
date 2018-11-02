<?php function getClientCurrentDate()
{		
	$currentdate = date("Y-m-d H:i:s");

	if(isset($_COOKIE["mbTimeDelta"]))
	{	
		$hourDif = $_COOKIE["mbTimeDelta"];
		$currentdate = date("Y-m-d H:i:s");

		if($hourDif < 0) $currentdate = date('Y-m-d H:i:s', strtotime($currentdate)-$hourDif*3600);
		else $currentdate = date('Y-m-d H:i:s', strtotime($currentdate)+$hourDif*3600);

		//$currentdate = date('Y-m-d', strtotime($currentdate));	
	}
	else
	{
		$currentdate = date("Y-m-d H:i:s");
	}	
	//echo $currentdate."|";
	return $currentdate;		
}
function getClientCurrentDateNoTime()
{		


		$currentdate =getClientCurrentDate();
		$currentdate = date('Y-m-d', strtotime($currentdate));
		return $currentdate;		
}
function getTZCurrentDateTime()
{
	$currentdate = date("Y-m-d H:i:s");
	$currentdateX = $currentdate;
		//echo "<br/>getTZCurrentDateTime";
		//echo "<br/>currentdate : " . $currentdate;

	if(isset($_COOKIE["mbTimeDelta"]))
	{	
		$hourDif = $_COOKIE["mbTimeDelta"];
			//$hourDif = 10;
		$currentdate = date("Y-m-d H:i:s");
			//echo "<br/>cook : " . $_COOKIE["mbTimeDelta"];
			//echo "<br/>currentdate2 : " . $currentdate;
			//echo "<br/>hourDif : " . $hourDif;


			//if($hourDif < 0) $hourDifStr = ' - '.$hourDif.' hours';
			//else $hourDifStr = ' + '.$hourDif.' hours';

		if($hourDif < 0) $currentdateX = date('Y-m-d H:i:s', strtotime($currentdate)-$hourDif*3600);
		else $currentdateX = date('Y-m-d H:i:s', strtotime($currentdate)+$hourDif*3600);

			///echo "<br/>$currentdateX : " . $currentdateX;


			//$currentdateX = date('Y-m-d H:i:s', strtotime($currentdate . $hourDifStr));		
			//$currentdateX = date('Y-m-d H:i:s', strtotime($currentdate));		
			//FIREFOX
			//$currentdateX = strtotime($currentdate . $hourDifStr);		
			//$currentdate = date('Y-m-d', strtotime($currentdate . $hourDifStr));		
			//echo "<br/>currentdateX : " . $currentdateX;
			//echo "<br/>currentdate : " . $currentdate;
			//echo "<br/>";
	}	
	return $currentdateX;
}
function allowedToSubscribe($validSubscription)
{		
	if(($validSubscription['type'] == "6" || $validSubscription['type'] == "12"))
	{
		$difStr = ' + 1 month';
		$inaMonth = date('Y-m-d H:i:s', strtotime(getTZCurrentDateTime() . $difStr));

		if($validSubscription['expiration_date'] < $inaMonth)
		{
			return $validSubscription['expiration_date'];
		}
	}

	if($validSubscription['type'] == "X")
	{
		$difStr = ' + 2 months';
		$in2Month = date('Y-m-d H:i:s', strtotime(getTZCurrentDateTime() . $difStr));

		if($validSubscription['expiration_date'] < $in2Month)
		{
			return $validSubscription['expiration_date'];
		}
	}

	return null;
}
function isDrillAllowedToFree($drill)
{	
	$ret = false;
	switch($drill)
	{
		case "FM01A1":
		case "FM01B1":
		case "FM02A1":
		case "FM02B1":
			//case "FM02C1":
		$ret = true;
		break;
		default:
		$ret = false;
		break;

	}
	return $ret;
}
function trace($connectedAs, $txt)
{
	if($connectedAs == "romain.butez1@gmail.com"
		|| $connectedAs == "romain.butez@gmail.com"
		|| $connectedAs == "romain.butez2@gmail.com"
		|| $connectedAs == "romain.buteiz@gmail.com"
		) echo "<br/>".$txt;
}
//Déterminer le niveau de vitesse en fonction de la vitesse
function setLevelFromSpeed($speed)
{
	$level = "01";
	if($speed <= 49) $level = "01";
	if($speed >= 50  && $speed <  80) $level = "02";
	if($speed >= 80  && $speed < 120) $level = "03";
	if($speed >= 120 && $speed < 150) $level = "04";
	if($speed >= 150) $level = "05";
	return $level;

}
//Déterminer le niveau de fraicheur en fonction de la prochaine rep
function setLevelFromNextRepetition($prevint, $nextint)
{
	$old = "1";	
		//On prend la repetition précedente +1 semaine
	$diff = date('Y-m-d', strtotime($prevint. ' + 1 weeks'));	
		//Si la next rep est dans plus d'une semaine, niveau 2
	if($diff <= $nextint ) $old = "2";

		//On prend la repetition précedente +1 mois
	$diff = date('Y-m-d', strtotime($prevint. ' + 1 months'));
		//Si la next rep est dans plus d'un mois, niveau 3
	if($diff <= $nextint ) $old = "3";

		//On prend la repetition précedente +4 mois
	$diff = date('Y-m-d', strtotime($prevint. ' + 4 months')); 
		//Si la next rep est dans plus de 4 mois, niveau 4
	if($diff <= $nextint ) $old = "4";
	//return "4";
	return $old;
} ?>
