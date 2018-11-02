<?php
include("php/incl.php");	
include("php/drillTools.php");	

if(!$connected)
{
	header( 'Location: login.php' );
	die();
}



if(isset($_POST['id']) && isset($_POST['wizard']))
{
	

	$upd = $authenticate->updateWizard($_POST['id'], $_POST['wizard']);

	return false;
}



?>


