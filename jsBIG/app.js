(function($){	
	$('#header__icon').click(function(e){
		e.preventDefault();
		$('body').toggleClass('with--sidebar');
	})
	
	$('#site-cache').click(function(e){		
		$('body').removeClass('with--sidebar');
	})

	$('.modalToogler').click(function(e){		
		$('.modal-frame').toggleClass('isVisible');

		$('.floating-character').removeClass('isInvisible'); 
		$('.floating-character').addClass('isInvisible'); 
	})	

	$('#endTheGame').click(function(e){		
		$('.modal-frame').addClass('isInvisible'); 
		$('#modalFrame_Results').removeClass('isInvisible'); 
		$('#modalFrame_Results').addClass('isVisible');		
	})

	$('.lockedDrill').click(function()
	{
		document.location.href = "fxm.php?page=subscribe";
	});

	//CINEMATIQUE MODALE:
	// Je clique sur le premier, je rend l'autre visible
	$('#modalFrame_Results-result-OK').click(function(e){navigateModals('modalFrame_Results-xp');})
	$('#modalFrame_Results-result-KO').click(function(e){navigateModals('modalFrame_Results-life');})

	$('#modalFrame_Results-xp-NEXT').click(function(e){navigateModals('modalFrame_Results-gold');})
	$('#modalFrame_Results-gold-NEXT').click(function(e){navigateModals('modalFrame_Results-gifts');})




	$('.menuProgRight').bind('touchstart touchend click', function(e){		

		$('.side-blocks').show();
		$('.main-block').hide();

		$('.menuProgLane').removeClass('menuProgLaneLeft'); 
		$('.menuProgLane').addClass('menuProgLaneRight');	
	})

	$('.menuProgLeft').bind('touchstart touchend click', function(e){

		$('.side-blocks').hide();
		$('.main-block').show();
		
		$('.menuProgLane').removeClass('menuProgLaneRight'); 
		$('.menuProgLane').addClass('menuProgLaneLeft');	
		
	})

	$('#titi').click(function(e){		
		event.preventDefault();
		var goal = $('#firstSection').offset().top - 66;
		$("html, body").animate({ scrollTop: goal });
		// $("html, body").animate({ scrollTop: "900px" });

		$('#firstSection').offset().top - 66
	})


	$('.helpButton').click(function()
	{
		navigateWizard('modalFrame_WizardDash-01');
	});

	$('.helpButtonProg').click(function()
	{
		//$('.side-blocks').hide();
		$('.wizardBlock').show();
		
		//$('.menuProgLane').removeClass('menuProgLaneRight'); 
		//$('.menuProgLane').addClass('menuProgLaneLeft');	
		navigateWizard('modalFrame_WizardProgression-01');
	});


	$('.helpButtonDrill').click(function()
	{

		navigateWizard('modalFrame_WizardDrill-01');
	});

	


})(jQuery);

function closeWizard()
{
	$('#modalFrame_Wizard').removeClass('isVisible'); 
	$('#modalFrame_Wizard').addClass('isInvisible'); 

	$('.modalFloater').removeClass('isInvisible'); 
	$('.modalFloater').addClass('isInvisible'); 
}

function navigateWizard(modalFrameName)
{
	$("#nextButton").show();
	$("#nextButton1").hide();	

	$('#modalFrame_Wizard').removeClass('isInvisible'); 
	$('#modalFrame_Wizard').addClass('isVisible'); 
	$("#previousButton").hide();
	currentFrame = modalFrameName;
	navigateModals(modalFrameName);
}

//Rend tous les objets de classe modalFloater invisible et rend l'objet dont l'id est en param visible
//en un mot: rend visible l'obj en param et rend invisible les autres
function navigateModals(modalFrameName)
{
	$('.modalFloater').removeClass('isInvisible'); 
	$('.modalFloater').addClass('isInvisible'); 
	
	$('#'+modalFrameName).removeClass('isInvisible'); 
	$('#'+modalFrameName).addClass('isVisible');
}
//Rend tous les objets de classe modalFloater invisible et rend l'objet dont l'id est en param visible
//en un mot: rend visible l'obj en param et rend invisible les autres
function navigateModalsInline(modalFrameName)
{
	$('.modalFloater').removeClass('isInvisible'); 
	$('.modalFloater').addClass('isInvisible'); 
	
	$('#'+modalFrameName).removeClass('isInvisible'); 
	$('#'+modalFrameName).addClass('isVisibleInline');
}
//Rend tous les objets de classe modalFloater invisible et rend l'objet dont l'id est en param visible
//en un mot: rend visible l'obj en param et rend invisible les autres
function sectionVisibility(section,  clicker)
{
	$('.accountSection').removeClass('isInvisible'); 
	$('.accountSection').addClass('isInvisible');

	$('#'+section).removeClass('isInvisible'); 
	$('#'+section).addClass('isVisible');

	$('.menubar').removeClass('menubarSelected'); 
	$('#'+clicker).addClass('menubarSelected');	
}

