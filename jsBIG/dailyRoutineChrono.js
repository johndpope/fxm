var dailyRoutineChrono = 120;

(function($){	

	$('#chronoStarter').click(function(e){			
		dailyStartChrono();
    //tick();
  })

  $('.chrono01').click(function(e){      
    //dailyStartChrono();
   //console.log($(this).attr("time"));
    
   sessionDuration = parseInt($(this).attr("time"));
   displayDailyChrono();
    //tick();
  })  	



})(jQuery);


var defaults = {}
, one_second = 1000
, one_minute = one_second * 60
, one_hour = one_minute * 60
, one_day = one_hour * 24
, startDate = new Date()
, face = document.getElementById('lazy');

// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
var requestAnimationFrame = (function() {
  return window.requestAnimationFrame       || 
  window.webkitRequestAnimationFrame || 
  window.mozRequestAnimationFrame    || 
  window.oRequestAnimationFrame      || 
  window.msRequestAnimationFrame     || 
  function( callback ){
   window.setTimeout(callback, 1000 / 60);
 };
}());



var now = new Date(); 
var endTime; // Heure de fin (heure de début + durée de la session)
var timeDifference; // Différence entre l'heure de fin et l'heure en cours
var sessionDuration = 0;//parseInt($('#chrono01').attr("time")); // durée de la session en secondes


function initProgressBarAndChrono()
{
  now = new Date();
  endTime = new Date();
  endTime.setSeconds(endTime.getSeconds() + sessionDuration);
  timeDifference = endTime - now;

  $('#dailyProgressBar').val(0);
  $('#dailyRoutineChrono').text(millisecondsToFormattedTime(timeDifference));
}


function dailyStartChrono() {
  initProgressBarAndChrono()

  updateDailyProgressBar();
}


// Calcule le pourcentage d'avancement du temps écoulé par rapport au temps total 
// et mets à jour la progressBar
function updateDailyProgressBar(){

  now = new Date();
  var newTimeDifference = endTime - now;
  var percentDifference = (100-((newTimeDifference/timeDifference)*100));

  $('#dailyProgressBar').val(percentDifference);
  $('#dailyRoutineChrono').text(millisecondsToFormattedTime(newTimeDifference));

  if(percentDifference <= 100) requestAnimationFrame(updateDailyProgressBar);
}


function millisecondsToFormattedTime(newTimeDifference){
  var parts = [];
  var newTimeDifference2 = newTimeDifference + 1000; //on ajouter 1s pour ne pas se retrouvezr à -1 sur le compteur
  parts[0] = '' + Math.floor( newTimeDifference2 / one_hour );
  parts[1] = '' + Math.floor( (newTimeDifference2 % one_hour) / one_minute );
  parts[2] = '' + Math.floor( ( (newTimeDifference2 % one_hour) % one_minute ) / one_second );

  parts[0] = (parts[0].length == 1) ? '0' + parts[0] : parts[0];
  parts[1] = (parts[1].length == 1) ? '0' + parts[1] : parts[1];
  parts[2] = (parts[2].length == 1) ? '0' + parts[2] : parts[2];
  return parts.join(':');
}


sessionDuration--;
initProgressBarAndChrono();
sessionDuration++;





function displayDailyChrono()
{

sessionDuration--;
initProgressBarAndChrono();
sessionDuration++;

}


displayDailyChrono();