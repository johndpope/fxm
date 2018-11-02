function submit_form_choose_drill(exo)
{document.getElementById('chosenDrill').value=exo;document.getElementById('form_choose_drill').submit();return!1}
window.AudioContext=window.AudioContext||window.webkitAudioContext;var audioContext=null;var isPlaying=!1;var sourceNode=null;var analyser=null;var theBuffer=null;var DEBUGCANVAS=null;var mediaStreamSource=null;var detectorElem,canvasElem,waveCanvas,pitchElem,noteElem,detuneElem,detuneAmount;var noteStringsD=["CN","CD","DN","DD","EN","FN","FD","GN","GD","AN","AD","BN"];var noteStringsB=["CN","DB","DN","EB","EN","FN","GB","GN","AB","AN","BB","BN"];function altNote(noteComplete)
{var note=noteComplete.substring(0,2);var altNote=note;switch(note)
{case "CD":altNote="DB";break;case "DB":altNote="CD";break;case "DD":altNote="EB";break;case "EB":altNote="DD";break;case "FD":altNote="GB";break;case "GB":altNote="FD";break;case "GD":altNote="AB";break;case "AB":altNote="GD";break;case "AD":altNote="BB";break;case "BB":altNote="AD";break}
return altNote+noteComplete.substring(2,3)}
var tableNotes=new Array;var max=0;var maxnote="";var tenCounter=0;var previousNote="";var displaynote="-";var piitch="0";function evaluateGuitarListener(noteToDisplay)
{if(play==!0&&resultGameEncours==!1&&(noteToDisplay==browsingNote.note||noteToDisplay==altNote(browsingNote.note)))
{resultGameEncours=!0;$('#successCheck').css('z-index','100');$('#successCheck').removeClass('zoomIn animated').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){$(this).removeClass('zoomIn animated')});score2a++;console.log('@@'+score2a)}
piitch=noteToDisplay.substring(2,3);if(onlyNaturalNotes||(accChoice&&accChoice=="A"))
{noteToDisplay=noteToDisplay==altNote(noteToDisplay)?fbLogic_displayableNote(noteToDisplay):fbLogic_displayableNote(noteToDisplay)+" / "+fbLogic_displayableNote(altNote(noteToDisplay))}
else{if(accChoice&&accChoice=="B")
{noteToDisplay=fbLogic_displayableNote(altNote(noteToDisplay))}
if(accChoice&&accChoice=="D")
{noteToDisplay=fbLogic_displayableNote(noteToDisplay)}}
noteElem.innerHTML=noteToDisplay+" ("+piitch+")"}
function displaySilence()
{noteElem.innerHTML="--"}
function pushPlayButton()
{if(play)pushPlayButtonStop();else pushPlayButtonPlay()}
function pushPlayButtonStop()
{$(".playStopIcon").attr("src","images/play.svg");$("#fabPlayButtonImg").attr("src","images/play.svg")
$('#playButton').removeClass("redButton");$('.fab').css('background-color','')
$('.fab').removeClass("redButton");$('.fab').addClass('greenButtonPlay');RhythmSample.stop();if(phaseEnCours==2)
{isPlaying=!0}
$('#successCheck').css('z-index','-10');reInitPianoStyle()}
function pushPlayButtonPlay()
{$(".playStopIcon").attr("src","images/stop.svg")
$("#fabPlayButtonImg").attr("src","images/stop.svg")
$('#playButton').addClass("redButton");$('.fab').css('background-color','')
$('.fab').addClass("redButton");RhythmSample.play();if(phaseEnCours==2)
{isPlaying=!1}}
function reInitPianoStyle()
{$('.white').css('background-color','white');$('.whiteNoteLabel').css('color','#777');$('.blackNote').removeClass('blackNoteStyleGreen');$('.blackNote').removeClass('blackNoteStyleRed');$('.blackNote').addClass('blackNoteStyle')}
function updateWizard(a,b)
{return!1}