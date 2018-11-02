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



				$sourcePath = './css/app.css';$minifier = new Minify\CSS($sourcePath);$minifiedPath = './cssmin/app.css';echo $minifier->minify($minifiedPath);
				$sourcePath = './css/responsive.css';$minifier = new Minify\CSS($sourcePath);$minifiedPath = './cssmin/responsive.css';echo $minifier->minify($minifiedPath);



				$sourcePath = 'js/app.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/app.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/base64-binary.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/base64-binary.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/content_dailyRoutine_ax.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/content_dailyRoutine_ax.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/content_login_ax.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/content_login_ax.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/dailyRoutineChrono.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/dailyRoutineChrono.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/dash.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/dash.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/drill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/drill.js';echo $minifier->minify($minifiedPath);
				//$sourcePath = 'js/drums.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/drums.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/earxDrill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/earxDrill.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/fbCanvas.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/fbCanvas.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/fbLogic.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/fbLogic.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/fretxDrill.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/fretxDrill.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/game.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/game.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/guitarListener.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/guitarListener.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/init.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/init.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/jquery-1.11.2.min.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/jquery-1.11.2.min.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/met.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/met.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/mustache.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/mustache.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/NoSleep.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/NoSleep.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/NoSleep.min.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/NoSleep.min.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/notationSystem.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/notationSystem.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/notif.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/notif.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/pyramid.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/pyramid.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/results.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/results.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/schedulerEngine.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/schedulerEngine.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/sheetGuitar.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/sheetGuitar.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/sheetPiano.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/sheetPiano.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/soundSystem.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/soundSystem.js';echo $minifier->minify($minifiedPath);
				$sourcePath = 'js/splash.js';$minifier = new Minify\JS($sourcePath);$minifiedPath = 'jsmin/splash.js';echo $minifier->minify($minifiedPath);


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