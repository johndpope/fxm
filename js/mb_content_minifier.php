<?php 

require './vendor/autoload.php';
include("php/drillTools.php"); 

use MatthiasMullie\Minify;

// or just output the content


?>

<script>
	
	window.onload = function(event) {
		//navigateWizard("modalFrame_WizardDash-01");
	}; 

</script>


<div class="modal-frame-wizard" id="modalFrame_Wizard">
	<div class="main-block">
		<div class="block-content" style="cursor:pointer;font-size:7px;font-family:consolas">
			Minify

			<div id="modalFrame_WizardDash-01" next="" previous="" class="block-content modalFloater isInvisible">			
				<?php 



				$sourcePath = './cssBIG/app.css';$minifier = new Minify\CSS($sourcePath);$minifiedPath = './css/app.css';echo $minifier->minify($minifiedPath);
				$sourcePath = './cssBIG/responsive.css';$minifier = new Minify\CSS($sourcePath);$minifiedPath = './css/responsive.css';echo $minifier->minify($minifiedPath);



				$sourcePath = 'jsBIG/app.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/app.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/base64-binary.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/base64-binary.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/content_dailyRoutine_ax.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/content_dailyRoutine_ax.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/content_login_ax.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/content_login_ax.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/dailyRoutineChrono.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/dailyRoutineChrono.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/dash.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/dash.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/drill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/drill.js';echo $minifier->minify($minifiedPath);
				//$sourcePath = 'jsBIG/drums.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/drums.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/earxDrill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/earxDrill.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/fbCanvas.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/fbCanvas.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/fbLogic.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/fbLogic.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/fretxDrill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/fretxDrill.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/game.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/game.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/guitarListener.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/guitarListener.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/init.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/init.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/jquery-1.11.2.min.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/jquery-1.11.2.min.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/met.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/met.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/mustache.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/mustache.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/NoSleep.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/NoSleep.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/NoSleep.min.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/NoSleep.min.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/notationSystem.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/notationSystem.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/notif.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/notif.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/pyramid.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/pyramid.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/results.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/results.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/schedulerEngine.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/schedulerEngine.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/sheetGuitar.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/sheetGuitar.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/sheetPiano.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/sheetPiano.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/soundSystem.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/soundSystem.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'jsBIG/splash.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'js/splash.js';echo $minifier->minify($minifiedPath);


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