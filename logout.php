<?php	
	include("php/incl.php");
		
	if(isset($_COOKIE[$config->cookie_name]))
	{
		$logout = $authenticate->logout($_COOKIE[$config->cookie_name]);
		
		if(!$logout['error'])
		$messInfo = $logout['message'];
		else 
		$messErr = $logout['message'];
		
		if($logout)
		{
			header( 'Location: fxm.php?page=splash' );
			die();
		}		
	}	
?>
	
