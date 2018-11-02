<?php
include("php/drillTools.php"); 
if(!$connected)
{
	header( 'Location: fxm.php?page=login' );
	die();
}
if($connected) {
/*
	if(!isset($_COOKIE["mbTimeDelta"]))
	{
		header( 'Location: dashboard.php' );
		die();
	}
*/
//RECUPERER LES DRILLS DU JOURS
	$mydrill = $authenticate->getMyDayDrills($uid);
	$firstDrill01 = "false";
	if(!$mydrill) $firstDrill01 = "true";
	//var_dump($firstDrill);
	//UPDATE `srs` SET `uid`= 99 WHERE `uid`= 7
	$drilltable = array();
	if($mydrill)
	{
		foreach ($mydrill as $row) {
			$drilltable[$row['drill_name']] = $row;							
		}		
	}
}
?>

<!-- INITIALISATION DES VARIABLES -->
<script>	
	var chosenDrill;
	var phaseDuration = "200";
	var prefSystem = "";
	var notation = "";
	var firstDrill = false;
	<?php
	if((isset($firstDrill01)) && ($firstDrill01 == "true"))	
	{ 
		?>		
		firstDrill = true;		
		<?php 
	}
	?>	
</script>

<?php
$chosenDrill;// = "FM02C1";
$label_level = "";
$label_drill = "";//$lang['label_ALL'];    
$achievement = "000000000";

$phaseDuration = "";


//$prefSystem = "fr";
$prefSystem = $language;

$notation = "sheet";

// RECUPERER LES PREFERENCES
if(isset($getPrefs))
{
	echo $phaseDuration;
	$phaseDuration = $getPrefs['duration'];
	$prefSystem = $getPrefs['system'];
	$notation = $getPrefs['note'];
	$lng = $getPrefs['lng'];
}

if(isset($_POST['noguitar'])) 
{
	$noguitar = $_POST['noguitar'];
	//var_dump($noguitar);
}
else
{
	$noguitar = "false";
}

/*CALCUL DES PROCHAINS INTERVALLES POUR LE DRILL EN COURS*/
$chosenDrill = "FM01A1";
$chosenModule = "FM01";
if(isset($_POST['chosenDrill']) && $_POST['chosenDrill'] != '' && $_POST['chosenDrill'] != 'ALL')
{

	
	$chosenDrill = $_POST['chosenDrill'];
	
	$chosenModule = substr($chosenDrill, 0, 4);		
	//$label_level = $lang['label_'.substr($chosenDrill, 0, 4)]; 		
	$altx = substr($chosenDrill, 6, 7);				
	$label_alt = "";
	
	if($altx == "D") $label_alt = " (&#9839;)";
	if($altx == "B") $label_alt = " (&#9837;)";
	if($altx == "A") $label_alt = " (&#9839;&#9837;)";	

	$label_drill = $lang['label_'.substr($chosenDrill, 0, 6)].$label_alt; 
	$currentDrill = "";		

	$currentdateString = getClientCurrentDateNoTime();
	$currentdate = strtotime($currentdateString);

	//trace($connectedAs, "<br/>drill.php - currentdateString : " . $currentdateString);
	//trace($connectedAs,"<br/>drill.php - currentdate : " . $currentdate);

	if(isset($drilltable[$chosenDrill]))
	{
		$currentDrill = $drilltable[$chosenDrill];
		$currentBpm = $currentDrill["speed"];
		if($currentDrill["achievement"] != "")	$achievement = $currentDrill["achievement"];
		//var_dump($currentDrill);		
		//echo($currentDrill["achievement"]);
		//echo($achievement);
		$next = strtotime($currentDrill["next_repetition"]);
		$prev2 = date('Y-m-d', strtotime($currentDrill["previous_repetition"]));
		//$prev = strtotime($currentDrill["previous_repetition"]);
		$prev = strtotime($prev2);
		//trace($connectedAs,"<br/>drill.php - next : " . $currentDrill["next_repetition"]);
		//trace($connectedAs,"<br/>drill.php - prev : " . $currentDrill["previous_repeition"]);
		//trace($connectedAs,"<br/>drill.php - prev2 : " . $prev2);
		$datediff = $next - $prev;
		$nextInterval = floor(($datediff/(60*60*24))*1.7);			
		//trace($connectedAs,"<br/>drill.php - datediff : " . $datediff);
		//trace($connectedAs,"<br/>drill.php - nextInterval : " . $nextInterval);
		//si on fait le drill en avance	
		if($currentdate < $next) 
		{				
			$datediffnowPrev = $currentdate - $prev;				
			$nextMoinsNow = $next - $currentdate;
			$nextMoinsNowInDays = floor(($nextMoinsNow/(60*60*24)));				
			$ratioAAppliquer = $datediffnowPrev / $datediff;
			$nextInterval = floor($nextMoinsNowInDays + ($nextInterval*$ratioAAppliquer));						
		}			
		if($nextInterval == 1 && ($next <= $currentdate)) $nextInterval = 3;			

		$newDrill = 0;
	}
	else
	{
		$nextInterval = 3;
		$currentBpm = 40;
		$newDrill = 1;
	}		

	$bpm = $_POST['bpm'];
	$currentBpm = $bpm;
	$daysDifStr = ' + '.$nextInterval.' days';
	$nextIntervalDate = date('Y-m-d', strtotime($currentdateString . $daysDifStr));
	?>		
	
	<script>	
		var currentBpm = parseInt(<?php echo($currentBpm); ?>);
		var nextInterval = <?php echo($nextInterval); ?>;		
		chosenDrill = "<?php echo($_POST['chosenDrill']); ?>";	
		phaseDuration = "<?php echo($phaseDuration); ?>";
		prefSystem = "<?php echo($prefSystem); ?>";
		notation = "<?php echo($notation); ?>";		
		//est ce un nouvel exo (jamais fait) ?
		var newDrill = <?php echo($newDrill); ?>;
		var noguitar = <?php echo($noguitar); ?>;
//		console.log("noguitar :"+noguitar);
	</script>	
	


	<?php

}
else
{
	header( 'Location: fxm.php?page=dashboard' );
	die();
}

