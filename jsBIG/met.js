//var bpm = 190;


//En cas de rotation de l'écran, on coupe l'éxo pour éviter tout décalage
function doOnOrientationChange()
{
	switch(window.orientation) 
	{  
		case -90:
		case 90:
		pushPlayButtonStop();
		break; 
		default:
		pushPlayButtonStop();
		break; 
	}
}

window.addEventListener('orientationchange', doOnOrientationChange);



window.onresize = fretboard_resize;

//-------------------------------------------------------------------------------------------------------------------------
//RAFRAICHISSEMENT PASTILLES
//-------------------------------------------------------------------------------------------------------------------------
var eightNoteReference = new Array();
var playedNoteReference = new Array();
var currentTime;
var previousTime;
//setTimeout(animationMonitor, 1000);
rAF = window.requestAnimationFrame;
// Fonction jouée en boucle, à fond
function update(timestamp) { ////trace("FCT", "update");

if(!previousTime > 0) previousTime = context.currentTime;
currentTime = context.currentTime;

if((currentTime - previousTime) > 1) pushPlayButtonStop();

var firstNote = eightNoteReference[0];
var myNoteHasBeenPlayed = false;

	//eightNoteReference: liste des croche à jouer, avec leur timing:
	//on a pris le hithat de référence pour la croche (de 0 à 7)	
	
	//Tant que le temps de la note en cours est passée, on vire la note en première position
	//jusqu'a trouver la note suivante qui n'a pas encore été jouée
	while (eightNoteReference.length > 0 && eightNoteReference[0].time < currentTime) {
		
	    //Si on entre ici pour la première fois (1er tour de boucle), c'est que notre note vient d'être jouée
		//On déclenche donc l'affichage
		if(!myNoteHasBeenPlayed)
		{
			////trace("06", "note en cours: "+eightNoteReference[0].beat);
			drills_playBEAT(); 
			myNoteHasBeenPlayed = true;
			
			//bizarre mais parfois eightNoteReference est parfois à 0 et on rentre qd mm ici...	
			if(eightNoteReference.length > 0)
			{
				//Mettre à jour le compteur de temps
				if(document.getElementById('beat') && document.getElementById('beat2'))
				{
					document.getElementById('beat').innerHTML = eightNoteReference[0].beat+1;	
					document.getElementById('beat2').innerHTML = catchupCounter+1;	
				}
				//RATTRAPAGE DE RETARD POSSIBLE
				var shift = (eightNoteReference[0].beat+1) - (catchupCounter+1);
				
				if(shift > 0)
				{
					//trace("07", "DECALAGE DE "+shift);
					for (i = 0; i < shift; i++) { 
						drills_playBEAT(); 
					}
				}
			}
			//document.getElementById('secb1').innerHTML = currentTime;	
		}
		
		//At position 0, remove 1 items:
		eightNoteReference.splice(0, 1);
		//Donc la suivante devient la premère etc.		
	}
	myNoteHasBeenPlayed = false;
	
	//if (firstNote != eightNoteReference[0])
	previousTime = context.currentTime;	
	rAF(update);
}


function animationMonitor()
{
	if(!previousTime > 0) previousTime = context.currentTime;
	currentTime = context.currentTime;
	
	if((currentTime - previousTime) > 0.5) pushPlayButtonStop();
	setTimeout(animationMonitor, 500);
}

var RhythmSample = {};
var schedulingTimer; // Timer de déclenchement régulier de la planification des notes (sound_soundsSchedule)

var element = document.body; // Make the body go full screen.


function metronomeDisplayPlay(){
	if(document.getElementById("MetPauseButton")){
		var element = document.getElementById("MetPauseButton");	
		element.classList.remove("invisible");
		element.classList.add("visible");
		
		element = document.getElementById("MetPauseButtonMini");	
		element.classList.remove("invisible");
		element.classList.add("visible");
		
		element = document.getElementById("MetPlayButton");	
		element.classList.remove("visible");
		element.classList.add("invisible");
		
		element = document.getElementById("MetPlayButtonMini");	
		element.classList.remove("visible");
		element.classList.add("invisible");
	}
}

function metronomeDisplayPause(){
	if(document.getElementById("MetPauseButton")){
		var element = document.getElementById("MetPauseButton");	
		element.classList.remove("visible");
		element.classList.add("invisible");
		
		element = document.getElementById("MetPauseButtonMini");	
		element.classList.remove("visible");
		element.classList.add("invisible");
		
		element = document.getElementById("MetPlayButton");	
		element.classList.remove("invisible");
		element.classList.add("visible");
		
		element = document.getElementById("MetPlayButtonMini");	
		element.classList.remove("invisible");
		element.classList.add("visible");
	}
}

function metronomeDisplayStop(){
	if(document.getElementById("MetPauseButton")){
		var element = document.getElementById("MetPauseButton");	
		element.classList.remove("visible");
		element.classList.add("invisible");
		
		element = document.getElementById("MetPauseButtonMini");	
		element.classList.remove("visible");
		element.classList.add("invisible");
		
		element = document.getElementById("MetPlayButton");	
		element.classList.remove("invisible");
		element.classList.add("visible");
		
		element = document.getElementById("MetPlayButtonMini");	
		element.classList.remove("invisible");
		element.classList.add("visible");
	}
}



var noSleep = new NoSleep();
var play;

