<?php
header('Content-Type: application/json');
include("php/incl.php");
include("php/drillTools.php");


if(isset($_POST['dateNow']))
{
//echo $_POST['dateNow'];
	//$dateServer = new DateTime()->getTimestamp();
//echo $dateServer;

	$dateServer = new DateTime();
	$dateLocal = new DateTime();
	
//setlocale(LC_ALL, "fr");	
	$expire_time = substr($_POST['dateNow'], 0, strpos($_POST['dateNow'], '('));

//echo date('Y-m-d h:i:s', strtotime($expire_time));  echo gmdate('d.m.Y H:i', strtotime('2012-06-28 23:55'));
$given = new DateTime();
echo $given->format("Y-m-d H:i:s") . "\n"; // 2014-12-12 14:18:00 Asia/Bangkok

$given->setTimezone(new DateTimeZone("UTC"));
echo $given->format("Y-m-d H:i:s") . "\n"; // 2014-12-12 07:18:00 UTC

}



$userCall;
if(isset($_POST['uid']))
{//echo json_encode($_POST['characterBase']);
$userCall = $user->getSrsDrill();
$userCall['error'] = false;
}
else
{
	$userCall['error'] = true;
	$userCall['message'] = "plantage";
}
//var_dump($userCall);
echo json_encode($userCall);
/*
if(!$userCall['error'])
	//$messInfo = $login['message'];
	
else 
	//$messErr = $login['message'];
	echo json_encode($userCall);
*/
	?>