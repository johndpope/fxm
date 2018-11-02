	
	// █████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗
	// ╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝
	// ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗  
	// ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝  
	
	
	//  
	//  ███████╗██╗  ██╗███████╗███████╗████████╗
	//  ██╔════╝██║  ██║██╔════╝██╔════╝╚══██╔══╝
	//  ███████╗███████║█████╗  █████╗     ██║   
	//  ╚════██║██╔══██║██╔══╝  ██╔══╝     ██║   
	//  ███████║██║  ██║███████╗███████╗   ██║   
	//  ╚══════╝╚═╝  ╚═╝╚══════╝╚══════╝   ╚═╝   
	
	function sheet_updateSheetWithNote(note) {
		
		if((!(typeof pianoDrill === 'undefined' || pianoDrill === null)) && pianoDrill == "1"){
			sheet_updatePiano(note);
		}
		else{
			var canvas = $("#sheetMusicCanvas")[0];
			//var canvas = $("#sheetMusic");
			
			var Ctx = canvas.getContext("2d");
			Ctx.clearRect(0, 0, canvas.width, canvas.height);
			var renderer = new Vex.Flow.Renderer(canvas, Vex.Flow.Renderer.Backends.CANVAS);
			
			var ctx = renderer.getContext();
			var sheeet = document.getElementById('sheetMusic');
			var sheeetCanvas = document.getElementById('sheetMusicCanvas');
			//sheeetCanvas.style.width = "164px";//sheeet.offsetWidth;
			//alert(sheeet.width);
			//var stave = new Vex.Flow.Stave(20, 30, sheeet.offsetWidth-40);
			var stave = new Vex.Flow.Stave(20, 30, 100);
			stave.addClef("treble").setContext(ctx).draw();
			
			//if(document.getElementById('hardWrittenNote')) document.getElementById('hardWrittenNote').innerHTML = "";
			if(note && play && notation == "both")
			{			
				$('#cheatNote').html(fbLogic_displayableNoteHTML(note));
				//if(document.getElementById('hardWrittenNote')) document.getElementById('hardWrittenNote').innerHTML = fbLogic_displayableNoteHTML(note);
			}
			else
			{
				$('#cheatNote').html(" ");

			}			
			
			if(note)
			{
				var name = note.substring(0, 1);
				var acc = note.substring(1, 2);
				if (acc == "B")
				acc = "b";
				if (acc == "D")
				acc = "#";
				if (acc == "N")
				acc = "";
				var pitch = parseInt(note.substring(2, 3)) + 1;
				
				var myNote;
				if (acc == "")
				myNote = new Vex.Flow.StaveNote({
					clef: 'treble',
					keys : [name + "/" + pitch],
					duration : "q",
					auto_stem: true
				});
				else
				myNote = new Vex.Flow.StaveNote({
					clef: 'treble',
					keys : [name + acc + "/" + pitch],
					duration : "q",
					auto_stem: true
				}).addAccidental(0, new Vex.Flow.Accidental(acc));							
				
				// Create the notes
				var notes = [
				// A quarter-note C.
				//new Vex.Flow.StaveNote({ keys: ["b/4"], duration: "qr" }),
				myNote
				
				
				
					// A quarter-note D.
					//new Vex.Flow.StaveNote({ keys: ["d/4"], duration: "q" })
					
					// A quarter-note rest. Note that the key (b/4) specifies the vertical
					// position of the rest.
					//new Vex.Flow.StaveNote({ keys: ["b/4"], duration: "qr" }),
					
					// A C-Major chord.
				//new Vex.Flow.StaveNote({ keys: ["c/4", "e/4", "g/4"], duration: "q" })
				
				];
				
				// Create a voice in 4/4
				var voice = new Vex.Flow.Voice({
					num_beats : 1,
					beat_value : 4,
					resolution : Vex.Flow.RESOLUTION
				});
				
				// Add notes to voice
				voice.addTickables(notes);
				
				// Format and justify the notes to 500 pixels
				var formatter = new Vex.Flow.Formatter().joinVoices([voice]).format([voice], 100);
				//var formatter = new Vex.Flow.Formatter().joinVoices([voice]).format([voice], sheeet.offsetWidth-20);
				
				// Render voice
				voice.draw(ctx, stave);



			}


			
		}

		
	}
	
	