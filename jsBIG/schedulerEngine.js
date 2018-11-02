var realBarsToPlay;
var startTime;
var wholeNoteTime;
var halfNoteTime;
var quarterNoteTime;
var eighthNoteTime;
var sixteenthNoteTime;			

var trioletwholeNoteTime;
var triolethalfNoteTime;
var trioletquarterNoteTime;
var trioleteighthNoteTime;
var trioletsixteenthNoteTime;

var notesScheduledUntil;
var nextScheduleIn;

var drumSound;
var drumSoundTernaire;
var stepEncoursDisplay;
var nextStepEnCoursTimer;
var nextStepEnCoursTimer2;

function sound_soundsSchedule(notesScheduledUntil, guitarNotesScheduledUntil) { //trace("03", "sound_soundsSchedule");
	
	// We'll start playing the rhythm 100 milliseconds from "now"
	startTime = context.currentTime + 0.100;
	
	
	
	// Si notesScheduledUntil a une valeur, il y a déjà eu une planif avant
	// Le timestamp de début commence donc à la fin de la dernière planif
	if (notesScheduledUntil != 0)	
	startTime = notesScheduledUntil;
	
	//----TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
	if(pyramid) 
	{
		//gestion des step (metron,ome)
		bpm = data[stepEncours].y;
		
		//trace("11", "sound_soundsSchedule - stepEncours : "+stepEncours);
		
		nextStepEnCoursTimer = setTimeout(function pl1() {
			stepEncours++;
			//trace("11", "sound_soundsSchedule - stepEncours++ after nextStepEnCoursTimer : "+stepEncours);
		},(startTime - currentTime)*1000);
		
		nextStepEnCoursTimer2 = setTimeout(pyramid_updatePyramid,(startTime - currentTime)*1000);
		
		//trace("05","update to "+bpm+ " in "+ (startTime - currentTime) + "ms");
		
		
		
		
	}
	//
	
	//trace("04",bpm+ " BPM");
	//trace("05",startTime+ " startTime");
	//trace("05",currentTime+" currentTime");
	//trace("04",((startTime - currentTime)*1000)+" ((startTime - currentTime)*1000)+" );	
	//trace("04", "startTime "+startTime)
	
	if(guitarNotesScheduledUntil == 0) guitarNotesScheduledUntil = startTime;	
	
	var tempo = bpm;	
	//bars = 2; //Nombre de mesures à planifier
	
	realBarsToPlay = parseInt(bars); //nb réel de mesures à jouer (ex on fait +1 si on veut une transition pour la pyramide)
	//trace("05",startTime+ " realBarsToPlay");
	
	if(pyramid && transition && pyramidType != "S") realBarsToPlay = parseInt(bars) + 1 ;
	
	if(firstBlankBar) 
	{
		realBarsToPlay = parseInt(bars) + 1 ;
	}
	
	
	wholeNoteTime = (60 / tempo) * 4;
	halfNoteTime = (60 / tempo) * 2;
	quarterNoteTime = (60 / tempo);
	eighthNoteTime = (60 / tempo) / 2;
	sixteenthNoteTime = (60 / tempo) / 4;			
	
	trioletwholeNoteTime = wholeNoteTime / 3;
	triolethalfNoteTime = halfNoteTime / 3;
	trioletquarterNoteTime = quarterNoteTime / 3;
	trioleteighthNoteTime = eighthNoteTime / 3;
	trioletsixteenthNoteTime = sixteenthNoteTime / 3;
	
	
	var fileToPlay;	
	var currentBeat = 0;
	var guitarTiming;
	
	// Play 2 bars of the following:
	
	
	
	
	
	//si on met une transition, on commence qu'a la deuxieme mesure (index 1)
	for (var bar = 0; bar < realBarsToPlay; bar++) {
		
		//var time = startTime + bar * 8 * eighthNoteTime;
		var time = startTime + bar * 4 * quarterNoteTime;
		if(ternaire) time = startTime + bar * 3 * quarterNoteTime;
		
		var coutingBase = 8
		if(ternaire) coutingBase = 6;
		
		
		if(!(firstBlankBar && bar == 0)){
			// On référence la liste des croche à jouer, avec leur timing, servira de référence pour le rafraichissement général (fct update)
			eightNoteReference.push({ beat : 0, time : time }); 
			eightNoteReference.push({ beat : 1, time : time + 1 * eighthNoteTime});
			eightNoteReference.push({ beat : 2, time : time + 2 * eighthNoteTime});
			eightNoteReference.push({ beat : 3, time : time + 3 * eighthNoteTime});
			eightNoteReference.push({ beat : 4, time : time + 4 * eighthNoteTime});
			eightNoteReference.push({ beat : 5, time : time + 5 * eighthNoteTime});
			eightNoteReference.push({ beat : 6, time : time + 6 * eighthNoteTime});
			eightNoteReference.push({ beat : 7, time : time + 7 * eighthNoteTime});
		}
		
		// REFERENCE A .  .  .  .  .  .  .  .  .  .  .  .  .  .  .  . 
		// dbl croches 1  2  3  4  5  6  7  8  9  10 11 12 13 14 15 16
		// croches	   1  .  2  .  3  .  4  .  5  .  6  .  7  .  8  .
		// noires	   1  .  .  .  2  .  .  .  3  .  .  .  4  .  .  .
		// blanches    1  .  .  .  .  .  .  .  2  .  .  .  .  .  .  .
		// rondes      1  .  .  .  .  .  .  .  .  .  .  .  .  .  .  .
		
		// REFERENCE B .  .  .  .  .  .  .  .  .  .  .  .  .  .  .  . 
		// dbl croches 0  1  2  3  4  5  6  7  8  9  10 11 12 13 14 15
		// croches	   0  .  1  .  2  .  3  .  4  .  5  .  6  .  7  .
		// noires	   0  .  .  .  1  .  .  .  2  .  .  .  3  .  .  .
		// blanches    0  .  .  .  .  .  .  .  1  .  .  .  .  .  .  .
		// rondes      0  .  .  .  .  .  .  .  .  .  .  .  .  .  .  .
		
		
		
		if((pyramid && transition && pyramidType != "S" && bar == 0) || (firstBlankBar && bar == 0)) // transition	ou si on veut juste une mesure blanche avant un drill	
		{	
			//trace("11", "soundschedule - firstBlankBar: "+firstBlankBar+" / bar : "+bar);
			if(ternaire)
			{
				sound_playSound("drum", BUFFERS.DSTICK, time);
				sound_playSound("drum", BUFFERS.DRIDE, time);					
				sound_playSound("drum", BUFFERS.DSTICK, time + 1 * quarterNoteTime);	
				sound_playSound("drum", BUFFERS.DSTICK, time + 2 * quarterNoteTime);				
			}
			else
			{
				sound_playSound("drum", BUFFERS.DRIDE, time);	
				sound_playSound("drum", BUFFERS.DSTICK, time);	
				sound_playSound("drum", BUFFERS.DSTICK, time + 1 * quarterNoteTime);	
				sound_playSound("drum", BUFFERS.DSTICK, time + 2 * quarterNoteTime);	
				sound_playSound("drum", BUFFERS.DSTICK, time + 3 * quarterNoteTime);
			}
		}
		else	//si on met une transition, on commence qu'a la deuxieme mesure (index 1)
		{
			
			
			//Math.floor((Math.random() * 3) + 1);
			if(ternaire)
			{
				switch(drumSoundTernaire)
				{
					case "Metronome":
					sound_playSound("drum", BUFFERS.DSTICK, time);
					sound_playSound("drum", BUFFERS.DSTICK, time + 1 * quarterNoteTime);						
					sound_playSound("drum", BUFFERS.DSTICK, time + 2 * quarterNoteTime);	
					break;
					case "Metronome2":
					sound_playSound("drum", BUFFERS.DBA1, time);	
					/*sound_playSound("drum", BUFFERS.DSTICK, time + 1 * trioletwholeNoteTime);						
					sound_playSound("drum", BUFFERS.DSTICK, time + 2 * trioletwholeNoteTime);*/		
					
					sound_playSound("drum", BUFFERS.DSTICK, time);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 1 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 2 * quarterNoteTime);	
					//sound_playSound("drum", BUFFERS.DSTICK, time + 3 * quarterNoteTime);
					case "HiHat":
					sound_playSound("drum", BUFFERS.DBA1, time);		
					
					sound_playSound("drum", BUFFERS.DHH1, time);		
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * quarterNoteTime);	
					
					
					break;
					case "Basic1":
					sound_playSound("drum", BUFFERS.DBA1, time);		
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * quarterNoteTime);						
					sound_playSound("drum", BUFFERS.DSN2, time + 2 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DHH1, time);		
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * quarterNoteTime);		
					break;
					case "Basic2":
					sound_playSound("drum", BUFFERS.DBA1, time);									
					
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * quarterNoteTime);						
					sound_playSound("drum", BUFFERS.DSN2, time + 2 * quarterNoteTime);	
					
					sound_playSound("drum", BUFFERS.DHH1, time);		
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * quarterNoteTime);	
					
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH2, time + 3 * eighthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 5 * eighthNoteTime);	
					
					break;
					case "Grave":
					
					
					sound_playSound("drum", BUFFERS.DBA1, time);	
					
					sound_playSound("drum", BUFFERS.DSN2, time + 3 * triolethalfNoteTime);	
					/*
						sound_playSound("drum", BUFFERS.DSN1, time + 1 * trioletwholeNoteTime);						
					sound_playSound("drum", BUFFERS.DSN2, time + 2 * trioletwholeNoteTime);	*/
					/*
						sound_playSound("drum", BUFFERS.DHH1, time);		
						sound_playSound("drum", BUFFERS.DHH2, time + 1 * trioletwholeNoteTime);	
						sound_playSound("drum", BUFFERS.DHH3, time + 2 * trioletwholeNoteTime);	
					*/
					sound_playSound("drum", BUFFERS.DHH2, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHH2, time + 2 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHH2, time + 3 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHH2, time + 4 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 5 * triolethalfNoteTime);	
					
					
					
					sound_playSound("drum", BUFFERS.DHIGH, time);	
					sound_playSound("drum", BUFFERS.DHIGH, time + 1 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHIGH, time + 2 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHIGH, time + 3 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHIGH, time + 4 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHIGH, time + 5 * triolethalfNoteTime);	
					
					
					
					
					//sound_playSound("drum", BUFFERS.DFLOW, time + 1 * trioleteighthNoteTime);	
					sound_playSound("drum", BUFFERS.DFLOW, time + 3 * trioleteighthNoteTime);	
					sound_playSound("drum", BUFFERS.DFLOW, time + 7 * trioleteighthNoteTime);	
					sound_playSound("drum", BUFFERS.DFLOW, time + 11 * trioleteighthNoteTime);	
					sound_playSound("drum", BUFFERS.DFLOW, time + 15 * trioleteighthNoteTime);	
					sound_playSound("drum", BUFFERS.DFLOW, time + 19 * trioleteighthNoteTime);	
					sound_playSound("drum", BUFFERS.DFLOW, time + 23 * trioleteighthNoteTime);	
					//		sound_playSound("drum", BUFFERS.DFLOW, time + 27 * trioleteighthNoteTime);	
					
					
					/*
						trioleteighthNoteTime
						
						
						sound_playSound("drum", BUFFERS.DHIGH, time);	
						sound_playSound("drum", BUFFERS.DHIGH, time + 2 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DFLOW, time + 3 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DHIGH, time + 4 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DFLOW, time + 5 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DHIGH, time + 6 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DFLOW, time + 7 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DHIGH, time + 8 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DFLOW, time + 9 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DHIGH, time + 10 * trioletquarterNoteTime);	
						sound_playSound("drum", BUFFERS.DFLOW, time + 11 * trioletquarterNoteTime);	
						
					*/
					
					
					
					
					break;
					default:
					sound_playSound("drum", BUFFERS.DBA1, time);									
					
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * trioletwholeNoteTime);						
					sound_playSound("drum", BUFFERS.DSN2, time + 2 * trioletwholeNoteTime);	
					
					sound_playSound("drum", BUFFERS.DHH1, time);		
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * trioletwholeNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * trioletwholeNoteTime);	
					
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHH2, time + 3 * triolethalfNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 5 * triolethalfNoteTime);	
					break;
				}
			}
			else
			{
				switch(drumSound)
				{
					case "Metronome":
					sound_playSound("drum", BUFFERS.DSTICK, time);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 1 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 2 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 3 * quarterNoteTime);
					break;
					case "Highway":
					sound_playSound("drum", BUFFERS.DHH1, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH4, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH6, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH8, time + 7 * eighthNoteTime);		
					
					
					// 1 Base Drum sur les temps forts (1 et 3)	
					sound_playSound("drum", BUFFERS.DBA1, time);
					sound_playSound("drum", BUFFERS.DBA2, time + 2 * quarterNoteTime);
					// 1 Snare Drum sur les temps faibles (2 et 4)	
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * quarterNoteTime);
					sound_playSound("drum", BUFFERS.DSN2, time + 3 * quarterNoteTime);
					break;
					case "Funky":
					
					
					sound_playSound("drum", BUFFERS.DHH1, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH4, time + 3 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DOHIT, time + 5 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DOHIT, time + 7 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH1, time + 8 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH2, time + 9 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 10 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH4, time + 11 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH5, time + 12 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DOHIT, time + 13 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH7, time + 14 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH8, time + 15 * sixteenthNoteTime);
					
					
					sound_playSound("drum", BUFFERS.DSN1, time + 4 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DSN2, time + 7 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DSN2, time + 9 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DSN2, time + 11 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DSN1, time + 12 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DSN2, time + 15 * sixteenthNoteTime);
					
					sound_playSound("drum", BUFFERS.DBA1, time);	
					sound_playSound("drum", BUFFERS.DBA2, time + 2 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA1, time + 10 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DBA2, time + 13 * sixteenthNoteTime);	
					
					
					break;
					case "Blue":
					sound_playSound("drum", BUFFERS.DHH1, time);	
					//sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * eighthNoteTime);		
					//sound_playSound("drum", BUFFERS.DHH4, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * eighthNoteTime);		
					//sound_playSound("drum", BUFFERS.DHH6, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * eighthNoteTime);		
					//sound_playSound("drum", BUFFERS.DHH8, time + 7 * eighthNoteTime);		
					
					
					// 1 Base Drum sur les temps forts (1 et 3)	
					sound_playSound("drum", BUFFERS.DBA1, time);
					sound_playSound("drum", BUFFERS.DBA2, time + 2 * quarterNoteTime);
					// 1 Snare Drum sur les temps faibles (2 et 4)	
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * quarterNoteTime);
					
					sound_playSound("drum", BUFFERS.DSN2, time + 7 * sixteenthNoteTime);
					sound_playSound("drum", BUFFERS.DSN2, time + 3 * quarterNoteTime);
					break;
					case "Life":
					sound_playSound("drum", BUFFERS.DHH1, time);	
					//sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * eighthNoteTime);		
					//sound_playSound("drum", BUFFERS.DHH4, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * eighthNoteTime);		
					//sound_playSound("drum", BUFFERS.DHH6, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * eighthNoteTime);		
					//sound_playSound("drum", BUFFERS.DHH8, time + 7 * eighthNoteTime);		
					
					
					//6789 10 12
					
					
					sound_playSound("drum", BUFFERS.DHH1, time + 6 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH2, time + 7 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 8 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH4, time + 9 * sixteenthNoteTime);
					
					sound_playSound("drum", BUFFERS.DOHIT, time + 10 * sixteenthNoteTime);
					sound_playSound("drum", BUFFERS.DOHIT, time + 12 * sixteenthNoteTime);
					
					
					// 1 Base Drum sur les temps forts (1 et 3)	
					sound_playSound("drum", BUFFERS.DBA1, time);
					sound_playSound("drum", BUFFERS.DBA2, time + 1 * eighthNoteTime);
					// 1 Snare Drum sur les temps faibles (2 et 4)	
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * quarterNoteTime);
					
					sound_playSound("drum", BUFFERS.DSN2, time + 6 * eighthNoteTime);
					//sound_playSound("drum", BUFFERS.DSN2, time + 3 * quarterNoteTime);
					break;
					case "Metronome2":
					sound_playSound("drum", BUFFERS.DSTICK, time);
					sound_playSound("drum", BUFFERS.DBA1, time);					
					sound_playSound("drum", BUFFERS.DSTICK, time + 1 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 2 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 3 * quarterNoteTime);
					break;
					case "Lost":
					sound_playSound("drum", BUFFERS.DHH1, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH4, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH6, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH8, time + 7 * eighthNoteTime);		
					
					
					sound_playSound("drum", BUFFERS.DBA1, time);	
					sound_playSound("drum", BUFFERS.DBA2, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA1, time + 4 * eighthNoteTime);		
					
					sound_playSound("drum", BUFFERS.DHIGH, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DFLOW, time + 6 * eighthNoteTime);		
					
					break;
					case "Factory":
					sound_playSound("drum", BUFFERS.DHH1, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH4, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH6, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH8, time + 7 * eighthNoteTime);		
					
					sound_playSound("drum", BUFFERS.DBA1, time);	
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA2, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DSN2, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA1, time + 4 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DSN1, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA2, time + 6 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DSN2, time + 7 * eighthNoteTime);	
					
					break;
					
					case "Joey":
					
					sound_playSound("drum", BUFFERS.DHH1, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH4, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH6, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH8, time + 7 * eighthNoteTime);		
					
					
					sound_playSound("drum", BUFFERS.DBA1, time);	
					sound_playSound("drum", BUFFERS.DBA2, time + 1 * eighthNoteTime);
					
					sound_playSound("drum", BUFFERS.DBA1, time + 7 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DBA2, time + 9 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DBA1, time + 10 * sixteenthNoteTime);	
					
					sound_playSound("drum", BUFFERS.DSN1, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DSN2, time + 6 * eighthNoteTime);		
					
					
					break;
					
					
					case "Pilgrim":
					sound_playSound("drum", BUFFERS.DHH1, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH4, time + 3 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH6, time + 5 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * sixteenthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH8, time + 7 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH1, time + 8 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH2, time + 9 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH3, time + 10 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH4, time + 11 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH5, time + 12 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH6, time + 13 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH7, time + 14 * sixteenthNoteTime);	
					sound_playSound("drum", BUFFERS.DHH8, time + 15 * sixteenthNoteTime);	
					
					sound_playSound("drum", BUFFERS.DBA1, time);				
					sound_playSound("drum", BUFFERS.DBA1, time + 1 * quarterNoteTime);
					
					sound_playSound("drum", BUFFERS.DBA1, time + 2 * quarterNoteTime);
					sound_playSound("drum", BUFFERS.DBA1, time + 3 * quarterNoteTime);
					
					sound_playSound("drum", BUFFERS.DSN1, time + 3 * sixteenthNoteTime);							
					sound_playSound("drum", BUFFERS.DSN2, time + 6 * sixteenthNoteTime);							
					sound_playSound("drum", BUFFERS.DSN1, time + 11 * sixteenthNoteTime);							
					sound_playSound("drum", BUFFERS.DSN2, time + 14 * sixteenthNoteTime);	
					break;
					
					case "Master":
					sound_playSound("drum", BUFFERS.DHH1, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH4, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH6, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH8, time + 7 * eighthNoteTime);
					
					// 1 Base Drum sur les temps forts (1 et 3)	
					sound_playSound("drum", BUFFERS.DBA1, time);					
					sound_playSound("drum", BUFFERS.DBA2, time + 2 * quarterNoteTime);
					sound_playSound("drum", BUFFERS.DBA1, time + 5 * eighthNoteTime);	
					
					// 1 Snare Drum sur les temps faibles (2 et 4)	
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * quarterNoteTime);
					sound_playSound("drum", BUFFERS.DSN2, time + 3 * quarterNoteTime);				
					break;
					
					case "Stone":
					sound_playSound("drum", BUFFERS.DHH1, time);	
					sound_playSound("drum", BUFFERS.DHH2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH3, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH4, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH5, time + 4 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH6, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH7, time + 6 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DHH8, time + 7 * eighthNoteTime);							
					sound_playSound("drum", BUFFERS.DBA1, time);	
					sound_playSound("drum", BUFFERS.DBA2, time + 1 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA1, time + 2 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA2, time + 3 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA1, time + 4 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA2, time + 5 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA1, time + 6 * eighthNoteTime);		
					sound_playSound("drum", BUFFERS.DBA2, time + 7 * eighthNoteTime);
					sound_playSound("drum", BUFFERS.DSN1, time + 1 * eighthNoteTime);								
					sound_playSound("drum", BUFFERS.DSN2, time + 3 * eighthNoteTime);									
					sound_playSound("drum", BUFFERS.DSN1, time + 5 * eighthNoteTime);								
					sound_playSound("drum", BUFFERS.DSN2, time + 13 * sixteenthNoteTime);							
					sound_playSound("drum", BUFFERS.DOHIT, time + 7 * eighthNoteTime);	
					break;
					default:
					sound_playSound("drum", BUFFERS.DSTICK, time);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 1 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 2 * quarterNoteTime);	
					sound_playSound("drum", BUFFERS.DSTICK, time + 3 * quarterNoteTime);
					/*
						t2 
					012-4567-811-12-14-15-16-17-18-21-22-23-24-2830-31*/
					
					break;
					
					
					
					
					/*
						
						case 1:
						sound_playSound(BUFFERS.D_HH_1, time);	
						sound_playSound(BUFFERS.D_HH_2, time + 1 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_3, time + 2 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_4, time + 3 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_5, time + 4 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_6, time + 5 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_7, time + 6 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_8, time + 7 * eighthNoteTime);
						// 1 Base Drum sur les temps forts (1 et 3)	
						sound_playSound(BUFFERS.D_BA_1, time);
						sound_playSound(BUFFERS.D_BA_2, time + 2 * quarterNoteTime);
						// 1 Snare Drum sur les temps faibles (2 et 4)	
						sound_playSound(BUFFERS.D_SN_1, time + 1 * quarterNoteTime);
						sound_playSound(BUFFERS.D_SN_2, time + 3 * quarterNoteTime);
						break;
						case 2:
						sound_playSound(BUFFERS.D_HH_1, time);	
						sound_playSound(BUFFERS.D_HH_2, time + 1 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_3, time + 2 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_4, time + 3 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_5, time + 4 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_6, time + 5 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_7, time + 6 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_8, time + 7 * eighthNoteTime);
						
						sound_playSound(BUFFERS.D_BA_1, time);	
						sound_playSound(BUFFERS.D_BA_2, time + 4 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_BA_1, time + 5 * eighthNoteTime);
						
						sound_playSound(BUFFERS.D_SN_1, time + 2 * eighthNoteTime);		
						//	sound_playSound(BUFFERS.D_SN_2, time + 7 * sixteenthNoteTime);
						sound_playSound(BUFFERS.D_SN_2, time + 6 * eighthNoteTime);
						break;
						case 44:
						sound_playSound(BUFFERS.D_HH_1, time);	
						sound_playSound(BUFFERS.D_HH_2, time + 1 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_3, time + 2 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_4, time + 3 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_5, time + 4 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_6, time + 5 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_7, time + 6 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_HH_8, time + 7 * eighthNoteTime);
						
						sound_playSound(BUFFERS.D_BA_1, time);	
						sound_playSound(BUFFERS.D_BA_2, time + 1 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_BA_1, time + 2 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_BA_2, time + 3 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_BA_1, time + 4 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_BA_2, time + 5 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_BA_1, time + 6 * eighthNoteTime);		
						sound_playSound(BUFFERS.D_BA_2, time + 7 * eighthNoteTime);
						
						
						sound_playSound(BUFFERS.D_SN_1, time + 1 * eighthNoteTime);	
						
						sound_playSound(BUFFERS.D_SN_2, time + 3 * eighthNoteTime);		
						
						sound_playSound(BUFFERS.D_SN_1, time + 5 * eighthNoteTime);	
						
						sound_playSound(BUFFERS.D_SN_2, time + 13 * sixteenthNoteTime);
						
						sound_playSound(BUFFERS.D_OHIT, time + 7 * eighthNoteTime);
						break;
						case 3:
						
						
						if(ternaire)
						{
						
						sound_playSound("drum", BUFFERS.DBA1, time);	
						sound_playSound("drum", BUFFERS.DSN1, time + 1 * trioletwholeNoteTime);	
						sound_playSound("drum", BUFFERS.DSN2, time + 2 * trioletwholeNoteTime);	
						
						sound_playSound("drum", BUFFERS.DHH1, time);	
						sound_playSound("drum", BUFFERS.DHH2, time + 1 * trioletquarterNoteTime);		
						sound_playSound("drum", BUFFERS.DHH3, time + 2 * trioletquarterNoteTime);		
						sound_playSound("drum", BUFFERS.DHH4, time + 3 * trioletquarterNoteTime);		
						sound_playSound("drum", BUFFERS.DHH5, time + 4 * trioletquarterNoteTime);		
						sound_playSound("drum", BUFFERS.DHH6, time + 5 * trioletquarterNoteTime);		
						sound_playSound("drum", BUFFERS.DHH7, time + 6 * trioletquarterNoteTime);		
						sound_playSound("drum", BUFFERS.DHH8, time + 7 * trioletquarterNoteTime);
						sound_playSound("drum", BUFFERS.DHH1, time + 8 * trioletquarterNoteTime);
						sound_playSound("drum", BUFFERS.DHH2, time + 9 * trioletquarterNoteTime);
						sound_playSound("drum", BUFFERS.DHH3, time + 10 * trioletquarterNoteTime);
						sound_playSound("drum", BUFFERS.DHH4, time + 11 * trioletquarterNoteTime);
						
						
						}
						else
						{
						
						
						
						}
						
						
						
						
						
						
					break;*/
					
				}
			}
			
			
			
			
			
			
		}
	}
	
	
	// nextScheduleIn = timer de planification (détermine dans cb de temps se fera la prochaine planif)
	// notesScheduledUntil = timestamp déterminant jusque quand on a planifié des notes	
	
	
	if (notesScheduledUntil != 0)
	nextScheduleIn = ((((realBarsToPlay/2) * coutingBase * eighthNoteTime)) + (((realBarsToPlay/2) * coutingBase * eighthNoteTimeOLD))) * 1000;
	else
	nextScheduleIn = (realBarsToPlay * coutingBase * eighthNoteTime / 2) * 1000;
	
	notesScheduledUntil = startTime + realBarsToPlay * coutingBase * eighthNoteTime;
	//notesScheduledUntil = startTime + realBarsToPlay * coutingBase * eighthNoteTime;
	
	eighthNoteTimeOLD = eighthNoteTime;
	//trace("05", "realBarsToPlay "+realBarsToPlay)
	//trace("05", "eighthNoteTimeOLD "+eighthNoteTimeOLD)
	//trace("05", "notesScheduledUntil "+notesScheduledUntil)
	//trace("05", "nextScheduleIn "+nextScheduleIn)
	
	//----TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
	if(!pyramid)  {
		//trace("07", "NEW DRILL");
		drillToSchedule = drills_prepareDrill();
		}/*	
		//----TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
		if(!pyramid)  {
		//trace("07", "NEW DRILL");
		drillToSchedule = drills_prepareDrill();
	}*/
	
	
	BUFFERS_TO_LOAD = {};
	//trace("07", "bb "+BUFFERS_TO_LOAD);
	//trace("07", "AdrillcounterSOUND "+drillcounterSOUND);
	//trace("07", "AnotecounterSOUND "+notecounterSOUND);
	//trace("07", "ArealBarsToPlay "+realBarsToPlay);
	
	
	for ( i = drillcounterSOUND; i < drillToSchedule.length; i++) {	
		for ( j = notecounterSOUND; j < drillToSchedule[i].length; j++) {	//On planifie la totalité du prochain drill
			if (currentBeat < (bars*2)) 
			{				
				fileToPlay = drillToSchedule[i][j].fileToPlay; //Récupère le fichier à jouer pour chaque note
				BUFFERS_TO_LOAD[fileToPlay] = "sounds/guitar/"+fileToPlay+".mp3";
				//trace("07", "ADD BUFFERS["+fileToPlay+"] = "+BUFFERS[fileToPlay]);
				
				guitarTiming = startTime + (currentBeat * halfNoteTime) + quarterNoteTime;
				
				drillToSchedule[i][j].timing = guitarTiming;
				
				playedNoteReference.push({ note : fileToPlay, time : guitarTiming});			
			}
			currentBeat++;
		}
	}
	
	boolLoadBuffer = true;//déclencher le chargement des buffers 
	currentBeat=0;
	buffers_loadBuffers();
	
	
	//scheduleInstru();
	
	
	
	
	//Vidage de sourceTable pour tous les sons passés
	var len = sourceTable.length;
	/*
		for (i = 0; i < sourceTable.length; i++) {
		
		if(sourceTable[i].tim < context.currentTime) 
		{
		sourceTable.splice(i, 1);
		//i--;
		//sound_playSound(sourceTable[i].inst,sourceTable[i].buf,sourceTable[i].tim);
		}
	}*/
	
	
	if(pyramidType == "S") stepEncours = 1;
	if((!pyramid) || (stepEncours < nbSteps))
	{
		
		schedulingTimer = setTimeout(function pl() {
			sound_soundsSchedule(notesScheduledUntil, guitarNotesScheduledUntil);
		}, nextScheduleIn)	
	}
	
	//trace("08","sourceTable.length - "+sourceTable.length);
	var i = 0;
	
	while(i < sourceTable.length)
	{
		//trace("08","sourceTable["+i+"].tim = "+sourceTable[i].tim +" < "+context.currentTime+" ?");
		
		if(sourceTable[i].tim < context.currentTime - 1)
		{
			//trace("08","YES -> KILL");
			sourceTable.splice(i, 1);
		}
		else
		{
			//trace("08","NO -> NEXT!");
			i++;
		}
	}	
}



