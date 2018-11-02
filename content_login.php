<?php	

$title = $lang['login'];

$connectionOK = false;

if(isset($_POST['user-email']) && isset($_POST['user-pw']))
{		
	$useremail = $_POST['user-email'];
	$userpw = $_POST['user-pw'];
	$remember = 0;

	if(isset($_POST['user-remember']) && $_POST['user-remember'] == 'yes') 
	{
		$remember = true;
	}

    
	if(isset($_COOKIE[$config->cookie_name]))
	{
		$logout = $authenticate->logout($_COOKIE[$config->cookie_name]);
	}
	

	$login = $authenticate->login($useremail , $userpw, $remember);	

	if(!$login['error'])
		$messInfo = $login['message'];
	else 
		$messErr = $login['message'];
/*
	if(!$login['error'])
	{
		setcookie($config->cookie_name, $login['hash'], $login['expire']);
		$connectionOK = true;
		header( 'Location: fxm.php?page=dashboard' );
		die();
	}*/
}

if(isset($_GET['id']))
{
	$authenticate = new Auth($dbh,$config,$lang);
	$idmail = htmlspecialchars($_GET['id']);

	$activate = $authenticate->activate($idmail);
	if(!$activate['error'])
		$messInfo = $activate['message'];
	else 
		$messErr = $activate['message'];	
}

?>

<?php if(true)//!$connectionOK)
{				
	?>

	<div class="content-container">
		<div class="block-container">
			<div class="unique-block">
				<div class="block-content">

					<form>
						<input  id="user-email" name="user-email" type="email" placeholder="<?php echo($lang['email']); ?>*">
						<input  id="user-pw" name="user-pw" type="password" placeholder="******">           
						<a href="forgotPass.php"><?php echo($lang['forgotmypassword']);?></a>			
						<input type="checkbox" id="user-remember" name="user-remember" value="yes"/>
						<label for="user-remember"><?php echo($lang['rememberMe']);?></label>		
						<button name="submit_login" id="submit_login" type="submit"><?php echo($lang['login']); ?></button>
					</form>
					<p><?php echo($lang['notYetMember']);?>&nbsp;<strong><a href="signup.php"><?php echo($lang['signupYou']);?></a></strong></p>
					<br/>

				</div>
			</div>
		</div>
	</div>



	<?php
}
?>
</p>


