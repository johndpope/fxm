var resulatatPiano="";var resultGameEncours=!1;var gameCounter=0;var globalDrillResult=!0;var color;window.addEventListener("keydown",function(event){if(event.defaultPrevented){return}
e=event.keyCode||event.which;console.log(e);switch(e){case 65:$('#CN-pianokey').click();break;case 90:$('#DN-pianokey').click();break;case 69:$('#EN-pianokey').click();break;case 82:$('#FN-pianokey').click();break;case 84:$('#GN-pianokey').click();break;case 89:$('#AN-pianokey').click();break;case 85:$('#BN-pianokey').click();break;case 50:$('#CD-pianokey').click();break;case 51:$('#DD-pianokey').click();break;é
case 53:$('#FD-pianokey').click();break;case 54:$('#GD-pianokey').click();break;case 55:$('#AD-pianokey').click();break;default:return}
event.preventDefault()},!0);(function($){$('.pianoProtect, .blackNote').bind('touchstart touchend click',function(e){if(play&&drillPianoAnswered==!1)
{if(browsingNote!=null)
{var noteEncours=browsingNote.note.substring(0,2)
if(browsingNote.note.substring(1,2)=="B")
{var idxNEC=notesFlat.indexOf(noteEncours);noteEncours=notesSharp[idxNEC]}
if(!drillPianoAnsweredAndEvaluated)
{if(this.id.substring(0,2)==noteEncours)
{score1a++;console.log('##'+score1a);$('#noteClicked').html(this.id.substring(0,2)+" = "+noteEncours+" YES");resultGameEncours=!0;color='#8AC149';$('#successCheck').css('z-index','100');$('#successCheck').removeClass('zoomIn animated').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){$(this).removeClass('zoomIn animated')})}
else{$('#noteClicked').html(this.id.substring(0,2)+" = "+noteEncours+" NO");gameCounter++;if(gameCounter>3)
{gameCounter=3}
else{if(gameCounter==3)globalDrillResult=!1}
color='#EF5350'}}
$('.white').css('background-color','white');$('.whiteNoteLabel').css('color','#777');$('.blackNote').css('background-color','#3F3F3F');if($('#'+this.id).hasClass('blackNote'))
{if(resultGameEncours==!0)
{$('#'+this.id).removeClass('blackNoteStyleRed');$('#'+this.id).removeClass('blackNoteStyle');$('#'+this.id).addClass('blackNoteStyleGreen')}
else{$('#'+this.id).removeClass('blackNoteStyle');$('#'+this.id).removeClass('blackNoteStyleGreen');$('#'+this.id).addClass('blackNoteStyleRed')}}
else{$('#'+this.id+'-under').css('background-color',color);$('#'+this.id+'-text').css('color','white')}
drillPianoAnsweredAndEvaluated=!0}}
drillPianoAnswered=!0})})(jQuery)