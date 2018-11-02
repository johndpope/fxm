<?php	


$contactObject = "";
if(isset($_GET['type']))
{
	$contactObject = $_GET['type'];
}	


if(isset($_POST['validate']))
{
	if(!isset($uid))
	{	
		$uid = "";
		$address = $_POST['user-email'];
	}
	else
	{
		$address = $connectedAs;
	}
	$body = $_POST['inputNote'];
	$body = str_replace("\n","<br />",$body);
	$contactObject = $_POST['contactObject'];


	$sendAmail = $authenticate->sendAmail($uid,$address,$contactObject,$body);
	//var_dump($sendAmail);
	if(!$sendAmail['error'])
	{
		$messInfo = $sendAmail['message'];
		if($contactObject == "review") 
		{
			$messInfo = $lang['yourmessageReview'];
		}
		else
		{
			$messInfo = $lang['yourmessageSent'];

		}


	}
	else 
		$messErr = $sendAmail['message'];	

		//include("php/lang.php");
}	
?>

<script type="text/javascript">		
	window.onload = function(){ 

		<?php
		if($messErr != "") 
			{ ?>

				$('body').notif({title:"<?php echo $messErr; ?>", cls:'error', timeout:5000});<?php
			} ?>

			<?php if($messInfo != "") { ?>

				$('body').notif({title:"<?php echo $messInfo; ?>", cls:'success', timeout:5000});
				<?php } ?>
			}
		</script>

		<div class="content-container">
			<div class="block-container">
				<div class="unique-block">
					<div class="block-content">

						<div class="circleContainer">
							<div class="circleBlue">

							</div>
							<img alt="Character" src="images/contacts.png" class="circleImg" />
						</div>

						<?php
						if($contactObject == "review")
						{
							?>
							<h3><?php echo($lang['review_title']); ?></h3>
							<?php
						}
						else
						{
							?>
							<h3><?php echo($lang['contactTitle']); ?></h3>
							<?php
						}						
						?>

						<form action="fxm.php?page=contacts"  method="post">

							<?php if(!$connected) { ?>
								<br/><h4><?php echo($lang['emailAdress']); ?></h4><br/>								
								<input  id="user-email" name="user-email" type="text" class="form-control" placeholder="<?php echo($lang['email']); ?>*">           
								<?php } ?>

								<br/>

								<?php
								if($contactObject == "review")
								{
									?>
									<h4><?php echo($lang['review_subtitle']); ?></h4><br/>									
									<span class="hint">
										<?php echo($lang['review_subsubtitle']); ?>
									</span>	
									<input type="hidden" id="contactObject" name="contactObject" value="review"></input>
									<?php
								}
								else
								{
									?>									
									<h4><?php echo($lang['object']); ?></h4><br/>						
									<select id="sel" name="contactObject">
										<option value="idea"  <?php if($contactObject=="idea") echo "selected=\"selected\""; ?>><?php echo($lang['improvIdea1']); ?></option>
										<option value="question"  <?php if($contactObject=="question") echo "selected=\"selected\""; ?>><?php echo($lang['question1']); ?></option>
										<option value="subscribe"  <?php if($contactObject=="subscribe") echo "selected=\"selected\""; ?>><?php echo($lang['questionSub']); ?></option>
										<option value="problem"   <?php if($contactObject=="problem") echo "selected=\"selected\""; ?>><?php echo($lang['techProblem1']); ?></option>												
										<option value="other"   <?php if($contactObject=="other") echo "selected=\"selected\""; ?>><?php echo($lang['other']); ?></option>
									</select>
									<br/><br/><h4><?php echo($lang['yourmessage']); ?></h4><br/>
									<span class="hint">
										<?php echo($lang['messageDesc1']); ?>
										<?php echo($lang['messageDesc2']); ?>
									</span>
									<?php
								}						
								?>

								<br/>		
								<textarea class="txtarea" id="inputNote" name="inputNote" rows="8"></textarea>							

								<br/>
								<button name="validate" type="submit" class="greenButton">
									<?php echo($lang['send']);?>
								</button>														

							</form>
						</div>

					</div>
				</div>

			</div>
