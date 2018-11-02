<?php
$title = $lang['mysubscriptions'];
include("php/pricing.php"); 
include("php/drillTools.php"); 

if(!$connected)
{
	header( 'Location: fxm.php?page=login' );
	die();
}

require_once('stripe-php-3.4.0/init.php');	
//$subscription_name = $global_subscriptionName;
//$type = "12"; //12 - 6 - X
$expire = date("Y-m-d H:i:s", strtotime("6 months"));
$currentdate = date("Y-m-d H:i:s");
//$price = 4.5;
//$price_dev = "EUR";

$subscriptions = $authenticate->getSubscriptions($uid, $global_subscriptionName);
$allowedToSubscribe = false;
$nextSubscriptionDate = null;
$new = false;

if(!$hasSubscribed) 
{
	$allowedToSubscribe = true;
	$nextSubscriptionDate = getClientCurrentDate();
	$new = true;
	//echo "allowedToSubscribe ".$allowedToSubscribe."<br/>";
	//echo "nextSubscriptionDate s".$nextSubscriptionDate."<br/>";
}
else
{
	$nextSubscriptionDate = allowedToSubscribe($validSubscription);
	//echo allowedToSubscribe($validSubscription);
	//echo "nextSubscriptionDate ".$nextSubscriptionDate."<br/>";
	if($nextSubscriptionDate != null) $allowedToSubscribe = true;

}

//résilier abonnement
if(isset($_POST['validateUnsubcribe']) && isset($_POST['chosenSubscription']) && isset($_POST['chargeId']))
{
	$chargeId = $_POST['chargeId'];

	try 
	{
	//\Stripe\Stripe::setApiKey("sk_test_rIGAYktVMX7IgnC94mgqxKJU");
		\Stripe\Stripe::setApiKey("sk_live_eK8lwzH4mjzZmHyN0Rj7K7zG");
		$re = \Stripe\Refund::create(array(
			"charge" => $chargeId
			));
	} 
	catch(\Stripe\Error\Card $e) 
	{
	// Since it's a decline, \Stripe\Error\Card will be caught
		$body = $e->getJsonBody();
		$err  = $body['error'];

		print('Status is:' . $e->getHttpStatus() . "\n");
		print('Type is:' . $err['type'] . "\n");
		print('Code is:' . $err['code'] . "\n");
	// param is '' in this case
		print('Param is:' . $err['param'] . "\n");
		print('Message is:' . $err['message'] . "\n");
	} catch (\Stripe\Error\RateLimit $e) {
// Too many requests made to the API too quickly
	} catch (\Stripe\Error\InvalidRequest $e) {
// Invalid parameters were supplied to Stripe's API
	} catch (\Stripe\Error\Authentication $e) {
// Authentication with Stripe's API failed
// (maybe you changed API keys recently)
	} catch (\Stripe\Error\ApiConnection $e) {
// Network communication with Stripe failed
	} catch (\Stripe\Error\Base $e) {
// Display a very generic error to the user, and maybe send
// yourself an email
	} catch (Exception $e) {
// Something else happened, completely unrelated to Stripe
		$messErr = "Problème technique";
	}



//echo $_POST['chosenSubscription'];
//echo "oooooooo";
	$id=$_POST['chosenSubscription'];
	$subscribe = $authenticate->unSubscribe($id);

	if(!$subscribe['error'])
	{
		$messInfo = $lang['unsubscribeOK'];
	}
	else 
	{
		$messErr = $subscribe['message'];
	}		

// recharger les données		
	$subscriptions = $authenticate->getSubscriptions($uid, $global_subscriptionName);
	$allowedToSubscribe = false;
	$nextSubscriptionDate = null;

	$hasSubscribed = false;
	$validSubscription = $authenticate->validSubscription($subscriptions, $global_subscriptionName);
	if($validSubscription != null) $hasSubscribed = true;

//echo $hasSubscribed;

	if(!$hasSubscribed) 
	{
		$allowedToSubscribe = true;
	//echo "allowedToSubscribe ".$allowedToSubscribe."<br/>";
	//echo "nextSubscriptionDate s".$nextSubscriptionDate."<br/>";
	}
	else
	{
		$nextSubscriptionDate = allowedToSubscribe($validSubscription);
	//echo "nextSubscriptionDate ".$nextSubscriptionDate."<br/>";
		if($nextSubscriptionDate != null) $allowedToSubscribe = true;

	}

}