function scheduleInstru()
{
	var currentBeat = 0;
	var fileToPlay;
	var guitarTiming;
	
	//trace("07", "BdrillcounterSOUND "+drillcounterSOUND);
	//trace("07", "BnotecounterSOUND "+notecounterSOUND);
	//trace("07", "BrealBarsToPlay "+realBarsToPlay);
	
	for ( i = drillcounterSOUND; i < drillToSchedule.length; i++) {	
		for ( j = notecounterSOUND; j < drillToSchedule[i].length; j++) {	//On planifie la totalité du prochain drill
			if (currentBeat < (bars*2)) 
			{
				fileToPlay = drillToSchedule[i][j].fileToPlay; //Récupère le fichier à jouer pour chaque note
				guitarTiming = startTime + (currentBeat * halfNoteTime) + quarterNoteTime;
				//si on fait une mesure a vide, on repousse le timing d'une ronde
				if(firstBlankBar) guitarTiming = guitarTiming + wholeNoteTime;
				//trace("07", "PLAY BUFFERS["+fileToPlay+"] = "+BUFFERS[fileToPlay]);
				sound_playSound("guitar", BUFFERS[fileToPlay], guitarTiming);	
				drillToSchedule[i][j].timing = guitarTiming;
				
				playedNoteReference.push({ note : fileToPlay, time : guitarTiming});
				//trace("07", "Play "+BUFFERS_TO_LOAD[fileToPlay]+" at "+guitarTiming)	
				
				notecounterSOUND++;			
				
				if (notecounterSOUND >= drillToSchedule[drillcounterSOUND].length) {
					notecounterSOUND = 0;			
					drillcounterSOUND++;					
				}		
			}
			currentBeat++;
		}
	}
	
	
	
	//On a parcourau tout le drill, on remet les compteurs à 0 pour le prochain drill
	if(infiniteDrill == true)
	{
		notecounterSOUND = 0;	
		drillcounterSOUND = 0;
	}
	
	firstBlankBar = false; //la mesure vide a été jouée, on réinitialise pour la suite	
	
	
}

	