RhythmSample.play = function() { 



	rAF(update);

	firstBlankBar=firstBlankBarPARAM;

	RhythmSample.stop();

	/*var video = document.getElementById("Video1");*/
	/*
	if (video && video.paused) {
		video.play();
	} */
	noSleep.enable();


	sound_soundsSchedule(0, 0);
	drill = drillToSchedule;	
	//document.body.scrollTop = document.documentElement.scrollTop = 0;
	//window.location.hash =  '#fretboardCanvas';
	//trace("10",element.scrollTop+" SCROLL")
	if(document.getElementById("header")) {
		
		//trace("10",document.getElementById("header").offsetHeight+" offsetHeight")
		
		if(element.scrollTop > document.getElementById("header").offsetHeight)
		{
			if(document.getElementById("fretboardCanvas")) {window.scrollTo(0,1);document.getElementById("fretboardCanvas").scrollIntoView();window.scrollBy(0, -26);}
		}
	}
	
	if(document.getElementById("metronomeContainer")) {window.scrollTo(0,1);document.getElementById("metronomeContainer").scrollIntoView(); window.scrollBy(0, -26);}
	
	clearTimeout(timer);
	//trace("11",drillCode+"888");
	if((infiniteDrill == true && drillCode != "ALL") || pyramid) chronoRebours(); //pour l'instant, si drill fini, pas de rebours
	catchupCounter = -1;
	
	if(document.getElementById("overCanvas")) document.getElementById("overCanvas").style.zIndex = "-1";
	
	
	if(document.getElementById("playerTitle")) document.getElementById("playerTitle").style.display="none";
	if(document.getElementById("playerTitle1")) document.getElementById("playerTitle1").style.display="none";
	if(document.getElementById("playerTitle2")) document.getElementById("playerTitle2").style.display="none";
	
	if(fretboardingLearningType == "FLPosToNote" && document.getElementById("playerTitle1")) document.getElementById("playerTitle1").style.display="inline-block";
	if(fretboardingLearningType == "FLNoteToPos" && document.getElementById("playerTitle2")) document.getElementById("playerTitle2").style.display="inline-block";
	metronomeDisplayPlay();
	
	play = true;

	var displayer;
};

var paused = 0;
var stepToKeep;

var onlyOneStopper = true;


RhythmSample.pause = function() { 	
	//trace("11", "RhythmSample.pause 1 - stepEncours : "+stepEncours);
	clearTimeout(nextStepEnCoursTimer);
	clearTimeout(nextStepEnCoursTimer2);
	stepToKeep = stepEncours;
	paused = 2;
	RhythmSample.stop();
	paused = 1;
	//stepEncours = stepToKeep - 1;
	//trace("11", "RhythmSample.pause 2 - stepEncours : "+stepEncours);
	metronomeDisplayPause();
}


RhythmSample.stop = function() { //trace("FCT", "RhythmSample.stop");
	//vidplay();
	//Parcourt le tableau des sons planifiés et les stoppent tous
	
	//trace("11", "RhythmSample.stop -  : ");

	metronomeDisplayStop();
	
	for (i = 0; i < sourceTable.length; i++) {
		sourceTable[i].src.stop(0);		
	}
	
	var len = sourceTable.length;
	var i = 0;
	for (a = 0; a < len; a++) {
		//sourceTable[i].src.stop(0); 
		sourceTable.splice(i, 1);	
	}
	
	// Vidage de eightNoteReference 
	eightNoteReference = new Array();
	playedNoteReference = new Array();
	
	//RAZ des compteurs de drill (pour redemarre de 0 à la prochaine exec)
	drillcounter = 0;
	notecounter = 0;
	drillcounterSOUND = 0;
	notecounterSOUND = 0;
	
	status = "Q"; //s'assurer de recommencer par une question au prochain
	fretboard_emptyUpLayer(); //vide le manche des pastilles
	
	
	
	drillRhythmCpt = 0; // RAZ compteur pour executer le rythme de playBEAT (1 sur 2 etc.)par rapport au tick de référence
	
	clearTimeout(timer);
	chronoCourant = chrono;
	updateTimeBar();
	
	// Arrêt de la planification
	clearTimeout(schedulingTimer);
	
	
	if(document.getElementById('sheetMusic')) sheet_updateSheetWithNote();
	
	if(document.getElementById("playerTitle")) document.getElementById("playerTitle").style.display="inline-block";
	
	
	clearTimeout(nextStepEnCoursTimer);
	clearTimeout(nextStepEnCoursTimer2);
	
	
	if(paused != 1 && paused != 2) stepEncours = 0;	

	if(paused == 1)	stepEncours--;
	paused = 0;

	noSleep.disable();

	play = false;
}



var drillcounterSOUND = 0;
var notecounterSOUND = 0; 


//----------------------------------------------------------------------------------------------------


var drillBPMLimit1;
var drillBPMLimit2;


