var canvasSizeBoule = 80;


$('#social').ready(function(){
	
	$('#twitter').bind('mouseenter click', function(e){	

		$('#twitter').removeClass('pulse animated').addClass('pulse animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$(this).removeClass('pulse animated');
		});
	})

	$('#facebook').bind('mouseenter click', function(e){	

		$('#facebook').removeClass('pulse animated').addClass('pulse animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$(this).removeClass('pulse animated');
		});
	})
}
)



function drawIn(canvasId, imagePath, colorBoule, speed, freshLevel)
{
	var canvas = document.getElementById(canvasId);
	var context = canvas.getContext('2d');
	var centerX = canvas.width / 2;
	var centerY = canvas.height / 2;
	var radius = (canvasSizeBoule-15)/2;		
	var radiusGold = (canvasSizeBoule-5)/2;
	context.translate(0.5,0.5);
	if(speed >= 120 && freshLevel==4)
	{
		context.beginPath();
		context.arc(centerX, centerY, radiusGold, 0, 2 * Math.PI, false);
		var gold = context.createLinearGradient(0, 0, canvas.width, 0);

		gold.addColorStop(0, '#BF9E37');   
		gold.addColorStop(1, '#F6E87F');
		context.fillStyle = gold;
		context.fill();

		speed = speed-20;
		speed = speed<0 ? 0 : speed;
		speed = speed/0.10;
		speed = 1+speed/1000;
		if(speed > 2) speed = 2;
		var x = canvas.width / 2;
		var y = canvas.height / 2;
		var radius = radius+4;
		var startAngle = 1 * Math.PI;
		var endAngle = 3 * Math.PI;
			//var endAngle = (speed) * Math.PI;
			var counterClockwise = false;

			context.beginPath();
			context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
			context.lineWidth = 0.5;

			context.strokeStyle = 'orange';
			context.stroke(); 
		}
		else
		{
			context.beginPath();
			context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
			context.fillStyle = colorBoule;
			context.fill();

			//SPEED
			//mini 20, maxi 120
			//120-20=100 // 120-100=20
			speed = speed-20;
			speed = speed<0 ? 0 : speed;
			speed = speed/0.10;
			speed = 1+speed/1000;
			if(speed > 2) speed = 2;
			var x = canvas.width / 2;
			var y = canvas.height / 2;
			var radius = radius+4;
			var startAngle = 1 * Math.PI;
			var endAngle = 2 * Math.PI;
			//var endAngle = (speed) * Math.PI;
			var counterClockwise = false;

			context.beginPath();
			context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
			context.lineWidth = 2;

			var grd = context.createLinearGradient(0, 0, canvas.width, 0);
			grd.addColorStop(0, '#F5ED7E');   
			grd.addColorStop(1, '#E13438');

			context.strokeStyle = '#cccccc';
			context.stroke(); 

			/*TIME*/
			endAngle = (speed) * Math.PI;
			context.beginPath();
			context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
			context.strokeStyle = grd;
			context.stroke();

			startAngle = 0.99 * Math.PI;
			endAngle = (0.01) * Math.PI;
			context.beginPath();
			context.arc(x, y, radius, startAngle, endAngle, true);

			context.strokeStyle = '#cccccc';
			context.stroke();

			var end = 0.99;
			if(freshLevel == 1) end = 0.75;
			if(freshLevel == 2) end = 0.50;
			if(freshLevel == 3) end = 0.25;
			if(freshLevel == 4) end = 0.01;
			startAngle = 0.99 * Math.PI;
			endAngle = end * Math.PI;
			context.beginPath();
			context.arc(x, y, radius, startAngle, endAngle, true);

			var grd = context.createLinearGradient(0, 0, canvas.width, 0);
			grd.addColorStop(0, '#F5ED7E');   
			grd.addColorStop(1, '#277545');

			context.strokeStyle = grd;
			context.stroke();
		}
	}


	var selectedDrill = "";
	function chooseDrill(exo, speed, dueDate, score, note, result)
	{
		/*document.getElementById('chosenDrill').value = exo;		*/
		/*$('#drillCode')[0].innerHTML = exo;*/
		//noguit = false;
		$('#BPMInput')[0].value = $('#BPMInput')[0].value > 220 ? 220 : speed;
		selectedDrill = exo;
		if(dueDate != "")
		{
			$('#dueLabel').removeClass('isInvisible'); 
			$('#dueLabel').addClass('isVisible'); 
			$('#dueStart').html(dueDate);
		}
		else
		{
			$('#dueLabel').removeClass('isVisible'); 
			$('#dueLabel').addClass('isInvisible'); 		
		}
		$('#drill-restore').html($('#'+exo).html());
		$("#drill-restore .drill-image").attr("id","newId");
		var drillToDisplay = $('#drill-restore .drill-name');
		var drillToDisplayColor = drillToDisplay.attr("color");
		var drillToDisplaySpeed = drillToDisplay.attr("speed");
		var drillToDisplayFresh = drillToDisplay.attr("fresh");
		canvasSizeBoule = 80;
		drawIn('newId', '', drillToDisplayColor, drillToDisplaySpeed, drillToDisplayFresh); 

		var module = exo.substring(3,4);
		//console.log(score);

		var title = $('.module'+module+' .title').html();
		var h3 = $('.module'+module+' h3').html();

		$('.startModuleTitle .title').html(title);
		$('.startModuleTitle h3').html(h3);

		if(note < 0)
		{
			$('#scoreLabel').removeClass('isVisible'); 
			$('#scoreLabel').addClass('isInvisible');
		}
		else
		{
			$('#scoreLabel').removeClass('isInvisible'); 
			$('#scoreLabel').addClass('isVisible'); 
			// $('#dueStart').html(dueDate);
		}

		$('#globalResult').removeClass('isInvisible');
		if(result != ""){
			//console.log(result);
			var t = result.split(";");

			var t1 = t[0].split(":");
			var t2 = t[1].split(":");
			//console.log(result);
			$('#previousNote').html(score+'%');

			$('#score1a').html(t1[0]);
			$('#score1q').html(t1[1]);
			$('#score2a').html(t2[0]);
			$('#score2q').html(t2[1]);
			$('#previousResult').removeClass('isInvisible');
			$('#previousNoteSimple').addClass('isInvisible');	

			if(score >= 90)
			{
				$('#scoreLabel2').addClass('isInvisible');			
				$('#scoreLabel').removeClass('isInvisible');	
			}
			else
			{
				$('#scoreLabel2').removeClass('isInvisible');			
				$('#scoreLabel').addClass('isInvisible');	
			}

		}
		else
		{
			$('#previousResult').addClass('isInvisible');	

			if(note >= 0)
			{
				if(note == 1)
				{
					$('#thumbImg').attr('src', 'images/thumbUp.svg');
					$('#scoreLabel2').addClass('isInvisible');			
					$('#scoreLabel').removeClass('isInvisible');	
				}

				if(note == 0)
				{
					$('#thumbImg').attr('src', 'images/thumbDown.svg');	
					$('#scoreLabel').addClass('isInvisible');				
					$('#scoreLabel2').removeClass('isInvisible');		


				}
				$('#previousNoteSimple').removeClass('isInvisible');
			}
			else
			{
				$('#globalResult').addClass('isInvisible');		
				$('#previousNoteSimple').addClass('isInvisible');		

				$('#scoreLabel2').addClass('isInvisible');					
				$('#scoreLabel').addClass('isInvisible');		

			}
		}
	}



	var noguit = false;
	function noguitClick()
	{
		noguit = !noguit;

		if(noguit)
		{
			// $('#noguitLabel img').attr('src', 'images/micOff.svg');
			$('#noguitLabel').addClass('isInvisible');	
			$('#noguitLabel2').removeClass('isInvisible');
		}
		else
		{
			// $('#noguitLabel img').attr('src', 'images/micOn.svg');
			$('#noguitLabel2').addClass('isInvisible');	
			$('#noguitLabel').removeClass('isInvisible');

		}

	}	

	function speedClick(add)
	{
		if(add == true)
		{
			$('#BPMInput')[0].value = parseInt($('#BPMInput')[0].value)+5 > 220 ? 220 : parseInt($('#BPMInput')[0].value)+5;
		}
		else
		{
			$('#BPMInput')[0].value = parseInt($('#BPMInput')[0].value)-5 < 20 ? 20 : parseInt($('#BPMInput')[0].value)-5;

		}


	}



	var fxm_width = 0;
	var fxm_previous_width = 0;

	window.onload = function(event) {
		if(window.innerWidth > 800)
		{
			$(".side-blocks").show();
		}
		else
		{  	
			$(".side-blocks").hide();
		}

		fxm_width=window.innerWidth;
		fxm_previous_width = fxm_width;
	};  

	window.onresize = function(event) { 		
		fxm_width=window.innerWidth;
		if(window.innerWidth > 800 )
		{
			$(".side-blocks").show();
			$(".main-block").show();
		}
		else
		{  	
			if(fxm_previous_width>800) 
			{
				$(".side-blocks").hide();
				$(".main-block").show();
				$('.menuProgLane').removeClass('menuProgLaneRight'); 
				$('.menuProgLane').addClass('menuProgLaneLeft');	
			}
		}
		fxm_previous_width = fxm_width;
	};


	function  updateWizard(id, wizard) {
	//console.log(result);
	$.post(
		'updateWizard_ax.php', 
		{
			id : id, 
			wizard : wizard
		},
		function(data1){
			//console.log(data1);
			
			
		},
		'text'
		);
	return false;
}




