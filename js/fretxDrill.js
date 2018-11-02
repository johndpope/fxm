var fretboardingLearningType="FLPosToNote";var onlyNaturalNotes=!1;var askedDrill="";function drills_prepareDrillFretboardingLearning(){var xCoord;var yCoord;notesPerTest=1;emptyQuestionLayer=1;var currentDrill=new Array();var type="C";switch(askedDrill)
{case "FM06A1":infiniteDrill=!1;var fretX=0;var cordY=0;var i=0;while(fretX<=frtKnwLimitFr2)
{notesSuite=new Array(notesPerTest);for(j=0;j<notesPerTest;j++){notesSuite[j]=drills_createSingleNoteFretboardLearning(fretX,cordY);cordY++;if(cordY>frtKnwLimitSt2){cordY=0;fretX++}}
currentDrill[i]=notesSuite;i++;drillSize=currentDrill.length}
break;case "FM06B1":infiniteDrill=!1;var fretX=0;var cordY=0;var i=0;var way=!0;while(fretX<=frtKnwLimitFr2)
{notesSuite=new Array(notesPerTest);for(j=0;j<notesPerTest;j++){notesSuite[j]=drills_createSingleNoteFretboardLearning(fretX,cordY);if(way==!0)cordY++;else cordY--;if((way==!0&&cordY>frtKnwLimitSt2)||(way==!1&&cordY<frtKnwLimitSt1)){if(way==!0)cordY--;else cordY++;fretX++;way=!way}}
currentDrill[i]=notesSuite;i++;drillSize=currentDrill.length}
break;case "FM06C1":infiniteDrill=!1;var fretX=1;var cordY=frtKnwLimitSt2;var i=0;var way=!0;while(fretX<frtKnwLimitFr2)
{notesSuite=new Array(notesPerTest);for(j=0;j<notesPerTest;j++){notesSuite[j]=drills_createSingleNoteFretboardLearning(fretX,cordY);if(way)
{cordY--;fretX++}
else{cordY--;fretX--}
way=!way;if(cordY<frtKnwLimitSt1)
{cordY=frtKnwLimitSt2;if(way)fretX++}}
currentDrill[i]=notesSuite;i++;drillSize=currentDrill.length}
break;case "FM06D1":infiniteDrill=!1;var fretX=1;var cordY=frtKnwLimitSt2;var i=0;var way=!0;var wayGlobal=!0;while(fretX<frtKnwLimitFr2)
{notesSuite=new Array(notesPerTest);for(j=0;j<notesPerTest;j++){notesSuite[j]=drills_createSingleNoteFretboardLearning(fretX,cordY);if(wayGlobal)
{if(way)
{cordY--;fretX++}
else{cordY--;fretX--}
way=!way;if(cordY<frtKnwLimitSt1)
{cordY=frtKnwLimitSt1;wayGlobal=!wayGlobal}}
else{if(way)
{cordY++;fretX++}
else{cordY++;fretX--}
way=!way;if(cordY>=frtKnwLimitSt2)
{cordY=frtKnwLimitSt2;wayGlobal=!wayGlobal;way=!way}}}
currentDrill[i]=notesSuite;i++;drillSize=currentDrill.length}
break;default:infiniteDrill=!0;drillSize=CONST_DRILLSIZE;for(i=0;i<drillSize;i++){notesSuite=new Array(notesPerTest);for(j=0;j<notesPerTest;j++)
{xCoord=Math.floor((Math.random()*(frtKnwLimitFr2-frtKnwLimitFr1+1))+frtKnwLimitFr1);yCoord=Math.floor((Math.random()*(frtKnwLimitSt2-frtKnwLimitSt1+1))+frtKnwLimitSt1);if(onlyNaturalNotes)
{while(drills_createSingleNoteFretboardLearning(xCoord,yCoord).note.substring(1,2)!="N")
{xCoord=Math.floor((Math.random()*(frtKnwLimitFr2-frtKnwLimitFr1+1))+frtKnwLimitFr1);yCoord=Math.floor((Math.random()*(frtKnwLimitSt2-frtKnwLimitSt1+1))+frtKnwLimitSt1)}}
notesSuite[j]=drills_createSingleNoteFretboardLearning(xCoord,yCoord)}
currentDrill[i]=notesSuite}
break}
return currentDrill}
function drills_createSingleNoteFretboardLearning(xCoord,yCoord){var singleNote=new Array();singleNote.note=fbLogic_getNoteFromCoordinates(xCoord,yCoord);if(accChoice=="A"){var sharpOrFlat=Math.floor((Math.random()*2)+1);if(sharpOrFlat==1)
singleNote.note=notesFlat[notesSharp.indexOf(singleNote.note.substring(0,2))]+singleNote.note.substring(2,3)}
singleNote.display=fbLogic_displayableNote(singleNote.note);singleNote.fretX=xCoord;singleNote.stringY=yCoord;singleNote.Q="1";singleNote.A="1";singleNote.QuestionBlind="1";singleNote.QuestionDeaf="1";if(fretboardingLearningType=="FLNoteToPos"){singleNote.QuestionInvisible="1";singleNote.showSheetInQ="1"}else{singleNote.QuestionInvisible="0";singleNote.showSheetInA="1"}
singleNote.fileToPlay=fbLogic_buildGuitarFileName(xCoord,yCoord,singleNote.note);return singleNote}
function drills_setDrill(drillCode)
{var drillName=drillCode;var acc="";if(drillCode.length>=6)drillName=drillCode.substring(0,6);if(drillCode.length>=7)acc=drillCode.substring(6,7);if(acc=="N")onlyNaturalNotes=!0;else accChoice=acc;askedDrill="";switch(drillName){case "test":frtKnwLimitFr1=0;frtKnwLimitFr2=0;frtKnwLimitSt1=0;frtKnwLimitSt2=0;debugPiano="o";drillBPMLimit1=20;drillBPMLimit2=250;break;case "FM01A1":frtKnwLimitFr1=0;frtKnwLimitFr2=0;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM01B1":frtKnwLimitFr1=12;frtKnwLimitFr2=12;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM02A1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=1;frtKnwLimitSt2=1;break;case "FM02B1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=5;frtKnwLimitSt2=5;break;case "FM02C1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=4;frtKnwLimitSt2=4;break;case "FM02D1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=3;frtKnwLimitSt2=3;break;case "ALL":frtKnwLimitFr1=0;frtKnwLimitFr2=22;frtKnwLimitSt1=0;frtKnwLimitSt2=5;onlyNaturalNotes=!1;break;case "FM02E1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=2;frtKnwLimitSt2=2;break;case "FM02F1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=0;frtKnwLimitSt2=0;break;case "FM03A1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=1;frtKnwLimitSt2=1;break;case "FM03B1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=5;frtKnwLimitSt2=5;break;case "FM03C1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=4;frtKnwLimitSt2=4;break;case "FM03D1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=3;frtKnwLimitSt2=3;break;case "FM03E1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=2;frtKnwLimitSt2=2;break;case "FM03F1":frtKnwLimitFr1=0;frtKnwLimitFr2=12;frtKnwLimitSt1=0;frtKnwLimitSt2=0;break;case "FM04A1":frtKnwLimitFr1=0;frtKnwLimitFr2=1;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM04B1":frtKnwLimitFr1=2;frtKnwLimitFr2=3;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM04C1":frtKnwLimitFr1=4;frtKnwLimitFr2=5;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM04D1":frtKnwLimitFr1=6;frtKnwLimitFr2=7;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM04E1":frtKnwLimitFr1=8;frtKnwLimitFr2=9;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM04F1":frtKnwLimitFr1=10;frtKnwLimitFr2=11;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM05A1":frtKnwLimitFr1=0;frtKnwLimitFr2=3;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM05B1":frtKnwLimitFr1=4;frtKnwLimitFr2=7;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM05C1":frtKnwLimitFr1=8;frtKnwLimitFr2=11;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;case "FM06A1":case "FM06B1":case "FM06C1":case "FM06D1":askedDrill=drillName;frtKnwLimitFr1=0;frtKnwLimitFr2=numberOfFrets;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break;default:frtKnwLimitFr1=0;frtKnwLimitFr2=0;frtKnwLimitSt1=0;frtKnwLimitSt2=5;break}
keepfrtKnwLimitFr2=frtKnwLimitFr2}