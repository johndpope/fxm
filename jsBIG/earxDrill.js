﻿
	
	//-------------------------------------------------------
	// ____ ____ ____    ___ ____ ____ _ _  _ _ _  _ ____ 
	// |___ |__| |__/     |  |__/ |__| | |\ | | |\ | | __ 
	// |___ |  | |  \     |  |  \ |  | | | \| | | \| |__] 
	//
	//-------------------------------------------------------                                                
	
	var allowedIntervals;
	var chek;
	//Préparer l'exercice d'Ear Training
	function drills_prepareDrillEarTraining() {
		
		//R�cup�rer les intervalles autoris�s
		allowedIntervals = new Array();
		notesPerTest = notesPerTestEarTraining;
		
		switch(radioEarTrainingExTyp) {
			case "EARFREE":
			var cptInterv;
			for ( i = 1; i <= 12; i++) {
				cptInterv = "choixInterv" + i;
				chek = document.getElementById(cptInterv);
				if (chek.checked == true) {
					allowedIntervals.push(chek.value);
				}
			}
			break;
			case "EAR1":
			//var tt = earTrainingExo.substring(1,2);
			notesPerTest = 2;
			switch(earTrainingExo) {
				case "N1-1":
				allowedIntervals.push(12);
				break;
				case "N2-1":
				allowedIntervals.push(1);
				break;
				case "N2-2":
				allowedIntervals.push(2);
				break;
				case "N3-1":
				allowedIntervals.push(3);
				break;
				case "N3-2":
				allowedIntervals.push(4);
				break;
				case "N4-1":
				allowedIntervals.push(5);
				break;
				case "N5-1":
				allowedIntervals.push(6);
				break;
				case "N5-2":
				allowedIntervals.push(7);
				break;
				case "N6-1":
				allowedIntervals.push(8);
				break;
				case "N6-2":
				allowedIntervals.push(9);
				break;
				case "N7-1":
				allowedIntervals.push(10);
				break;
				case "N7-2":
				allowedIntervals.push(11);
				break;
				case "N8-A":
				allowedIntervals.push(11);
				for (var i = 1; i <= 12; i++) {
					allowedIntervals.push(i);
				};
				break;
				
			}
			break;
			
		}
		
		//Si pas d'intervalle, on ajoute 0 (unisson)
		if (allowedIntervals.length == 0)
		allowedIntervals.push(0);
		
		emptyQuestionLayer = 0;
		var xCoord;
		var yCoord;
		drill = new Array();
		var sens;
		var noteDesti;
		
		var twinNotes;
		var twinNote;
		var previousNote;
		//pour le nombre d'exercice � faire
		for ( i = 0; i < drillSize; i++) {
			notesSuite = new Array(notesPerTest);
			
			singleNote = new Array();
			
			if (scaleProgression == "0" || ( typeof previousNote == 'undefined')) {
				
				//On prend une note au hasard dans l'intervalle de choix
				xCoord = Math.floor((Math.random() * (frtKnwLimitFr2 - frtKnwLimitFr1 + 1)) + frtKnwLimitFr1);
				yCoord = Math.floor((Math.random() * (frtKnwLimitSt2 - frtKnwLimitSt1 + 1)) + frtKnwLimitSt1);
				singleNote.note = fbLogic_getNoteFromCoordinates(xCoord, yCoord);
				} else {
				singleNote.note = previousNote;
			}
			
			singleNote.display = "T";
			singleNote.fretX = -1;
			singleNote.stringY = -1;
			singleNote.Q = "1";
			singleNote.A = "1";
			singleNote.QuestionBlind = "0";
			singleNote.QuestionDeaf = "0";
			singleNote.QuestionInvisible = "0";
			singleNote.twinNotes = fbLogic_findTwinNotes(singleNote.note);
			if (!(singleNote.twinNotes.length > 0)) {
				var yy = 2;
			}
			singleNote.fileToPlay = fbLogic_buildGuitarFileName(singleNote.twinNotes[0].X, singleNote.twinNotes[0].Y, singleNote.note);
			previousNote = singleNote.note;
			notesSuite[0] = singleNote;
			
			for ( j = 1; j < notesPerTest; j++) {
				
				do {
					//On choisi le sens au hasard
					sens = Math.floor((Math.random() * (2)) + 1);
					rdIntervalle = Math.floor((Math.random() * allowedIntervals.length) + 0);
					rdIntervalle = allowedIntervals[rdIntervalle];
					rdIntervalle = parseInt(rdIntervalle);
					
					//on d�finit la note d'arriv�e
					noteDesti = fbLogic_getNoteFromNote(previousNote, rdIntervalle, sens);
					
					singleNote = new Array();
					singleNote.note = noteDesti;
					singleNote.display = fbLogic_getTextFromInterval(rdIntervalle);
					//On met les coordonn�es � -1 car il y en a plusieurs
					singleNote.fretX = -1;
					singleNote.stringY = -1;
					singleNote.Q = "1";
					singleNote.A = "1";
					singleNote.QuestionBlind = "0";
					singleNote.QuestionDeaf = "0";
					singleNote.QuestionInvisible = "1";
					//tableau de coodorn�es de la note
					//on parcours toutes les cordes pour trouver les notes jumelles
					singleNote.twinNotes = fbLogic_findTwinNotes(noteDesti);
					
				} while (!(singleNote.twinNotes.length > 0));
				
				previousNote = singleNote.note;
				if (singleNote.twinNotes.length > 0) {
					
					singleNote.fileToPlay = fbLogic_buildGuitarFileName(singleNote.twinNotes[0].X, singleNote.twinNotes[0].Y, singleNote.note);
					
				}
				
				notesSuite[j] = singleNote;
			}
			drill[i] = notesSuite;
		}
	}
	
	
	