var timer;
function chronoRebours()
{
	chronoCourant--;	
	updateTimeBar();
	
	if(chronoCourant > 0) timer = setTimeout(chronoRebours,1000);		
	else 
	{	
		phaseEnCours++;
		$('.pianoBlock').addClass("isInvisible");
		$('.sheetBlock').removeClass("isInvisible");

		$('#phase1Instruction').addClass("isInvisible");
		$('#phase2Instruction').removeClass("isInvisible");

		if(!noguitar)
		{
			guitarListener();
			guitarVolume = 0;
		}
		gameCounter = 0;
		if(drillCode == "test")
		{
			phaseEnCours--;
			indexPiano++;
			DEBUGPIANO_note1 ="";
			DEBUGPIANO_note2 ="";
			DEBUGPIANO_drillRhythmCpt = 0;
			if(document.getElementById('DEBUGPIANO')) document.getElementById('DEBUGPIANO').innerHTML = "";
		}

		if(phaseEnCours > 2)
		{
			fretboardingLearningType = "FLPosToNote";

			pushPlayButtonStop();

				//Activer l'écran de résultats
				$('.modal-frame').addClass('isInvisible'); 
				$('#modalFrame_Results').removeClass('isInvisible'); 
				$('#modalFrame_Results').addClass('isVisible');	


				if(noguitar) /*si pas de guiatre on chaine directement sur le modal result sans déclencher de maj*/
				{
					navigateModalsInline('modalFrame_Results-tableMarks');
				}
				else /*sinon maj auto*/
				{
					active = false; /*désactivation du moteur de notess*/

					var res = score1a + ':' + score1q + ';' + score2a + ':' + score2q; 
					//var perf = (score1a/score1q) 
					score1 = score1a == 0 ? 0 : (score1a / score1q);
					score2 = score2a == 0 ? 0 : (score2a / score2q);
					var score = Math.round(((score1 + score2)/2)*100);
					console.log(score);

					$('#precent').html(score);
					$('#1a').html(score1a);
					$('#1q').html(score1q);
					$('#2a').html(score2a);
					$('#2q').html(score2q);

					globalDrillResult = score < 90 ? false : true;



					if(globalDrillResult)
					{
						navigateModals('modalFrame_Results-xp');

						// $('.unit-finished').removeClass('result-neutral');	
						// $('.unit-finished').addClass('result-ok');	
						$('.dateSiKO').hide();
						/*MAJ résultat	*/
						insertNoteAndUpdateXP(currentBpm, chosenDrill, 1, nextInterval, points, pointsLvl, levelAfter, totalMoney, drillAchievementOut, res); 

						/*Effets points	*/
						setTimeout(moveOn, 1500);	

					}
					else
					{

						navigateModals('modalFrame_Results-life');

						// $('.unit-finished').removeClass('result-neutral');	
						// $('.unit-finished').addClass('result-ko');
						$('.dateSiOK').hide();
						/*MAJ résultat	*/

						insertNoteAndUpdateLife(currentBpm, chosenDrill, 0, 1, subtractedLife, res);

						/*Effets points	*/
						setTimeout(function() {
							moveLife('lifeProgressBar', 
								life, 
								lostLife);
						}, 1000);
					}
				}

			}
			else
			{
				fretboardingLearningType = "FLNoteToPos";		
				chronoCourant = chrono;
				//RhythmSample.play();
				//RhythmSample.stop();
				pushPlayButton();
			}
		}
	}








	var phaseEnCours;
	var firstBlankBar;
	var firstBlankBarPARAM;
	var force12ifSmallScreen = true;
	var drumVolume;
	var guitarVolume;


	window.onload = function() {

		if(firstDrill && firstDrill == true)
		{		
			navigateWizard("modalFrame_WizardDrill-01");
		}

		noteElem = document.getElementById( "note" );

		drills_setDrill(drillCode);

		$('#fabButton').removeClass('pulse animated').addClass('pulse animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$(this).removeClass('pulse animated');
		});

		// $('.fab').css('background-color','#7EB530')
		$('.fab').addClass('greenButtonPlay');



		$('input[type=range]').on('input', function(e){
			var min = e.target.min,
			max = e.target.max,
			val = e.target.value;

			$(e.target).css({
				'backgroundSize': (val - min) * 100 / (max - min) + '% 100%'
			});
		}).trigger('input');

		
	//Champs BPM limité au limites de l'exo
	
	bpm = 60;
	
	if (typeof currentBpm === 'undefined' || currentBpm === null) {
		bpm = bpm + 0;
	}
	else
	{
		bpm = currentBpm;
	}
	
	if(bpm < 50)
	{
		drillBPMLimit1 = 10;
		drillBPMLimit2 = 49;
	}		
	if(bpm >= 50 && bpm < 80)
	{
		drillBPMLimit1 = 50;
		drillBPMLimit2 = 79;
	}
	if(bpm >= 80 && bpm < 120)
	{
		drillBPMLimit1 = 80;
		drillBPMLimit2 = 119;
	}
	if(bpm >= 120 && bpm < 150)
	{
		drillBPMLimit1 = 120;
		drillBPMLimit2 = 149;
	}
	if(bpm >= 150)
	{
		drillBPMLimit1 = 150;
		drillBPMLimit2 = 250;
	}
	
	
	if(drillCode == "ALL" || drillCode == "test")
	{
		drillBPMLimit1 = 10;
		drillBPMLimit2 = 250;
	}
	
	if(drillCode == "test")
	{
		chrono = 1800;
	}
	
	
	
	
	var bpmElt = document.getElementById("bpm");
	if(bpmElt)
	{
		bpmElt.step = 5;
		bpmElt.value = bpm;
		bpmElt.min = drillBPMLimit1;
		bpmElt.max = drillBPMLimit2;		
	}
	
	var loadingPercentage = Math.round(((bpm - drillBPMLimit1) / (drillBPMLimit2 - drillBPMLimit1))*100);
	if(document.getElementById('progressBPM')) document.getElementById('progressBPM').style.width = loadingPercentage + "%" ;
	
	drumSound = "Highway";
	drumSoundTernaire = "Basic1";
	if(document.getElementById('drumSound')) document.getElementById('drumSound').value = drumSound ;
	if(document.getElementById('drumSoundTernaire')) document.getElementById('drumSoundTernaire').value = drumSoundTernaire ;
	
	
	//pour faire un mesure blanche avant de commencer
	firstBlankBarPARAM = true;
	firstBlankBar = firstBlankBarPARAM;
	
	phaseEnCours = 1;//phase de jeu: 1=posToNote, 2:NoteToPos
	
	
	
	drumVolume = 0.8;
	guitarVolume = 0.8;
	if(document.getElementById('drumVolume')) document.getElementById('drumVolume').value = drumVolume*100;
	if(document.getElementById('guitarVolume')) document.getElementById('guitarVolume').value = guitarVolume*100;
	
	var nbSteps = 16;setElementValue("nbSteps", nbSteps)
	if(document.getElementById('magnifyChartPlus'))  document.getElementById('magnifyChartPlus').style.display = 'none';
	//Calculer les données de la pyramide 
	//pyramid_updatePyramid();
	//Dessiner la pyramide
	//pyramid_createChart();
	//openbox(1);
	
	if(document.getElementById('chrono')) chronoElt   = document.getElementById('chrono');
	if(document.getElementById('chrono2')) chronoElt2 = document.getElementById('chrono2');
	updateTimeBar();
	
	
	
	//si c'est un nouvel exo, on affiche automatiquement les instructions
	if(!(typeof newDrill === 'undefined') && newDrill == "1") 
	{
		//console.log("si c'est un nouvel exo, on affiche automatiquement les instructions");
		//openbox(1);
		//displayInstuctions();
	}

	//ON VIRE LA WAITING QUAND TOUT EST CHARGE					
	$('.modal-frame').toggleClass('isVisible');		

