<?php
include("php/drillTools.php"); 
?>
<?php
if(!$connected)
{
	header( 'Location: fxm.php?page=login' );
	die();
}

define('CONST_sheetOrNote', 'sheet');
define('CONST_notationSystem', 'english');

if(isset($_COOKIE["datalang"])) $cooklang = $_COOKIE["datalang"];
else $cooklang = "en";

if($cooklang == "fr")
{
	$notationSystem = "fr";
}
else
{
	$notationSystem = "en";
}

/*COHERENCE lang notation syst*/
define('CONST_phaseDuration', '120');
/*define('CONST_language', 'englishEN');*/
define('CONST_nextDay', '0000');
define('CONST_menu', 'right');

$sheetOrNote = CONST_sheetOrNote;
/*$notationSystem = $notationSystem;*/
$phaseDuration = CONST_phaseDuration;
$language = $cooklang;
$nextDay = CONST_nextDay;
$menu = CONST_menu;

if(isset($_POST['validate']))
{
	if(isset($uid))
	{		
		$sheetOrNote = "sheet";//$_POST['sheetOrNote'];
		$sheetOrNote = $_POST['sheetOrNote'];
		$notationSystem = $_POST['notationSystem'];
		$phaseDuration = $_POST['phaseDuration'];
		//$language = "fr";//$_POST['language'];
		$language = $_POST['language'];
		/*$nextDay = $_POST['nextDay'];*/
		$menu = "right";
		/*$_POST['menu'];*/
		
		switch ($language) {
			case "en":
			include("auth/PHPAuth-master/languages/en.php");
			break;
			case "fr":
			include("auth/PHPAuth-master/languages/fr.php");
			break;
			default:
			include("auth/PHPAuth-master/languages/en.php");
			break;
		}

		$authenticate->updateLang($lang);
		

		$validatePrefs = $authenticate->validatePrefs($uid,$sheetOrNote,$notationSystem,$phaseDuration,$language,$nextDay,$menu);
		$getPrefs = $authenticate->getPrefs($uid);

		if(!$validatePrefs['error'])
			$messInfo = $validatePrefs['message'];
		else 
			$messErr = $validatePrefs['message'];	


		?>

		<?php
		
	}
}	

$title = $lang['preferences'];	


if(isset($getPrefs))
{
	$sheetOrNote = $getPrefs['note'];
	$notationSystem = $getPrefs['system'];
	$phaseDuration = $getPrefs['duration'];
	$language = $getPrefs['lng'];
	$nextDay = $getPrefs['nextDayTime'];
	$menu = $getPrefs['mobileMenu'];
}
?>


<script type="text/javascript">		

	window.onload = function(){ <?php
		if($messErr != "") 
			{ ?>
				$('body').notif({title:'<?php echo $messErr; ?>', cls:'error', timeout:500000});<?php
			} ?>
			<?php if($messInfo != "") { ?>
				$('body').notif({title:'<?php echo $messInfo; ?>', cls:'success', timeout:500000});
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
						$prefpage = "preferences";
						include("content_menu_preferences.php"); ?>

						<div class="circleContainer">
							<div class="circleBlue"></div>
							<img alt="<?php echo($lang['preferences']);?>" src="images/person.svg" class="circleImg" />
						</div>
						<h3><?php echo($lang['preferences']); ?></h3>
						<p></p>

						<form action="fxm.php?page=preferences"  method="post">
							<div class="">
								
								<p>										
									<?php echo($lang['sheetOrNote']);?>: 
									<br/>
									<select name="sheetOrNote">
										<option value="sheet" <?php if($sheetOrNote=="sheet") echo "selected=\"selected\""; ?>><?php echo($lang['sheetOrNoteSheet']); ?></option>
										<option value="both" <?php if($sheetOrNote=="both") echo "selected=\"selected\""; ?>><?php echo($lang['sheetOrNoteBoth']); ?></option>												
									</select>	
								</p>	
								
								<p>
									<?php echo($lang['notationSystem']); ?>:
									<br/>
									<select name="notationSystem">
										<option value="en" <?php if($notationSystem=="en") echo "selected=\"selected\""; ?>><?php echo($lang['notationSystemEnglish']); ?></option>
										<option value="fr" <?php if($notationSystem=="fr") echo "selected=\"selected\""; ?>><?php echo($lang['notationSystemFrench']); ?></option>
									</select>
								</p>	
								<hr/>
								<p>
									<?php echo($lang['phaseDuration']);?>: <br/>
									<select name="phaseDuration">

										<?php
										if($debugMode)
										{
											?>
											<option value="005" <?php if($phaseDuration=="005") echo "selected=\"selected\""; ?>>00:05</option>
											<?php
										}
										?>


										<option value="030" <?php if($phaseDuration=="030") echo "selected=\"selected\""; ?>>00:30</option>
										<option value="060" <?php if($phaseDuration=="060") echo "selected=\"selected\""; ?>>01:00</option>
										<option value="090" <?php if($phaseDuration=="090") echo "selected=\"selected\""; ?>>01:30</option>
										<option value="120" <?php if($phaseDuration=="120") echo "selected=\"selected\""; ?>>02:00</option>
										<option value="150" <?php if($phaseDuration=="150") echo "selected=\"selected\""; ?>>02:30</option>
										<option value="180" <?php if($phaseDuration=="180") echo "selected=\"selected\""; ?>>03:00</option>
										<option value="210" <?php if($phaseDuration=="210") echo "selected=\"selected\""; ?>>03:30</option>
										<option value="240" <?php if($phaseDuration=="240") echo "selected=\"selected\""; ?>>04:00</option>												
									</select>
								</p>

								<hr/>
								<p>
									<?php echo($lang['language']); ?>:
									<br/>
									<select name="language">
										<option value="en" <?php if($language=="en") echo "selected=\"selected\""; ?>><?php echo($lang['english']); ?></option>
										<option value="fr" <?php if($language=="fr") echo "selected=\"selected\""; ?>><?php echo($lang['french']); ?></option>
									</select>
								</p>	

							</div>
							<button class="greenButton" name="validate" type="submit">
								<?php echo($lang['validate']);?>
							</button>
						</form>
					</div>

				</div>
				<?php 
				include("content_side_preferences.php"); 
				?>
			</div>
		</div>
	</div>
</div>
</div>


