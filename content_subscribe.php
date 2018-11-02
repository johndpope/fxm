<?php
$title = $lang['mysubscriptions'];
include("php/pricing.php"); 
include("php/drillTools.php"); 

if(!$connected)
{
	header( 'Location: fxm.php?page=login' );
	die();
}



$allowedToSubscribe = false;
$nextSubscriptionDate = getClientCurrentDate();	
if(!$hasSubscribed) 
{
	$allowedToSubscribe = true;
}
else
{
	$nextSubscriptionDate = allowedToSubscribe($validSubscription);
	if($nextSubscriptionDate != null) $allowedToSubscribe = true;		
}

if(!$allowedToSubscribe) {
	header( 'Location: fxm.php?page=dashboard' );
	die();
}

?>


<div class="content-container">
	<div class="block-container">
		<!--BLOC PRINCIPAL DES EXERCICES -->
		<div class="main-block">
			<div class="block-content">
				<?php
				$prefpage = "subscribe";
				include("content_menu_preferences.php"); 
				?>

				<div style="text-align:justify;">
					<div class="circleContainer">
						<div class="circleBlue"></div>
						<img alt="School" src="images/school.png" class="circleImg" />
					</div>
					<h3>
						<?php echo($lang['subscribe_Title']); ?>
						<p></p>
						<?php echo($lang['subscribe_subTitle']); ?>
					</h3>


					<p></p>
					<?php
					if($authorizedConnection)
					{
						?>


						<div style="width:100%;text-align:center;">
							<form  class="" style="display: inline-block;" id="buttonPrice6" style="display:block;" action="fxm.php?page=sub" method="POST">
								<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								data-key="pk_live_P4bc4xwHrdGDD9AFA9dxueh4"
								data-amount="<?php echo($pricing['FM06EUR_stripelabel']); ?>"
								data-name='FretXMaster'
								data-description="<?php echo($lang['subscribe_access6']); ?>: 27 €"		
								data-image="images/FXM.jpg"
								data-locale="<?php echo($language); ?>"
								data-currency="EUR"
								data-email="<?php echo($connectedAs); ?>"
								data-label="<?php echo($lang['6months']); ?> : 4,5 € /<?php echo($lang['month']); ?>"
								data-panel-label="<?php echo($lang['validate']); ?>" async defer>
							</script>
							<input type="hidden" name="pricing" value="06">
						</form>


						<form  id="buttonPrice12" style="display: inline-block;"  action="fxm.php?page=sub" method="POST">
							<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							data-key="pk_live_P4bc4xwHrdGDD9AFA9dxueh4"
							data-amount="<?php echo($pricing['FM12EUR_stripelabel']); ?>"
							data-name='FretXMaster'
							data-description="<?php echo($lang['subscribe_access12']); ?>: 47 €"		
							data-image="images/FXM.jpg"
							data-locale="<?php echo($language); ?>"
							data-currency="EUR"
							data-email="<?php echo($connectedAs); ?>"
							data-label="<?php echo($lang['1year']); ?> : 3,9 € /<?php echo($lang['month']); ?>"
							data-panel-label="<?php echo($lang['validate']); ?>" async defer>												
						</script>
						<input type="hidden" name="pricing" value="12">

					</form>
					<br/><span class="hint"><?php echo($lang['stripe']); ?></span>
				</div>

				<?php
			}
			?>


			<p></p>
			<span class="hint" style="color:black;font-weight:normal;">
				
			</span>
			<?php echo($lang['subsc_risks']); ?>
			<p></p>



			En vous abonnant, vous soutenez une <strong>initiative indépendante</strong>. <p/>MusicianBooster est une (très) petite entreprise française indépendante, guidée par la passion de la musique. <p/>
			Nous sommes basés à <strong>Lille</strong> dans le nord de la France. N’hésitez pas à nous poser toutes vos questions et remarques, nous adorons échanger avec d'autres musiciens passionnés.