/*


	var pianoCanvas = document.getElementById('pianoCanvas');
	var pianoCanvasCtx = pianoCanvas ? pianoCanvas.getContext("2d") : null;
	pianoCanvas.width = $('#mainBlock').width();
	var blockWidth = $('#mainBlock').width();
	if(blockWidth > 400) blockWidth = 400;
	var keyHeight = blockWidth/1.75;
	pianoCanvas.height = keyHeight+2;


	var pianoColor = "white";
	//if(nb == 10) fretColor = "#FF9494";

	pianoCanvasCtx.fillStyle = pianoColor;
	
	var keyWith = (blockWidth) / 7;
	var blackkeyWith = keyWith/1.5;
	var blackkeyHeight = keyHeight/1.7;
	var start = 0;



	pianoCanvasCtx.fillRect(start + (0*keyWith), 0, keyWith, keyHeight);
	pianoCanvasCtx.fillRect(start + (1*keyWith), 0, keyWith, keyHeight);
	pianoCanvasCtx.fillRect(start + (2*keyWith), 0, keyWith, keyHeight);
	pianoCanvasCtx.fillRect(start + (3*keyWith), 0, keyWith, keyHeight);
	pianoCanvasCtx.fillRect(start + (4*keyWith), 0, keyWith, keyHeight);
	pianoCanvasCtx.fillRect(start + (5*keyWith), 0, keyWith, keyHeight);
	pianoCanvasCtx.fillRect(start + (6*keyWith), 0, keyWith, keyHeight);

	pianoColor = "gray";
	pianoCanvasCtx.fillStyle = pianoColor;

	



	pianoCanvasCtx.fillRect(start + (0*keyWith), 0, 1, keyHeight);
	pianoCanvasCtx.fillRect(start + (1*keyWith), 0, 1, keyHeight);
	pianoCanvasCtx.fillRect(start + (2*keyWith), 0, 1, keyHeight);
	pianoCanvasCtx.fillRect(start + (3*keyWith), 0, 1, keyHeight);
	pianoCanvasCtx.fillRect(start + (4*keyWith), 0, 1, keyHeight);
	pianoCanvasCtx.fillRect(start + (5*keyWith), 0, 1, keyHeight);
	pianoCanvasCtx.fillRect(start + (6*keyWith), 0, 1, keyHeight);
	pianoCanvasCtx.fillRect(start + (7*keyWith - 1), 0, 1, keyHeight);

	pianoCanvasCtx.fillRect(start, start, blockWidth, start+1);
	pianoCanvasCtx.fillRect(start, keyHeight, blockWidth, 1);



	pianoColor = "#29A9E6";
	pianoCanvasCtx.fillStyle = pianoColor;

//pianoCanvasCtx.fillRect(start + (0*keyWith-(blackkeyWith/2)), 0, blackkeyWith, keyHeight/2);
pianoCanvasCtx.fillRect(start + (1*keyWith-(blackkeyWith/2)), 0, blackkeyWith, blackkeyHeight);
pianoCanvasCtx.fillRect(start + (2*keyWith-(blackkeyWith/2)), 0, blackkeyWith, blackkeyHeight);
	//pianoCanvasCtx.fillRect(start + (3*keyWith-(blackkeyWith/2)), 0, blackkeyWith, keyHeight/2);
	pianoCanvasCtx.fillRect(start + (4*keyWith-(blackkeyWith/2)), 0, blackkeyWith, blackkeyHeight);
	pianoCanvasCtx.fillRect(start + (5*keyWith-(blackkeyWith/2)), 0, blackkeyWith, blackkeyHeight);
	pianoCanvasCtx.fillRect(start + (6*keyWith-(blackkeyWith/2)), 0, blackkeyWith, blackkeyHeight);

	*/

	
	//fretboardCanvas.width = 


}

var notesSharp = ["CN", "CD", "DN", "DD", "EN", "FN", "FD", "GN", "GD", "AN", "AD", "BN"];
var notesFlat = ["CN", "DB", "DN", "EB", "EN", "FN", "GB", "GN", "AB", "AN", "BB", "BN"];

var DoMaj = ["C", "D", "E", "F", "G", "A", "B"];
var scaleProgression = "0";

var notes = notesSharp;
var accChoice = "D";
var progressive = false;

var naturalNotes = ["C", "D", "E", "F", "G", "A", "B"];

var emptyQuestionLayer = 1;















if(document.getElementById('numberOfFrets')) document.getElementById('numberOfFrets').value = numberOfFrets;
if(document.getElementById('accChoice')) document.getElementById('accChoice').value = accChoice;

var frtKnwLimitFr1 = 0;
var frtKnwLimitFr2 = 22;

setElementValue('frtKnwLimitFr1', frtKnwLimitFr1);
setElementValue('frtKnwLimitFr2', frtKnwLimitFr2);

var frtKnwLimitSt1 = 0;
var frtKnwLimitSt2 = 5;


setElementValue('frtKnwLimitSt1', frtKnwLimitSt1 + 1);
setElementValue('frtKnwLimitSt2', frtKnwLimitSt2 + 1);



var fretLimit = numberOfFrets;
var stringLimit = 5;

var snapshot = new Array(numberOfFrets);

fretboard_initFretboard();
fretboard_resize();







//  
//  ██████╗ ██████╗ ██╗██╗     ██╗     ███████╗
//  ██╔══██╗██╔══██╗██║██║     ██║     ██╔════╝
//  ██║  ██║██████╔╝██║██║     ██║     ███████╗
//  ██║  ██║██╔══██╗██║██║     ██║     ╚════██║
//  ██████╔╝██║  ██║██║███████╗███████╗███████║
//  ╚═════╝ ╚═╝  ╚═╝╚═╝╚══════╝╚══════╝╚══════╝
//     

var drill = new Array();

var playingDrill = new Array();
var drillToSchedule = new Array();

//chaque cell de drill est une question
var QA = new Array();

//chaque cell de question est un ensemble de note
var notesSuite;

var singleNote = new Array();
var CONST_DRILLSIZE = bars*2;
var drillSize = CONST_DRILLSIZE;
var notesPerTest = 1;
var notesPerTestEarTraining = 2;






var DEBUGPIANO_note1 = "";
var DEBUGPIANO_note2 = "";
var DEBUGPIANO_note3 = "";


