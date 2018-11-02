<div class="modal-frame isInvisible" id="modalFrame_Results">
	<div class="main-block"><?php
		$previous_repetition = getClientCurrentDate();
		$daysDifStr2 = ' + '.$nextInterval.' days';
		$next_repetition = date('Y-m-d', strtotime($previous_repetition . $daysDifStr2));	

		$freshLevel = setLevelFromNextRepetition($previous_repetition, $next_repetition);

		$points = pointsToAdd($point, $chosenDrill, $achievement, $currentBpm, $freshLevel); 

		$wonPoints = intval($points["points"])+intval($points["pointsToCorrect"]);

		$level = intval($user->_character->getLevel());
		
		$beforePoints = intval($user->_character->getXP());
		$addedPoints = $beforePoints+$wonPoints;		
		
		$wonMoney = round($wonPoints*0.13);
		$beforeMoney = intval($user->_character->getMoney());
		$addedMoney = $beforeMoney+$wonMoney;		

		$lostLife = 10;
		$beforeLife = intval($user->_character->getLife());
		$subtractedLife = $beforeLife-$lostLife;
		if($subtractedLife <= 0) $subtractedLife = 0;

		//$levels[$level] = 0;
		$pointsLevelTab = explode("|", $levels[$level]);
		$f = $pointsLevelTab[0];
		$levelPointsCompound = $pointsLevelTab[1];

		$pointsLevelTab = explode("|", $levels[$level+1]);
		$nextLevelPointsSize = $pointsLevelTab[0];

		$pointsLevelTab = explode("|", $levels[$level+2]);
		$nextLevelPointsSize2 = $pointsLevelTab[0];

		$beforePointsLvl = intval($user->_character->getXPLvl());
		$addedPointsLvl = $beforePointsLvl+$wonPoints;

		$levelBefore = intval($user->_character->getLevel());
		$levelAfter = $levelBefore;
		if($addedPointsLvl > $levelPointsSize)
		{
			$levelAfter++;
			$addedPointsLvl = $addedPointsLvl - $levelPointsSize;
			if($addedPointsLvl > $levelPointsSize)
			{
				$levelAfter++;
				$addedPointsLvl = $addedPointsLvl - $nextLevelPointsSize;
			}
		}

		if($hasSubscribed) $returnPage = "fxm.php?page=dashboard";
		else $returnPage = "fxm.php?page=dashboard";
		?>

		<script>	
			var drillAchievementOut = parseInt(<?php echo($points["drillAchievementOut"]); ?>);
			var points = <?php echo($addedPoints); ?>;
			//console.log(points);
			var pointsLvl = <?php echo($addedPointsLvl); ?>;
			var levelAfter = <?php echo($levelAfter); ?>;
			var wonMoney = <?php echo($wonMoney); ?>;
			var money = <?php echo($beforeMoney); ?>;
			var totalMoney = <?php echo($addedMoney); ?>;
			var life = <?php echo($beforeLife); ?>;
			var lostLife = <?php echo($lostLife); ?>;
			var subtractedLife = <?php echo($subtractedLife); ?>;

			var wonPoints = <?php echo($wonPoints); ?>;
			var	levelPointsSize = <?php echo($levelPointsSize); ?>;
			var	nextLevelPointsSize = <?php echo($nextLevelPointsSize); ?>;
			var	nextLevelPointsSize2 = <?php echo($nextLevelPointsSize2); ?>;

		</script>	


		<script src="js/results.js"></script>


