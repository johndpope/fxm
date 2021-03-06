var paramBpm = getParameterByName("bpm");
if(paramBpm > 0 && paramBpm < 500) bpm = paramBpm;


var debugPiano = getParameterByName("debugPiano");

var automaticPyramid = getParameterByName("ap") != "0" ? true : false;

if (typeof pyramid === 'undefined' || pyramid === null) {
	var pyramid = getParameterByName("py") == "1" ? true : false;
}

var transition = getParameterByName("tr") != "0" ? true : false;

if(transition)
{
	if(document.getElementById('transitionCheck')) document.getElementById('transitionCheck').checked = true;
}

var pyramidType = "";//p=progressif, s=static, rien = pyramide
if(!getParameterByName("ap")) pyramidType = "P"
//else pyramidType = pyramidType = "P"


if(pyramid)
{
	switch(pyramidType)
	{
		case "S":
		if(document.getElementById('metronomeTypestatic')) document.getElementById('metronomeTypestatic').checked = true;
		if(document.getElementById('remainingTime')) document.getElementById('remainingTime').style.display="none";
		
		break;
		case "P":
		if(document.getElementById('metronomeTypeprogressive')) document.getElementById('metronomeTypeprogressive').checked = true;
		if(document.getElementById('bpmStatic')) document.getElementById('bpmStatic').style.display="none";
		document.getElementById('sommet').style.display="none";
		if(document.getElementById('stepBPMTDHead1').innerHTML!="") rustineStepDisplay=document.getElementById('stepBPMTDHead1').innerHTML;
		document.getElementById('stepBPMTDHead1').innerHTML="";
		document.getElementById('sommetStepTD').style.display="none";
		document.getElementById('sommetBpmTD').style.display="none";
		document.getElementById('departStepTD').style.display="none";
		document.getElementById('cibleStepTD').style.display="none";		
		break;
		default:
		if(document.getElementById('metronomeTypepyramidal')) document.getElementById('metronomeTypepyramidal').checked = true;
		if(document.getElementById('bpmStatic')) document.getElementById('bpmStatic').style.display="none";
		break;
		
	}
}
if(pyramidType == "S")
{
	
	
}

var ternaire = getParameterByName("ternaire") == "1" ? true : false;
if(ternaire) 
{
	if(document.getElementById('drumSound')) document.getElementById('drumSound').style.display="none";
	if(document.getElementById('drumSoundTernaire')) document.getElementById('drumSoundTernaire').style.display="block";
	
}
else
{
	//if(document.getElementById('drumSound')) document.getElementById('drumSound').style.display="block";
	if(document.getElementById('drumSoundTernaire')) document.getElementById('drumSoundTernaire').style.display="none";
	if(document.getElementById('signatureRythmique44')) document.getElementById('signatureRythmique44').checked = true;
}


//?cBpm=100&sBpm=220&dBpm=20&cStep=12&sStep=8&dStep=1

var cibleBpm = parseInt(getParameterByName("cBpm")) > 0 && parseInt(getParameterByName("cBpm")) < 440 ? parseInt(getParameterByName("cBpm")) : 120; 
var sommetBpm = parseInt(getParameterByName("sBpm")) > 0 && parseInt(getParameterByName("sBpm")) < 440 ? parseInt(getParameterByName("sBpm")) : 120; 
var departBpm = parseInt(getParameterByName("dBpm")) > 0 && parseInt(getParameterByName("dBpm")) < 440 ? parseInt(getParameterByName("dBpm")) : 120; 



if(automaticPyramid)
{
	sommetBpm = cibleBpm + 20;
	departBpm = cibleBpm - 20;
}

if(document.getElementById('departBpm')) document.getElementById('departBpm').value = departBpm;
if(document.getElementById('sommetBpm')) document.getElementById('sommetBpm').value = sommetBpm;
if(document.getElementById('cibleBpm'))  document.getElementById('cibleBpm').value = cibleBpm;

if(document.getElementById('staticBpm')) document.getElementById('staticBpm').value = cibleBpm;


var cibleStep  = parseInt(getParameterByName("cStep")) > 0 && parseInt(getParameterByName("cStep")) < 440 ? parseInt(getParameterByName("cStep")) : 14; 
var sommetStep = parseInt(getParameterByName("sStep")) > 0 && parseInt(getParameterByName("sStep")) < 440 ? parseInt(getParameterByName("sStep")) : 10; 
var departStep = parseInt(getParameterByName("dStep")) > 0 && parseInt(getParameterByName("dStep")) < 440 ? parseInt(getParameterByName("dStep")) : 1; 

if(departStep >= sommetStep || departStep >= cibleStep || sommetStep >= cibleStep || automaticPyramid)
{
	sommetStep = 10;
	cibleStep  = 14;
	departStep = 1;
}

if(document.getElementById('sommetStep')) document.getElementById('sommetStep').value = sommetStep;
if(document.getElementById('cibleStep')) document.getElementById('cibleStep').value =  cibleStep;
if(document.getElementById('departStep')) document.getElementById('departStep').value = departStep;














function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}     

function setElementValue(elementToChange, valueToSet)
{
	//trace("10",elementToChange+":"+valueToSet);
	if(document.getElementById(elementToChange)) document.getElementById(elementToChange).value = valueToSet;
	
}

var nbSteps = 16; 
setElementValue("nbSteps", nbSteps);
var chrono;
var chronoCourant;
//Met a jour la barre de temps 

var chronoElt;
var chronoElt2;
var displayNoteMethod = "EN";


var bars = 4;
var eighthNoteTimeOLD;
var drillCode = "ALL";

var nbMesures = bars; 
setElementValue("nbMesures", nbMesures)

if (!(typeof prefSystem === 'undefined' || prefSystem === null)) displayNoteMethod = prefSystem;
/*
	//trace("11",displayNoteMethod+"displayNoteMethod");
	//trace("11",prefSystem+"prefSystem");
//trace("11",drillCode+"55");*/
if(!pyramid) 
{
	chrono = 60;
	if(phaseDuration && phaseDuration != "") chrono = parseInt(phaseDuration);
	
	if (typeof chosenDrill === 'undefined' || chosenDrill === null) {
		bpm = bpm + 0;
	}
	else
	{
		drillCode = chosenDrill;
	}
}
else chrono=0;

chronoCourant = chrono;





function updateTimeBar()
{
	var min = Math.floor(chronoCourant / 60);
	if (min<10) min = "0"+min;
	var sec = chronoCourant - (60*min);
	if (sec<10) sec = "0"+sec;		
	var chronoDisplay = min+":"+sec;
	if(pyramidType == "S") chronoDisplay = "";
	
	if(document.getElementById('chrono')) chronoElt   = document.getElementById('chrono');
	if(document.getElementById('chrono2')) chronoElt2 = document.getElementById('chrono2');
	if(chronoElt) chronoElt.innerHTML = chronoDisplay;
		// if(chronoElt) chronoElt.innerHTML = chronoElt.innerHTML+" ("+chronoDisplay+")";

	if(chronoElt2) chronoElt2.innerHTML = chronoDisplay;
	var loadingPercentage = Math.round(((chrono-chronoCourant) / chrono)*100);		
	
	if(document.getElementById('progressTime')) document.getElementById('progressTime').style.width = loadingPercentage+"%" ;
	if(document.getElementById('progressTime2')) document.getElementById('progressTime2').style.width = loadingPercentage+"%" ;

	if(chosenDrill.substring(0,4) == "FM06") chronoElt.innerHTML = "";

}