var DEBUGPIANO_notes = new Array(7);
DEBUGPIANO_notes[0] = "C";
DEBUGPIANO_notes[1] = "D";
DEBUGPIANO_notes[2] = "E";
DEBUGPIANO_notes[3] = "F";
DEBUGPIANO_notes[4] = "G";
DEBUGPIANO_notes[5] = "A";
DEBUGPIANO_notes[6] = "B";


var DEBUGPIANO_notesC = ["C", "D", "E", "F", "G", "A", "B"];
var DEBUGPIANO_notesG = ["G", "A", "B", "C", "D", "E", "F#"];
var DEBUGPIANO_notesD = ["D", "E", "F#", "G", "A", "B", "C#"];
var DEBUGPIANO_notesA = ["A", "B", "C#", "D", "E", "F#", "G#"];
var DEBUGPIANO_notesE = ["E", "F#", "G#", "A", "B", "C#", "D#"];
var DEBUGPIANO_notesB = ["B", "C#", "D#", "E", "F#", "G#", "A#"];
var DEBUGPIANO_notesFd = ["F#", "G#", "A#", "B", "C#", "D#", "E#"];
var DEBUGPIANO_notesCd = ["C#", "D#", "E#", "F#", "G#", "A#", "B#"];
var DEBUGPIANO_notesF = ["F", "G", "A", "Bb", "C", "D", "E"];
var DEBUGPIANO_notesBb = ["Bb", "C", "D", "Eb", "F", "G", "A"];
var DEBUGPIANO_notesEb = ["Eb", "F", "G", "Ab", "Bb", "C", "D"];
var DEBUGPIANO_notesAb = ["Ab", "Bb", "C", "Db", "Eb", "F", "G"];
var DEBUGPIANO_notesDb = ["Db", "Eb", "F", "Gb", "Ab", "Bb", "C"];
var DEBUGPIANO_notesGb = ["Gb", "Ab", "Bb", "Cb", "Db", "Eb", "F"];
var DEBUGPIANO_notesCb = ["Cb", "Db", "Eb", "Fb", "Gb", "Ab", "Bb"];





var DEBUGPIANO_notesXXX = [
DEBUGPIANO_notesC,
DEBUGPIANO_notesG,
DEBUGPIANO_notesD,
DEBUGPIANO_notesA, 
DEBUGPIANO_notesE, 
DEBUGPIANO_notesB, 
DEBUGPIANO_notesFd,
DEBUGPIANO_notesCd,
DEBUGPIANO_notesF, 
DEBUGPIANO_notesBb,
DEBUGPIANO_notesEb,
DEBUGPIANO_notesAb,
DEBUGPIANO_notesDb,
DEBUGPIANO_notesGb,
DEBUGPIANO_notesCb
];





var indexPiano = 0;





var DEBUGPIANO_notes=DEBUGPIANO_notesXXX[indexPiano];

var DEBUGPIANO_alt = new Array(3);
DEBUGPIANO_alt[0] = "";
DEBUGPIANO_alt[1] = "#";
DEBUGPIANO_alt[2] = "b";

var DEBUGPIANO_nat = new Array(2);
DEBUGPIANO_nat[0] = "";
DEBUGPIANO_nat[1] = "m";

var DEBUGPIANO_drillRhythm = 8; 
var DEBUGPIANO_drillRhythmCpt = 0; // Compteur pour executer le rythme	

var DEBUGPIANOREADING_drillRhythm = 32; 
var DEBUGPIANOREADING_drillRhythmCpt = 0; // Compteur pour executer le rythme


var catchupCounter = 0;	
//Rythme des executions par rapport au rythme de référence (eightNoteReference)
// 2 = 1 fois sur 2
var drillRhythm = 2; 
var drillRhythmCpt = 0; // Compteur pour executer le rythme
// Exécuter un battement d'exercice

function drills_playBEAT() { //trace("FCT", "drills_playBEAT");	


if((!(typeof pianoDrill === 'undefined' || pianoDrill === null)) && pianoDrill == "1")
{
	DEBUGPIANOREADING_drillRhythmCpt++;		

		//trace("11","DEBUGPIANOREADING_drillRhythmCpt: "+DEBUGPIANOREADING_drillRhythmCpt);
		if(document.getElementById('playerTitle1')) document.getElementById('playerTitle1').innerHTML = DEBUGPIANOREADING_drillRhythmCpt;
		if(document.getElementById('hardWrittenNote'))
		{//sheet_updateSheetWithNote("");
			//document.getElementById('BarShower').style.position = "";
			//document.getElementById('hardWrittenNote').innerHTML = "";
			//document.getElementById('hardWrittenNote').innerHTML = DEBUGPIANOREADING_drillRhythmCpt;
			document.getElementById('hardWrittenNote').style.position = "relative";
			
			//document.getElementById('hardWrittenNote').style.top = "-170px"
			if (DEBUGPIANOREADING_drillRhythmCpt == 1)  {barOffsetWidthLive = barOffsetWidth/3; document.getElementById('hardWrittenNote').style.left = (barOffsetWidthLive)+"px";}
			if (DEBUGPIANOREADING_drillRhythmCpt == 9)  {barOffsetWidthLive = barOffsetWidthLive+barOffsetWidth;document.getElementById('hardWrittenNote').style.left = (barOffsetWidthLive)+"px";}
			if (DEBUGPIANOREADING_drillRhythmCpt == 17) {barOffsetWidthLive = barOffsetWidthLive+barOffsetWidth;document.getElementById('hardWrittenNote').style.left = (barOffsetWidthLive)+"px";}
			if (DEBUGPIANOREADING_drillRhythmCpt == 25) {barOffsetWidthLive = barOffsetWidthLive+barOffsetWidth;document.getElementById('hardWrittenNote').style.left = (barOffsetWidthLive)+"px";}
			//document.getElementById('BarShower').style.left = "-"+160+"px";
		}
		//1-9-17-25
		if (DEBUGPIANOREADING_drillRhythmCpt == 1) {
			//if (drill.length > 0)
			if(!play) sheet_updateSheetWithNote("");
			else play = false;
		}
		if(DEBUGPIANOREADING_drillRhythmCpt >= DEBUGPIANOREADING_drillRhythm) DEBUGPIANOREADING_drillRhythmCpt = 0;
		
		catchupCounter++;
		if(catchupCounter > 7) catchupCounter = 0;
	}
	else
	{
		
		drillRhythmCpt++;		
		if (drillRhythmCpt == 1) {
			if (drill.length > 0)
				drills_executeOneBeat();		
		}
		if(drillRhythmCpt >= drillRhythm) drillRhythmCpt = 0;
		
		catchupCounter++;
		if(catchupCounter > 7) catchupCounter = 0;
		
		if(debugPiano == "o") launchDebugPiano();
		
	}
	
	
	
	
	
	
}






