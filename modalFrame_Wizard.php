
<div class="modal-frame-wizard" id="modalFrame_Wizard">
	<div class="main-block wizardBlock">
		<div class="block-content" style="cursor:pointer;">

			<div id="modalFrame_WizardDash-0x" next="modalFrame_WizardDash-01bis" previous="" class="block-content modalFloater isInvisible">			
				<h3><?php echo($lang['wizDash01']); ?></h3><p></p>
				<?php echo($lang['wizDash02']); ?>
			</div>

			<div id="modalFrame_WizardDash-01"  next="modalFrame_WizardDash-02" previous="" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash01']); ?></h3><p></p>
				<?php echo($lang['wizDash04']); ?>
				<div class="divimg"><img width="230px" style="" src="images/<?php echo($language); ?>/instruc01.png" /></div>
			</div>

			<div id="modalFrame_WizardDash-02"  next="modalFrame_WizardDash-07" previous="modalFrame_WizardDash-01" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash05']); ?></h3><p></p>
				<?php echo($lang['wizDash06']); ?>
				<div class="divimg"><img  width="100%" style="max-width:336px;"  src="images/<?php echo($language); ?>/instruc02.png" /></div>
			</div>

			<div id="modalFrame_WizardDash-03"  next="modalFrame_WizardDash-04" previous="modalFrame_WizardDash-02" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash07']); ?></h3><p></p>
				<?php echo($lang['wizDash08']); ?>
			</div>

			<div id="modalFrame_WizardDash-04"  next="modalFrame_WizardDash-07" previous="modalFrame_WizardDash-02" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash09']); ?></h3><p></p>
				<?php echo($lang['wizDash10']); ?>
				<div class="divimg"><img width="230px" style="" src="images/<?php echo($language); ?>/instruc01.png" /></div>
			</div>

			<div id="modalFrame_WizardDash-06"  next="modalFrame_WizardDash-07" previous="modalFrame_WizardDash-02" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash11']); ?></h3><p></p>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/wiz03.png" /></div>
				<?php echo($lang['wizDash12']); ?>
			</div>

			<div id="modalFrame_WizardDash-07"  next="modalFrame_WizardDash-08" previous="modalFrame_WizardDash-02" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash13']); ?></h3><p></p>

				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/wiz03.png" /></div>
				<?php echo($lang['wizDash14']); ?>
			</div>

			<div id="modalFrame_WizardDash-08"  next="modalFrame_WizardDash-10" previous="modalFrame_WizardDash-07" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash15']); ?></h3><p></p>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/wiz03.png" /></div>
				<?php echo($lang['wizDash16']); ?>
			</div>

			<div id="modalFrame_WizardDash-09"  next="modalFrame_WizardDash-10" previous="modalFrame_WizardDash-08" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash17']); ?></h3><p></p>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/wiz03.png" /></div>
				<?php echo($lang['wizDash18']); ?>
			</div>

			<div id="modalFrame_WizardDash-10"  next="modalFrame_WizardDash-11" previous="modalFrame_WizardDash-08" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash19']); ?></h3><p></p>
				<!-- <?php echo($lang['wizDash20']); ?> -->
				<!-- <div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instruc03.png" /></div> -->
				<?php echo($lang['wizDash21']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instruc04.png" /></div>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instruc05.png" /></div>
			</div>

			<div id="modalFrame_WizardDash-11"  next="modalFrame_WizardDash-12" previous="modalFrame_WizardDash-10" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash22']); ?></h3><p></p>
				<?php echo($lang['wizDash23']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instruc06.png" /></div>
				<?php echo($lang['wizDash24']); ?>		
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instruc07.png" /></div>
			</div>	

			<div id="modalFrame_WizardDash-12"  next="modalFrame_WizardDash-13" previous="modalFrame_WizardDash-11" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash25']); ?></h3><p></p>
				<?php echo($lang['wizDash26']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instruc09.png" /></div>
				<?php echo($lang['wizDash27']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instruc08.png" /></div>
			</div>

			<div onclick="closeWizard();updateWizard(<?php echo $user->getUID(); ?>, 2);" id="modalFrame_WizardDash-13"  next="" previous="modalFrame_WizardDash-12" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDash28']); ?></h3><p></p>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instruc10.png" /></div>
				<?php echo($lang['wizDash29']); ?>
			</div>








			<div previous="" id="modalFrame_WizardProgression-01" next="modalFrame_WizardProgression-02" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizProg01']); ?></h3><p/>
				<?php echo($lang['wizProg02']); ?>
				<div class="divimg"><img width="100%" style="max-width:266px;"  style="" src="images/<?php echo($language); ?>/progress01.png" /></div>
				<?php echo($lang['wizProg03']); ?>										
			</div>


			<div onclick="closeWizard();" previous="modalFrame_WizardProgression-01" id="modalFrame_WizardProgression-02" next="" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizProg04']); ?></h3><p/>				
				<?php echo($lang['wizProg05']); ?>									
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/progress02.png" /></div>
			</div>





			<div previous="" id="modalFrame_WizardDrill-01" next="modalFrame_WizardDrill-02" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill01']); ?></h3><p/>
				<?php echo($lang['wizDrill02']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instrucDrill02.png" /></div>				
				<?php echo($lang['wizDrill03']); ?>
			</div>

			<div previous="modalFrame_WizardDrill-01" id="modalFrame_WizardDrill-02" next="modalFrame_WizardDrill-02bis" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill04']); ?></h3><p/>
				<?php echo($lang['wizDrill05']); ?>
				<div class="divimg"><img width="230px" style="" src="images/<?php echo($language); ?>/wiz13.png" /></div>
				<?php echo($lang['wizDrill06']); ?>
				<div class="divimg"><img  width="100%" style="max-width:358px;"  style="" src="images/<?php echo($language); ?>/instrucDrill04.png" /></div>
				<?php echo($lang['wizDrill07']); ?>
			</div>

			<div previous="modalFrame_WizardDrill-02" id="modalFrame_WizardDrill-02bis" next="modalFrame_WizardDrill-03" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill08']); ?></h3><p/>
				<?php echo($lang['wizDrill09']); ?>
				<div class="divimg"><img width="100%" style="max-width:358px;" src="images/<?php echo($language); ?>/instrucDrill05.png" /></div>
			</div>

			<div previous="modalFrame_WizardDrill-02bis" id="modalFrame_WizardDrill-03" next="modalFrame_WizardDrill-05" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill10']); ?></h3><p/>
				<?php echo($lang['wizDrill11']); ?>
			</div>

			<div previous="modalFrame_WizardDrill-03" id="modalFrame_WizardDrill-05" next="modalFrame_WizardDrill-06" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill12']); ?></h3><p/>
				<?php echo($lang['wizDrill13']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/wiz12.png" /></div>
			</div>

			<div previous="modalFrame_WizardDrill-05" id="modalFrame_WizardDrill-06" next="modalFrame_WizardDrill-07" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill14']); ?></h3><p/>
				<?php echo($lang['wizDrill15']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/wiz12.png" /></div>
			</div>

			<div previous="modalFrame_WizardDrill-06" id="modalFrame_WizardDrill-07" next="modalFrame_WizardDrill-08" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill16']); ?></h3><p/>
				<div class="divimg"><img width="50px" style="" src="images/<?php echo($language); ?>/micSplash.png" /></div>
				<?php echo($lang['wizDrill17']); ?>
			</div>

			<div previous="modalFrame_WizardDrill-07" id="modalFrame_WizardDrill-08" next="modalFrame_WizardDrill-09" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill18']); ?></h3><p/>
				<?php echo($lang['wizDrill19']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instrucDrill03.png" /></div>
			</div>


			<div previous="modalFrame_WizardDrill-08" id="modalFrame_WizardDrill-09" next="modalFrame_WizardDrill-10" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill20']); ?></h3><p/>
				<?php echo($lang['wizDrill21']); ?>
				<div class="divimg"><img width="" style="" src="images/<?php echo($language); ?>/instrucDrill08.png" /></div>
				<?php echo($lang['wizDrill22']); ?>
			</div>


			<div previous="modalFrame_WizardDrill-09" id="modalFrame_WizardDrill-10" next="modalFrame_WizardDrill-12" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill23']); ?></h3><p/>
				<?php echo($lang['wizDrill24']); ?>
				<div class="divimg"><img width="230px" style="" src="images/<?php echo($language); ?>/instrucDrill06.png" /></div>
				<?php echo($lang['wizDrill25']); ?>
			</div>

			<div onclick="closeWizard();" previous="modalFrame_WizardDrill-10" id="modalFrame_WizardDrill-12" next="" class="block-content modalFloater isInvisible">
				<h3><?php echo($lang['wizDrill26']); ?></h3><p/>
				<?php echo($lang['wizDrill27']); ?>
			</div>


			<div class="block-content" style="padding-top: 12px;">			
				<div style="text-align:right;">


					<a id="skipButton" class="backButton" onclick="closeWizard();updateWizard(<?php echo $user->getUID(); ?>, 1);"><?php echo($lang['wizSkip']); ?></a>
					<a id="previousButton" class="backButton" onclick="goPreviousFrame();"><</a>
					<a id="nextButton" class="startButton" onclick="goNextFrame();">></a>
					<a id="nextButton1" class="startButton" onclick="closeWizard();updateWizard(<?php echo $user->getUID(); ?>, 2);"><?php echo($lang['wizOK']); ?></a>

					


				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var previousFrame = "";
	var nextFrame = "";
	var currentFrame = "modalFrame_WizardDash-01";
	
	
	$('#modalFrame_Wizard .modalFloater').click(function(e){
		if($("#"+currentFrame).attr("next") != "")
		{
			goNextFrame();
		}
	});



	function goNextFrame()
	{		
		previousFrame = $("#"+currentFrame).attr("previous");
		nextFrame = $("#"+currentFrame).attr("next");
		navigateModals(nextFrame);
		currentFrame = nextFrame;

		if($("#"+currentFrame).attr("next") == "") /* Si c'est la dernière page*/ 
		{
			$("#nextButton").hide();
			$("#nextButton1").show();	



		}
		else
		{
			$("#nextButton").show();
		}

		if($("#"+currentFrame).attr("previous") == "") /* Si c'est la 1ere page*/ 
		{
			$("#previousButton").hide();
		}
		else
		{
			$("#previousButton").show();
		}

	}
	function goPreviousFrame()
	{
		previousFrame = $("#"+currentFrame).attr("previous");
		nextFrame = $("#"+currentFrame).attr("next");
		navigateModals(previousFrame);
		currentFrame = previousFrame;

		if($("#"+currentFrame).attr("next") == "") /* Si c'est la dernière page*/ 
		{
			$("#nextButton").hide();
			$("#nextButton1").show();

		}
		else
		{
			$("#nextButton").show();
			$("#nextButton1").hide();
		}

		if($("#"+currentFrame).attr("previous") == "") /* Si c'est la 1ere page*/ 
		{
			$("#previousButton").hide();
		}
		else
		{
			$("#previousButton").show();
		}



	}


</script>