<!-- 	<div class="unit-finished result-ok" style="position:relative;height: 75px;">


		<div id="globalResult" style="position:absolute;height: 50px;width: calc(100% - 15px);left: 15px;top: 38px;font-family: 'Roboto', Helvetica, Arial;color: #5a0f0f;text-align: left;font-weight: 500;/* text-transform: uppercase; */font-size: 16px;/* padding-left: 15px; */">

			

			<div id="previousResult">
				<div style="position:absolute;width:70%;left:0px;top: 0px;height: 50%;max-width: 160px;">Phase 1: <span id="score1a"></span>11/12<span id="score1q"></span></div>
				<div style="position:absolute;width:70%;left:0px;top: 50%;max-width: 160px;height: 50%;">Phase 2: <span id="score2a"></span>9/12<span id="score2q"></span></div>

				<div id="previousNote" style="position:absolute;color: #7eb530;right: 0px;padding-right: 15px;top: -12px;height: 0px;text-align: left;font-size: 50px;font-weight: 300;">89%
				</div>
			</div>

			


		</div>


		<h4 style="
		font-family: 'Roboto', Helvetica, Arial;
		font-weight: 500;
		font-size: 16px;
		text-transform: uppercase;
		">Unité terminée !</h4>

		
	</div> -->



	<div class="block-content startModuleTitle unit-finished">

		<div style="text-align:left;">
			<div class="title"><?php echo $lang["unitFinished"]; ?></div>
			<?php if($noguitar == "false"){ ?>
				<h3 id="scoreResult"><?php echo $lang["score"]; ?>: <span id="precent"></span>% (<span id="1a"></span>/<span id="1q"></span>, <span id="2a"></span>/<span id="2q"></span>)</h3>
				<?php } ?>
			</div>
		</div>


		<div class="result-character">
			<?php include("component_characterFrame3.php"); ?>
		</div>

		<div id="modalFrame_Results-xp" class="modalFloater isInvisible">


			<div class="block-content bcCard" id="">		
				<img class="heartImg resultImg" src="images/xpColor.svg" />
				<div class="startCardContent">
					<span class="pointsTab" perso="<?php echo $points["pointsToCorrect"]; ?>"><?php echo $points["pointsToCorrect"]; ?></span>
					<br/>
					<div class="startCardSubContent"><?php echo $lang['victory']; ?></div>
				</div>		
			</div>


			<?php
			$pointsTab = $points["pointsTab"];
			?><?php

			if(isset($pointsTab[0]))
			{ 		
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[0]; ?>"><?php echo $pointsTab[0]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_firstVictory']; ?></div>
					</div>		
				</div>
				<?php			
			} 
			if(isset($pointsTab[1]))
			{ 
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[1]; ?>"><?php echo $pointsTab[1]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_oneweek']; ?></div>
					</div>		
				</div>
				<?php	
			} 
			if(isset($pointsTab[2]))
			{ 
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[2]; ?>"><?php echo $pointsTab[2]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_onemonth']; ?></div>
					</div>		
				</div>

				<?php		
			} 
			if(isset($pointsTab[3]))
			{ 

				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[3]; ?>"><?php echo $pointsTab[3]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_fourmonth']; ?></div>
					</div>		
				</div>
				<?php	
			} 
			if(isset($pointsTab[4]))
			{ 
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[4]; ?>"><?php echo $pointsTab[4]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_20bpm']; ?></div>
					</div>		
				</div>
				<?php	
			} 
			if(isset($pointsTab[5]))
			{ 
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[5]; ?>"><?php echo $pointsTab[5]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_50bpm']; ?></div>
					</div>		
				</div>
				<?php
			} 
			if(isset($pointsTab[6]))
			{ 
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[6]; ?>"><?php echo $pointsTab[6]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_80bpm']; ?></div>
					</div>		
				</div>
				<?php	
			} 
			if(isset($pointsTab[7]))
			{ 
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[7]; ?>"><?php echo $pointsTab[7]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_120bpm']; ?></div>
					</div>		
				</div>
				<?php	
			} 
			if(isset($pointsTab[8]))
			{ 
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/xpColor.svg" />
					<div class="startCardContent">
						<span class="pointsTab" perso="<?php echo $pointsTab[8]; ?>"><?php echo $pointsTab[8]; ?></span>
						<br/>
						<div class="startCardSubContent"><?php echo $lang['result_150bpm']; ?></div>
					</div>		
				</div>
				<?php
			} 

			if($noguitar == "false"){
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/date.svg" />
					<div class="startCardContent">
						<span class="dateSiOK">
							<?php 
							setlocale(LC_ALL, $language);
							if($nextInterval == 1) 
							{
								echo($lang['tomorrowOneDay']); 
							}
							else
							{
								echo(strftime("%x", strtotime($nextIntervalDate)));
								echo sprintf($lang['nbDays'], $nextInterval); 
							}
							?>
						</span>
						<span class="dateSiKO">
							<?php
							echo($lang['tomorrowOneDay']); 
							?>
						</span>
						<br/>
						<div class="startCardSubContent">
							<?php echo($lang['nextRevision']); ?>

						</div>
					</div>		
				</div>
				<?php
			}
			?>

			<div class="block-content" style="padding-top: 12px;">

				<div style="text-align:right;">
					<a href="<?php echo $returnPage; ?>" class="backButton href="#"><?php echo $lang['return']; ?></a>
					<a class="startButton" id="modalFrame_Results-xp-NEXT" href="#" onclick="
					setTimeout(function() {
						moveMoney('wonMoney', 'character-money', wonMoney, money);
					}, 1000)
					">Continuer</a>
				</div>
			</div>

		</div>


		<div id="modalFrame_Results-life" class="modalFloater isInvisible">
			<div class="block-content bcCard" id="">		
				<img class="heartImg resultImg" src="images/heartPink.svg" />
				<div class="startCardContent">
					<span class="character-life2 pointsTab">- <?php echo($lostLife); ?></span>
					<br/>
					<div class="startCardSubContent"><?php echo $lang['fail']; ?></div>
				</div>		
			</div>

			<?php
			if($noguitar == "false"){
				?>
				<div class="block-content bcCard" id="">		
					<img class="heartImg resultImg" src="images/date.svg" />
					<div class="startCardContent">
						<span class="dateSiOK">
							<?php 
							setlocale(LC_ALL, $language);
							if($nextInterval == 1) 
							{
								echo($lang['tomorrowOneDay']); 
							}
							else
							{
								echo(strftime("%x", strtotime($nextIntervalDate)));
								echo sprintf($lang['nbDays'], $nextInterval); 
							}
							?>
						</span>
						<span class="dateSiKO">
							<?php
							echo($lang['tomorrowOneDay']); 
							?>
						</span>
						<br/>
						<div class="startCardSubContent">
							<?php echo($lang['nextRevision']); ?>

						</div>
					</div>		
				</div>
				<?php
			}
			?>

			<div class="block-content" style="padding-top: 12px;">			
				<div style="text-align:right;">
					<a href="<?php echo $returnPage; ?>" class="backButton href="#"><?php echo $lang['return']; ?></a>
					<a class="startButton" href="<?php echo $returnPage; ?>"><?php echo $lang['continue']; ?></a>
				</div>
			</div>
		</div>


		<div id="modalFrame_Results-gold" class="modalFloater isInvisible">
			<div class="block-content bcCard" id="">	

				<img class="heartImg resultImg" src="images/money0.png" />
				<div class="startCardContent">
					<span id="wonMoney" class=""><?php echo($wonMoney); ?></span>
					<br/>
					<div class="startCardSubContent"><?php echo $lang['victory']; ?></div>
				</div>		
			</div>




			<div class="block-content" style="padding-top: 12px;">			
				<div style="text-align:right;">
					<a href="<?php echo $returnPage; ?>" class="backButton href="#"><?php echo $lang['return']; ?></a>
					<a class="startButton" href="<?php echo $returnPage; ?>"><?php echo $lang['continue']; ?></a>
				</div>
			</div>
		</div>






		<div  id="modalFrame_Results-gifts" class="block-content modalFloater isInvisible">
			<div class="title">CADEAUX</div>		
		</div>



		
		<table id="modalFrame_Results-tableMarks" style="margin:auto;padding-bottom: 30px;padding-top: 0px;" class="tableMark modalFloater isInvisible">
			<tr>
				<td colspan="2" style="width:100%;"><?php echo $lang['selfasses']; ?></td>
			</tr>

			<tr>
				<td style="width:50%;">
					<button class="result-ok buttonEvaluation"  id="modalFrame_Results-result-OK" onclick="
					navigateModals('modalFrame_Results-xp');
				// $('.unit-finished').removeClass('result-neutral');	
				// $('.unit-finished').addClass('result-ok');	
				$('.dateSiKO').hide();	
				var res = score1a + ':' + score1q + ';' + score2a + ':' + score2q; 
				insertNoteAndUpdateXP(currentBpm, chosenDrill, 1, nextInterval, points, pointsLvl, levelAfter, totalMoney, drillAchievementOut, ''); 				
				setTimeout(function() {
					move('xpProgressBar', 
						<?php echo($wonPoints); ?>, 
						'character-xp', 
						'character-levelPointsSize',
						<?php echo($levelPointsSize); ?>, 
						<?php echo($nextLevelPointsSize); ?>, 
						<?php echo($nextLevelPointsSize2); ?>);
				}, 1000)

				" type="submit">
				<img src="images/thumbUp.svg" alt="OK" />
			</button>
		</td>
		<td style="width:50%;">
			<button class="result-ko buttonEvaluation"  id="modalFrame_Results-result-KO" onclick="
			navigateModals('modalFrame_Results-life');

			// $('.unit-finished').removeClass('result-neutral');	
			// $('.unit-finished').addClass('result-ko');
			$('.dateSiOK').hide();
			var res = score1a + ':' + score1q + ';' + score2a + ':' + score2q; 
			insertNoteAndUpdateLife(currentBpm, chosenDrill, 0, 1, subtractedLife, '');
			setTimeout(function() {
				moveLife('lifeProgressBar', 
					life, 
					lostLife);
			}, 1000)

			" type="submit">
			<img src="images/thumbDown.svg" alt="KO" />
		</button>
	</td>
</tr>
<tr class="hint">
	<td>
		<?php echo($lang['nextRevision']); ?>:
		<br/>
		<?php 										
		setlocale(LC_ALL, $language);	
		echo(strftime("%x", strtotime($nextIntervalDate)));
		if($nextInterval == 1) echo sprintf($lang['nbDay'], $nextInterval); 
		else echo sprintf($lang['nbDays'], $nextInterval); 

		?>
	</td>
	<td><?php echo($lang['nextRevision']); ?>:<br/><?php echo($lang['tomorrowOneDay']); ?></td>
</tr>
</table>

</div>

</div>	

