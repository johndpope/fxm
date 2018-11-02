function sheet_updateSheetWithNote(note){if((!(typeof pianoDrill==='undefined'||pianoDrill===null))&&pianoDrill=="1"){sheet_updatePiano(note)}
else{var canvas=$("#sheetMusicCanvas")[0];var Ctx=canvas.getContext("2d");Ctx.clearRect(0,0,canvas.width,canvas.height);var renderer=new Vex.Flow.Renderer(canvas,Vex.Flow.Renderer.Backends.CANVAS);var ctx=renderer.getContext();var sheeet=document.getElementById('sheetMusic');var sheeetCanvas=document.getElementById('sheetMusicCanvas');var stave=new Vex.Flow.Stave(20,30,100);stave.addClef("treble").setContext(ctx).draw();if(note&&play&&notation=="both")
{$('#cheatNote').html(fbLogic_displayableNoteHTML(note))}
else{$('#cheatNote').html(" ")}
if(note)
{var name=note.substring(0,1);var acc=note.substring(1,2);if(acc=="B")
acc="b";if(acc=="D")
acc="#";if(acc=="N")
acc="";var pitch=parseInt(note.substring(2,3))+1;var myNote;if(acc=="")
myNote=new Vex.Flow.StaveNote({clef:'treble',keys:[name+"/"+pitch],duration:"q",auto_stem:!0});else myNote=new Vex.Flow.StaveNote({clef:'treble',keys:[name+acc+"/"+pitch],duration:"q",auto_stem:!0}).addAccidental(0,new Vex.Flow.Accidental(acc));var notes=[myNote];var voice=new Vex.Flow.Voice({num_beats:1,beat_value:4,resolution:Vex.Flow.RESOLUTION});voice.addTickables(notes);var formatter=new Vex.Flow.Formatter().joinVoices([voice]).format([voice],100);voice.draw(ctx,stave)}}}