//S'abonner
if(isset($_POST['stripeToken']))
{

	if($allowedToSubscribe)
	{
		if(isset($_POST['pricing']))
		{

			if($_POST['pricing'] == "01")
			{

	//vérifier si abonnement actif
				try
				{
	//  \Stripe\Stripe::setApiKey("sk_test_rIGAYktVMX7IgnC94mgqxKJU");
					\Stripe\Stripe::setApiKey("sk_live_eK8lwzH4mjzZmHyN0Rj7K7zG");

	// Get the credit card details submitted by the form
					$token = $_POST['stripeToken'];

					$customer = \Stripe\Customer::create(array(
						"source" => $token,
						"plan" => "FM99",
						"email" => $connectedAs)
					);
	//$e = new Exception();
	//throw $e;
	//echo $customer;
					$messInfo = $lang['subActivated'];
				} 
				catch(\Stripe\Error\Card $e) 
				{
	// Since it's a decline, \Stripe\Error\Card will be caught
					$body = $e->getJsonBody();
					$err  = $body['error'];

					print('Status is:' . $e->getHttpStatus() . "\n");
					print('Type is:' . $err['type'] . "\n");
					print('Code is:' . $err['code'] . "\n");
	// param is '' in this case
					print('Param is:' . $err['param'] . "\n");
					print('Message is:' . $err['message'] . "\n");
				} catch (\Stripe\Error\RateLimit $e) {
// Too many requests made to the API too quickly
				} catch (\Stripe\Error\InvalidRequest $e) {
// Invalid parameters were supplied to Stripe's API
				} catch (\Stripe\Error\Authentication $e) {
// Authentication with Stripe's API failed
// (maybe you changed API keys recently)
				} catch (\Stripe\Error\ApiConnection $e) {
// Network communication with Stripe failed
				} catch (\Stripe\Error\Base $e) {
// Display a very generic error to the user, and maybe send
// yourself an email
				} catch (Exception $e) {
// Something else happened, completely unrelated to Stripe
					$messErr = $lang['subDeclined'];
				}

//echo "pricing: ".$_POST['pricing']."<br/>";
				$expire = date("Y-m-d H:i:s", strtotime("10 years"));
//$authenticate->subscribe($uid, "FM", $nextSubscriptionDate,  $expire, "X", $pricing['FM01EUR'], "EUR");
			}

			if($_POST['pricing'] == "06")
			{
	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here https://dashboard.stripe.com/account/apikeys
	//\Stripe\Stripe::setApiKey("sk_test_rIGAYktVMX7IgnC94mgqxKJU");
				\Stripe\Stripe::setApiKey("sk_live_eK8lwzH4mjzZmHyN0Rj7K7zG");

	// Get the credit card details submitted by the form
				$token = $_POST['stripeToken'];

	// Create the charge on Stripe's servers - this will charge the user's card
				try 
				{
					$charge = \Stripe\Charge::create(array(
	"amount" => $pricing['FM06EUR_stripelabel'], // amount in cents, again
	"currency" => "eur",
	"source" => $token,
	"receipt_email" => $connectedAs,
	"description" => $lang['offer06TitleReceipt']
	));
					$chargeId = $charge['id'];
	//$messInfo = $lang['subActivated'];
				} 
				catch(\Stripe\Error\Card $e) 
				{
	// Since it's a decline, \Stripe\Error\Card will be caught
					$body = $e->getJsonBody();
					$err  = $body['error'];

					print('Status is:' . $e->getHttpStatus() . "\n");
					print('Type is:' . $err['type'] . "\n");
					print('Code is:' . $err['code'] . "\n");
	// param is '' in this case
					print('Param is:' . $err['param'] . "\n");
					print('Message is:' . $err['message'] . "\n");
				} catch (\Stripe\Error\RateLimit $e) {
// Too many requests made to the API too quickly
				} catch (\Stripe\Error\InvalidRequest $e) {
// Invalid parameters were supplied to Stripe's API
				} catch (\Stripe\Error\Authentication $e) {
// Authentication with Stripe's API failed
// (maybe you changed API keys recently)
				} catch (\Stripe\Error\ApiConnection $e) {
// Network communication with Stripe failed
				} catch (\Stripe\Error\Base $e) {
// Display a very generic error to the user, and maybe send
// yourself an email
				} catch (Exception $e) {
// Something else happened, completely unrelated to Stripe
					$messErr = $lang['subDeclined'];
				}
				$expire = date("Y-m-d H:i:s", strtotime($nextSubscriptionDate . "+6 months"));
//$expire = date("Y-m-d H:i:s", strtotime("6 months"));				
//echo $expire;
				$subscribe = $authenticate->subscribe($uid, "FM", $nextSubscriptionDate,  $expire, "6", $pricing['FM06EUR'], "EUR", $chargeId);

				if(!$subscribe['error'])
					$messInfo = $lang['subActivated'];
				else 
					$messErr = $subscribe['message'];	


			}

			if($_POST['pricing'] == "12")
			{
	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here https://dashboard.stripe.com/account/apikeys
	//\Stripe\Stripe::setApiKey("sk_test_rIGAYktVMX7IgnC94mgqxKJU");
				\Stripe\Stripe::setApiKey("sk_live_eK8lwzH4mjzZmHyN0Rj7K7zG");

	// Get the credit card details submitted by the form
				$token = $_POST['stripeToken'];

	// Create the charge on Stripe's servers - this will charge the user's card
				try 
				{
					$charge = \Stripe\Charge::create(array(
	"amount" => $pricing['FM12EUR_stripelabel'], // amount in cents, again
	"currency" => "eur",
	"source" => $token,
	"receipt_email" => $connectedAs,
	"description" => $lang['offer12TitleReceipt']
	));
					$chargeId = $charge['id'];

				} 
				catch(\Stripe\Error\Card $e) 
				{
	// Since it's a decline, \Stripe\Error\Card will be caught
					$body = $e->getJsonBody();
					$err  = $body['error'];

					print('Status is:' . $e->getHttpStatus() . "\n");
					print('Type is:' . $err['type'] . "\n");
					print('Code is:' . $err['code'] . "\n");
	// param is '' in this case
					print('Param is:' . $err['param'] . "\n");
					print('Message is:' . $err['message'] . "\n");
				} catch (\Stripe\Error\RateLimit $e) {
// Too many requests made to the API too quickly
				} catch (\Stripe\Error\InvalidRequest $e) {
// Invalid parameters were supplied to Stripe's API
				} catch (\Stripe\Error\Authentication $e) {
// Authentication with Stripe's API failed
// (maybe you changed API keys recently)
				} catch (\Stripe\Error\ApiConnection $e) {
// Network communication with Stripe failed
				} catch (\Stripe\Error\Base $e) {
// Display a very generic error to the user, and maybe send
// yourself an email
				} catch (Exception $e) {
// Something else happened, completely unrelated to Stripe
					$messErr = $lang['subDeclined'];
				}


				$expire = date("Y-m-d H:i:s", strtotime($nextSubscriptionDate . "+12 months"));
				$subscribe = $authenticate->subscribe($uid, "FM", $nextSubscriptionDate,  $expire, "12", $pricing['FM12EUR'], "EUR", $chargeId);
				if(!$subscribe['error'])
					$messInfo = $lang['subActivated'];
				else 
					$messErr = $subscribe['message'];	

			}

		}


		$subscriptions = $authenticate->getSubscriptions($uid, $global_subscriptionName);
		$allowedToSubscribe = false;
		$nextSubscriptionDate = null;


		$validSubscription = $authenticate->validSubscription($subscriptions, $global_subscriptionName);
		if($validSubscription != null) $hasSubscribed = true;

		if(!$hasSubscribed) 
		{
			$allowedToSubscribe = true;
	//echo "allowedToSubscribe ".$allowedToSubscribe."<br/>";
	//echo "nextSubscriptionDate s".$nextSubscriptionDate."<br/>";
		}
		else
		{
			$nextSubscriptionDate = allowedToSubscribe($validSubscription);
	//echo "nextSubscriptionDate ".$nextSubscriptionDate."<br/>";
			if($nextSubscriptionDate != null) $allowedToSubscribe = true;

		}
	}
	else
	{
		$messErr = $lang["impossibleToSubscribe"];
	}


}



