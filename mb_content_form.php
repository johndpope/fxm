<script type="text/javascript" src="js/app.js"></script> 
<script>	
	window.onload = function(event) {
		navigateWizard("modalFrame_WizardDash-01");
	}; 
</script>

<div class="modal-frame-wizard" id="modalFrame_Wizard">
	<div class="main-block">
		<div class="block-content" style="cursor:pointer;">		
			<div id="modalFrame_WizardDash-01" next="modalFrame_WizardDash-02" previous="" class="block-content modalFloater isInvisible">
				<?php
				if(isset($_GET["id"]))
				{
					?>
					<h3>Entrez votre adresse email pour recevoir votre fichier</h3>		
					<script type="text/javascript" src="//www.musicianbooster.com/2.9.2/form/generate.js?id=<?php echo $_GET["id"] ?>"></script>
					<p></p>
					<?php
				}
				else
					{?>
						<h3>Erreur d'accès</h3>		
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<script>
		var previousFrame = "";
		var nextFrame = "";
		var currentFrame = "modalFrame_WizardDash-01";


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