//Rend tous les objets de classe modalFloater invisible et rend l'objet dont l'id est en param visible
//en un mot: rend visible l'obj en param et rend invisible les autres
function navigating(modalFrameName, classToApply)
{
	$('.'+classToApply).removeClass('isInvisible'); 
	$('.'+classToApply).addClass('isInvisible'); 
	
	$('#'+modalFrameName).removeClass('isInvisible'); 
	$('#'+modalFrameName).addClass('isVisible');
}



//Met à jour l'image source du personnage
function updateCharacterImage(imageName, partToUpdate, details)
{	
	//console.log('#'+imageName);
	$('.saveButton').removeClass('saveButtonInactive');
	switch (partToUpdate) {
		case "background":
		//$('.character-background').attr('src', "images/"+imageName+".png");
		$('.character-background').attr('src', "images/"+imageName+".png");
		details["background"] = imageName;
		$('#backgrounds .object-frame').removeClass("object-selector");

		drawInCanvas("cvsBACK", "images/"+imageName+".png", 0);
		drawInCanvas("cvsBACK_mob", "images/"+imageName+".png", 0);
		//updateObject(details);
		break;
		case "character":
		$('.character-character').attr('src', "images/"+imageName+".png");
		//$('#character-character')[0].src="images/"+imageName+".png";
		details["character"] = imageName;
		$('#characters .object-frame').removeClass("object-selector");
		//updateObject(details);
		break;
		case "amp":
		//$('#character-amp')[0].src="images/"+imageName+".png";
		$('.character-amp').attr('src', "images/"+imageName+".png");
		details["amp"] = imageName;
		$('#amps .object-frame').removeClass("object-selector");
		//updateObject(details);
		break;
		case "guitar":
		//$('#character-guitar')[0].src="images/"+imageName+".png";
		$('.character-guitar').attr('src', "images/"+imageName+".png");
		details["guitar"] = imageName;
		$('#guitars .object-frame').removeClass("object-selector");

		drawInCanvas("cvsGUIT", "images/"+imageName+".png", 0);
		drawInCanvas("cvsGUIT_mob", "images/"+imageName+".png", 0);
		//updateObject(details);
		break;
		case "hair":
		details["hair"] = imageName;
		$('#hair .object-frame').removeClass("object-selector");

		drawInCanvas("cvsHAIR", "images/"+details["character"]+"/"+details["character"]+imageName+".png", 0);
		drawInCanvas("cvsHAIR_mob", "images/"+details["character"]+"/"+details["character"]+imageName+".png", 0);
		
		break;
		case "cup":
		details["cup"] = imageName;
		$('#clothesUp .object-frame').removeClass("object-selector");

		drawInCanvas("cvsCLUP", "images/"+details["character"]+"/"+details["character"]+imageName+".png", 0);
		drawInCanvas("cvsCLUP_mob", "images/"+details["character"]+"/"+details["character"]+imageName+".png", 0);
		
		drawInCanvas("cvsCLAR", "images/"+details["character"]+"/"+details["character"]+imageName+"a.png", 0);
		drawInCanvas("cvsCLAR_mob", "images/"+details["character"]+"/"+details["character"]+imageName+"a.png", 0);
		break;
		case "cdo":
		details["cdo"] = imageName;
		$('#clothesDown .object-frame').removeClass("object-selector");
		drawInCanvas("cvsCLDO", "images/"+details["character"]+"/"+details["character"]+imageName+".png", 0);
		drawInCanvas("cvsCLDO_mob", "images/"+imageName+".png", 0);
		break;
		case "access1":
		details["access1"] = imageName;
		$('#access1 .object-frame').removeClass("object-selector");
		drawInCanvas("cvsACC1", "images/"+details["character"]+"/"+details["character"]+imageName+".png", 0);
		drawInCanvas("cvsACC1_mob", "images/"+imageName+".png", 0);
		break;
	}	
	$("#"+imageName).addClass("object-selector");
}


function updateCharacter(details) {
//	console.log($('#characterNameInput')[0].value);
details["name"] = $('#characterNameInput')[0].value;
	//$('#character-name')[0].innerHTML = details["name"];
	$('.character-name').html(details["name"])
	updateObject(details);
}


function buyObject(id, type, price, details) {


	$.post(
		'character_ax.php', 
		{				
			id : id,
			price : price	

		},
		function(data){
			//console.log(data);
			var buying = JSON.parse(data.trim());   
			
			if(buying.error){
				$('body').notif({title:buying.message, cls:'error', timeout:5000})
			}
			else{				
				$('body').notif({title:buying.message, cls:'success', timeout:5000})

				$("#"+buying.id+"-buy").addClass("isInvisible");
				$("#"+buying.id+"-lock").addClass("isInvisible");
				$("#"+buying.id+"-price").addClass("isInvisible");
				$("#"+buying.id+"-gray").addClass("isInvisible");

				//$("#character-money")[0].innerHTML = buying.reste;
				$('.character-money').html(buying.reste)
				
			}
		},
		'text'
		);
	return false;
}

