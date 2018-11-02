<?php
header('Content-Type: application/json');
include("php/incl.php");
if(isset($_POST['uid'])){$uid_user=$_POST['uid'];}  
$getMyDayDrills = $authenticate->getMyDayDrills($uid);	
echo json_encode($getMyDayDrills);
/*
if(!$getMyDayDrills['error'])
	//$messInfo = $login['message'];
	
else 
	//$messErr = $login['message'];
	echo json_encode($getMyDayDrills);
	?>
	*/