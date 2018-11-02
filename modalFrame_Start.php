<div class="modal-frame">
	<div class="main-block" id="startCard">
		<div class="block-content startModuleTitle">

			<div style="text-align:left;">
				<div class="title">
					
				</div>
				<h3></h3>
			</div>
		</div>

		<div class="block-content" style="background:#29A9E6;position:relative;height:125px">
			<div style="text-align:center;color:#fff !important;position:absolute;width:50%;left:0px;top:0px;">
				<div  id="drill-restore" class="drill-frame" onclick="submit_form_choose_drill(selectedDrill, bpm);">	
				</div>
			</div>
			<div style="font-family: 'Roboto', Helvetica, Arial;color: #fff;font-weight: 100;position: absolute;left: calc(50% + 95px);top: 47px;">BPM</div>
			<input style="position:absolute;left: 50%;text-align: left;top: 0px;" id="BPMInput" class="BPMInput" size="3" type="number" step="1" min="10" max="220">

			<div id="globalResult" style="position:absolute;height: 40%;width:50%;right:0px;bottom: 14px;font-family: 'Roboto', Helvetica, Arial;color: #fff;text-align: left;font-weight: 300;text-transform: uppercase;font-size: 12px;">
				<!-- <div>Premier essai de l'unité</div> -->
				<div style="position:absolute;width:100%;left:0px;top:0px;height:33.3333%;"><?php echo($lang['previous_result']); ?> :</div>

				<div id="previousResult">
					<div style="position:absolute;width:70%;left:0px;top:33.3333%;height:33.3333%;"><?php echo($lang['phase1']); ?>: <span id="score1a"></span>/<span id="score1q"></span></div>
					<div style="position:absolute;width:70%;left:0px;top:66.6666%;height:33.3333%;"><?php echo($lang['phase2']); ?>: <span id="score2a"></span>/<span id="score2q"></span></div>

					<div id="previousNote" style="position:absolute;width: 40%;vertical-align: middle;right:5px;top:33.3333%;height:66.6666%;text-align: left;font-size: 26px;font-weight: 300;">
					</div>
				</div>

				<div id="previousNoteSimple">
					<div style="position:absolute;width:100%;left:0px;
					top:33.3333%;height:66.6666%;">
					<img id="thumbImg" src="images/thumbUp.svg" class="thumb"/>
				</div>

			</div>


		</div>
	</div>	

	<div class="block-content bcCard" id="dueLabel">	
		<img src="images/date.svg"/>

		<div class="startCardContent">
			<?php echo($lang['nextRevision']); ?> <span id="dueStart"></span>
			<br/>
			<div class="startCardSubContent"><?php echo($lang['spacedRepetition']); ?></div>
		</div>			
	</div>

	<div class="block-content bcCard" id="scoreLabel" onclick="speedClick(true);" style="cursor:pointer;">		
		<img src="images/up.svg"/>	
		<div class="startCardContent">
			<?php echo($lang['speedUp']); ?> (+5)
			<br/>
			<div class="startCardSubContent"><?php echo($lang['goodPreviousResult']); ?></div>
		</div>		
	</div>

	<div class="block-content bcCard isInvisible" id="scoreLabel2" onclick="speedClick(false);" style="cursor:pointer;">		
		<img src="images/down.svg"/>	
		<div class="startCardContent">
			<?php echo($lang['slowDown']); ?> (-5)
			<br/>
			<div class="startCardSubContent"><?php echo($lang['badPreviousResult']); ?></div>
		</div>		
	</div>


	<div class="block-content bcCard" id="noguitLabel" onclick="noguitClick();" style="cursor:pointer;">		
		<img src="images/micOn.svg"/>	
		<div class="startCardContent">
			<?php echo($lang['useGuitar']); ?>
			<br/>
			<div class="startCardSubContent"><?php echo($lang['audioActivated']); ?></div>
		</div>		
	</div>

	<div class="block-content bcCard isInvisible" id="noguitLabel2" onclick="noguitClick();" style="cursor:pointer;">		
		<img src="images/micOff.svg"/>	
		<div class="startCardContent">
			<?php echo($lang['autoEv']); ?>
			<br/>
			<div class="startCardSubContent"><?php echo($lang['audioDisabled']); ?></div>
		</div>		
	</div>

		
		<div class="block-content" style="padding-top: 12px;">
			
			<div style="text-align:right;">
				<span class="modalToogler backButton" href="#"><?php echo($lang['return']); ?></span>
				<a class="startButton" onclick="submit_form_choose_drill(selectedDrill, bpm);"><?php echo($lang['start']); ?></a>
			</div>
		</div>
	</div>
</div>

<form id="form_choose_drill" action="fxm.php?page=drill"  method="post">								
	<input id="chosenDrill" name="chosenDrill" type="hidden"> 
	<input id="bpm" name="bpm" type="hidden">      
	<input id="noguitar" name="noguitar" type="hidden">      
</form>
<script type="text/javascript">
	function submit_form_choose_drill(exo)
	{
		$('#chosenDrill')[0].value = exo;		
		$('#bpm')[0].value = $('#BPMInput')[0].value > 220 ? 220 : $('#BPMInput')[0].value;
		$('#noguitar')[0].value = noguit;//$('#noguitarCheck')[0].checked;
		/*console.log($('#noguitar')[0].value);
		console.log($('#noguitarCheck')[0].checked);*/
		$('#form_choose_drill')[0].submit(); 
		return false;
	}
</script>