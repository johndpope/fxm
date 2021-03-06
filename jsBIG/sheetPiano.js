﻿

	
	function makeBar(hand)
	{
		var notesRight = ["c/4", "d/4", "e/4", "f/4", "g/4"];
		var notesLeft = ["c/3", "d/3", "e/3", "f/3", "g/3"];		
		
		var notesReal = notesRight;
		if(hand == "left") notesReal = notesLeft;
		
		var cle = 'treble';
		if(hand == "left") cle = 'bass';
		
		var randNote = (Math.floor((Math.random() * 5) + 1)) - 1;		
		var chosen = notesReal[randNote];	
		
		//(1, 22, 244, 442, 4444, 2.4)
		var randNoteRhythmic = (Math.floor((Math.random() * 7) + 1)) - 1;
		//var NoteRhythmic = ["1000", "2020", "2044", "4420", "4444", "88888888"];
		var NoteRhythmic = ["1000", "2020", "2044", "4420", "4444", "2004", "4200"];
		
		var rhythmicPattern = NoteRhythmic[randNoteRhythmic];
		//var rhythmicPattern = "2020";
		var notesRand = new Array;
		var noteCreated;
		switch(rhythmicPattern)
		{
			case "1000":	
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote];
			noteCreated = new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "w" });
			notesRand.push(noteCreated);
			
			
			break;
			case "2004":
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "hd" }).addDotToAll());
			
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			break;
			case "4200":
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "hd" }).addDotToAll());
			break;
			case "2020":
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "h" }));
			
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "h" }));
			break;
			case "2044":
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "h" }));
			
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			break;
			case "4420":	
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "h" }));				
			break;
			case "4444":			
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			randNote = (Math.floor((Math.random() * 5) + 1)) - 1; 
			chosen = notesReal[randNote]+'';
			notesRand.push(new Vex.Flow.StaveNote({ clef: cle, keys: [chosen], duration: "q" }));
			break;
			default:
			break;
		}
		
		return notesRand;
	}
	
	
	//taille signature + clé = 55 px
	var staveLenght = 145;
	var firstStaveLenght = 200;	
			
	var atrebleVoice1;
	var atrebleVoice2;
	var atrebleVoice3;
	var atrebleVoice4;
	var abassVoice1;
	var abassVoice2;
	var abassVoice3;
	var abassVoice4;
	
	var astave;
	var astaveBar2;
	var astaveBar3;
	var astaveBar4;
	var astaveBass;
	var astaveBassBar2;
	var astaveBassBar3;
	var astaveBassBar4;
	
	var barOffsetWidth = 0;
	var barOffsetWidthLive = 0;
	function sheet_updatePiano(note) {
		
		
		staveLenght = 145;
		firstStaveLenght = 200;
		//trace("11", document.getElementById("boxPaperPiano").offsetWidth);
		barOffsetWidth  = document.getElementById("boxPaperPiano").offsetWidth;
		
		barOffsetWidth = barOffsetWidth - 30;
		barOffsetWidth = barOffsetWidth / 4;
		firstStaveLenght = barOffsetWidth;
		staveLenght = barOffsetWidth;
		
		if(firstStaveLenght > 200) firstStaveLenght = 200;
		if(staveLenght > 200) staveLenght = 200;
		
		
		// Create a voice in 4/4
		function create_4_4_voice() {
			return new Vex.Flow.Voice({
				num_beats: 4,
				beat_value: 4,
				resolution: Vex.Flow.RESOLUTION
			});
		}
		
		var canvas = $("div.two div.a canvas")[0];		
		var renderer = new Vex.Flow.Renderer(canvas,
		Vex.Flow.Renderer.Backends.CANVAS);		
		var ctx = renderer.getContext();
		ctx.clearRect(0, 0, canvas.width, canvas.height);	
		
		
		//LIGNE 1			---------------------
		stave     = createBarSkeleton(true,  "treble", "4/4", 5, 0, "");
		staveBar2 = createBarSkeleton(false, "treble", "4/4", 0, 0, stave);
		staveBar3 = createBarSkeleton(false, "treble", "4/4", 0, 0, staveBar2);
		staveBar4 = createBarSkeleton(false, "treble", "4/4", 0, 0, staveBar3);			
		stave.setContext(ctx).draw();		
		staveBar2.setContext(ctx).draw();
		staveBar3.setContext(ctx).draw();		
		staveBar4.setContext(ctx).draw();
		
		staveBass     = createBarSkeleton(true,  "bass", "4/4", 5, 80, "");
		staveBassBar2 = createBarSkeleton(false, "bass", "4/4", 0, 0, staveBass);
		staveBassBar3 = createBarSkeleton(false, "bass", "4/4", 0, 0, staveBassBar2);
		staveBassBar4 = createBarSkeleton(false, "bass", "4/4", 0, 0, staveBassBar3);		
		staveBass.setContext(ctx).draw();		
		staveBassBar2.setContext(ctx).draw();
		staveBassBar3.setContext(ctx).draw();
		staveBassBar4.setContext(ctx).draw();
		
		if(atrebleVoice1 != null)
		{			
			var aformatter1 = new Vex.Flow.Formatter();aformatter1.format([atrebleVoice1, abassVoice1], staveLenght-15);
			var aformatter2 = new Vex.Flow.Formatter();aformatter2.format([atrebleVoice2, abassVoice2], staveLenght-15);
			var aformatter3 = new Vex.Flow.Formatter();aformatter3.format([atrebleVoice3, abassVoice3], staveLenght-15);
			var aformatter4 = new Vex.Flow.Formatter();aformatter4.format([atrebleVoice4, abassVoice4], staveLenght-15);
			                                                                            
			var max_x;
			max_x = Math.max(stave.getNoteStartX(), staveBass.getNoteStartX()); stave.setNoteStartX(max_x-10); staveBass.setNoteStartX(max_x-10);
			max_x = Math.max(staveBar2.getNoteStartX(), staveBassBar2.getNoteStartX());staveBar2.setNoteStartX(max_x-10);staveBassBar2.setNoteStartX(max_x-10);		
			max_x = Math.max(staveBar3.getNoteStartX(), staveBassBar3.getNoteStartX());staveBar3.setNoteStartX(max_x-10);staveBassBar3.setNoteStartX(max_x-10);		
			max_x = Math.max(staveBar4.getNoteStartX(), staveBassBar4.getNoteStartX());staveBar4.setNoteStartX(max_x-10);staveBassBar4.setNoteStartX(max_x-10);
			
			atrebleVoice1.draw(ctx, stave);	    abassVoice1.draw(ctx, staveBass);
			atrebleVoice2.draw(ctx, staveBar2);	abassVoice2.draw(ctx, staveBassBar2);
			atrebleVoice3.draw(ctx, staveBar3);	abassVoice3.draw(ctx, staveBassBar3);
			atrebleVoice4.draw(ctx, staveBar4);	abassVoice4.draw(ctx, staveBassBar4);		
			
			
		}
		else
		{
			
			var trebleNotes1 = makeBar("right");
			var trebleNotes2 = makeBar("right");
			var trebleNotes3 = makeBar("right");
			var trebleNotes4 = makeBar("right");		
			trebleVoice1 = create_4_4_voice().addTickables(trebleNotes1);
			trebleVoice2 = create_4_4_voice().addTickables(trebleNotes2);
			trebleVoice3 = create_4_4_voice().addTickables(trebleNotes3);
			trebleVoice4 = create_4_4_voice().addTickables(trebleNotes4);
			
			
			var bassNotes1 = makeBar("left");
			var bassNotes2 = makeBar("left");
			var bassNotes3 = makeBar("left");
			var bassNotes4 = makeBar("left");		
			bassVoice1 = create_4_4_voice().addTickables(bassNotes1);
			bassVoice2 = create_4_4_voice().addTickables(bassNotes2);
			bassVoice3 = create_4_4_voice().addTickables(bassNotes3);
			bassVoice4 = create_4_4_voice().addTickables(bassNotes4);
			
			var formatter1 = new Vex.Flow.Formatter();formatter1.format([trebleVoice1, bassVoice1], staveLenght-15);			
			var formatter2 = new Vex.Flow.Formatter();formatter2.format([trebleVoice2, bassVoice2], staveLenght-15);
			var formatter3 = new Vex.Flow.Formatter();formatter3.format([trebleVoice3, bassVoice3], staveLenght-15);
			var formatter4 = new Vex.Flow.Formatter();formatter4.format([trebleVoice4, bassVoice4], staveLenght-15);
			
			var max_x;
			max_x = Math.max(stave.getNoteStartX(), staveBass.getNoteStartX());            stave.setNoteStartX(max_x-10);    staveBass.setNoteStartX(max_x-10);
			max_x = Math.max(staveBar2.getNoteStartX(), staveBassBar2.getNoteStartX());staveBar2.setNoteStartX(max_x-10);staveBassBar2.setNoteStartX(max_x-10);		
			max_x = Math.max(staveBar3.getNoteStartX(), staveBassBar3.getNoteStartX());staveBar3.setNoteStartX(max_x-10);staveBassBar3.setNoteStartX(max_x-10);		
			max_x = Math.max(staveBar4.getNoteStartX(), staveBassBar4.getNoteStartX());staveBar4.setNoteStartX(max_x-10);staveBassBar4.setNoteStartX(max_x-10);
			
			
			trebleVoice1.draw(ctx, stave);	    bassVoice1.draw(ctx, staveBass);
			trebleVoice2.draw(ctx, staveBar2);	bassVoice2.draw(ctx, staveBassBar2);
			trebleVoice3.draw(ctx, staveBar3);	bassVoice3.draw(ctx, staveBassBar3);
			trebleVoice4.draw(ctx, staveBar4);	bassVoice4.draw(ctx, staveBassBar4);		
			
			
			
		}
		
		
		
		
		//LIGNE2			---------------------
		astave     = createBarSkeleton(true,  "treble", "4/4", 5, 160, "");
		astaveBar2 = createBarSkeleton(false, "treble", "4/4", 0, 0, astave);
		astaveBar3 = createBarSkeleton(false, "treble", "4/4", 0, 0, astaveBar2);
		astaveBar4 = createBarSkeleton(false, "treble", "4/4", 0, 0, astaveBar3);			
		astave.setContext(ctx).draw();		
		astaveBar2.setContext(ctx).draw();
		astaveBar3.setContext(ctx).draw();		
		astaveBar4.setContext(ctx).draw();
		var atrebleNotes1 = makeBar("right");
		var atrebleNotes2 = makeBar("right");
		var atrebleNotes3 = makeBar("right");
		var atrebleNotes4 = makeBar("right");		
		atrebleVoice1 = create_4_4_voice().addTickables(atrebleNotes1);
		atrebleVoice2 = create_4_4_voice().addTickables(atrebleNotes2);
		atrebleVoice3 = create_4_4_voice().addTickables(atrebleNotes3);
		atrebleVoice4 = create_4_4_voice().addTickables(atrebleNotes4);
		
		astaveBass     = createBarSkeleton(true,  "bass", "4/4", 5, 240, "");
		astaveBassBar2 = createBarSkeleton(false, "bass", "4/4", 0, 0, astaveBass);
		astaveBassBar3 = createBarSkeleton(false, "bass", "4/4", 0, 0, astaveBassBar2);
		astaveBassBar4 = createBarSkeleton(false, "bass", "4/4", 0, 0, astaveBassBar3);		
		astaveBass.setContext(ctx).draw();		
		astaveBassBar2.setContext(ctx).draw();
		astaveBassBar3.setContext(ctx).draw();
		astaveBassBar4.setContext(ctx).draw();
		var abassNotes1 = makeBar("left");
		var abassNotes2 = makeBar("left");
		var abassNotes3 = makeBar("left");
		var abassNotes4 = makeBar("left");		
		abassVoice1 = create_4_4_voice().addTickables(abassNotes1);
		abassVoice2 = create_4_4_voice().addTickables(abassNotes2);
		abassVoice3 = create_4_4_voice().addTickables(abassNotes3);
		abassVoice4 = create_4_4_voice().addTickables(abassNotes4);
		
		var aformatter1 = new Vex.Flow.Formatter();aformatter1.format([atrebleVoice1, abassVoice1], staveLenght-15);
		var aformatter2 = new Vex.Flow.Formatter();aformatter2.format([atrebleVoice2, abassVoice2], staveLenght-15);
		var aformatter3 = new Vex.Flow.Formatter();aformatter3.format([atrebleVoice3, abassVoice3], staveLenght-15);
		var aformatter4 = new Vex.Flow.Formatter();aformatter4.format([atrebleVoice4, abassVoice4], staveLenght-15);
		
		//var formatter2 = new Vex.Flow.Formatter().joinVoices([voiceBass]).format([voiceBass], 500);
		
		max_x = Math.max(astave.getNoteStartX(), astaveBass.getNoteStartX());            astave.setNoteStartX(max_x-10); astaveBass.setNoteStartX(max_x-10);
		max_x = Math.max(astaveBar2.getNoteStartX(), astaveBassBar2.getNoteStartX());astaveBar2.setNoteStartX(max_x-10);astaveBassBar2.setNoteStartX(max_x-10);		
		max_x = Math.max(astaveBar3.getNoteStartX(), astaveBassBar3.getNoteStartX());astaveBar3.setNoteStartX(max_x-10);astaveBassBar3.setNoteStartX(max_x-10);		
		max_x = Math.max(astaveBar4.getNoteStartX(), astaveBassBar4.getNoteStartX());astaveBar4.setNoteStartX(max_x-10);astaveBassBar4.setNoteStartX(max_x-10);
		
		//astave.setNoteStartX(0);
		//trace("11", "astave.getNoteStartX(): "+astave.getNoteStartX());
		atrebleVoice1.draw(ctx, astave);	    abassVoice1.draw(ctx, astaveBass);
		atrebleVoice2.draw(ctx, astaveBar2);	abassVoice2.draw(ctx, astaveBassBar2);
		atrebleVoice3.draw(ctx, astaveBar3);	abassVoice3.draw(ctx, astaveBassBar3);
		atrebleVoice4.draw(ctx, astaveBar4);	abassVoice4.draw(ctx, astaveBassBar4);
		
		for (i = 0; i < atrebleNotes1.length; i++) { 
				//trace("11","testX "+atrebleNotes1[i].getAbsoluteX());
					
		}
		
	}
	
	
	
	
	function createBarSkeleton(first, clef, sig, x, y, previous)
	{
		var staveBar2;
		if(first == true)
		{
			staveBar2 = new Vex.Flow.Stave(x,y, firstStaveLenght);			
			staveBar2.setBegBarType(Vex.Flow.Barline.type.SINGLE);
			staveBar2.setEndBarType(Vex.Flow.Barline.type.SINGLE);
			
			//staveBar2.addClef(clef);
			//staveBar2.addTimeSignature(sig);
			
		}
		else
		{
			staveBar2 = new Vex.Flow.Stave(previous.width + previous.x,previous.y, staveLenght);
			staveBar2.setBegBarType(Vex.Flow.Barline.type.SINGLE);
			staveBar2.setEndBarType(Vex.Flow.Barline.type.SINGLE);			
		}
		
		return staveBar2;
	}
	
	
	// █████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗
	// ╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝
	// ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗  
	// ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝  
	