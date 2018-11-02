<?php 





include("php/drillTools.php"); 


















// or just output the content


?>

<script type="text/javascript" src="js/app.js"></script>   
<script>
	
	window.onload = function(event) {
		navigateWizard("modalFrame_WizardDash-01");
	}; 

</script>


<div class="modal-frame-wizard" id="modalFrame_Wizard">
	<div class="main-block">
		<div class="block-content" style="cursor:pointer;">
			Minify

			<div id="modalFrame_WizardDash-01" next="" previous="" class="block-content modalFloater isInvisible">			
				<?php 

				//$sourcePath = 'js/game.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'test.min.js';$minifier->minify();


/*

$sourcePath = 'js/dash.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'dash.js';$minifier->minify();
$sourcePath = 'js/drill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'drill.js';$minifier->minify();
$sourcePath = 'js/drums.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'drums.js';$minifier->minify();
$sourcePath = 'js/earxDrill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'earxDrill.js';$minifier->minify();
$sourcePath = 'js/fbCanvas.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'fbCanvas.js';$minifier->minify();
$sourcePath = 'js/fbLogic.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'fbLogic.js';$minifier->minify();
$sourcePath = 'js/fretxDrill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'fretxDrill.js';$minifier->minify();
$sourcePath = 'js/game.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'game.js';$minifier->minify();
$sourcePath = 'js/guitarListener.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'guitarListener.js';$minifier->minify();
$sourcePath = 'js/init.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'init.js';$minifier->minify();
$sourcePath = 'js/jquery-1.11.2.min.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jquery-1.11.2.min.js';$minifier->minify();
$sourcePath = 'js/met.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'met.js';$minifier->minify();
$sourcePath = 'js/mustache.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'mustache.js';$minifier->minify();
$sourcePath = 'js/NoSleep.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'NoSleep.js';$minifier->minify();
$sourcePath = 'js/NoSleep.min.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'NoSleep.min.js';$minifier->minify();
$sourcePath = 'js/notationSystem.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'notationSystem.js';$minifier->minify();
$sourcePath = 'js/notif.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'notif.js';$minifier->minify();
$sourcePath = 'js/pyramid.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'pyramid.js';$minifier->minify();
$sourcePath = 'js/results.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'results.js';$minifier->minify();
$sourcePath = 'js/schedulerEngine.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'schedulerEngine.js';$minifier->minify();
$sourcePath = 'js/sheetGuitar.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'sheetGuitar.js';$minifier->minify();
$sourcePath = 'js/sheetPiano.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'sheetPiano.js';$minifier->minify();
$sourcePath = 'js/soundSystem.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'soundSystem.js';$minifier->minify();
$sourcePath = 'js/splash.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'splash.js';$minifier->minify();*/

				
// we can even add another file, they'll then be
// joined in 1 output file
//$sourcePath2 = 'js/met.js';
//$minifier->add($sourcePath2);

// or we can just add plain CSS
//$css = 'body { color: #000000; }';
//$minifier->add($css);

// save minified file to disk

				?>

				Bonjour et bienvenue !
				<p></p>
				Voyons comment va se passer cette formation qui vous guidera pas à pas vers la maîtrise du manche de guitare...
			</div>

			<!--

			<span id="previousButton" style="float:left;" class="hint" onclick="goPreviousFrame();">< Précédent</span>
			<span id="nextButton" style="float:right;" class="hint" onclick="goNextFrame();">Continuer ></span>
			<span id="nextButton1" style="float:right;" class="hint isInvisible" onclick="closeWizard();">Commencer ></span>
			<div style="width:100%;text-align:center;"><div id="skipButton"  class="hint" style="width:50px;display:block;margin:auto;padding-top: 30px;" onclick="closeWizard();">Passer</div></div>-->

		</div>
	</div>
</div>

<script>
	var previousFrame = "";
	var nextFrame = "";
	var currentFrame = "modalFrame_WizardDash-01";
	
	/*
	$('#modalFrame_Wizard .modalFloater').click(function(e){
		if($("#"+currentFrame).attr("next") != "")
		{
			goNextFrame();
		}
	});
	*/


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