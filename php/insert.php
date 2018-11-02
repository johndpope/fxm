<?php
	include("php/incl.php");	
	include("php/drillTools.php");	
	
	if(!$connected)
	{
		header( 'Location: login.php' );
		die();
	}
		
	if(isset($_GET['speed'])) $speed=$_GET['speed']; 
	else $speed="400";
	
	if(isset($_GET['code'])) $code=$_GET['code'];
	else $code="AAA";
	
	if(isset($_GET['note'])) $note=$_GET['note'];	
	else $note="2";	
	
	if(isset($_GET['next'])) $next=$_GET['next'];	
	else $next="1";
	
	$current_note=$note;	
	//$next_repetition=date("Y-m-d", strtotime($next." days"));
	
	$previous_repetition = getTZCurrentDate(); echo $previous_repetition;
	$daysDifStr2 = ' + '.$next.' days';
	$next_repetition = date('Y-m-d', strtotime($previous_repetition . $daysDifStr2));	
	
	//$previous_repetition=date("Y-m-d");
	
	/*
	if(isset($_COOKIE["mbTimeDelta"]))
	{	
		$hourDif = $_COOKIE["mbTimeDelta"];
		if($hourDif < 0) $hourDifStr = ' - '.$hourDif.' hours';
		else $hourDifStr = ' + '.$hourDif.' hours';
		
		$next_repetition = date('Y-m-d', strtotime($next_repetition . $hourDifStr));		
		$previous_repetition = date('Y-m-d', strtotime($previous_repetition . $hourDifStr));		
	}
	*/
	
	//$next_repetition = adjustTimeZone($next_repetition);
	//$previous_repetition = adjustTimeZone($previous_repetition);
	
	$upd = $authenticate->giveAmark($uid, $code, $next_repetition,  $current_note, $previous_repetition, $speed);
	
	
	
?>