function launchDebugPiano()
{
	DEBUGPIANO_drillRhythmCpt++;		
	if (DEBUGPIANO_drillRhythmCpt == 1) {			
		
		//AJOUT++ POUR PIANO
		var DEBUGPIANO_notenb = (Math.floor((Math.random() * 7) + 1)) - 1;
		var DEBUGPIANO_notenbA = (Math.floor((Math.random() * 7) + 1)) - 1;
		var DEBUGPIANO_notenbB = (Math.floor((Math.random() * 7) + 1)) - 1;
		
		var DEBUGPIANO_altnb = (Math.floor((Math.random() * 3) + 1)) - 1;
		var DEBUGPIANO_natnb = (Math.floor((Math.random() * 2) + 1)) - 1;			
		
		DEBUGPIANO_notes=DEBUGPIANO_notesXXX[indexPiano];
		
		
		if(DEBUGPIANO_note1 == "") 	DEBUGPIANO_note1 = DEBUGPIANO_notes[DEBUGPIANO_notenb]+DEBUGPIANO_notenbX;
		
		DEBUGPIANO_note1 = DEBUGPIANO_note2;
		
		
		//DEBUGPIANO_note3 = DEBUGPIANO_notes[DEBUGPIANO_notenb] + " ("+DEBUGPIANO_notenb1+")";
		
		
		
		
		
		if(true) DEBUGPIANO_note1 = DEBUGPIANO_note2;
		else
		{
			var DEBUGPIANO_notenb1 = DEBUGPIANO_notenbA + 1;			
			var DEBUGPIANO_notenbX = "";
			if(DEBUGPIANO_notenb1 == 2 || DEBUGPIANO_notenb1 == 3 || DEBUGPIANO_notenb1 == 6) DEBUGPIANO_notenbX = "m";
			if(DEBUGPIANO_notenb1 == 7) DEBUGPIANO_notenbX = "mb5";
			DEBUGPIANO_note1 = DEBUGPIANO_notes[DEBUGPIANO_notenbA]+DEBUGPIANO_notenbX+" ("+DEBUGPIANO_notenb1+")";
		}
		
		if(true) DEBUGPIANO_note2 = DEBUGPIANO_note3;
		else
		{
			var DEBUGPIANO_notenb1 = DEBUGPIANO_notenbB + 1;			
			var DEBUGPIANO_notenbX = "";
			if(DEBUGPIANO_notenb1 == 2 || DEBUGPIANO_notenb1 == 3 || DEBUGPIANO_notenb1 == 6) DEBUGPIANO_notenbX = "m";
			if(DEBUGPIANO_notenb1 == 7) DEBUGPIANO_notenbX = "mb5";
			DEBUGPIANO_note2 = DEBUGPIANO_notes[DEBUGPIANO_notenbB]+DEBUGPIANO_notenbX+" ("+DEBUGPIANO_notenb1+")";
		}
		/*
			var DEBUGPIANO_notenb1 = DEBUGPIANO_notenb + 1;			
			var DEBUGPIANO_notenbX = "";
			if(DEBUGPIANO_notenb1 == 2 || DEBUGPIANO_notenb1 == 3 || DEBUGPIANO_notenb1 == 6) DEBUGPIANO_notenbX = "m";
			if(DEBUGPIANO_notenb1 == 7) DEBUGPIANO_notenbX = "mb5";*/
			DEBUGPIANO_note3 = DEBUGPIANO_notes[DEBUGPIANO_notenb]+DEBUGPIANO_notenbX+" ("+DEBUGPIANO_notenb1+")";

			DEBUGPIANO_note3 = DEBUGPIANO_notes[DEBUGPIANO_notenb]+DEBUGPIANO_alt[DEBUGPIANO_altnb]+DEBUGPIANO_nat[DEBUGPIANO_natnb];
		//DEBUGPIANO_noteALL = DEBUGPIANO_note1 + " - " +DEBUGPIANO_note2 + " - " +DEBUGPIANO_note3 ;
		DEBUGPIANO_noteALL = DEBUGPIANO_note1 + " - " +DEBUGPIANO_note2 + " - " +DEBUGPIANO_note3;//+"<br/>"+DEBUGPIANO_notes[0] ;
		if(document.getElementById('DEBUGPIANO')) document.getElementById('DEBUGPIANO').innerHTML = DEBUGPIANO_noteALL;
		if(document.getElementById('playerTitle')) document.getElementById('playerTitle').innerHTML = "";
		if(document.getElementById('playerTitle1')) document.getElementById('playerTitle1').innerHTML = "";
		if(document.getElementById('playerTitle2')) document.getElementById('playerTitle2').innerHTML = "";
		
		guitarVolume = 0;
		
		
		//trace("11",DEBUGPIANO_noteALL);
		
	}
	if(DEBUGPIANO_drillRhythmCpt >= DEBUGPIANO_drillRhythm) DEBUGPIANO_drillRhythmCpt = 0;
	
}


//pour formuler le score
var score1q = 0;
var score1a = 0;
var score2q = 0;
var score2a = 0;