?>

<script src='<?php echo $jsPath; ?>/sound/G00.js' type='text/javascript' async></script>

<?php
switch($chosenDrill){
	case "FM01A1N": break;
	case "FM01B1N": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <?php break;
	case "FM02A1N": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G2N.js' type='text/javascript' async></script> <?php break;
	case "FM02B1N": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G6N.js' type='text/javascript' async></script> <?php break;
	case "FM02C1N": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G5N.js' type='text/javascript' async></script> <?php break;
	case "FM02D1N": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G4N.js' type='text/javascript' async></script> <?php break;
	case "FM02E1N": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G3N.js' type='text/javascript' async></script> <?php break;
	case "FM02F1N": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G1N.js' type='text/javascript' async></script> <?php break;
	case "FM03A1D":
	case "FM03A1B":
	case "FM03A1A": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G2N.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G2A.js' type='text/javascript' async></script> <?php break;
	case "FM03B1D":
	case "FM03B1B":
	case "FM03B1A": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G6N.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G6A.js' type='text/javascript' async></script> <?php break;
	case "FM03C1D":
	case "FM03C1B":
	case "FM03C1A": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G5N.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G5A.js' type='text/javascript' async></script> <?php break;
	case "FM03D1D":
	case "FM03D1B":
	case "FM03D1A": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G4N.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G4A.js' type='text/javascript' async></script> <?php break;
	case "FM03E1D":
	case "FM03E1B":
	case "FM03E1A": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G3N.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G3A.js' type='text/javascript' async></script> <?php break;
	case "FM03F1D":
	case "FM03F1B":
	case "FM03F1A": ?> <script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G1N.js' type='text/javascript' async></script> <script src='<?php echo $jsPath; ?>/sound/G1A.js' type='text/javascript' async></script> <?php break;
	case "FM04A1D":
	case "FM04A1B":
	case "FM04A1A":
	case "FM04B1D":
	case "FM04B1B":
	case "FM04B1A":
	case "FM04C1D":
	case "FM04C1B":
	case "FM04C1A":
	case "FM04D1D":
	case "FM04D1B":
	case "FM04D1A":
	case "FM04E1D":
	case "FM04E1B":
	case "FM04E1A":
	case "FM04F1D":
	case "FM04F1B":
	case "FM04F1A":
	case "FM05A1D":
	case "FM05A1B":
	case "FM05A1A":
	case "FM05B1D":
	case "FM05B1B":
	case "FM05B1A":
	case "FM05C1D":
	case "FM05C1B":
	case "FM05C1A":
	?>
	<script src='<?php echo $jsPath; ?>/sound/G1A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G1N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G2A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G2N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G3A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G3N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G4A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G4N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G5A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G5N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G6A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G6N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> 
	<?php 
	break;
	default:
	?>
	<script src='<?php echo $jsPath; ?>/sound/G1A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G1N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G2A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G2N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G3A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G3N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G4A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G4N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G5A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G5N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G6A.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G6N.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G12.js' type='text/javascript' async></script> 
	<script src='<?php echo $jsPath; ?>/sound/G24.js' type='text/javascript' async></script> 
	<?php 
	break;
}

$drilll=substr($chosenDrill, 0, 6);

if($hasSubscribed) $isDrillAllowed = true;
else
{
	$isDrillAllowed = isDrillAllowedToFree($drilll);
}

?>		