// █████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗
// ╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝
// ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗  
// ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝  


// 
// ███████╗ ██████╗ ██╗   ██╗███╗   ██╗██████╗ 
// ██╔════╝██╔═══██╗██║   ██║████╗  ██║██╔══██╗
// ███████╗██║   ██║██║   ██║██╔██╗ ██║██║  ██║
// ╚════██║██║   ██║██║   ██║██║╚██╗██║██║  ██║
// ███████║╚██████╔╝╚██████╔╝██║ ╚████║██████╔╝
// ╚══════╝ ╚═════╝  ╚═════╝ ╚═╝  ╚═══╝╚═════╝ 


var sourceTable = new Array(); // Tableau des sons planifiés (objets "source" : context.createBufferSource sur lesquels on peut faire start/stop)
// Jouer un son à un timing donné et le trace dans une "sourceTable"
function sound_playSound(instru, buffer, time) { ////trace("FCT", "playSound");
	
	var source = context.createBufferSource();
	source.buffer = buffer;	
	
	var gainNode = context.createGain();
	source.connect(gainNode);	
	
	//var stereoPanner = context.createPanner();
	
	gainNode.connect(context.destination);		
	//gainNode.connect(stereoPanner);		
	//stereoPanner.connect(context.destination);
	
	if(instru == "drum") 
	{
		gainNode.gain.value = drumVolume;
		//stereoPanner.setPosition(1,0,0);
	}
	if(instru == "guitar") 
	{
		gainNode.gain.value = guitarVolume;
		//stereoPanner.setPosition(-1,0,0);
	}
	
	
	////trace("11","play "+buffer+" at " + time + " at vol " + gainNode.gain.value);
	
	//source.connect(context.destination);
	if (!source.start)
	source.start = source.noteOn;
	source.start(time);
	
	
	sourceTable.push({src:source,inst:instru,tim:time,buf:buffer});
	
}