// le drill est-il infini ?
var infiniteDrill = true;
var drillcounter = 0;
var notecounter = 0;
var status = "Q";
var browsingNote;
var drillPianoAnswered = false;
var drillPianoAnsweredAndEvaluated = false;
//var textLog = "";
var lastNote = "";//note de la question précédente
// Exécuter un battement d'exercice
function drills_executeOneBeat() { //trace("FCT","drills_executeOneBeat");
	//joue toute les notes une fois
	var stopTheDrill = false;
	if (drillcounter >= drillSize) {
		//trace("03", "END OF THE DRILL, NEXT DRILL");
		drillcounter = 0;
		notecounter = 0;
		drillcounterSOUND = 0;
		notecounterSOUND = 0;
		
		//Si le drill est finissable et fini on stop tout et on empeche de continuer cette proc 
		if(infiniteDrill == false)
		{
			//trace("07", "END");
			/*
			RhythmSample.stop();
			drill_noteDrill();
			stopTheDrill = true;*/
			chronoCourant = 0;
			chronoRebours();
		}		
		status = "Q";	
		
		//On a fini le traitement de ce drill, on passe au drill suivant, précédemment créé par le soundScheduling
		drill = drillToSchedule;		
	}
	
	if(!stopTheDrill)
	{
		browsingNote = drill[drillcounter][notecounter];
		
		if (status == "Q") {
//			textLog = textLog+"<br/>------------------------";			
/*Réponse donnée*/
			if(!(drillcounter == 0 && notecounter == 0)) // si c'est pas le premier
			{
				if(phaseEnCours == 1)
				{
					/*Pour la phase 1*/
					if(!drillPianoAnswered)
					{
						//textLog = textLog+"<br/>Bilan du drill précédent: Pas répondu";
						if(!resultGameEncours)
						{
							gameCounter++;
							if(gameCounter > 3)
							{
								gameCounter = 3;
							}
							else
							{
								if(gameCounter == 3) globalDrillResult = false;
								// $('#circleGray'+gameCounter).addClass("circleLost");
								// $('#circleGlobal').addClass('error');
							}
						}
					}
					else
					{
						//textLog = textLog+"<br/>Bilan du drill précédent: Répondu";					
					}
				}
				else
				{

					/*Phase 2, dernière chance: après le A, on vérifie si la bonne réponse a été donnée*/
					if(phaseEnCours == 2)
					{
						var noteEncours = lastNote;
						if(!resultGameEncours)
						{  
							//textLog = textLog+"<br/>dernier test pr le drill précedent: Note maj "+maxnote+" = "+noteEncours+" Note en cours";	
							if(maxnote == noteEncours || maxnote == altNote(noteEncours))
							{
								resultGameEncours = true;
								// $('#circleGlobal').addClass('success');
							}
							else /*donc si c toujours pas bon, là c mort*/
							{
								gameCounter++;
								if(gameCounter > 3)
								{
									gameCounter = 3;
								}
								else
								{
									if(gameCounter == 3) globalDrillResult = false;
									// $('#circleGray'+gameCounter).addClass("circleLost");
									// $('#circleGlobal').addClass('error');
								}

							}
						}
					}
				}
				/*si c'est pas le cas, il y a une deuxieme chance après (sur la Q suivante)*/
			}

			//Début de drill
			//pour l'étape 2
			tableNotes = new Array;
			max = 0;
			maxnote = "";

			//Pour l'étape 1
			drillPianoAnswered = false;
			drillPianoAnsweredAndEvaluated = false;
			// $('#circleGlobal').removeClass('success');
			// $('#circleGlobal').removeClass('error');

			reInitPianoStyle();

			
			$('#successCheck').css('z-index','-10');

			
			if (emptyQuestionLayer == 1 || notecounter == 0)
				fretboard_emptyUpLayer();
			
			if (browsingNote.Q == "1") {
				//Si fretX a une valeur, c'est que c'est une coordonnee valide, on dessine
				if (browsingNote.QuestionInvisible != "1") {
					if (browsingNote.fretX != -1) {
						fretboard_drawPoint(browsingNote.fretX, browsingNote.stringY + 1, browsingNote.display, browsingNote.QuestionBlind);
						} else { //Sinon c'est un ensemble de note, on dessine tout!
						for ( i = 0; i < browsingNote.twinNotes.length; i++) {
							fretboard_drawPoint(browsingNote.twinNotes[i].X, browsingNote.twinNotes[i].Y + 1, browsingNote.display, browsingNote.QuestionBlind);
						}
					}
				}
				if (browsingNote.showSheetInQ != null && browsingNote.showSheetInQ == "1") {
					sheet_updateSheetWithNote(browsingNote.note);
				}			
			}

			//textLog = textLog+"<br/>"+"Etape "+phaseEnCours+", Status "+status+", Note à trouver: "+browsingNote.note;
			//$('#noteInTheDrill').html(textLog);	

			resultGameEncours = false;
		}
		
		if (status == "A") {


			if(phaseEnCours == 1) {score1q++;console.log('#'+score1q);}
			if(phaseEnCours == 2) {score2q++;console.log('@'+score2q);}

			//Phase 2, après le Q, on vérifie si la bonne réponse a été donnée
			if(phaseEnCours == 2)
			{
				var noteEncours = lastNote;// browsingNote.note;//.substring(0,2);
				//textLog = textLog+"<br/>premier test: Note maj "+maxnote+" = "+noteEncours+" Note en cours";
				if(maxnote == noteEncours || maxnote == altNote(noteEncours))
				{
					resultGameEncours = true;
					$('#circleGlobal').addClass('success');
				}
			}
			//si c'est pas le cas, il y a une deuxieme chance après (sur la Q suivante)


			fretboard_emptyUpLayer();
			if (browsingNote.A == "1") {
				//Si fretX a une valeur, c'est que c'est une coordonn�e valide, on dessine
				if (browsingNote.fretX != -1) {
					fretboard_drawPoint(browsingNote.fretX, browsingNote.stringY + 1, browsingNote.display, "0");	
					//trace("06", "display "+browsingNote.note+" at "+ context.currentTime + " and has its note played at " + browsingNote.timing);					
					} else {//Sinon c'est un ensemble de note, on dessine tout!11
					for ( i = 0; i < browsingNote.twinNotes.length; i++) {
						fretboard_drawPoint(browsingNote.twinNotes[i].X, browsingNote.twinNotes[i].Y + 1, browsingNote.display, "0");
						
					}
				}
				if (browsingNote.showSheetInA != null && browsingNote.showSheetInA == "1") {
					sheet_updateSheetWithNote(browsingNote.note);
				}
			}

			//textLog = textLog+"<br/>"+"Etape "+phaseEnCours+", Status "+status+", Note à trouver: "+browsingNote.note;
			//$('#noteInTheDrill').html(textLog);	
		}
		lastNote = browsingNote.note;

		notecounter++;
		
		if (notecounter >= drill[drillcounter].length) {
			notecounter = 0;
			//Alternance des phases 
			if (status == "Q")
				status = "A";
			else {
				drillcounter++;
				status = "Q";
			}
		}
		
	}
	
}