?>

<div class="content-container">
	<div class="block-container">
		<!--BLOC PRINCIPAL DES EXERCICES -->
		<div class="main-block">
			<div class="block-content">

				<?php
				$prefpage = "sub";
				include("content_menu_preferences.php"); 
				?>

				<div class="circleContainer">
					<div class="circleBlue"></div>
					<img alt="<?php echo($lang['mysubscriptions']);?>" src="images/person.svg" class="circleImg" />
				</div>
				<h3><?php echo($lang['mysubscriptions']); ?></h3>

				<p></p>
				
				<?php if($allowedToSubscribe)				
				{
					$labelSubscribe = $lang['subscribe'];

					if(!$new) {					
						$labelSubscribe = $lang['renewSubscription'];}

						?>
						<!--
						<a href="subscribe.php"><button name="submit" type="" class="templatemo-blue-button width-100"><?php echo($labelSubscribe);?></button></a>
					-->

					<?php 
				}
				?>
				<?php 
						//setlocale(LC_ALL, 'fra');
				
						//$currentdate = getTZCurrentDateTime();
				$currentdate = strtotime(getClientCurrentDate());

				if(isset($subscriptions) && $subscriptions != null){
					foreach($subscriptions as $sub) { 					

						$active = "0"; 
								/*echo "expiration_date".$sub['expiration_date']."<br/>";
									echo "expiration_date".strtotime($sub['expiration_date']);
									echo "<br/>";
									echo $currentdate;*/								
									if(strtotime($sub['expiration_date']) > $currentdate && $currentdate >= strtotime($sub['start_date'])) 
									{
										$active = "1"; 
									}							
									if(strtotime($sub['start_date']) > $currentdate && strtotime($sub['start_date']) < strtotime($sub['expiration_date'])) 
									{
										$active = "2"; 
									}			
								//echo $sub['state'];
									if($sub['state'] == 3) 
									{
										$active = "3"; 
									}

									?>
									<div class="">								
										<div class="">
											<div class="">
												<div class="yellowUnit <?php if($active == "0" || $active == "3") echo "grayUnit"?>">		
													<div class="<?php if($active == "0" || $active == "3") echo "subExpired"?>">

														<h3 class="<?php if($active == "0") echo "subExpired"?>"><?php 										
															if($sub['type'] == "X") echo($lang['subscriptionMonth']);
															if($sub['type'] == "6") echo($lang['subscription6']);
															if($sub['type'] == "12") echo($lang['subscription12']);

															?></h3>
															<hr/>													
															<?php //if($sub['subscription_name'] == "FM") echo($lang['fretxmasterMini'] ); ?> 


															<span class="smallBlack">
																<?php
																if($sub['type'] != "X")
																{
																	echo sprintf($lang['fromTo'], strftime("%x", strtotime($sub['start_date'])), strftime("%x", strtotime($sub['expiration_date'])));

																}
																else
																{

																	echo sprintf($lang['from'], strftime("%x", strtotime($sub['start_date'])));
																}
																?>

																<br/>

																<?php echo sprintf($lang['subscribedFrom'], strftime("%x", strtotime($sub['subscription_date']))); ?>


																<br/>




																<?php 
																echo($sub['price_num'] . ' ' . $sub['price_dev']); 
																if($sub['type'] == "X")
																{
																	echo(" (".$lang['monthly'].")")
																	?> <a onclick="openbox(1);boxUnsubscribe();" href="#" title="Se désabonner"><i class="fa fa-times-circle"></i></a><?php 
																}

																?>

																<br/>	

																<?php 
																/*
															if(($active == "1" || $active == "2")&& strtotime($sub['start_date'] . "+8 days") > $currentdate) 
															{
																?>
																<a onclick="openbox(1);boxUnsubscribe();document.getElementById('chosenSubscription').value='<?php echo $sub['id'] ?>';document.getElementById('chargeId').value='<?php echo $sub['chargeId'] ?>';" href="#" title="<?php echo $lang['unsubscribe']; ?>"><?php echo $lang['unsubscribe']; ?></a> 	
																<i class="fa fa-question-circle fa-15x hand" onclick="toggle_visibility('unsubscribeDesc');" ></i>
																<span id="unsubscribeDesc"  style="display:none;">
																	<?php echo($lang['unsubscribeDesc']);?></span>
																	<?php 
																}
*/
																?>
																<br/>
												<?php /*
													if($active == "2") 
													{
													?>
													<span class="subActiveSoon">
													<?php 
													//echo($lang['activeSoon']);
													echo sprintf($lang['activeSoon'], strftime("%x", strtotime($sub['start_date'])));
													
													?>
													</span>
													
													<?php }
												*/

													switch($active)
													{
														case "1":
														?>
														<span class="subActive">
															<?php echo($lang['active']);?>
														</span>

														<?php
														break;
														case "2":
														?>
														<span class="subActiveSoon">
															<?php 
														//echo($lang['activeSoon']);
															echo sprintf($lang['activeSoon'], strftime("%x", strtotime($sub['start_date'])));

															?>
														</span>													
														<?php
														break;
														case "3":
														?>
														<span class="subInactive">
															<?php echo($lang['quit']);?>
														</span>

														<?php
														break;
														default:
														?>
														<span class="subInactive">
															<?php echo($lang['expired']);?>
														</span>

														<?php 
														break;
													}
												/*
													if($active == "1") 
													{
													?>
													<span class="subActive">
													<?php echo($lang['active']);?>
													</span>
													
													<?php }*/
												/*
													if($active != "1" && $active != "2") 
													{
													?>
													<span class="subInactive">
													<?php echo($lang['expired']);?>
													</span>
													
													<?php 
												}*/
												
												?>									
											</span>
											<br/>

										</div>
									</div>		
								</div>
							</div>
						</div> 




						<?php }

					}
					else
					{
						?> <tr><td colspan="7"><?php echo($lang['nosub']);?></td></tr> <?php
					} ?>






				</div>
			</div>


			<?php 
			$prefpage = "sub";
			include("content_side_preferences.php"); 
			?>
		</div>

	</div>



















