function buyPotion(potionPrice) {


	$.post(
		'character_ax.php', 
		{			
			
			potionPrice : potionPrice	

		},
		function(data){
			//console.log(data);
			var buying = JSON.parse(data.trim());   
			
			if(buying.error){
				$('body').notif({title:buying.message, cls:'error', timeout:5000})
			}
			else{				
				$('body').notif({title:buying.message, cls:'success', timeout:5000})

				//$("#character-money")[0].innerHTML = buying.reste;
				$('.character-money').html(buying.reste);
				//$('.character-money').html(buying.reste)
				//$("#LifeBarCharacter")[0].value = buying.life;
				//$(".LifeBarCharacter").attr('value', buying.life);

				//$(".xpProgressBar").attr('value', 'buying.life'+'%');
				$(".lifeProgressBar").width(buying.life+'%');

				$(".character-life").html(buying.life);
			}
		},
		'text'
		);
	return false;
}






//Fonction AX
function updateObject(details) {
	$.post(
		'character_ax.php', 
		{				
			characterBase : details["character"],
			guitarBase : details["guitar"],
			ampBase : details["amp"],
			backgroundBase : details["background"],
			hair : details["hair"]+"|ff",
			cup : details["cup"]+"|ff",
			cdo : details["cdo"]+"|ff",
			name : details["name"]

		},
		function(data){
			//console.log(data);
			var majbase = JSON.parse(data.trim());   
			if(majbase.error){
				$('body').notif({title:majbase.message, cls:'error', timeout:5000})
			}
			/*{
				
				//	$('body').notif({title:majbase.error, content:majbase.message, cls:'success', timeout:5000})
			}*/
		},
		'text'
		);
	return false;
}

//Fonction AX
function getSrsDrills(dateNow) {
	$.post(
		'drills_ax.php', 
		{				
			uid : 1,
			dateNow : dateNow
			

		},
		function(data){
			//console.log(data);
			var srsdrills = JSON.parse(data.trim());   
			
			if(srsdrills.error){
				$('body').notif({title:srsdrills.message, cls:'error', timeout:5000})
			}
			else{
				updateDrillDisplay(srsdrills);
			}
		},
		'text'
		);
	return false;
}

//met a jour les images d'exo à partir du retour de l'ajax
function updateDrillDisplay(srsdrills)
{
	//Nombree de drills enregistré
	var count = Object.keys(srsdrills).length - 1;

	//Niveau de vitesse
	var level = "01";

	//Niveau de fraicheur
	var freshLevel = "4";

	var now = new Date();
	var next_repetition;

	var oneWeek = new Date();
	oneWeek.setDate(oneWeek.getDate()+7);
	var oneMonth = new Date();
	oneMonth.setDate(oneMonth.getDate()+30);
	var fourMonths = new Date();
	fourMonths.setDate(fourMonths.getDate()+120);

	//On boucle sur les objets drills
	for (var i = 0, len = count; i < len; i++) {	
		
		//Si le noeud existe dans le DOM,
		if($('#'+srsdrills[i].drill_name)[0])
		{
			//on calcule le niveau de fraicheur en fonction de la date de prochaine répétition
			next_repetition = new Date(srsdrills[i].next_repetition);
			freshLevel = "4";
			if(next_repetition > oneWeek) {freshLevel = "3";} 
			if(next_repetition > oneMonth) {freshLevel = "2";} 
			if(next_repetition > fourMonths) {freshLevel = "1";} 

			//on calcule le niveau en fonction de la vitesse
			level = setLevelFromSpeed(srsdrills[i].speed+'');

			//On met à jour le dessin normal	
			$('#'+srsdrills[i].drill_name+'-speed')[0].src="images/speed"+level+".png";
			$('#'+srsdrills[i].drill_name+'-drill')[0].src="images/drill"+freshLevel+".png";

			//Si la date de prochaine répétition est passée, l'unité devient "due"
			if(next_repetition <= now)
			{				
				//On met à jour le dessin des unités du jour
				$('#'+srsdrills[i].drill_name+'-u').removeClass('isInvisible'); 
				$('#'+srsdrills[i].drill_name+'-u').addClass('isVisibleInline');
				$('#'+srsdrills[i].drill_name+'-u-speed')[0].src="images/speed"+level+".png";
				$('#'+srsdrills[i].drill_name+'-u-drill')[0].src="images/drill"+freshLevel+".png";
			}						
		}
	}
}


//Déterminer le niveau de vitesse en fonction de la vitesse
function setLevelFromSpeed(speed)
{
	var level = "01";
	if(speed <= 49) level = "01";
	if(speed >= 50  && speed <  70) level = "02";
	if(speed >= 70  && speed < 100) level = "03";
	if(speed >= 100 && speed < 120) level = "04";
	if(speed >= 120) level = "05";
	return level;
}

function toogleUserIcon()
{
	$('.floating-character').toggleClass('isInvisible');
	// $('#credentials').toggleClass('credentialSelected');
}

function toogleStatsIcon()
{
	$('.floating-stats').toggleClass('isInvisible');
}