//Préparer l'exercice à venir
function drills_prepareDrill() {
	
	
	//playingDrill = drills_prepareDrillFretboardingLearning();	
	
	return drills_prepareDrillFretboardingLearning();	
	//drillToSchedule = playingDrill();
	//drills_prepareDrillEarTraining();
	//status = "Q";
}





function setStepsLimit(step) {
	if (step > nbSteps) {
		step = nbSteps;
		
	}
	if (step < 1) {
		step = 1;
		
	}
	return step;
}

function setBPMLimit(bpm) {
	if (bpm > 250) {
		bpm = 250;
		
	}
	if (bpm < 20) {
		bpm = 20;
		
	}
	return bpm;
}








function bpm_EVT_bpm(val)
{
	
	bpm = parseInt(val);
	if(bpm > drillBPMLimit2) bpm = drillBPMLimit2;
	if(bpm < drillBPMLimit1) bpm = drillBPMLimit1;
	
	var loadingPercentage = Math.round(((bpm - drillBPMLimit1) / (drillBPMLimit2 - drillBPMLimit1))*100);
	if(document.getElementById('progressBPM')) document.getElementById('progressBPM').style.width = loadingPercentage+"%"


	//bpm = document.getElementById('bpm').value = setBPMLimit(val);
	//pyramid_updatePyramid();
}	





function changeVolume(instru)
{
	
	
	
	var len = sourceTable.length;
	//trace("11","CLIC TO " + drumVolume + "---" + len);
	var tmpInst;
	var tmpBuf;
	var tmpTim;
	
	var i = 0;
	for (a = 0; a < len; a++) {
		
		if(sourceTable[i].inst == instru && sourceTable[i].tim > context.currentTime) 
		{
			////trace("11","KILL " + sourceTable[i].src);
			////trace("11","play "+buffer+" at " + time + " at vol " + gainNode.gain.value);
			
			tmpInst = sourceTable[i].inst;
			tmpBuf = sourceTable[i].buf;			
			tmpTim = sourceTable[i].tim;
			
			sourceTable[i].src.stop(0); 
			sourceTable.splice(i, 1);
			i--;
			sound_playSound(tmpInst,tmpBuf,tmpTim);
			
		}
		i++;
	}
	
	
}


var voltim;
if(document.getElementById('drumVolume')) { document.getElementById('drumVolume').addEventListener('change', function vol_EVT_drumVolume_change() {
	drumVolume = (parseInt(this.value))/100;
	clearTimeout(voltim);
	voltim = setTimeout(changeVolume('drum'),400);
	
	//this.value = bpm;
});}	
	if(document.getElementById('guitarVolume')) { document.getElementById('guitarVolume').addEventListener('change', function vol_EVT_guitarVolume_change() {
		guitarVolume = (parseInt(this.value))/100;
		clearTimeout(voltim);
		voltim = setTimeout(changeVolume('guitar'),400);

	//this.value = bpm;
});}	
/*
	if(document.getElementById('guitarVolume')) { document.getElementById('guitarVolume').addEventListener('change', function vol_EVT_guitarVolume_change() {
	guitarVolume = (parseInt(this.value))/100;
	
	var len = sourceTable.length;
	for (i = 0; i < len; i++) {
	
	if(sourceTable[i].inst == "guitar" && sourceTable[i].tim > context.currentTime + 0.5) 
	{
	sourceTable[i].src.stop(0);
	sound_playSound(sourceTable[i].inst,sourceTable[i].buf,sourceTable[i].tim);
	}
	}
	
	//this.value = bpm;
	});}
	*/

	if(document.getElementById('bpm')) { document.getElementById('bpm').addEventListener('change', function bpm_EVT_bpm_change() {
		bpm = parseInt(this.value);
		if(bpm > drillBPMLimit2) bpm = drillBPMLimit2;
		if(bpm < drillBPMLimit1) bpm = drillBPMLimit1;

		var loadingPercentage = Math.round(((bpm - drillBPMLimit1) / (drillBPMLimit2 - drillBPMLimit1))*100);
		if(document.getElementById('progressBPM')) document.getElementById('progressBPM').style.width = loadingPercentage+"%"
			this.value = bpm;
	});}



		function stringLimiter(nbxx)
		{
			if(nbxx < 0) nbxx = 0;
			if(nbxx > 5) nbxx = 5;
			return nbxx;
		}


		if(document.getElementById('drumSound')) { document.getElementById('drumSound').addEventListener('change', function sound_EVT_drumSound() {
			drumSound = this.value
			pushPlayButtonStop();
		});}
			if(document.getElementById('drumSoundTernaire')) { document.getElementById('drumSoundTernaire').addEventListener('change', function sound_EVT_drumSoundTernaire() {
				drumSoundTernaire = this.value;
				pushPlayButtonStop();
			});}

				function fretLimiter(nb)
				{
					if(nb < 0) nb = 0;
					if(nb > 22) nb = 22;
					return nb;
				}
//METRONOME



//  ████████╗ ██████╗  ██████╗ ██╗     ███████╗
//  ╚══██╔══╝██╔═══██╗██╔═══██╗██║     ██╔════╝
//     ██║   ██║   ██║██║   ██║██║     ███████╗
//     ██║   ██║   ██║██║   ██║██║     ╚════██║
//     ██║   ╚██████╔╝╚██████╔╝███████╗███████║
//     ╚═╝    ╚═════╝  ╚═════╝ ╚══════╝╚══════╝



function trace(type, trace)	
{
	switch(type)
	{
		case "FCT":
		//console.log(trace);
		break;
		case "11":
		console.log(trace);
		break;
		default: break;
	}
	
}	


// █████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗
// ╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝
// ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗  
// ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝  






















