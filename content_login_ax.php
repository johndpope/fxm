<?php
require __DIR__ . '/vendor/autoload.php';
header('Content-Type: application/json');
include('php/incl.php');
include('php/drillTools.php');

if(isset($_POST['request']) && isset($_POST['pw1']) && isset($_POST['pw2']))
{
	if(isset($_POST['request'])){
		$request=$_POST['request'];
		$pw1=$_POST['pw1'];
		$pw2=$_POST['pw2'];
	}  

	

	$resetPass = $authenticate->resetPass($request, $pw1, $pw2);		
	
	if(!$resetPass['error'])
	{
		echo json_encode($resetPass);
	}
	else 
	{
		echo json_encode($resetPass);
	}	
}

if(isset($_POST['emailForgotPass']))
{
	if(isset($_POST['emailForgotPass'])){$emailForgotPass=$_POST['emailForgotPass'];}  

	$requestReset = $authenticate->requestReset($emailForgotPass);
	
	if(!$requestReset['error'])
	{
		echo json_encode($requestReset);
	}
	else 
	{
		echo json_encode($requestReset);
	}	
}

if(isset($_POST['email']) && isset($_POST['pwd']))
{
	if(isset($_POST['email'])){$email=$_POST['email'];}  
	if(isset($_POST['pwd'])){$pwd=$_POST['pwd'];}  

	$remember = false;
	if(isset($_POST['remember']) && $_POST['remember'] == 'yes'){$remember=true;}  

	$connectionOK = false;
	if(isset($_COOKIE[$config->cookie_name]))
	{
		$logout = $authenticate->logout($_COOKIE[$config->cookie_name]);
	}

	$login = $authenticate->login($email , $pwd, $remember, false);	

	if(!$login['error'])
	{
	//$login['error'] = 
		echo json_encode($login);
	}
	else 
	{
		echo json_encode($login);
	}


	if(!$login['error'])
	{
		setcookie($config->cookie_name, $login['hash'], $login['expire']); 
		$connectionOK = true;
		//header( 'Location: fxm.php?page=dashboard' );
		die();
	}
}

//SIGNUP SIMPLE
if(isset($_POST['email_signup']) && isset($_POST['pwd_signup']) && isset($_POST['pwd2_signup']) && isset($_POST['utmToStore']))
{		
	$useremail = $_POST['email_signup'];
	$userpw = $_POST['pwd_signup'];
	$userpwrepeat = $_POST['pwd2_signup'];	
	$connectionOK = false;
	$utmToStore = $_POST['utmToStore'];	

	if(isset($_COOKIE[$config->cookie_name]))
	{
		$logout = $authenticate->logout($_COOKIE[$config->cookie_name]);
	}

	$register = $authenticate->register($useremail , $userpw, $userpwrepeat, $utmToStore);		

	if(!$register['error'])
	{
		$login2 = $authenticate->login($useremail , $userpw, 1, true);
		$register['message'] = $register['message'];
		$register['message2'] = $login2['message'];

		$mailsentOK = true;	

		if(!$login2['error'])
		{
			setcookie($config->cookie_name, $login2['hash'], $login2['expire']); 
			$connectionOK = true;
			$register['login'] = '1';
		//	die();	
		}
		else
		{
			$register['error'] = true;
		}
		echo json_encode($register);

	}
	else 
	{
		echo json_encode($register);
	}

}

function facebookLoginCheck($userID_FBsignup, $email_FBsignup, $nameFB, $token, $authenticate, $config, $utmToStore)
{

	$rs= "Facebook";
	$connectionOK = false;
	$fb = new \Facebook\Facebook([
		'app_id' => '239178436552928',
		'app_secret' => 'cfbfd589a08ad58212c729f98a4e2431',
		'default_graph_version' => 'v2.9',
  //'default_access_token' => '{access-token}', // optional
		]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

	try {
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
		$response = $fb->get('/me', $token);
	} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
		$register['error'] = true;
		$register['message'] = "Erreur d'autentification Facebook. ".$e->getMessage();
		return $register;

		exit;
	} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
		//echo 'Facebook SDK returned an error: ' . $e->getMessage();
		$register['error'] = true;
		$register['message'] = "Erreur d'autentification Facebook. ".$e->getMessage();
		return $register;
		exit;
	}

	$me = $response->getGraphUser();
	//echo 'Logged in as ' . $me->getName();

	if(isset($_COOKIE[$config->cookie_name]))
	{
		$logout = $authenticate->logout($_COOKIE[$config->cookie_name]);
	}

	$loginFB = $authenticate->loginFB($userID_FBsignup, $email_FBsignup, 1, false, $rs);

	if(!$loginFB['error']) // Si pas d'erreur on log en enregistrant le cookie
	{
		setcookie($config->cookie_name, $loginFB['hash'], $loginFB['expire']); 
		$connectionOK = true;
		$loginFB['login'] = '1';
		//var_dump($loginFB);
		return $loginFB;
	}
	else
	{
		if($loginFB['code'] == "0") // On vérifie que le problème vient juste de la non existence en base
		{
			$register = $authenticate->registerFB($userID_FBsignup , $email_FBsignup, $nameFB, $rs, $utmToStore);	//on enregistre en nouvel user	
			if(!$register['error'])
			{
				$register['newUser'] = '1';

				$login2 = $authenticate->loginFB( $userID_FBsignup, $email_FBsignup, 1, false, $rs);
				//$authenticate->login($email_FBsignup , "", 1, true);

				$register['message'] = $register['message'];
				//." ".'Logged in as ' . $me->getName();
				$register['message2'] = $login2['message'];
				$mailsentOK = true;	

				if(!$login2['error'])
				{
					setcookie($config->cookie_name, $login2['hash'], $login2['expire']); 
					$connectionOK = true;
					$register['login'] = '1';
				}
				else
				{
					$register['error'] = true;
				}
				return $register;
			}
			else 
			{
				return $register;
			}
		}
	}	
}


