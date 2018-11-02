<?php
header('Content-Type: application/json');
include("php/incl.php");
include("php/drillTools.php");


if(isset($_POST['diff']))
{
	setcookie("mbTimeDelta", $_POST['diff'], time() + 365*24*3600, null, null, false, true); 
}

?>