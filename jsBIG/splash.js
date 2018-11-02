//======================FACEBOOK===========================

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
//  	console.log('statusChangeCallback');
  //	console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI(response);
    } else {
      // The person is not logged into your app or we are unable to tell.

      //document.getElementById('status').innerHTML = 'Please log ' +
      //'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
  	FB.getLoginStatus(function(response) {
  		statusChangeCallback(response);
  	});
  }


  if(authorizedConnection){
    window.fbAsyncInit = function() {
     FB.init({
       appId      : '239178436552928',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  // FB.getLoginStatus(function(response) {
  // 	statusChangeCallback(response);
  // 	console.log(response.authResponse.accessToken);
  // });

};

}




if(authorizedConnection){
  // Load the SDK asynchronously
  (function(d, s, id) {
  	var js, fjs = d.getElementsByTagName(s)[0];
  	if (d.getElementById(id)) return;
  	js = d.createElement(s); js.id = id;
  	js.src = "//connect.facebook.net/"+FBlng+"/sdk.js";
  	fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
}

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI(response1) {
//  	console.log('Welcome!  Fetching your information.... ');
FB.api('/me?fields=id,name,email', function(response) {
  		//console.log('Successful login for: ' + response.name);
  		//console.log(JSON.stringify(response));

  		//document.getElementById('status').innerHTML =
  		//'Thanks for logging in, ' + response.name + '!';

    //  response.email = "";
    if(response.email != null && response.email != "")
    {
        //login(email, pwd, remember);
        signupRS(response.id, response.email, response.name, response1.authResponse.accessToken, "F", utmToStore, lng);
      }
      else
      {
        $('body').notif({title:lang_jsFBError, cls:'error', timeout:5000})
      }

      //signup(response.email, "Leserpent0", "Leserpent0");
     // 
   });
}




//=============GOOGLE===========================

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  /*console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); */// This is null if the 'email' scope is not present.
  var id_token = googleUser.getAuthResponse().id_token;
  //console.log('Token: ' + id_token); // This is null if the 'email' scope is not present.


    //  response.email = "";
    if(profile.getEmail() != null && profile.getEmail() != "")
    {
        //login(email, pwd, remember);
       //
       signupRS(profile.getId(), profile.getEmail(), profile.getName(), id_token, "G", utmToStore, lng);
     }
     else
     {
      $('body').notif({title:lang_jsGGError, cls:'error', timeout:5000})
    }

  }


  function onSuccess2(googleUser) {

    return false;

  }



  function onSuccess(googleUser) {

    var profile = googleUser.getBasicProfile();
  //console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  //console.log('Name: ' + profile.getName());
  //console.log('Image URL: ' + profile.getImageUrl());
  //console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  var id_token = googleUser.getAuthResponse().id_token;
  //console.log('Token: ' + id_token); // This is null if the 'email' scope is not present.


    //  response.email = "";
    if(profile.getEmail() != null && profile.getEmail() != "")
    {
        //login(email, pwd, remember);
       //
       signupRS(profile.getId(), profile.getEmail(), profile.getName(), id_token, "G", utmToStore, lng);
       //$('body').notif({title:"bouton google créé", cls:'error', timeout:5000})
     }
     else
     {
      $('body').notif({title:lang_jsGGError, cls:'error', timeout:5000})
    }


  }
  
  function onFailure(error) {
    console.log(error);
    $('body').notif({title:lang_jsGGError2, cls:'error', timeout:5000})
  }
  
  function renderButton() {
    gapi.signin2.render('my-signin2', {
      'scope': 'profile email',
      'width': 270,
      'height': 40,
      'longtitle': true,
      'theme': 'dark',
      'font-size': '22px',
      'onsuccess': onSuccess,
      'onfailure': onFailure
    });
    //console.log('renderButton');
  }

  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.disconnect().then(function () {
      //console.log('User signed out.');
    });
  }


//==================FIN AUTHENTICATION=============



function setSpashElements()
{
  var sz = $('#globalSignupZone');
  var hs = $('#snap');
  var hs1 = $('#headSnap');
  var sp = $('.splash')[0];

  if(window.innerWidth > 650)
  {
   var splash = document.getElementsByClassName('splash')[0];
   var splashSize = window.innerHeight - 66;    
   var mid = sz.innerHeight()/2;
   var toop = (splashSize/2) - mid;
   if(toop>150) toop = 150;
   if(toop<13) toop = 13;
   sz.css("top", toop+"px");
   hs.css("top", toop+"px");

   if(splashSize < 570) splashSize = 570;

   hs.width(''+sz.offset().left);


/*
     var midSnap = hs.innerHeight()/2;
     toop = toop + mid - midSnap;
     hs.css("top", toop+"px");*/
   }
   else
   {
    hs.width(''+$('.splash').width());
    sz.css("top", "13px");
    hs.css("top", "13px");
  }
}





window.onresize = function(event) {
  setSpashElements();

};

function toggle_visibility(id) {
  var e = document.getElementById(id);
  if(e.style.display == 'block' || e.style.display == 'inline' )
  {
    e.style.display = 'none';
  }
  else
  {
    e.style.display = 'block';
  }
}

$.fn.textWidth = function(){
  var html_org = $(this).html();
  var html_calc = '<span>' + html_org + '</span>';
  $(this).html(html_calc);
  var width = $(this).find('span:first').width();
  $(this).html(html_org);
  return width;
};


function zoneToDisplay(zone)
{
  $('.splashEnterZone').hide();
  $('.'+zone).show();
  location.href = '#';


}


//FB.Event.subscribe('xfbml.render', finished_rendering);