function googleLoginCheck($userID_FBsignup, $email_FBsignup, $nameFB, $token, $authenticate, $config, $utmToStore)
{
	$connectionOK = false;
	$rs ="Google";

	$client = new Google_Client(['client_id' => "919019235860-l65aul6gko9p2e7pkclng40abqi5tive.apps.googleusercontent.com"]);

	try{

		$payload = $client->verifyIdToken($token);
	}
	catch(Exception $e) {
		$register['error'] = true;
		$register['message'] = "Erreur d'autentification Google. ".$e->getMessage();
		return $register;
		exit;
	}

	if ($payload) {
		$userid = $payload['sub'];

		if(isset($_COOKIE[$config->cookie_name]))
		{
			$logout = $authenticate->logout($_COOKIE[$config->cookie_name]);
		}

		$loginFB = $authenticate->loginFB( $userID_FBsignup, $email_FBsignup, 1, false, $rs);

		if(!$loginFB['error']) /* Si pas d'erreur on log en enregistrant le cookie */
		{
			setcookie($config->cookie_name, $loginFB['hash'], $loginFB['expire']); 
			$connectionOK = true;
			$loginFB['login'] = '1';
			return $loginFB;
		}
		else
		{
			if($loginFB['code'] == "0") /* On vérifie que le problème vient juste de la non existence en base */
			{
				$register = $authenticate->registerFB($userID_FBsignup , $email_FBsignup, $nameFB, $rs, $utmToStore);	/* On enregistre en nouvel user	*/
				if(!$register['error'])
				{
					$register['newUser'] = '1';
					$login2 = $authenticate->loginFB( $userID_FBsignup, $email_FBsignup, 1, false, $rs);
				//$authenticate->login($email_FBsignup , "", 1, true);

					$register['message'] = $register['message'];
				//." ".'Logged in as ' . $me->getName();
					$register['message2'] = $login2['message'];
					$mailsentOK = true;	

					if(!$login2['error'])
					{
						setcookie($config->cookie_name, $login2['hash'], $login2['expire']); 
						$connectionOK = true;
						$register['login'] = '1';
					}
					else
					{
						$register['error'] = true;
					}
					return $register;
				}
				else 
				{
					return $register;
				}
			}
		}	
	} 
	else {
		$register['error'] = true;
		$register['message'] = "Erreur d'autentification Facebook. ";
		return $register;
		exit;
	}





}

//SIGNUP RS
if(isset($_POST['userID_FBsignup']) && isset($_POST['email_FBsignup']) && isset($_POST['nameFB']) && isset($_POST['tokenFB']) && isset($_POST['rs']) && isset($_POST['utmToStore']) )
{		
	$userID_FBsignup = $_POST['userID_FBsignup'];
	$email_FBsignup = $_POST['email_FBsignup'];
	$nameFB = $_POST['nameFB'];	
	$token = $_POST['tokenFB'];
	$utmToStore = $_POST['utmToStore'];

	//echo "ertyffff ".$_POST['rs'];
	if($_POST['rs'] == "F")
	{
		$message = facebookLoginCheck($userID_FBsignup, $email_FBsignup, $nameFB, $token, $authenticate, $config, $utmToStore);
		echo json_encode($message);
	} 
	else{

		if($_POST['rs'] == "G")
		{
			$message = googleLoginCheck($userID_FBsignup, $email_FBsignup, $nameFB, $token, $authenticate, $config, $utmToStore);
			echo json_encode($message);
		} 
	}
	//var_dump($message);
}





?>