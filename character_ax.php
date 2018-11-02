<?php
header('Content-Type: application/json');
include("php/incl.php");
include("php/drillTools.php");

$userCall;
if(isset($_POST['characterBase']) && 
	isset($_POST['guitarBase']) && 
	isset($_POST['name']) && 
	isset($_POST['hair']) && 
	isset($_POST['cup']) && 
	isset($_POST['cdo']) && 
	isset($_POST['ampBase']) && 
	isset($_POST['backgroundBase'])
	)
{
	$userCall = $user->_character->setBase($_POST['name'], $_POST['characterBase'], $_POST['guitarBase'], $_POST['backgroundBase'], $_POST['ampBase'], $_POST['hair'], $_POST['cup'], $_POST['cdo']);
}
else
{
	$userCall['error'] = true;
	$userCall['message'] = "Error";



	if(isset($_POST['id']) && 
		isset($_POST['price'])
		)
	{
		if (strpos($_POST['id'], '-') !== false)
		{

			$idObj = explode("-", $_POST['id'])[0];
		}
		else
		{
			$idObj = $_POST['id'];
		}

		$reste = intval($user->_character->getMoney()) - intval($_POST['price']);
		if($reste >= 0)
		{
			$userCall = $user->_character->buyObject($idObj, $reste);
			$userCall['id'] = $idObj;
			$userCall['reste'] = $reste;
			$userCall['message'] = $lang["bought"];
		}
		else
		{
			$userCall['error'] = true;			
			$userCall['message'] = $lang["notEnoughMoney"];
		}	
	}
	else
	{

		if(isset($_POST['potionPrice']))
		{
			$reste = intval($user->_character->getMoney()) - intval($_POST['potionPrice']);
			if($reste >= 0)
			{	
				
				$life                = intval($user->_character->getLife()) + 20;
				if($life >= 100) $life = 100;
				$userCall            = $user->_character->applyPotion($reste, $life);				
				$userCall['reste']   = $reste;
				$userCall['life']    = $life;
				$userCall['message'] = $lang["bought"];
			}
			else
			{
				$userCall['error'] = true;			
				$userCall['message'] = $lang["notEnoughMoney"];
			}
		}
		else
		{
			$userCall['error'] = true;
			$userCall['message'] = "Error, please try later";			
		}
	}
}

if(!$userCall['error'])
	echo json_encode($userCall);
else 
	echo json_encode($userCall);

?>