<!--			<hr/>

			<p></p>
			<?php echo($lang['subsc_01']); ?>
			<p></p>

			<h3><?php echo($lang['subsc_02']); ?></h3>
			<p></p><img class="checkSubscribe" src="images/check.png" /><?php echo($lang['subsc_03']); ?>
			<br/>
			<?php echo($lang['subsc_04']); ?>

			<p></p><img class="checkSubscribe" src="images/check.png" /><?php echo($lang['subsc_05']); ?>
			<br/>
			<?php echo($lang['subsc_06']); ?>

			<p></p><img class="checkSubscribe" src="images/check.png" /><?php echo($lang['subsc_07']); ?>
			<br/>
			<?php echo($lang['subsc_08']); ?>

			<p></p><img class="checkSubscribe" src="images/check.png" /><b><?php echo($lang['subsc_09']); ?></b>
			<br/>
			<?php echo($lang['subsc_10']); ?>

			<p></p><img class="checkSubscribe" src="images/check.png" /><?php echo($lang['subsc_11']); ?>

			<hr/>
			<div class="circleContainer">
				<div class="circleBlue"></div>
				<img alt="School" src="images/school.png" class="circleImg" />
			</div>
			<h3><?php echo($lang['subscribe_Title']); ?>
				<p></p>
				<?php echo($lang['subscribe_subTitle']); ?>
			</h3>
		-->

		<p></p>
		<?php
			if(false)//$authorizedConnection)
			{
				?>

				<div style="width:100%;text-align:center;">
					<form  class="" style="display: inline-block;" id="buttonPrice6" style="display:block;" action="fxm.php?page=sub" method="POST">
						<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						data-key="pk_live_P4bc4xwHrdGDD9AFA9dxueh4"
						data-amount="<?php echo($pricing['FM06EUR_stripelabel']); ?>"
						data-name='FretXMaster'
						data-description="<?php echo($lang['subscribe_access6']); ?>: 27 €"		
						data-image="images/FXM.jpg"
						data-locale="<?php echo($language); ?>"
						data-currency="EUR"
						data-email="<?php echo($connectedAs); ?>"
						data-label="<?php echo($lang['6months']); ?> : 4,5 € /<?php echo($lang['month']); ?>"
						data-panel-label="<?php echo($lang['validate']); ?>" async defer>
					</script>
					<input type="hidden" name="pricing" value="06">
				</form>


				<form  id="buttonPrice12" style="display: inline-block;"  action="fxm.php?page=sub" method="POST">
					<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="pk_live_P4bc4xwHrdGDD9AFA9dxueh4"
					data-amount="<?php echo($pricing['FM12EUR_stripelabel']); ?>"
					data-name='FretXMaster'
					data-description="<?php echo($lang['subscribe_access12']); ?>: 47 €"		
					data-image="images/FXM.jpg"
					data-locale="<?php echo($language); ?>"
					data-currency="EUR"
					data-email="<?php echo($connectedAs); ?>"
					data-label="<?php echo($lang['1year']); ?> : 3,9 € /<?php echo($lang['month']); ?>"
					data-panel-label="<?php echo($lang['validate']); ?>" async defer>												
				</script>
				<input type="hidden" name="pricing" value="12">

			</form>
			<br/><span class="hint"><?php echo($lang['stripe']); ?></span>
		</div>
		<?php
	}
	?>

<!--
	<p></p>
	<span class="hint" style="color:black;font-weight:normal;">
		<?php echo($lang['subsc_risks']); ?>
	</span>
-->
</div>


</div>
</div>



<?php 
$prefpage = "subscribe";
include("content_side_preferences.php"); 
?>




<div class="main-block">
	<div class="block-content">

		

		<div style="clear:left" class="footerMenu" >
			<span class="footerText"><a href="fxm.php?page=dashboard">FretXMaster <?php echo date("Y"); ?></a></span>&nbsp;&nbsp;&nbsp;
			<span class="footerText"><a href="fxm.php?page=conditions"><?php echo($lang['conditions']); ?></a></span>&nbsp;&nbsp;&nbsp;
			<span class="footerText"><a href="fxm.php?page=contacts"><?php echo($lang['contacts']); ?></a></span>
		</div>
	</div>






</div>


</div>

</div>


<script type="text/javascript">	


	function buttonStyle()
	{
		var str = $('.stripe-button-el');

		if(str.length > 0)
		{
			str.removeClass('stripe-button-el');
			str.addClass('greenButton');
			str[0].innerHTML = str[0].innerHTML.replace(/pour/g, "<p/>");
			str[1].innerHTML = str[1].innerHTML.replace(/pour/g, "<p/>");
			str[0].style.width = "100px";str[1].style.width = "100px";
			str[0].style.height = "95px";str[1].style.height = "95px";
			str[0].style.fontSize = "16px";str[1].style.fontSize = "16px";

			str[2].innerHTML = str[2].innerHTML.replace(/pour/g, "<p/>");
			str[3].innerHTML = str[3].innerHTML.replace(/pour/g, "<p/>");
			str[2].style.width = "100px";str[3].style.width = "100px";
			str[2].style.height = "95px";str[3].style.height = "95px";
			str[2].style.fontSize = "16px";str[3].style.fontSize = "16px";
		}
	}
/*
	buttonStyle();
	
	window.onload = function(){ 
		buttonStyle();
	}
	*/

</script> 

















