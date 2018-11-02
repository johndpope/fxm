(function($){$('#header__icon').click(function(e){e.preventDefault();$('body').toggleClass('with--sidebar')})
$('#site-cache').click(function(e){$('body').removeClass('with--sidebar')})
$('.modalToogler').click(function(e){$('.modal-frame').toggleClass('isVisible');$('.floating-character').removeClass('isInvisible');$('.floating-character').addClass('isInvisible')})
$('#endTheGame').click(function(e){$('.modal-frame').addClass('isInvisible');$('#modalFrame_Results').removeClass('isInvisible');$('#modalFrame_Results').addClass('isVisible')})
$('.lockedDrill').click(function()
{document.location.href="fxm.php?page=subscribe"});$('#modalFrame_Results-result-OK').click(function(e){navigateModals('modalFrame_Results-xp')})
$('#modalFrame_Results-result-KO').click(function(e){navigateModals('modalFrame_Results-life')})
$('#modalFrame_Results-xp-NEXT').click(function(e){navigateModals('modalFrame_Results-gold')})
$('#modalFrame_Results-gold-NEXT').click(function(e){navigateModals('modalFrame_Results-gifts')})
$('.menuProgRight').bind('touchstart touchend click',function(e){$('.side-blocks').show();$('.main-block').hide();$('.menuProgLane').removeClass('menuProgLaneLeft');$('.menuProgLane').addClass('menuProgLaneRight')})
$('.menuProgLeft').bind('touchstart touchend click',function(e){$('.side-blocks').hide();$('.main-block').show();$('.menuProgLane').removeClass('menuProgLaneRight');$('.menuProgLane').addClass('menuProgLaneLeft')})
$('#titi').click(function(e){event.preventDefault();var goal=$('#firstSection').offset().top-66;$("html, body").animate({scrollTop:goal});$('#firstSection').offset().top-66})
$('.helpButton').click(function()
{navigateWizard('modalFrame_WizardDash-01')});$('.helpButtonProg').click(function()
{$('.wizardBlock').show();navigateWizard('modalFrame_WizardProgression-01')});$('.helpButtonDrill').click(function()
{navigateWizard('modalFrame_WizardDrill-01')})})(jQuery);function closeWizard()
{$('#modalFrame_Wizard').removeClass('isVisible');$('#modalFrame_Wizard').addClass('isInvisible');$('.modalFloater').removeClass('isInvisible');$('.modalFloater').addClass('isInvisible')}
function navigateWizard(modalFrameName)
{$("#nextButton").show();$("#nextButton1").hide();$('#modalFrame_Wizard').removeClass('isInvisible');$('#modalFrame_Wizard').addClass('isVisible');$("#previousButton").hide();currentFrame=modalFrameName;navigateModals(modalFrameName)}
function navigateModals(modalFrameName)
{$('.modalFloater').removeClass('isInvisible');$('.modalFloater').addClass('isInvisible');$('#'+modalFrameName).removeClass('isInvisible');$('#'+modalFrameName).addClass('isVisible')}
function navigateModalsInline(modalFrameName)
{$('.modalFloater').removeClass('isInvisible');$('.modalFloater').addClass('isInvisible');$('#'+modalFrameName).removeClass('isInvisible');$('#'+modalFrameName).addClass('isVisibleInline')}
function sectionVisibility(section,clicker)
{$('.accountSection').removeClass('isInvisible');$('.accountSection').addClass('isInvisible');$('#'+section).removeClass('isInvisible');$('#'+section).addClass('isVisible');$('.menubar').removeClass('menubarSelected');$('#'+clicker).addClass('menubarSelected')}
function navigating(modalFrameName,classToApply)
{$('.'+classToApply).removeClass('isInvisible');$('.'+classToApply).addClass('isInvisible');$('#'+modalFrameName).removeClass('isInvisible');$('#'+modalFrameName).addClass('isVisible')}
function updateCharacterImage(imageName,partToUpdate,details)
{$('.saveButton').removeClass('saveButtonInactive');switch(partToUpdate){case "background":$('.character-background').attr('src',"images/"+imageName+".png");details.background=imageName;$('#backgrounds .object-frame').removeClass("object-selector");drawInCanvas("cvsBACK","images/"+imageName+".png",0);drawInCanvas("cvsBACK_mob","images/"+imageName+".png",0);break;case "character":$('.character-character').attr('src',"images/"+imageName+".png");details.character=imageName;$('#characters .object-frame').removeClass("object-selector");break;case "amp":$('.character-amp').attr('src',"images/"+imageName+".png");details.amp=imageName;$('#amps .object-frame').removeClass("object-selector");break;case "guitar":$('.character-guitar').attr('src',"images/"+imageName+".png");details.guitar=imageName;$('#guitars .object-frame').removeClass("object-selector");drawInCanvas("cvsGUIT","images/"+imageName+".png",0);drawInCanvas("cvsGUIT_mob","images/"+imageName+".png",0);break;case "hair":details.hair=imageName;$('#hair .object-frame').removeClass("object-selector");drawInCanvas("cvsHAIR","images/"+details.character+"/"+details.character+imageName+".png",0);drawInCanvas("cvsHAIR_mob","images/"+details.character+"/"+details.character+imageName+".png",0);break;case "cup":details.cup=imageName;$('#clothesUp .object-frame').removeClass("object-selector");drawInCanvas("cvsCLUP","images/"+details.character+"/"+details.character+imageName+".png",0);drawInCanvas("cvsCLUP_mob","images/"+details.character+"/"+details.character+imageName+".png",0);drawInCanvas("cvsCLAR","images/"+details.character+"/"+details.character+imageName+"a.png",0);drawInCanvas("cvsCLAR_mob","images/"+details.character+"/"+details.character+imageName+"a.png",0);break;case "cdo":details.cdo=imageName;$('#clothesDown .object-frame').removeClass("object-selector");drawInCanvas("cvsCLDO","images/"+details.character+"/"+details.character+imageName+".png",0);drawInCanvas("cvsCLDO_mob","images/"+imageName+".png",0);break;case "access1":details.access1=imageName;$('#access1 .object-frame').removeClass("object-selector");drawInCanvas("cvsACC1","images/"+details.character+"/"+details.character+imageName+".png",0);drawInCanvas("cvsACC1_mob","images/"+imageName+".png",0);break}
$("#"+imageName).addClass("object-selector")}
function updateCharacter(details){details.name=$('#characterNameInput')[0].value;$('.character-name').html(details.name)
updateObject(details)}
function buyObject(id,type,price,details){$.post('character_ax.php',{id:id,price:price},function(data){var buying=JSON.parse(data.trim());if(buying.error){$('body').notif({title:buying.message,cls:'error',timeout:5000})}
else{$('body').notif({title:buying.message,cls:'success',timeout:5000})
$("#"+buying.id+"-buy").addClass("isInvisible");$("#"+buying.id+"-lock").addClass("isInvisible");$("#"+buying.id+"-price").addClass("isInvisible");$("#"+buying.id+"-gray").addClass("isInvisible");$('.character-money').html(buying.reste)}},'text');return!1}
function buyPotion(potionPrice){$.post('character_ax.php',{potionPrice:potionPrice},function(data){var buying=JSON.parse(data.trim());if(buying.error){$('body').notif({title:buying.message,cls:'error',timeout:5000})}
else{$('body').notif({title:buying.message,cls:'success',timeout:5000})
$('.character-money').html(buying.reste);$(".lifeProgressBar").width(buying.life+'%');$(".character-life").html(buying.life)}},'text');return!1}
function updateObject(details){$.post('character_ax.php',{characterBase:details.character,guitarBase:details.guitar,ampBase:details.amp,backgroundBase:details.background,hair:details.hair+"|ff",cup:details.cup+"|ff",cdo:details.cdo+"|ff",name:details.name},function(data){var majbase=JSON.parse(data.trim());if(majbase.error){$('body').notif({title:majbase.message,cls:'error',timeout:5000})}},'text');return!1}
function getSrsDrills(dateNow){$.post('drills_ax.php',{uid:1,dateNow:dateNow},function(data){var srsdrills=JSON.parse(data.trim());if(srsdrills.error){$('body').notif({title:srsdrills.message,cls:'error',timeout:5000})}
else{updateDrillDisplay(srsdrills)}},'text');return!1}
function updateDrillDisplay(srsdrills)
{var count=Object.keys(srsdrills).length-1;var level="01";var freshLevel="4";var now=new Date();var next_repetition;var oneWeek=new Date();oneWeek.setDate(oneWeek.getDate()+7);var oneMonth=new Date();oneMonth.setDate(oneMonth.getDate()+30);var fourMonths=new Date();fourMonths.setDate(fourMonths.getDate()+120);for(var i=0,len=count;i<len;i++){if($('#'+srsdrills[i].drill_name)[0])
{next_repetition=new Date(srsdrills[i].next_repetition);freshLevel="4";if(next_repetition>oneWeek){freshLevel="3"}
if(next_repetition>oneMonth){freshLevel="2"}
if(next_repetition>fourMonths){freshLevel="1"}
level=setLevelFromSpeed(srsdrills[i].speed+'');$('#'+srsdrills[i].drill_name+'-speed')[0].src="images/speed"+level+".png";$('#'+srsdrills[i].drill_name+'-drill')[0].src="images/drill"+freshLevel+".png";if(next_repetition<=now)
{$('#'+srsdrills[i].drill_name+'-u').removeClass('isInvisible');$('#'+srsdrills[i].drill_name+'-u').addClass('isVisibleInline');$('#'+srsdrills[i].drill_name+'-u-speed')[0].src="images/speed"+level+".png";$('#'+srsdrills[i].drill_name+'-u-drill')[0].src="images/drill"+freshLevel+".png"}}}}
function setLevelFromSpeed(speed)
{var level="01";if(speed<=49)level="01";if(speed>=50&&speed<70)level="02";if(speed>=70&&speed<100)level="03";if(speed>=100&&speed<120)level="04";if(speed>=120)level="05";return level}
function toogleUserIcon()
{$('.floating-character').toggleClass('isInvisible')}
function toogleStatsIcon()
{$('.floating-stats').toggleClass('isInvisible')}