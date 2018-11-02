var resulatatPiano = "";
var resultGameEncours = false;

var gameCounter = 0;
var globalDrillResult = true;
var color;



window.addEventListener("keydown", function (event) {
	if (event.defaultPrevented) {
    return; // Do nothing if the event was already processed
}

e = event.keyCode || event.which;
console.log(e);
switch (e) {
	case 65:$('#CN-pianokey').click();     
	break;
	case 90: $('#DN-pianokey').click();    
	break;
	case 69:$('#EN-pianokey').click();      
	break;
	case 82:$('#FN-pianokey').click();    
	break;
	case 84:$('#GN-pianokey').click();     
	break;
	case 89: $('#AN-pianokey').click();    
	break;
	case 85:$('#BN-pianokey').click();     
	break;

	case 50:$('#CD-pianokey').click();      
	break;
	case 51:$('#DD-pianokey').click();    
	break;	é
	case 53:$('#FD-pianokey').click();     
	break;
	case 54: $('#GD-pianokey').click();    
	break;
	case 55:$('#AD-pianokey').click();     
	break;
	default:
	return; 
}

event.preventDefault();
}, true);





(function($){	
	$('.pianoProtect, .blackNote').bind('touchstart touchend click', function(e){		

		
		if(play && drillPianoAnswered == false)
		{
			if(browsingNote != null)
			{
				var noteEncours = browsingNote.note.substring(0,2)


				if(browsingNote.note.substring(1,2) == "B")
				{
					var idxNEC = notesFlat.indexOf(noteEncours);
					noteEncours = notesSharp[idxNEC];
				}

				if(!drillPianoAnsweredAndEvaluated)
				{
					if(this.id.substring(0,2) == noteEncours) /*Bien répondu*/
					{
						score1a++;console.log('##'+score1a);
						$('#noteClicked').html(this.id.substring(0,2) + " = " + noteEncours + " YES");	
						resultGameEncours = true;
						// $('#circleGlobal').addClass('success');
						//color ='#4CAF50';	
						color ='#8AC149';	

						// $('#successCheck').removeClass('animated fadeOut');
						// $('#successCheck').addClass('animated fadeIn');	
/*
						$('#successCheck').css('opacity',0);
						$('#successCheck').fadeIn(1);
						$('#successCheck').css('opacity',1);
						$('#successCheck').removeClass().addClass('bounceIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$(this).removeClass();
						});*/


						$('#successCheck').css('z-index','100');
						$('#successCheck').removeClass('zoomIn animated').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$(this).removeClass('zoomIn animated');
						});

					}
					else /*Mal répondu*/
					{
						$('#noteClicked').html(this.id.substring(0,2) + " = " + noteEncours + " NO");	

						gameCounter++;
						if(gameCounter > 3)
						{
							gameCounter = 3;
						}
						else
						{


							if(gameCounter == 3) globalDrillResult = false;
							//$('#circleGray'+gameCounter).addClass("circleLost");
							// $('#circleGlobal').addClass('error');
						}
						color='#EF5350';

					}
				}

				$('.white').css('background-color','white');
				$('.whiteNoteLabel').css('color','#777');
				$('.blackNote').css('background-color','#3F3F3F');




				if($('#'+this.id).hasClass('blackNote'))
				{
					/*$('#'+this.id).css('background-color',color);*/
					if(resultGameEncours == true)
					{
						$('#'+this.id).removeClass('blackNoteStyleRed');
						$('#'+this.id).removeClass('blackNoteStyle');			
						$('#'+this.id).addClass('blackNoteStyleGreen');
						
					}
					else
					{
						$('#'+this.id).removeClass('blackNoteStyle');			
						$('#'+this.id).removeClass('blackNoteStyleGreen');
						$('#'+this.id).addClass('blackNoteStyleRed');

					}


					




				}
				else
				{
					$('#'+this.id+'-under').css('background-color',color);
					$('#'+this.id+'-text').css('color','white');
				}

				drillPianoAnsweredAndEvaluated = true;
			}
		}
		drillPianoAnswered = true;


		
	})	

})(jQuery);


