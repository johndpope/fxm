function doOnOrientationChange()
{switch(window.orientation)
{case-90:case 90:pushPlayButtonStop();break;default:pushPlayButtonStop();break}}
window.addEventListener('orientationchange',doOnOrientationChange);window.onresize=fretboard_resize;var eightNoteReference=new Array();var playedNoteReference=new Array();var currentTime;var previousTime;rAF=window.requestAnimationFrame;function update(timestamp){if(!previousTime>0)previousTime=context.currentTime;currentTime=context.currentTime;if((currentTime-previousTime)>1)pushPlayButtonStop();var firstNote=eightNoteReference[0];var myNoteHasBeenPlayed=!1;while(eightNoteReference.length>0&&eightNoteReference[0].time<currentTime){if(!myNoteHasBeenPlayed)
{drills_playBEAT();myNoteHasBeenPlayed=!0;if(eightNoteReference.length>0)
{if(document.getElementById('beat')&&document.getElementById('beat2'))
{document.getElementById('beat').innerHTML=eightNoteReference[0].beat+1;document.getElementById('beat2').innerHTML=catchupCounter+1}
var shift=(eightNoteReference[0].beat+1)-(catchupCounter+1);if(shift>0)
{for(i=0;i<shift;i++){drills_playBEAT()}}}}
eightNoteReference.splice(0,1)}
myNoteHasBeenPlayed=!1;previousTime=context.currentTime;rAF(update)}
function animationMonitor()
{if(!previousTime>0)previousTime=context.currentTime;currentTime=context.currentTime;if((currentTime-previousTime)>0.5)pushPlayButtonStop();setTimeout(animationMonitor,500)}
var RhythmSample={};var schedulingTimer;var element=document.body;function metronomeDisplayPlay(){if(document.getElementById("MetPauseButton")){var element=document.getElementById("MetPauseButton");element.classList.remove("invisible");element.classList.add("visible");element=document.getElementById("MetPauseButtonMini");element.classList.remove("invisible");element.classList.add("visible");element=document.getElementById("MetPlayButton");element.classList.remove("visible");element.classList.add("invisible");element=document.getElementById("MetPlayButtonMini");element.classList.remove("visible");element.classList.add("invisible")}}
function metronomeDisplayPause(){if(document.getElementById("MetPauseButton")){var element=document.getElementById("MetPauseButton");element.classList.remove("visible");element.classList.add("invisible");element=document.getElementById("MetPauseButtonMini");element.classList.remove("visible");element.classList.add("invisible");element=document.getElementById("MetPlayButton");element.classList.remove("invisible");element.classList.add("visible");element=document.getElementById("MetPlayButtonMini");element.classList.remove("invisible");element.classList.add("visible")}}
function metronomeDisplayStop(){if(document.getElementById("MetPauseButton")){var element=document.getElementById("MetPauseButton");element.classList.remove("visible");element.classList.add("invisible");element=document.getElementById("MetPauseButtonMini");element.classList.remove("visible");element.classList.add("invisible");element=document.getElementById("MetPlayButton");element.classList.remove("invisible");element.classList.add("visible");element=document.getElementById("MetPlayButtonMini");element.classList.remove("invisible");element.classList.add("visible")}}
var noSleep=new NoSleep();var play;RhythmSample.play=function(){rAF(update);firstBlankBar=firstBlankBarPARAM;RhythmSample.stop();noSleep.enable();sound_soundsSchedule(0,0);drill=drillToSchedule;if(document.getElementById("header")){if(element.scrollTop>document.getElementById("header").offsetHeight)
{if(document.getElementById("fretboardCanvas")){window.scrollTo(0,1);document.getElementById("fretboardCanvas").scrollIntoView();window.scrollBy(0,-26)}}}
if(document.getElementById("metronomeContainer")){window.scrollTo(0,1);document.getElementById("metronomeContainer").scrollIntoView();window.scrollBy(0,-26)}
clearTimeout(timer);if((infiniteDrill==!0&&drillCode!="ALL")||pyramid)chronoRebours();catchupCounter=-1;if(document.getElementById("overCanvas"))document.getElementById("overCanvas").style.zIndex="-1";if(document.getElementById("playerTitle"))document.getElementById("playerTitle").style.display="none";if(document.getElementById("playerTitle1"))document.getElementById("playerTitle1").style.display="none";if(document.getElementById("playerTitle2"))document.getElementById("playerTitle2").style.display="none";if(fretboardingLearningType=="FLPosToNote"&&document.getElementById("playerTitle1"))document.getElementById("playerTitle1").style.display="inline-block";if(fretboardingLearningType=="FLNoteToPos"&&document.getElementById("playerTitle2"))document.getElementById("playerTitle2").style.display="inline-block";metronomeDisplayPlay();play=!0;var displayer};var paused=0;var stepToKeep;var onlyOneStopper=!0;RhythmSample.pause=function(){clearTimeout(nextStepEnCoursTimer);clearTimeout(nextStepEnCoursTimer2);stepToKeep=stepEncours;paused=2;RhythmSample.stop();paused=1;metronomeDisplayPause()}
RhythmSample.stop=function(){metronomeDisplayStop();for(i=0;i<sourceTable.length;i++){sourceTable[i].src.stop(0)}
var len=sourceTable.length;var i=0;for(a=0;a<len;a++){sourceTable.splice(i,1)}
eightNoteReference=new Array();playedNoteReference=new Array();drillcounter=0;notecounter=0;drillcounterSOUND=0;notecounterSOUND=0;status="Q";fretboard_emptyUpLayer();drillRhythmCpt=0;clearTimeout(timer);chronoCourant=chrono;updateTimeBar();clearTimeout(schedulingTimer);if(document.getElementById('sheetMusic'))sheet_updateSheetWithNote();if(document.getElementById("playerTitle"))document.getElementById("playerTitle").style.display="inline-block";clearTimeout(nextStepEnCoursTimer);clearTimeout(nextStepEnCoursTimer2);if(paused!=1&&paused!=2)stepEncours=0;if(paused==1)stepEncours--;paused=0;noSleep.disable();play=!1}
var drillcounterSOUND=0;var notecounterSOUND=0;var drillBPMLimit1;var drillBPMLimit2;var timer;function chronoRebours()
{chronoCourant--;updateTimeBar();if(chronoCourant>0)timer=setTimeout(chronoRebours,1000);else{phaseEnCours++;$('.pianoBlock').addClass("isInvisible");$('.sheetBlock').removeClass("isInvisible");$('#phase1Instruction').addClass("isInvisible");$('#phase2Instruction').removeClass("isInvisible");if(!noguitar)
{guitarListener();guitarVolume=0}
gameCounter=0;if(drillCode=="test")
{phaseEnCours--;indexPiano++;DEBUGPIANO_note1="";DEBUGPIANO_note2="";DEBUGPIANO_drillRhythmCpt=0;if(document.getElementById('DEBUGPIANO'))document.getElementById('DEBUGPIANO').innerHTML=""}
if(phaseEnCours>2)
{fretboardingLearningType="FLPosToNote";pushPlayButtonStop();$('.modal-frame').addClass('isInvisible');$('#modalFrame_Results').removeClass('isInvisible');$('#modalFrame_Results').addClass('isVisible');if(noguitar)
{navigateModalsInline('modalFrame_Results-tableMarks')}
else{active=!1;var res=score1a+':'+score1q+';'+score2a+':'+score2q;score1=score1a==0?0:(score1a/score1q);score2=score2a==0?0:(score2a/score2q);var score=Math.round(((score1+score2)/2)*100);console.log(score);$('#precent').html(score);$('#1a').html(score1a);$('#1q').html(score1q);$('#2a').html(score2a);$('#2q').html(score2q);globalDrillResult=score<90?!1:!0;if(globalDrillResult)
{navigateModals('modalFrame_Results-xp');$('.dateSiKO').hide();insertNoteAndUpdateXP(currentBpm,chosenDrill,1,nextInterval,points,pointsLvl,levelAfter,totalMoney,drillAchievementOut,res);setTimeout(moveOn,1500)}
else{navigateModals('modalFrame_Results-life');$('.dateSiOK').hide();insertNoteAndUpdateLife(currentBpm,chosenDrill,0,1,subtractedLife,res);setTimeout(function(){moveLife('lifeProgressBar',life,lostLife)},1000)}}}
else{fretboardingLearningType="FLNoteToPos";chronoCourant=chrono;pushPlayButton()}}}
var phaseEnCours;var firstBlankBar;var firstBlankBarPARAM;var force12ifSmallScreen=!0;var drumVolume;var guitarVolume;window.onload=function(){if(firstDrill&&firstDrill==!0)
{navigateWizard("modalFrame_WizardDrill-01")}
noteElem=document.getElementById("note");drills_setDrill(drillCode);$('#fabButton').removeClass('pulse animated').addClass('pulse animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){$(this).removeClass('pulse animated')});$('.fab').addClass('greenButtonPlay');$('input[type=range]').on('input',function(e){var min=e.target.min,max=e.target.max,val=e.target.value;$(e.target).css({'backgroundSize':(val-min)*100/(max-min)+'% 100%'})}).trigger('input');bpm=60;if(typeof currentBpm==='undefined'||currentBpm===null){bpm=bpm+0}
else{bpm=currentBpm}
if(bpm<50)
{drillBPMLimit1=10;drillBPMLimit2=49}
if(bpm>=50&&bpm<80)
{drillBPMLimit1=50;drillBPMLimit2=79}
if(bpm>=80&&bpm<120)
{drillBPMLimit1=80;drillBPMLimit2=119}
if(bpm>=120&&bpm<150)
{drillBPMLimit1=120;drillBPMLimit2=149}
if(bpm>=150)
{drillBPMLimit1=150;drillBPMLimit2=250}
if(drillCode=="ALL"||drillCode=="test")
{drillBPMLimit1=10;drillBPMLimit2=250}
if(drillCode=="test")
{chrono=1800}
var bpmElt=document.getElementById("bpm");if(bpmElt)
{bpmElt.step=5;bpmElt.value=bpm;bpmElt.min=drillBPMLimit1;bpmElt.max=drillBPMLimit2}
var loadingPercentage=Math.round(((bpm-drillBPMLimit1)/(drillBPMLimit2-drillBPMLimit1))*100);if(document.getElementById('progressBPM'))document.getElementById('progressBPM').style.width=loadingPercentage+"%";drumSound="Highway";drumSoundTernaire="Basic1";if(document.getElementById('drumSound'))document.getElementById('drumSound').value=drumSound;if(document.getElementById('drumSoundTernaire'))document.getElementById('drumSoundTernaire').value=drumSoundTernaire;firstBlankBarPARAM=!0;firstBlankBar=firstBlankBarPARAM;phaseEnCours=1;drumVolume=0.8;guitarVolume=0.8;if(document.getElementById('drumVolume'))document.getElementById('drumVolume').value=drumVolume*100;if(document.getElementById('guitarVolume'))document.getElementById('guitarVolume').value=guitarVolume*100;var nbSteps=16;setElementValue("nbSteps",nbSteps)
if(document.getElementById('magnifyChartPlus'))document.getElementById('magnifyChartPlus').style.display='none';if(document.getElementById('chrono'))chronoElt=document.getElementById('chrono');if(document.getElementById('chrono2'))chronoElt2=document.getElementById('chrono2');updateTimeBar();if(!(typeof newDrill==='undefined')&&newDrill=="1")
{}
$('.modal-frame').toggleClass('isVisible')}
var notesSharp=["CN","CD","DN","DD","EN","FN","FD","GN","GD","AN","AD","BN"];var notesFlat=["CN","DB","DN","EB","EN","FN","GB","GN","AB","AN","BB","BN"];var DoMaj=["C","D","E","F","G","A","B"];var scaleProgression="0";var notes=notesSharp;var accChoice="D";var progressive=!1;var naturalNotes=["C","D","E","F","G","A","B"];var emptyQuestionLayer=1;if(document.getElementById('numberOfFrets'))document.getElementById('numberOfFrets').value=numberOfFrets;if(document.getElementById('accChoice'))document.getElementById('accChoice').value=accChoice;var frtKnwLimitFr1=0;var frtKnwLimitFr2=22;setElementValue('frtKnwLimitFr1',frtKnwLimitFr1);setElementValue('frtKnwLimitFr2',frtKnwLimitFr2);var frtKnwLimitSt1=0;var frtKnwLimitSt2=5;setElementValue('frtKnwLimitSt1',frtKnwLimitSt1+1);setElementValue('frtKnwLimitSt2',frtKnwLimitSt2+1);var fretLimit=numberOfFrets;var stringLimit=5;var snapshot=new Array(numberOfFrets);fretboard_initFretboard();fretboard_resize();var drill=new Array();var playingDrill=new Array();var drillToSchedule=new Array();var QA=new Array();var notesSuite;var singleNote=new Array();var CONST_DRILLSIZE=bars*2;var drillSize=CONST_DRILLSIZE;var notesPerTest=1;var notesPerTestEarTraining=2;var DEBUGPIANO_note1="";var DEBUGPIANO_note2="";var DEBUGPIANO_note3="";var DEBUGPIANO_notes=new Array(7);DEBUGPIANO_notes[0]="C";DEBUGPIANO_notes[1]="D";DEBUGPIANO_notes[2]="E";DEBUGPIANO_notes[3]="F";DEBUGPIANO_notes[4]="G";DEBUGPIANO_notes[5]="A";DEBUGPIANO_notes[6]="B";var DEBUGPIANO_notesC=["C","D","E","F","G","A","B"];var DEBUGPIANO_notesG=["G","A","B","C","D","E","F#"];var DEBUGPIANO_notesD=["D","E","F#","G","A","B","C#"];var DEBUGPIANO_notesA=["A","B","C#","D","E","F#","G#"];var DEBUGPIANO_notesE=["E","F#","G#","A","B","C#","D#"];var DEBUGPIANO_notesB=["B","C#","D#","E","F#","G#","A#"];var DEBUGPIANO_notesFd=["F#","G#","A#","B","C#","D#","E#"];var DEBUGPIANO_notesCd=["C#","D#","E#","F#","G#","A#","B#"];var DEBUGPIANO_notesF=["F","G","A","Bb","C","D","E"];var DEBUGPIANO_notesBb=["Bb","C","D","Eb","F","G","A"];var DEBUGPIANO_notesEb=["Eb","F","G","Ab","Bb","C","D"];var DEBUGPIANO_notesAb=["Ab","Bb","C","Db","Eb","F","G"];var DEBUGPIANO_notesDb=["Db","Eb","F","Gb","Ab","Bb","C"];var DEBUGPIANO_notesGb=["Gb","Ab","Bb","Cb","Db","Eb","F"];var DEBUGPIANO_notesCb=["Cb","Db","Eb","Fb","Gb","Ab","Bb"];var DEBUGPIANO_notesXXX=[DEBUGPIANO_notesC,DEBUGPIANO_notesG,DEBUGPIANO_notesD,DEBUGPIANO_notesA,DEBUGPIANO_notesE,DEBUGPIANO_notesB,DEBUGPIANO_notesFd,DEBUGPIANO_notesCd,DEBUGPIANO_notesF,DEBUGPIANO_notesBb,DEBUGPIANO_notesEb,DEBUGPIANO_notesAb,DEBUGPIANO_notesDb,DEBUGPIANO_notesGb,DEBUGPIANO_notesCb];var indexPiano=0;var DEBUGPIANO_notes=DEBUGPIANO_notesXXX[indexPiano];var DEBUGPIANO_alt=new Array(3);DEBUGPIANO_alt[0]="";DEBUGPIANO_alt[1]="#";DEBUGPIANO_alt[2]="b";var DEBUGPIANO_nat=new Array(2);DEBUGPIANO_nat[0]="";DEBUGPIANO_nat[1]="m";var DEBUGPIANO_drillRhythm=8;var DEBUGPIANO_drillRhythmCpt=0;var DEBUGPIANOREADING_drillRhythm=32;var DEBUGPIANOREADING_drillRhythmCpt=0;var catchupCounter=0;var drillRhythm=2;var drillRhythmCpt=0;function drills_playBEAT(){if((!(typeof pianoDrill==='undefined'||pianoDrill===null))&&pianoDrill=="1")
{DEBUGPIANOREADING_drillRhythmCpt++;if(document.getElementById('playerTitle1'))document.getElementById('playerTitle1').innerHTML=DEBUGPIANOREADING_drillRhythmCpt;if(document.getElementById('hardWrittenNote'))
{document.getElementById('hardWrittenNote').style.position="relative";if(DEBUGPIANOREADING_drillRhythmCpt==1){barOffsetWidthLive=barOffsetWidth/3;document.getElementById('hardWrittenNote').style.left=(barOffsetWidthLive)+"px"}
if(DEBUGPIANOREADING_drillRhythmCpt==9){barOffsetWidthLive=barOffsetWidthLive+barOffsetWidth;document.getElementById('hardWrittenNote').style.left=(barOffsetWidthLive)+"px"}
if(DEBUGPIANOREADING_drillRhythmCpt==17){barOffsetWidthLive=barOffsetWidthLive+barOffsetWidth;document.getElementById('hardWrittenNote').style.left=(barOffsetWidthLive)+"px"}
if(DEBUGPIANOREADING_drillRhythmCpt==25){barOffsetWidthLive=barOffsetWidthLive+barOffsetWidth;document.getElementById('hardWrittenNote').style.left=(barOffsetWidthLive)+"px"}}
if(DEBUGPIANOREADING_drillRhythmCpt==1){if(!play)sheet_updateSheetWithNote("");else play=!1}
if(DEBUGPIANOREADING_drillRhythmCpt>=DEBUGPIANOREADING_drillRhythm)DEBUGPIANOREADING_drillRhythmCpt=0;catchupCounter++;if(catchupCounter>7)catchupCounter=0}
else{drillRhythmCpt++;if(drillRhythmCpt==1){if(drill.length>0)
drills_executeOneBeat()}
if(drillRhythmCpt>=drillRhythm)drillRhythmCpt=0;catchupCounter++;if(catchupCounter>7)catchupCounter=0;if(debugPiano=="o")launchDebugPiano()}}
function launchDebugPiano()
{DEBUGPIANO_drillRhythmCpt++;if(DEBUGPIANO_drillRhythmCpt==1){var DEBUGPIANO_notenb=(Math.floor((Math.random()*7)+1))-1;var DEBUGPIANO_notenbA=(Math.floor((Math.random()*7)+1))-1;var DEBUGPIANO_notenbB=(Math.floor((Math.random()*7)+1))-1;var DEBUGPIANO_altnb=(Math.floor((Math.random()*3)+1))-1;var DEBUGPIANO_natnb=(Math.floor((Math.random()*2)+1))-1;DEBUGPIANO_notes=DEBUGPIANO_notesXXX[indexPiano];if(DEBUGPIANO_note1=="")DEBUGPIANO_note1=DEBUGPIANO_notes[DEBUGPIANO_notenb]+DEBUGPIANO_notenbX;DEBUGPIANO_note1=DEBUGPIANO_note2;if(!0)DEBUGPIANO_note1=DEBUGPIANO_note2;else{var DEBUGPIANO_notenb1=DEBUGPIANO_notenbA+1;var DEBUGPIANO_notenbX="";if(DEBUGPIANO_notenb1==2||DEBUGPIANO_notenb1==3||DEBUGPIANO_notenb1==6)DEBUGPIANO_notenbX="m";if(DEBUGPIANO_notenb1==7)DEBUGPIANO_notenbX="mb5";DEBUGPIANO_note1=DEBUGPIANO_notes[DEBUGPIANO_notenbA]+DEBUGPIANO_notenbX+" ("+DEBUGPIANO_notenb1+")"}
if(!0)DEBUGPIANO_note2=DEBUGPIANO_note3;else{var DEBUGPIANO_notenb1=DEBUGPIANO_notenbB+1;var DEBUGPIANO_notenbX="";if(DEBUGPIANO_notenb1==2||DEBUGPIANO_notenb1==3||DEBUGPIANO_notenb1==6)DEBUGPIANO_notenbX="m";if(DEBUGPIANO_notenb1==7)DEBUGPIANO_notenbX="mb5";DEBUGPIANO_note2=DEBUGPIANO_notes[DEBUGPIANO_notenbB]+DEBUGPIANO_notenbX+" ("+DEBUGPIANO_notenb1+")"}
DEBUGPIANO_note3=DEBUGPIANO_notes[DEBUGPIANO_notenb]+DEBUGPIANO_notenbX+" ("+DEBUGPIANO_notenb1+")";DEBUGPIANO_note3=DEBUGPIANO_notes[DEBUGPIANO_notenb]+DEBUGPIANO_alt[DEBUGPIANO_altnb]+DEBUGPIANO_nat[DEBUGPIANO_natnb];DEBUGPIANO_noteALL=DEBUGPIANO_note1+" - "+DEBUGPIANO_note2+" - "+DEBUGPIANO_note3;if(document.getElementById('DEBUGPIANO'))document.getElementById('DEBUGPIANO').innerHTML=DEBUGPIANO_noteALL;if(document.getElementById('playerTitle'))document.getElementById('playerTitle').innerHTML="";if(document.getElementById('playerTitle1'))document.getElementById('playerTitle1').innerHTML="";if(document.getElementById('playerTitle2'))document.getElementById('playerTitle2').innerHTML="";guitarVolume=0}
if(DEBUGPIANO_drillRhythmCpt>=DEBUGPIANO_drillRhythm)DEBUGPIANO_drillRhythmCpt=0}
var score1q=0;var score1a=0;var score2q=0;var score2a=0;var infiniteDrill=!0;var drillcounter=0;var notecounter=0;var status="Q";var browsingNote;var drillPianoAnswered=!1;var drillPianoAnsweredAndEvaluated=!1;var lastNote="";function drills_executeOneBeat(){var stopTheDrill=!1;if(drillcounter>=drillSize){drillcounter=0;notecounter=0;drillcounterSOUND=0;notecounterSOUND=0;if(infiniteDrill==!1)
{chronoCourant=0;chronoRebours()}
status="Q";drill=drillToSchedule}
if(!stopTheDrill)
{browsingNote=drill[drillcounter][notecounter];if(status=="Q"){if(!(drillcounter==0&&notecounter==0))
{if(phaseEnCours==1)
{if(!drillPianoAnswered)
{if(!resultGameEncours)
{gameCounter++;if(gameCounter>3)
{gameCounter=3}
else{if(gameCounter==3)globalDrillResult=!1}}}
else{}}
else{if(phaseEnCours==2)
{var noteEncours=lastNote;if(!resultGameEncours)
{if(maxnote==noteEncours||maxnote==altNote(noteEncours))
{resultGameEncours=!0}
else{gameCounter++;if(gameCounter>3)
{gameCounter=3}
else{if(gameCounter==3)globalDrillResult=!1}}}}}}
tableNotes=new Array;max=0;maxnote="";drillPianoAnswered=!1;drillPianoAnsweredAndEvaluated=!1;reInitPianoStyle();$('#successCheck').css('z-index','-10');if(emptyQuestionLayer==1||notecounter==0)
fretboard_emptyUpLayer();if(browsingNote.Q=="1"){if(browsingNote.QuestionInvisible!="1"){if(browsingNote.fretX!=-1){fretboard_drawPoint(browsingNote.fretX,browsingNote.stringY+1,browsingNote.display,browsingNote.QuestionBlind)}else{for(i=0;i<browsingNote.twinNotes.length;i++){fretboard_drawPoint(browsingNote.twinNotes[i].X,browsingNote.twinNotes[i].Y+1,browsingNote.display,browsingNote.QuestionBlind)}}}
if(browsingNote.showSheetInQ!=null&&browsingNote.showSheetInQ=="1"){sheet_updateSheetWithNote(browsingNote.note)}}
resultGameEncours=!1}
if(status=="A"){if(phaseEnCours==1){score1q++;console.log('#'+score1q)}
if(phaseEnCours==2){score2q++;console.log('@'+score2q)}
if(phaseEnCours==2)
{var noteEncours=lastNote;if(maxnote==noteEncours||maxnote==altNote(noteEncours))
{resultGameEncours=!0;$('#circleGlobal').addClass('success')}}
fretboard_emptyUpLayer();if(browsingNote.A=="1"){if(browsingNote.fretX!=-1){fretboard_drawPoint(browsingNote.fretX,browsingNote.stringY+1,browsingNote.display,"0")}else{for(i=0;i<browsingNote.twinNotes.length;i++){fretboard_drawPoint(browsingNote.twinNotes[i].X,browsingNote.twinNotes[i].Y+1,browsingNote.display,"0")}}
if(browsingNote.showSheetInA!=null&&browsingNote.showSheetInA=="1"){sheet_updateSheetWithNote(browsingNote.note)}}}
lastNote=browsingNote.note;notecounter++;if(notecounter>=drill[drillcounter].length){notecounter=0;if(status=="Q")
status="A";else{drillcounter++;status="Q"}}}}
function drills_prepareDrill(){return drills_prepareDrillFretboardingLearning()}
function setStepsLimit(step){if(step>nbSteps){step=nbSteps}
if(step<1){step=1}
return step}
function setBPMLimit(bpm){if(bpm>250){bpm=250}
if(bpm<20){bpm=20}
return bpm}
function bpm_EVT_bpm(val)
{bpm=parseInt(val);if(bpm>drillBPMLimit2)bpm=drillBPMLimit2;if(bpm<drillBPMLimit1)bpm=drillBPMLimit1;var loadingPercentage=Math.round(((bpm-drillBPMLimit1)/(drillBPMLimit2-drillBPMLimit1))*100);if(document.getElementById('progressBPM'))document.getElementById('progressBPM').style.width=loadingPercentage+"%"}
function changeVolume(instru)
{var len=sourceTable.length;var tmpInst;var tmpBuf;var tmpTim;var i=0;for(a=0;a<len;a++){if(sourceTable[i].inst==instru&&sourceTable[i].tim>context.currentTime)
{tmpInst=sourceTable[i].inst;tmpBuf=sourceTable[i].buf;tmpTim=sourceTable[i].tim;sourceTable[i].src.stop(0);sourceTable.splice(i,1);i--;sound_playSound(tmpInst,tmpBuf,tmpTim)}
i++}}
var voltim;if(document.getElementById('drumVolume')){document.getElementById('drumVolume').addEventListener('change',function vol_EVT_drumVolume_change(){drumVolume=(parseInt(this.value))/100;clearTimeout(voltim);voltim=setTimeout(changeVolume('drum'),400)})}
if(document.getElementById('guitarVolume')){document.getElementById('guitarVolume').addEventListener('change',function vol_EVT_guitarVolume_change(){guitarVolume=(parseInt(this.value))/100;clearTimeout(voltim);voltim=setTimeout(changeVolume('guitar'),400)})}
if(document.getElementById('bpm')){document.getElementById('bpm').addEventListener('change',function bpm_EVT_bpm_change(){bpm=parseInt(this.value);if(bpm>drillBPMLimit2)bpm=drillBPMLimit2;if(bpm<drillBPMLimit1)bpm=drillBPMLimit1;var loadingPercentage=Math.round(((bpm-drillBPMLimit1)/(drillBPMLimit2-drillBPMLimit1))*100);if(document.getElementById('progressBPM'))document.getElementById('progressBPM').style.width=loadingPercentage+"%"
this.value=bpm})}
function stringLimiter(nbxx)
{if(nbxx<0)nbxx=0;if(nbxx>5)nbxx=5;return nbxx}
if(document.getElementById('drumSound')){document.getElementById('drumSound').addEventListener('change',function sound_EVT_drumSound(){drumSound=this.value
pushPlayButtonStop()})}
if(document.getElementById('drumSoundTernaire')){document.getElementById('drumSoundTernaire').addEventListener('change',function sound_EVT_drumSoundTernaire(){drumSoundTernaire=this.value;pushPlayButtonStop()})}
function fretLimiter(nb)
{if(nb<0)nb=0;if(nb>22)nb=22;return nb}
function trace(type,trace)
{switch(type)
{case "FCT":break;case "11":console.log(trace);break;default:break}}