<script>
	prefSystem = "<?php echo($prefSystem); ?>";	

	notation = "<?php echo($notation); ?>";

	var eatMe = "<?php echo($isDrillAllowed); ?>";

</script>

<script src="<?php echo $jsPath; ?>/drill.js?ver=2.3"></script>

<div class="fretboardAndDots" >			
	<canvas id="fretboardCanvas" height="1" >
		<?php echo($lang['html5Error']); ?>
	</canvas>	
	<canvas id="dotsCanvas" height="1" >
		<?php echo($lang['html5Error']); ?>	
	</canvas>	
	<canvas id="overCanvas" height="1" >
		<?php echo($lang['html5Error']); ?>
	</canvas>
</div>	
<!-- Canvas Pastilles notes -->
<!--Canvas pour pousser le contenu non flottant d'Ãªtre sous le Canvas mache-->
<div>
	<canvas id="mon_canvas" width="1" height="200" >
		<?php echo($lang['html5Error']); ?>
	</canvas>
</div>

<img alt="Réussi" id="successCheck" src="images/checked.svg" class="checkGreen" />

<!-- <div class="circleGreen">
	
</div> -->


<div class="content-container">
	<div class="block-container">
		<div class="unique-block">
			<div class="block-content" id="mainBlock">

				<div id="fabButton" class="fabContainer" onclick="pushPlayButton();">
					<div class="fab" id="playButton" class="playButton" onclick="pushPlayButton();"></div>
					<img id="fabPlayButtonImg" alt="Play" src="images/play.svg" class="fabImg" />
				</div>

				<div class="piano pianoBlock" id="" >

					<div class="whiteNote white" id="BN-pianokey-under" style="left: 85.71428571428520%;background:white;"><div id="BN-pianokey-text" class="whiteNoteLabel"><?php echo($lang[$prefSystem.'Si']); ?></div></div>
					<div class="whiteNote white" id="AN-pianokey-under" style="left: 71.42857142857100%;background:white;"><div id="AN-pianokey-text" class="whiteNoteLabel"><?php echo($lang[$prefSystem.'La']); ?></div></div>
					<div class="whiteNote white" id="GN-pianokey-under" style="left: 57.14285714285680%;background:white;"><div id="GN-pianokey-text" class="whiteNoteLabel"><?php echo($lang[$prefSystem.'Sol']); ?></div></div>
					<div class="whiteNote white" id="FN-pianokey-under" style="left: 42.85714285714260%;background:white;"><div id="FN-pianokey-text" class="whiteNoteLabel"><?php echo($lang[$prefSystem.'Fa']); ?></div></div>
					<div class="whiteNote white" id="EN-pianokey-under" style="left: 28.57142857142857%;background:white;"><div id="EN-pianokey-text" class="whiteNoteLabel"><?php echo($lang[$prefSystem.'Mi']); ?></div></div>
					<div class="whiteNote white" id="DN-pianokey-under" style="left: 14.28571428571429%;background:white;"><div id="DN-pianokey-text" class="whiteNoteLabel"><?php echo($lang[$prefSystem.'Re']); ?></div></div>
					<div class="whiteNote white" id="CN-pianokey-under" style="left: 0px;               background:white;"><div id="CN-pianokey-text" class="whiteNoteLabel"><?php echo($lang[$prefSystem.'Do']); ?></div></div>


					<div class="whiteNote pianoProtect" id="BN-pianokey" style="left: 85.71428571428520%;"></div>
					<div class="whiteNote pianoProtect" id="AN-pianokey" style="left: 71.42857142857100%;"></div>
					<div class="whiteNote pianoProtect" id="GN-pianokey" style="left: 57.14285714285680%;"></div>
					<div class="whiteNote pianoProtect" id="FN-pianokey" style="left: 42.85714285714260%;"></div>
					<div class="whiteNote pianoProtect" id="EN-pianokey" style="left: 28.57142857142857%;"></div>
					<div class="whiteNote pianoProtect" id="DN-pianokey" style="left: 14.28571428571429%;"></div>
					<div class="whiteNote pianoProtect" id="CN-pianokey" style="left: 0px;"></div>


					<div class="blackNote blackNoteStyle" id="CD-pianokey"></div>
					<div class="blackNote blackNoteStyle" id="DD-pianokey"></div>
					<div class="blackNote blackNoteStyle" id="FD-pianokey"></div>
					<div class="blackNote blackNoteStyle" id="GD-pianokey"></div>
					<div class="blackNote blackNoteStyle" id="AD-pianokey"></div>




				</div> 
				




				<div id="" class="center isInvisible sheetBlock">
					<?php if(!($noguitar == "true"))
					{
						?>
						<!--<canvas id="waveform" width="512px" height="256px"></canvas> -->		
						<!--<canvas id="waveform" width="164px" height="180"></canvas>		-->
						<?php
					}
					?>
					<div id="sheetMusic" class="example a sheet">
						<canvas class="z1" id="sheetMusicCanvas"  height="180" width="164" ></canvas>						
					</div>
				</div>

				<div id="cheatNote" class="center isInvisible sheetBlock"></div>				

			</div>


			<div class="block-content playBar" id="mainBlock">
				<div class="helpButtonDrill">					
					<img alt="Aide" src="images/helpWhite.svg" class="circleImg" />
				</div>
				<span id="chrono"></span>
				<?php if(!($noguitar == "true"))
				{
					?>
					<div style="color:black;" class="center hint playedNoteNote isInvisible sheetBlock">
						<span id="note">--</span>
					</div>
					<div style="color:black;" class="center hint playedNote isInvisible sheetBlock">
						<span class="noteaa1"><?php echo($lang['playedNote']); ?></span>					
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div class="unique-block" id="phase1Instruction" style="margin-bottom:15px;">
			<div class="block-content" id="mainBlock" style="display: inline-block;min-height: 80px;">
				<div class="imageLeft" style="position: absolute;width: 100px;">	
					<img src="images/brainTofret.png" alt="Phase1" style="width:100%;">
				</div>
				<div class="textRight" style="padding-left: 120px;">	
					<div class="subTextRight">	
						<div class="drillTitle">
							<?php echo $lang["label_".$chosenModule] ?>: 
							<?php echo $lang["label_".substr($chosenDrill, 0, 6)];	 ?>
						</div>
						<br/>
						<div class="drillInstruction"><?php echo($lang['phase1Title']); ?></div>
					</div>
				</div>
			</div>
		</div>

		<div class="unique-block isInvisible" id="phase2Instruction" style="margin-bottom:15px;">
			<div class="block-content" id="mainBlock" style="display: inline-block;min-height: 80px;">
				<div class="imageLeft" style="position: absolute;width: 100px;">	
					<img src="images/brainTofret2.png" alt="Phase2" style="width:100%;">
				</div>
				<div class="textRight" style="padding-left: 120px;">	
					<div class="subTextRight">	
						<div class="drillTitle"></div>
						<div class="drillTitle">
							<?php echo $lang["label_".$chosenModule] ?>: 
							<?php echo $lang["label_".substr($chosenDrill, 0, 6)];	 ?>
						</div>
						<br/>
						<div class="drillInstruction"><?php echo($lang['phase2Title']); ?></div>
					</div>
				</div>
			</div>
		</div>


		<div class="unique-block">
			<div class="block-content" id="mainBlock"	style="border-bottom: 1px solid #ddd;">


				<img alt="Guitar" src="images/neck4.svg" class="instrumentImg" />
				<input id="guitarVolume" type="range" value="80" max="100" min="0" step="1" />
				<select id="guitarSound" class="selectInstrument">
					<option value="Acoustic"><?php echo($lang['acoustic']); ?></option>								
				</select>		

			</div>

			<div class="block-content" id="mainBlock">			

				<img alt="Drum" src="images/drum.svg" class="instrumentImg" />
				<input id="drumVolume" type="range" value="80" max="100" min="0" step="1" />

				<select id="drumSound" class="selectInstrument">
					<option value="Metronome"><?php echo($lang['drumSound_Metronome']); ?></option>
					<option value="Metronome2"><?php echo($lang['drumSound_Metronome2']); ?></option>
					<option value="Highway"><?php echo($lang['drumSound_Highway']); ?></option>
					<option value="Master"><?php echo($lang['drumSound_Master']); ?></option>
					<option value="Stone"><?php echo($lang['drumSound_Stone']); ?></option>
					<option value="Life"><?php echo($lang['drumSound_Life']); ?></option>
					<option value="Blue"><?php echo($lang['drumSound_Blue']); ?></option>
					<option value="Pilgrim"><?php echo($lang['drumSound_Pilgrim']); ?></option>
					<option value="Funky"><?php echo($lang['drumSound_Funky']); ?></option>
				</select>
				<select id="drumSoundTernaire">
					<option value="Metronome"><?php echo($lang['drumSound_Metronome']); ?></option>			
					<option value="Metronome2"><?php echo($lang['drumSound_Metronome2']); ?></option>											
					<option value="HiHat"><?php echo($lang['drumSound_HiHat']); ?></option>											
					<option value="Basic1"><?php echo($lang['drumSound_Basic1']); ?></option>											
					<option value="Basic2"><?php echo($lang['drumSound_Basic2']); ?></option>											
				</select>
			</div>

		</div>		
	</div>	



	<?php include("modalFrame_Waiting.php"); ?>
	<?php include("modalFrame_Results.php"); ?>
	<?php include("modalFrame_Wizard.php"); ?>