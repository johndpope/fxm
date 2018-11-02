<header class="<?php if($connected){echo "header";}else{echo "headerSplash";} ?>">
	<a href="#" class="header__icon" id="header__icon"></a>
	<div class="header-container">
		<?php if($connected){ ?>
			<?php } ?>
			<a href="<?php if($connected){echo "fxm.php?page=dashboard";}else{echo "fxm.php?page=login";} ?>" class="header__logo">
				<span class="qwiTitle">F</span><span class="boyTitle">X</span><span class="bebTitle">M</span>			
			</a>
			<nav class="menu">			
				<?php
				if($connected)
				{
					?>
					<a id="menu-Home" href="fxm.php?page=dashboard"><img alt="Accueil" src="images/home.svg" class="logout-img" />
						<div class="circleNotifNumber isInvisible">						  
							<div class="notifNumber"></div>
						</div>
					</a> 
					<a id="menu-Home" href="fxm.php?page=cm"><img alt="<?php echo($lang['preferences']); ?>" src="images/person.svg" class="logout-img" /></a>
					<?php 
					if($hasSubscribed)
					{ 
						?>
						<a id="menu-Home" href="fxm.php?page=account"><img alt="<?php echo($lang['preferences']); ?>" src="images/settings.svg" class="logout-img" /></a> 
						<?php
					}
					else
					{
						?>
						<a id="menu-Home" href="fxm.php?page=subscribe"><img alt="<?php echo($lang['preferences']); ?>" src="images/settings.svg" class="logout-img" /></a> 
						<?php
					}
					?>
					<a id="menu-Home" href="fxm.php?page=contact&type=review"><img alt="<?php echo($lang['review']); ?>" src="images/review.svg" class="logout-img" /></a> 
					<?php
					include("business/points.php"); 
					$pointsLevelTab = explode("|", $levels[$user->_character->getLevel()]);
					$levelPointsSize = $pointsLevelTab[0];
				}
				else
				{
					if(isset($_GET['page']) && ($_GET['page'] == "login" || $_GET['page'] == "splash"))
					{
						?>
						<!-- <a href="http://musicianbooster.com/blog/" target="_blank" title="Découvrir le blog"><span class="">Blog</span></a>		-->
						<a onclick="zoneToDisplay('loginZone');" class="signupZone forgotPassZone splashEnterZone" href="#" title="<?php echo($lang['signin']); ?>"><span class=""><?php echo($lang['signin']); ?></span></a>
						<a onclick="zoneToDisplay('signupZone');" class="loginZone splashEnterZone" href="#" title="<?php echo($lang['signup']); ?>"><span class=""><?php echo($lang['signup']); ?></span></a>		
						<?php 
					}
				}
				?>
			</nav>
		</div>
	</header>

