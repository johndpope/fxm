function statusChangeCallback(response){if(response.status==='connected'){testAPI(response)}else{}}
function checkLoginState(){FB.getLoginStatus(function(response){statusChangeCallback(response)})}
if(authorizedConnection){window.fbAsyncInit=function(){FB.init({appId:'239178436552928',cookie:!0,xfbml:!0,version:'v2.8'})}}
if(authorizedConnection){(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="//connect.facebook.net/"+FBlng+"/sdk.js";fjs.parentNode.insertBefore(js,fjs)}(document,'script','facebook-jssdk'))}
function testAPI(response1){FB.api('/me?fields=id,name,email',function(response){if(response.email!=null&&response.email!="")
{signupRS(response.id,response.email,response.name,response1.authResponse.accessToken,"F",utmToStore,lng)}
else{$('body').notif({title:lang_jsFBError,cls:'error',timeout:5000})}})}
function onSignIn(googleUser){var profile=googleUser.getBasicProfile();var id_token=googleUser.getAuthResponse().id_token;if(profile.getEmail()!=null&&profile.getEmail()!="")
{signupRS(profile.getId(),profile.getEmail(),profile.getName(),id_token,"G",utmToStore,lng)}
else{$('body').notif({title:lang_jsGGError,cls:'error',timeout:5000})}}
function onSuccess2(googleUser){return!1}
function onSuccess(googleUser){var profile=googleUser.getBasicProfile();var id_token=googleUser.getAuthResponse().id_token;if(profile.getEmail()!=null&&profile.getEmail()!="")
{signupRS(profile.getId(),profile.getEmail(),profile.getName(),id_token,"G",utmToStore,lng)}
else{$('body').notif({title:lang_jsGGError,cls:'error',timeout:5000})}}
function onFailure(error){console.log(error);$('body').notif({title:lang_jsGGError2,cls:'error',timeout:5000})}
function renderButton(){gapi.signin2.render('my-signin2',{'scope':'profile email','width':270,'height':40,'longtitle':!0,'theme':'dark','font-size':'22px','onsuccess':onSuccess,'onfailure':onFailure})}
function signOut(){var auth2=gapi.auth2.getAuthInstance();auth2.disconnect().then(function(){})}
function setSpashElements()
{var sz=$('#globalSignupZone');var hs=$('#snap');var hs1=$('#headSnap');var sp=$('.splash')[0];if(window.innerWidth>650)
{var splash=document.getElementsByClassName('splash')[0];var splashSize=window.innerHeight-66;var mid=sz.innerHeight()/2;var toop=(splashSize/2)-mid;if(toop>150)toop=150;if(toop<13)toop=13;sz.css("top",toop+"px");hs.css("top",toop+"px");if(splashSize<570)splashSize=570;hs.width(''+sz.offset().left)}
else{hs.width(''+$('.splash').width());sz.css("top","13px");hs.css("top","13px")}}
window.onresize=function(event){setSpashElements()};function toggle_visibility(id){var e=document.getElementById(id);if(e.style.display=='block'||e.style.display=='inline')
{e.style.display='none'}
else{e.style.display='block'}}
$.fn.textWidth=function(){var html_org=$(this).html();var html_calc='<span>'+html_org+'</span>';$(this).html(html_calc);var width=$(this).find('span:first').width();$(this).html(html_org);return width};function zoneToDisplay(zone)
{$('.splashEnterZone').hide();$('.'+zone).show();location.href='#'}