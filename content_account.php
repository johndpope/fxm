<?php
include("php/drillTools.php"); 
?>
<?php
if(!$connected){
	header( 'Location: fxm.php?page=login' );
	die();
}
if(isset($_POST['submitChgPass']) && isset($_POST['user-pw']) && isset($_POST['user-pw-new']) && isset($_POST['user-pw-repeat']))
{
	if(isset($uid))
	{		
		$userpw       = $_POST['user-pw'];
		$userpwnew    = $_POST['user-pw-new'];
		$userpwrepeat = $_POST['user-pw-repeat'];
		$changePass   = $authenticate->changePassword($uid,$userpw,$userpwnew,$userpwrepeat);
		if(!$changePass['error'])
			$messInfo = $changePass['message'];
		else 
			$messErr = $changePass['message'];		
	}
}	
if(isset($_POST['submitChgMail']) && isset($_POST['user-email']) && isset($_POST['user-pw']))
{
	if(isset($uid))
	{
		$userpw   = $_POST['user-pw'];
		$usermail = $_POST['user-email'];
		$changeMail = $authenticate->changeEmail($uid,$usermail,$userpw);	
		if(!$changeMail['error'])
		{
			$messInfo = $changeMail['message'];
			$connectedAs=$usermail;
		}
		else 
			$messErr = $changeMail['message'];
	}
}	
?>
<script type="text/javascript">		
	window.onload = function(){ <?php
		if($messErr != "") 
			{ ?>
				$('body').notif({title:'<?php echo $messErr; ?>', cls:'error', timeout:5000});
				<?php
			} ?>
			<?php if($messInfo != "") { ?>
				$('body').notif({title:'<?php echo $messInfo; ?>', cls:'success', timeout:5000});
								<?php } ?>
			}
			function toggle_visibility(id) {
				var e = document.getElementById(id);
				if(e.style.display == 'block')
				{
					e.style.display = 'none';
				}
				else
				{
					e.style.display = 'block';
				}
			}
		</script>
		<div class="content-container">
			<div class="block-container">
				<div class="main-block">
					<div class="block-content">
						<?php
						$prefpage = "account";
						include("content_menu_preferences.php"); 
						?>
						<div id="MONCOMPTE" class="accountSection">		
							<div class="circleContainer">
								<div class="circleBlue"></div>
								<img alt="<?php echo($lang['infos']);?>" src="images/person.svg" class="circleImg" />
							</div>
							<h3><?php echo($lang['infos']);?></h3>
							<p></p>
							<?php echo($lang['emailAdress']); ?> : <?php echo($connectedAs); /*var_dump($user);*/?> 
							<!--<span onclick="toggle_visibility('changeemailSection');" class="blue-text hand">(<?php echo($lang['modify']); ?>)</span>-->
							<section id="changeemailSection" style="display:none;">
								<p></p>
								<header>
									<h2 class=""><?php echo($lang['changeemail']); ?></h2>
								</header>
								<form action="fxm.php?page=account"  method="post">
									<div class="form-group">
										<div class="">
											<div class=""></div>
											<input  id="user-email" name="user-email" type="text" class="" placeholder="<?php echo($lang['newemail']); ?> *">
										</div>
									</div>
									<div class="">
										<div class="">
											<div class=""><i class=""></i></div>
											<input  id="user-pw" name="user-pw" type="password" class="" placeholder="Mot de passe">           
										</div>
									</div>
									<button name="submitChgMail" type="submit" class=""><?php echo($lang['changeemail']); ?></button>
								</form>
							</section>
							<hr/>

							<?php
							if($user->getRsBrand() == "")
							{
								?>
							<?php echo($lang['password']); ?> : *****  <span onclick="toggle_visibility('changepasswordSection');" class="greenButton"><?php echo($lang['modify']); ?></span>
							<section class="yellowUnit" id="changepasswordSection" style="display:none;">
								<h4 class=""><?php echo($lang['changepassword']); ?></h4>
								<p>
									<form action="fxm.php?page=account" method="post">
										<div class="">
											<div class="">
												<div class=""></div>
												<input  id="user-pw" name="user-pw" type="password" class="" placeholder="<?php echo($lang['currentpassword']); ?> *">           
											</div>
										</div>
										<div class="">
											<div class="">
												<div class=""></div>
												<input  id="user-pw-new" name="user-pw-new" type="password" class="" placeholder="<?php echo($lang['newpassword']); ?> *">           
											</div>
										</div>
										<div class="">
											<div class="">
												<div class=""></div>
												<input  id="user-pw-repeat" name="user-pw-repeat" type="password" class="" placeholder="<?php echo($lang['repeatpassword']); ?> *">           
											</div>
										</div>
										<button name="submitChgPass" type="submit" class="greenButton"><?php echo($lang['changepassword']); ?></button>
									</form>	
								</p>
							</section>
							<hr/>

							<?php
						}
						?>

							<?php
							setlocale(LC_ALL, $language);
							echo sprintf($lang['memberSince'], strftime("%x", strtotime($date_signup)));
							/* Output: vrijdag 22 december 1978 */
							echo(strftime("%x", strtotime($date_signup)));
							?>
							<hr/>
							<?php echo($lang['subscriptionType']); ?> : <?php 
							if($hasSubscribed) 
							{
								echo($lang['premium']); ?> <?php echo($lang['until']); ?>
								<?php echo(strftime("%x", strtotime($subscriptions[0]['expiration_date'])));
							}
							else {echo($lang['free']); ?> <?php } ?>
						</div>
						<div id="MESSUBS" class="accountSection isInvisible">
							dsfdsfdsf
						</div>
						<div id="SABONNER" class="accountSection isInvisible">
							vcbvcbvcbvc
						</div>
					</div>
				</div>
				<?php 
				include("content_side_preferences.php"); 
				?>
			</div>
		</div>
	</div>
</div>