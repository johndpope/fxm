
//---------------------------------------------------------------------------------
	//____ ____ ____ ___ ___  ____ ____ ____ ___     ___ ____ ____ _ _  _ _ _  _ ____ 
	//|___ |__/ |___  |  |__] |  | |__| |__/ |  \     |  |__/ |__| | |\ | | |\ | | __ 
	//|    |  \ |___  |  |__] |__| |  | |  \ |__/     |  |  \ |  | | | \| | | \| |__] 
	//
	//---------------------------------------------------------------------------------                                                
	
	//drill => noteSuite, noteSuite, noteSuite ...
	//			||
	//			\/
	//			note,
	//			note,
	//			note, => | .note                 : note ("AN4")
	//			note,    | .display              : note à afficher sur la pastille ("La")
	//			note...  | .fretX                : Coord de la frette (0 à 22) (-1 si twins)
	//                   | .stringY              : Coord de la corde (0 à 5) (-1 si twins)
	//                   | .Q                    : Cette note a-telle une question (0/1)
	//	                 | .A                    : Cette note a-telle une réponse (0/1)
	//		             | .QuestionBlind        : masquer la pastille à la question (0/1)
	//			         | .QuestionDeaf         : ne pas entendre le son à la question (0/1)
	//			         | .QuestionInvisible    : ne pas afficher du tout la pastille à la question (0/1)
	//			         | .showSheetInQ         : afficher la partition à la question ? (0/1)
	//			         | .showSheetInA         : afficher la partition à la réponse ? (0/1)
	//			         | .fileToPlay           : nom du fichier lié ("AC617AN3.mp3")
	//			         | .twinNotes[]          : notes jumelles sur le manche
	//			        			 | .X        : Coord X de la jumelle
	//			        			 | .Y        : Coord X de la jumelle
	//
	// NB. a chaque executeBeat si notepertest = 1, alors QAQAQAQA si = 2 alors QQAAQQAAQQAA
	// (on parcours les ensembles de notes 2 fois)
	
	
	
	
	var fretboardingLearningType = "FLPosToNote";
	var onlyNaturalNotes = false;
	//Code du drill demandé
	var askedDrill = "";
	
	//Préparer l'exercice d'apprentissage du manche
	function drills_prepareDrillFretboardingLearning() {
		var xCoord;
		var yCoord;
		notesPerTest = 1;
		emptyQuestionLayer = 1;
		var currentDrill = new Array();
		
		var type = "C";		
		
		switch(askedDrill)	
		{
			case "FM06A1":
			infiniteDrill = false;
			var fretX = 0;
			var cordY = 0;			
			var i = 0;
			while(fretX <= frtKnwLimitFr2)
			{
				notesSuite = new Array(notesPerTest);				
				for ( j = 0; j < notesPerTest; j++) {				
					notesSuite[j] = drills_createSingleNoteFretboardLearning(fretX, cordY);													
					cordY++;					
					if(cordY > frtKnwLimitSt2) {				
						cordY = 0;
						fretX++;
					}
				}				
				currentDrill[i] = notesSuite;i++;
				drillSize = currentDrill.length;
			}
			break;
			case "FM06B1":
			infiniteDrill = false;
			var fretX = 0;
			var cordY = 0;			
			var i = 0;
			var way = true; 
			while(fretX <= frtKnwLimitFr2)
			{
				notesSuite = new Array(notesPerTest);				
				for ( j = 0; j < notesPerTest; j++) {				
					notesSuite[j] = drills_createSingleNoteFretboardLearning(fretX, cordY);													
					if(way == true) cordY++;	
					else cordY--;
					
					if((way == true && cordY > frtKnwLimitSt2) || (way == false && cordY < frtKnwLimitSt1)) {				
						if(way == true) cordY--;	
						else cordY++;
						
						fretX++;
						way = !way;
					}
				}				
				currentDrill[i] = notesSuite;i++;
				drillSize = currentDrill.length;
			}
			break;
			case "FM06C1":
			infiniteDrill = false;
			var fretX = 1;
			var cordY = frtKnwLimitSt2;			
			var i = 0;
			var way = true; 
			while(fretX < frtKnwLimitFr2)
			{
				notesSuite = new Array(notesPerTest);				
				for ( j = 0; j < notesPerTest; j++) {	
					
					notesSuite[j] = drills_createSingleNoteFretboardLearning(fretX, cordY);		
					
					if(way)
					{
						cordY--;
						fretX++;					
					}
					else
					{
						cordY--;
						fretX--;	
						
					}
					
					way = !way;
					
					if(cordY < frtKnwLimitSt1)
					{
						cordY = frtKnwLimitSt2;
						if(way) fretX++;
					}				
				}				
				currentDrill[i] = notesSuite;i++;
				drillSize = currentDrill.length;
			}
			break;
			case "FM06D1":
			infiniteDrill = false;
			var fretX = 1;
			var cordY = frtKnwLimitSt2;			
			var i = 0;
			var way = true; 
			var wayGlobal = true; 
			
			while(fretX < frtKnwLimitFr2)
			{
				notesSuite = new Array(notesPerTest);				
				for ( j = 0; j < notesPerTest; j++) {	
					//trace("03", fretX + "//"+cordY);
					notesSuite[j] = drills_createSingleNoteFretboardLearning(fretX, cordY);		
					
					if(wayGlobal)
					{
						if(way)
						{
							cordY--;
							fretX++;					
						}
						else
						{
							cordY--;
							fretX--;
						}	
						
						way = !way;	
						
						if(cordY < frtKnwLimitSt1)
						{		
							cordY = frtKnwLimitSt1;
							//fretX--;
							wayGlobal = !wayGlobal;	
							//way = !way;	
						}							
					}
					else
					{
						if(way)
						{
							cordY++;
							fretX++;					
						}
						else
						{
							cordY++;
							fretX--;
						}	
						
						way = !way;	
						
						if(cordY >= frtKnwLimitSt2)
						{					
							cordY = frtKnwLimitSt2;
							//fretX--;
							wayGlobal = !wayGlobal;	
							way = !way;	
						}		
					}
					
					
					
					
					
					
				}				
				currentDrill[i] = notesSuite;i++;
				drillSize = currentDrill.length;
			}
			break;
			default:
			infiniteDrill = true;
			drillSize = CONST_DRILLSIZE;
			for ( i = 0; i < drillSize; i++) {
				notesSuite = new Array(notesPerTest);
				for ( j = 0; j < notesPerTest; j++) 
				{	//On choisi au hasard des coordonnées dans les limites définies			
					xCoord = Math.floor((Math.random() * (frtKnwLimitFr2 - frtKnwLimitFr1 + 1)) + frtKnwLimitFr1);
					yCoord = Math.floor((Math.random() * (frtKnwLimitSt2 - frtKnwLimitSt1 + 1)) + frtKnwLimitSt1);	
					if(onlyNaturalNotes)
					{	//Si on ne veut que des naturelles, on chercher jusqu'à trouver une naturelle
						while(drills_createSingleNoteFretboardLearning(xCoord, yCoord).note.substring(1, 2) != "N")
						{				
							xCoord = Math.floor((Math.random() * (frtKnwLimitFr2 - frtKnwLimitFr1 + 1)) + frtKnwLimitFr1);
							yCoord = Math.floor((Math.random() * (frtKnwLimitSt2 - frtKnwLimitSt1 + 1)) + frtKnwLimitSt1);	
						}
					}							
					notesSuite[j] = drills_createSingleNoteFretboardLearning(xCoord, yCoord);//On en déduit la note				
				}
				//On ajoute les notes au drill
				currentDrill[i] = notesSuite;
			}
			break;
		}
		
		//A REVOIR-------------------------------------------------------------------------
		/*
			if (askedDrill == "FM06A1") {
			
			infiniteDrill = false;
			var fretX = 0;
			var cordY = 0;		
			
			var i = 0;
			while(fretX <= frtKnwLimitFr2)
			{
			notesSuite = new Array(notesPerTest);
			
			for ( j = 0; j < notesPerTest; j++) {
			
			notesSuite[j] = drills_createSingleNoteFretboardLearning(fretX, cordY);
			
			cordY++;
			
			if(cordY > frtKnwLimitSt2) {				
			cordY = 0;
			fretX++;
			}
			}				
			currentDrill[i] = notesSuite;i++;
			drillSize = currentDrill.length;
			}
		*/
		
		/*		if (progressive && ((type == "C") || (type == "F"))) {
			
			var frtKnwLimitSt1TMP = frtKnwLimitSt1;
			var frtKnwLimitSt2TMP = frtKnwLimitSt1;
			var frtKnwLimitFr1TMP = frtKnwLimitFr1;
			var frtKnwLimitFr2TMP = frtKnwLimitFr1;
			var reset = 0;
			var jecontinue = true;
			var stopper = 0;
			
			var i = 0;
			while (jecontinue) {
			notesSuite = new Array(notesPerTest);
			for ( j = 0; j < notesPerTest; j++) {
			xCoord = Math.floor((Math.random() * (frtKnwLimitFr2TMP - frtKnwLimitFr1 + 1)) + frtKnwLimitFr1);
			yCoord = Math.floor((Math.random() * (frtKnwLimitSt2TMP - frtKnwLimitSt1 + 1)) + frtKnwLimitSt1);
			
			notesSuite[j] = drills_createSingleNoteFretboardLearning(xCoord, yCoord);
			}
			
			if (type == "C")
			stopper = (frtKnwLimitFr2TMP - frtKnwLimitFr1 + 1) * 2;
			if (type == "F")
			stopper = (frtKnwLimitSt2TMP - frtKnwLimitSt1 + 1) * 5;
			
			if (reset >= stopper) {
			reset = 0;
			if (frtKnwLimitSt2TMP < frtKnwLimitSt2) {
			frtKnwLimitSt2TMP++;
			} else {
			if (type == "F")
			jecontinue = false;
			}
			
			if (frtKnwLimitFr2TMP < frtKnwLimitFr2) {
			frtKnwLimitFr2TMP++;
			} else {
			if (type == "C")
			jecontinue = false;
			}
			}
			reset++;
			drill[i] = notesSuite;
			i++;
			}
			
		drillSize = i;*/
		//------------------------
		/*	} else {
			
		}*/
		return currentDrill;
		
	}
	
	
	// Créer un objet Note à partir de coordonées
	function drills_createSingleNoteFretboardLearning(xCoord, yCoord) {
		var singleNote = new Array();
		singleNote.note = fbLogic_getNoteFromCoordinates(xCoord, yCoord);
		
		if (accChoice == "A") {
			var sharpOrFlat = Math.floor((Math.random() * 2) + 1);
			if (sharpOrFlat == 1)
			singleNote.note = notesFlat[notesSharp.indexOf(singleNote.note.substring(0, 2))] + singleNote.note.substring(2, 3);
		}
		singleNote.display = fbLogic_displayableNote(singleNote.note);
		singleNote.fretX = xCoord;
		singleNote.stringY = yCoord;
		singleNote.Q = "1";
		singleNote.A = "1";
		singleNote.QuestionBlind = "1";
		singleNote.QuestionDeaf = "1";
		
		if (fretboardingLearningType == "FLNoteToPos") {
			singleNote.QuestionInvisible = "1";
			singleNote.showSheetInQ = "1";
			} else {
			singleNote.QuestionInvisible = "0";
			singleNote.showSheetInA = "1";
		}
		singleNote.fileToPlay = fbLogic_buildGuitarFileName(xCoord, yCoord, singleNote.note);
		
		return singleNote;
	}
	
	// Positionner les valeurs des paramètres d'exercices
	function drills_setDrill(drillCode)
	{
		var drillName = drillCode;
		var acc = "";
		
		if(drillCode.length >= 6) drillName = drillCode.substring(0, 6);
		if(drillCode.length >= 7) acc = drillCode.substring(6, 7);
		
		//trace("11", drillName.length+"++");
		//trace("11", drillName+"**");
		//trace("11", acc+"//");
		
		if(acc == "N") onlyNaturalNotes = true;
		else accChoice = acc; 
		
		askedDrill ="";
		switch(drillName) {	
			//NIVEAU 1 - Bases
			case "test"://a. Cordes à vide case 0
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 0;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 0;
			debugPiano="o";
			drillBPMLimit1 = 20;			
			drillBPMLimit2 = 250;			
			
			break;
			case "FM01A1"://a. Cordes à vide case 0
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 0;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			break;
			case "FM01B1"://b. Cordes case 12
			frtKnwLimitFr1 = 12;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			break;
			//NIVEAU 2 - Les notes naturelles
			case "FM02A1"://a. Corde de Si
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 1;
			frtKnwLimitSt2 = 1;
			//onlyNaturalNotes = true;
			break;	
			case "FM02B1"://b. Corde de Mi
			frtKnwLimitFr1 = 0;//0
			frtKnwLimitFr2 = 12;//12
			frtKnwLimitSt1 = 5;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = true;
			break;	
			case "FM02C1"://c. Corde de La
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 4;
			frtKnwLimitSt2 = 4;
			//onlyNaturalNotes = true;
			break;	
			case "FM02D1"://d. Corde de Ré
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 3;
			frtKnwLimitSt2 = 3;
			//onlyNaturalNotes = true;
			break;	
			case "ALL"://e. Corde de Sol
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 22;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			onlyNaturalNotes = false;
			break;
			case "FM02E1"://e. Corde de Sol
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 2;
			frtKnwLimitSt2 = 2;
			//onlyNaturalNotes = true;
			break;	
			case "FM02F1"://e. Corde de Sol
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 0;
			//onlyNaturalNotes = true;
			break;	
			//NIVEAU 3 - Les altarations
			case "FM03A1"://a. Corde de Si
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 1;
			frtKnwLimitSt2 = 1;
			//onlyNaturalNotes = false;
			//accChoice = "D";
			break;	
			case "FM03B1"://b. Corde de Mi
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 5;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "D";
			break;	
			case "FM03C1"://c. Corde de La
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 4;
			frtKnwLimitSt2 = 4;
			//onlyNaturalNotes = false;
			//accChoice = "D";
			break;	
			case "FM03D1"://d. Corde de Ré
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 3;
			frtKnwLimitSt2 = 3;
			//onlyNaturalNotes = false;
			//accChoice = "D";
			break;	
			case "FM03E1"://e. Corde de Sol
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 2;
			frtKnwLimitSt2 = 2;
			//onlyNaturalNotes = false;
			//accChoice = "D";
			break;	
			case "FM03F1"://f. Corde de Mi
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 12;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 0;
			//onlyNaturalNotes = false;
			//accChoice = "D";
			break;	
			//NIVEAU 4 - Maitrise de zones réduites
			case "FM04A1":
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 1;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;		
			case "FM04B1"://
			frtKnwLimitFr1 = 2;
			frtKnwLimitFr2 = 3;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;	
			case "FM04C1"://
			frtKnwLimitFr1 = 4;
			frtKnwLimitFr2 = 5;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;	
			case "FM04D1"://e. Corde de Sol
			frtKnwLimitFr1 = 6;
			frtKnwLimitFr2 = 7;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;	
			case "FM04E1":
			frtKnwLimitFr1 = 8;
			frtKnwLimitFr2 = 9;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;	
			case "FM04F1":
			frtKnwLimitFr1 = 10;
			frtKnwLimitFr2 = 11;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;	
			case "FM05A1":
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 3;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;	
			case "FM05B1":
			frtKnwLimitFr1 = 4;
			frtKnwLimitFr2 = 7;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;	
			case "FM05C1":
			frtKnwLimitFr1 = 8;
			frtKnwLimitFr2 = 11;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			//accChoice = "A";
			break;	
			case "FM06A1":
			case "FM06B1":
			case "FM06C1":		
			case "FM06D1":		
			askedDrill = drillName;
			//accChoice = "A";			
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = numberOfFrets;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			//onlyNaturalNotes = false;
			break;				
			default:
			frtKnwLimitFr1 = 0;
			frtKnwLimitFr2 = 0;
			frtKnwLimitSt1 = 0;
			frtKnwLimitSt2 = 5;
			break;
		}
		keepfrtKnwLimitFr2 = frtKnwLimitFr2;
	}
	
	
	
	
	