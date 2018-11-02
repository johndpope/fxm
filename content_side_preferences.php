
<?php
if($authorizedConnection)
{
	?>
	<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
	<?php
}
?>

<script type="text/javascript">



	<?php
	if($authorizedConnection)
	{
		?>
	// Load the SDK asynchronously
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/fr_FR/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		<?php
	}
	?>



	var rsBrand = "<?php echo $user->getRsBrand(); ?>";

	function logout()
	{
	//if(rsBrand != "")
	if(true)
	{
		try{
			FBLogout();
			signOut();	
		}
		catch(err)
		{
			window.location = "logout.php?page=logout";
		}		
	}
	window.location = "logout.php?page=logout";

}


function signOut() {		
	var auth2 = gapi.auth2.getAuthInstance();
	auth2.disconnect().then(function () {
	});
}

function onSignIn(googleUser) {
	var profile = googleUser.getBasicProfile();
	var id_token = googleUser.getAuthResponse().id_token;
}


function onSuccess(googleUser) {
	return false;
}

function onFailure(error) {
	//console.log(error);	
	var errMsg = "<?php echo $lang['errorGoogleConnect']; ?>";
	$('body').notif({title:errMsg, cls:'error', timeout:5000})
}

function renderButton() {
	gapi.signin2.render('my-signin2', {
		'scope': 'profile email',
		'width': 270,
		'height': 40,
		'longtitle': true,
		'theme': 'dark',
		'font-size': '22px',
		'onsuccess': onSuccess,
		'onfailure': onFailure
	});
}





function FBLogout()
{
	FB.init({
		appId      : '239178436552928',
		cookie     : true,  
		xfbml      : true,  
		version    : 'v2.8' 
	});


	FB.getLoginStatus(function(response) {

		FB.logout();
  	//console.log("si");
  });



}


</script>

<div style="display:none;">
	<div id="my-signin2"><span class="buttonText">Google</span></div>
</div>
<div class="side-blocks">
	<div class="side-blocks-inner">
		<div class="side-block">
			<div class="block-content">
				<a href="fxm.php?page=account"><div id="MONCOMPTEClicker" class="menubar <?php if($prefpage=="account") echo "menubarSelected" ?>"><?php echo($lang['myaccount']); ?></div></a>									
				<a href="fxm.php?page=preferences"><div id="PREFSClicker" class="menubar <?php if($prefpage=="preferences") echo "menubarSelected" ?>"><?php echo($lang['preferences']); ?></div></a>		
				<a href="fxm.php?page=sub"><div id="MESSUBSClicker" class="menubar <?php if($prefpage=="sub") echo "menubarSelected" ?>"><?php echo($lang['mysubscriptions']); ?></div></a>	
				<?php
				if(!$hasSubscribed || (($hasSubscribed && allowedToSubscribe($validSubscription) != null)))
				{
					?>
					<a href="fxm.php?page=subscribe"><div id="SABONNERClicker" class="menubar <?php if($prefpage=="subscribe") echo "menubarSelected" ?>"><?php echo($lang['subscribe']); ?></div></a>

					<?php
				}
				?>


				<a onclick="logout();" href="#"><div id="LOGOUTClicker" class="menubar <?php if($prefpage=="logout") echo "menubarSelected" ?>"><?php echo($lang['logout']); ?></div></a>	
				<?php

				?>

			</div>
		</div>
	</div>
</div>

