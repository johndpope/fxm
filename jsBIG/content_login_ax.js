function login(email, pwd, remember) {
  $.post(
    'content_login_ax.php', 
    {
     email : email, 
     pwd : pwd,
     remember : remember
   },
   function(data){
    var login = JSON.parse(data.trim());
   // alert(login.message);
   // alert(login.error);
   if(!login.error){
     //window.location.href = "fxm.php?page=dashboard";
     $('body').notif({title:login.message, cls:'success', timeout:5000})
     window.location.href = "fxm.php?page=dashboard";

   }
   else{
     $('body').notif({title:login.message, cls:'error', timeout:5000})
   }
 },
 'text'
 );
  return false;
}
function forgotPass(emailForgotPass) {
  $.post(
    'content_login_ax.php', 
    {
     emailForgotPass : emailForgotPass
   },
   function(data){
    var forgotPass = JSON.parse(data.trim());
    if(!forgotPass.error){
      $('body').notif({title:forgotPass.message, cls:'success', timeout:15000})
    }
    else{
     $('body').notif({title:forgotPass.message, cls:'error', timeout:15000})
   }
 },
 'text'
 );
  return false;
}

function reinitPass(request, pw1, pw2) {
  $.post(
    'content_login_ax.php', 
    {
     request : request,
     pw1 : pw1,
     pw2 : pw2
   },
   function(data){   
    var reinitPass = JSON.parse(data.trim());

    if(!reinitPass.error){
      $('body').notif({title:reinitPass.message, cls:'success', timeout:15000})
      setTimeout(function e(){ window.location = "fxm.php?page=login"},2000);//ici, renvoyer vers -> se connecter
    }
    else{
     $('body').notif({title:reinitPass.message, cls:'error', timeout:15000})
   }
 },
 'text'
 );
  return false;
}

(function($){ 
  $("#submit_login").click(function(event) {
    event.preventDefault();
    login($("#user-email").val(), $("#user-pw").val(), 1);
  });
})(jQuery);


(function($){ 
  $("#submit_forgotPass").click(function(event) {
    event.preventDefault();
    forgotPass($("#user-email-forgotPass").val());
  });
})(jQuery);


(function($){ 
  $("#submit_reinitPass").click(function(event) {
    event.preventDefault();
    reinitPass($("#requestkey").val(),$("#user-email-reinitPass-1").val(),$("#user-email-reinitPass-2").val());
  });
})(jQuery);



function signup(email_signup, pwd_signup, pwd2_signup, utmToStore, lng) {
  $.post(
    'content_login_ax.php', 
    {
     email_signup : email_signup, 
     pwd_signup : pwd_signup,
     pwd2_signup : pwd2_signup,
     utmToStore : utmToStore
   },
   function(data){
    var signup = JSON.parse(data.trim());
    if(!signup.error){
     $('body').notif({title:signup.message, content:signup.message2, cls:'success', timeout:5000});

     if(signup.login == "1"){
      MauticAddToInscrits(email_signup, utmToStore, lng);
      setTimeout(function(){window.location.href = "fxm.php?page=dashboard";}, 2000);
    }
  }
  else{
   $('body').notif({title:signup.message, cls:'error', timeout:5000})
 }
},
'text'
);
  return false;
}


function signupRS(userID_FBsignup, email_FBsignup, nameFB, tokenFB, rs, utmToStore, lng) {
  $.post(
    'content_login_ax.php', 
    {
     userID_FBsignup : userID_FBsignup, 
     email_FBsignup : email_FBsignup,
     nameFB : nameFB,
     tokenFB : tokenFB,
     rs : rs,
     utmToStore : utmToStore
   },
   function(data){

    try{

      var signup = JSON.parse(data.trim());
    }
    catch(e)
    {
     $('body').notif({title:lang_jsError, cls:'error', timeout:5000})

   }

   // alert(login.message);
   // alert(login.error);
   if(!signup.error){
     //window.location.href = "fxm.php?page=dashboard";
     $('body').notif({title:signup.message, content:signup.message2, cls:'success', timeout:5000});

     if(signup.login == "1"){
      if(signup.hasOwnProperty('newUser') && signup.newUser == "1"){MauticAddToInscrits(email_FBsignup, utmToStore, lng);}        
      setTimeout(function(){window.location.href = "fxm.php?page=dashboard";}, 2000);
    }
  }
  else{
   $('body').notif({title:signup.message, cls:'error', timeout:5000})
 }
},
'text'
);
  return false;
}


function insertMautic(email) {
  $.post(
    'https://www.musicianbooster.com/2.9.2/form/submit?formId=2', 
    {
      'mauticform[mail]' : email,
      'mauticform[formId]' : '2',
      'mauticform[submit]' : '1',
      'mauticform[return]' : '',
      'mauticform[formName]' : 'tst'
    },
    function(data){
      var forgotPass = data.trim();
    },
    'text'
    );
  return false;
}
function MauticAddToInscrits(email, utm, lng) {

  $.post(
    'https://www.musicianbooster.com/2.9.2/form/submit?formId=13', 
    {
      'mauticform[mail]' : email,
      'mauticform[formId]' : '13',
      'mauticform[submit]' : '1',
      'mauticform[dateinscfxm]' : giveDateNow(),
      'mauticform[utm1]' : utm,
      'mauticform[lng1]' : lng,
      'mauticform[return]' : '',
      'mauticform[formName]' : 'segmentsinscritsfxmnewsletter'
    },
    function(data){
      var forgotPass = data.trim();
    },
    'text'
    );

  return false;
}

function MauticAddToInscrits3(email, utm, lng) {

  $.post(
    'https://www.musicianbooster.com/2.9.2/form/submit?formId=11', 
    {
      'mauticform[mail]' : email,
      'mauticform[formId]' : '11',
      'mauticform[submit]' : '1',
      'mauticform[dateinscfxm]' : giveDateNow(),
      'mauticform[utm1]' : utm,
      'mauticform[lng1]' : lng,
      'mauticform[return]' : '',
      'mauticform[formName]' : 'segmentsinscritsfxmnewsletter'
    },
    function(data){
      var forgotPass = data.trim();
    },
    'text'
    );

  return false;
}
function MauticAddToInscrits6(email) {

  $.post(
    'https://www.musicianbooster.com/2.9.2/form/submit?formId=12', 
    {
      'mauticform[mail]' : email,
      'mauticform[formId]' : '12',
      'mauticform[submit]' : '1',      
      'mauticform[return]' : '',
      'mauticform[formName]' : 'test'
    },
    function(data){
      var forgotPass = data.trim();
    },
    'text'
    );

  return false;
}

function AddZero(num) {
  return (num >= 0 && num < 10) ? "0" + num : num + "";
}

function giveDateNow()
{
  var now = new Date();
  var strDateTime = [[AddZero(now.getDate()), 
  AddZero(now.getMonth() + 1), 
  now.getFullYear()].join("-"), 
  [AddZero(now.getHours()), 
  AddZero(now.getMinutes())].join(":")].join(" ");
  return (strDateTime);
}

(function($){	
	$("#submit_signup").click(function(event) {
		event.preventDefault();
		signup($("#user-email-signup").val(), $("#user-pw-signup").val(), $("#user-pw-signup").val(), utmToStore, lng);
	});

})(jQuery);