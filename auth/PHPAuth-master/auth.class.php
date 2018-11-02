<?php

	/*
		* Auth class
		* Works with PHP 5.4 and above.
	*/

		class Auth
		{
			private $dbh;
			public $config;
			public $lang;

		/*
			* Initiates database connection
		*/

			public function __construct(\PDO $dbh, $config, $lang)
			{
				$this->dbh = $dbh;
				$this->config = $config;
				$this->lang = $lang;

				if (version_compare(phpversion(), '5.5.0', '<')) {
					require("files/password.php");
				}
			}

			public function updateLang($lang)
			{
				$this->lang = $lang;
			}

		/*
			* Logs a user in
			* @param string $email
			* @param string $password
			* @param bool $remember
			* @return array $return
		*/

			public function login($email, $password, $remember = true, $firstLogin)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];

					return $return;
				}

				$validateEmail = $this->validateEmail($email);
				$validatePassword = $this->validatePassword($password);

				if ($validateEmail['error'] == 1) {
					$this->addAttempt();
					$return['message'] = $this->lang["email_password_invalid"];
					return $return;
				} elseif($validatePassword['error'] == 1) {
					$this->addAttempt();
					$return['message'] = $this->lang["email_password_invalid"];
					return $return;
				} 
				/*elseif($remember != 0 && $remember != 1) {
					$this->addAttempt();

					$return['message'] = $this->lang["remember_me_invalid"];
					return $return;
				}*/

				$uid = $this->getUID(strtolower($email));

				if(!$uid) {
					$this->addAttempt();

					$return['message'] = $this->lang["email_password_incorrect"];
					return $return;
				}

				$user = $this->getUser($uid);

				if (!password_verify($password, $user['password'])) {
					$this->addAttempt();

					$return['message'] = $this->lang["email_password_incorrect"];
					return $return;
				}

				/*
				if ($user['isactive'] != 1 && (!$firstLogin)) {
					$this->addAttempt();

					$return['message'] = $this->lang["account_inactive"];
					return $return;
				}*/

				$sessiondata = $this->addSession($user['uid'], $remember);

				if($sessiondata == false) {
					$return['message'] = $this->lang["system_error"] . " #01";
					return $return;
				}

				$return['error'] = false;
				$return['message'] = $this->lang["logged_in"];

				$return['hash'] = $sessiondata['hash'];
				$return['expire'] = $sessiondata['expiretime'];

				return $return;
			}
		/*
			* Logs a user in
			* @param string $email
			* @param string $password
			* @param bool $remember
			* @return array $return
		*/

		//public function loginFB($email, $password, $remember = 0, $firstLogin)
			public function loginFB($userID, $email, $remember = true, $firstLogin, $rs)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];

					return $return;
				}


				$uid = $this->getUIDFB($userID, $rs);

				if(!$uid) {
				//$this->addAttempt();

					$return['code'] = "0";
					return $return;
				}

				$user = $this->getUser($uid);



				$sessiondata = $this->addSession($user['uid'], $remember);

				if($sessiondata == false) {
					$return['message'] = $this->lang["system_error"] . " #01";
					return $return;
				}

				$return['error'] = false;
				$return['message'] = $this->lang["logged_in"];

				$return['hash'] = $sessiondata['hash'];
				$return['expire'] = $sessiondata['expiretime'];

				return $return;
			}

		/*
			* Creates a new user, adds them to database
			* @param string $email
			* @param string $password
			* @param string $repeatpassword
			* @return array $return
		*/

			public function register($email, $password, $repeatpassword, $utmToStore)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				$validateEmail = $this->validateEmail($email);
				$validatePassword = $this->validatePassword($password);

				if ($validateEmail['error'] == 1) {
					$return['message'] = $validateEmail['message'];
					return $return;
				} elseif ($validatePassword['error'] == 1) {
					$return['message'] = $validatePassword['message'];
					return $return;
				} elseif($password !== $repeatpassword) {
					$return['message'] = $this->lang["password_nomatch"];
					return $return;
				}

				if ($this->isEmailTaken($email)) {
					$this->addAttempt();

					$return['message'] = $this->lang["email_taken"];
					return $return;
				}

				$addUser = $this->addUser($email, $password, $utmToStore);

				if($addUser['error'] != 0) {
					$return['message'] = $addUser['message'];
					return $return;
				}

				$return['error'] = false;
				$return['message'] = $this->lang["register_success"];

				return $return;
			}
		/*
			* Creates a new user, adds them to database
			* @param string $email
			* @param string $password
			* @param string $repeatpassword
			* @return array $return
		*/

			public function registerFB($userID_FBsignup, $email_FBsignup, $nameFB, $rs, $utmToStore)
			{
				$email = $email_FBsignup;
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				$validateEmail = $this->validateEmail($email);
				/*$validatePassword = $this->validatePassword($password);*/

				if ($validateEmail['error'] == 1) {
					$return['message'] = $validateEmail['message'];
					return $return;
				} 

				if ($this->isEmailTaken($email)) {
					$this->addAttempt();

					$return['message'] = $this->lang["email_taken"];
					return $return;
				}

				$addUser = $this->addUserFB($userID_FBsignup, $email_FBsignup, $nameFB, $rs, $utmToStore);

				if($addUser['error'] != 0) {
					$return['message'] = $addUser['message'];
					return $return;
				}

				$return['error'] = false;
				$return['message'] = $this->lang["register_successFB"];

				return $return;
			}

		/*
			* Activates a user's account
			* @param string $key
			* @return array $return
		*/

			public function activate($key)
			{
				$return['error'] = true;

				if($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				if(strlen($key) !== 20) {
					$this->addAttempt();

					$return['message'] = $this->lang["key_invalid"];
					return $return;
				}

				$getRequest = $this->getRequest($key, "activation");

				if($getRequest['error'] == 1) {
					$return['message'] = $getRequest['message'];
					return $return;
				}

				if($this->getUser($getRequest['uid'])['isactive'] == 1) {
					$this->addAttempt();
					$this->deleteRequest($getRequest['id']);

					$return['message'] = $this->lang["system_error"] . " #02";
					return $return;
				}

				$query = $this->dbh->prepare("UPDATE {$this->config->table_users} SET isactive = ? WHERE id = ?");
				$query->execute(array(1, $getRequest['uid']));

				$this->deleteRequest($getRequest['id']);

				$return['error'] = false;
				$return['message'] = $this->lang["account_activated"];

				return $return;
			}

		/*
			* Creates a reset key for an email address and sends email
			* @param string $email
			* @return array $return
		*/

			public function requestReset($email)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				$validateEmail = $this->validateEmail($email);

				if ($validateEmail['error'] == 1) {
					$return['message'] = $this->lang["email_invalid"];
					return $return;
				}

				$query = $this->dbh->prepare("SELECT id FROM {$this->config->table_users} WHERE email = ?");
				$query->execute(array($email));

				if ($query->rowCount() == 0) {
					$this->addAttempt();

					$return['message'] = $this->lang["email_incorrect"];
					return $return;
				}

				$addRequest = $this->addRequest($query->fetch(PDO::FETCH_ASSOC)['id'], $email, "reset");
				if ($addRequest['error'] == 1) {
					$this->addAttempt();

					$return['message'] = $addRequest['message'];
					return $return;
				}

				$return['error'] = false;
				$return['message'] = $this->lang["reset_requested"];

				return $return;
			}

		/*
			* Logs out the session, identified by hash
			* @param string $hash
			* @return boolean
		*/

			public function logout($hash)
			{
				if (strlen($hash) != 40) {
					return false;
				}

				return $this->deleteSession($hash);
			}

		/*
			* Provides a randomly generated salt for hashing the password
			* @return string
		*/

			public function getSalt()
			{
				return substr(strtr(base64_encode(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)), '+', '.'), 0, 22);
			}

		/*
			* Hashes provided password with Bcrypt
			* @param string $password
			* @param string $password
			* @return string
		*/

			public function getHash($password)
			{
				return password_hash($password, PASSWORD_BCRYPT, ['salt' => $this->getSalt(), 'cost' => $this->config->bcrypt_cost]);
			}

		/*
			* Gets UID for a given email address and returns an array
			* @param string $email
			* @return array $uid
		*/

			public function getUID($email)
			{
				$query = $this->dbh->prepare("SELECT id FROM {$this->config->table_users} WHERE email = ?");
				$query->execute(array($email));

				if($query->rowCount() == 0) {
					return false;
				}

				return $query->fetch(PDO::FETCH_ASSOC)['id'];
			}		

			/*
			* Gets UID for a given email address and returns an array
			* @param string $email
			* @return array $uid
		*/

			public function getUIDFB($FBUserId, $rs)
			{
				$brand = $rs;
				$query = $this->dbh->prepare("SELECT id FROM {$this->config->table_users} WHERE rs_user_id = ? AND rs_brand = ?");
				$query->execute(array($FBUserId, $brand));

				if($query->rowCount() == 0) {
					return false;
				}

				return $query->fetch(PDO::FETCH_ASSOC)['id'];
			}

		/*
			* Creates a session for a specified user id
			* @param int $uid
			* @param boolean $remember
			* @return array $data
		*/

			private function addSession($uid, $remember)
			{
				$ip = $this->getIp();
				$user = $this->getUser($uid);

				if(!$user) {
					return false;
				}

				$data['hash'] = sha1($this->config->site_key . microtime());
				$agent = $_SERVER['HTTP_USER_AGENT'];

				//$this->deleteExistingSessions($uid);

				if($remember == true) {
					$data['expire'] = date("Y-m-d H:i:s", strtotime($this->config->cookie_remember));
					$data['expiretime'] = strtotime($data['expire']);
				} else {
					$data['expire'] = date("Y-m-d H:i:s", strtotime($this->config->cookie_remember));
					//$data['expiretime'] = 0;
					$data['expiretime'] = strtotime($data['expire']);
				}

				$data['cookie_crc'] = sha1($data['hash'] . $this->config->site_key);

				$query = $this->dbh->prepare("INSERT INTO {$this->config->table_sessions} (uid, hash, expiredate, ip, agent, cookie_crc) VALUES (?, ?, ?, ?, ?, ?)");

				if(!$query->execute(array($uid, $data['hash'], $data['expire'], $ip, $agent, $data['cookie_crc']))) {
					return false;
				}

				$data['expire'] = strtotime($data['expire']);
				return $data;
			}

		/*
			* Removes all existing sessions for a given UID
			* @param int $uid
			* @return boolean
		*/

			private function deleteExistingSessions($uid)
			{
				$query = $this->dbh->prepare("DELETE FROM {$this->config->table_sessions} WHERE uid = ?");

				return $query->execute(array($uid));
			}

		/*
			* Removes a session based on hash
			* @param string $hash
			* @return boolean
		*/

			private function deleteSession($hash)
			{
				$query = $this->dbh->prepare("DELETE FROM {$this->config->table_sessions} WHERE hash = ?");

				return $query->execute(array($hash));
			}

		/*
			* Function to check if a session is valid
			* @param string $hash
			* @return boolean
		*/

			public function checkSession($hash)
			{
				$ip = $this->getIp();

				if ($this->isBlocked()) {
					return false;
				}

				if (strlen($hash) != 40) {
					return false;
				}

				$query = $this->dbh->prepare("SELECT id, uid, expiredate, ip, agent, cookie_crc FROM {$this->config->table_sessions} WHERE hash = ?");
				$query->execute(array($hash));

				if ($query->rowCount() == 0) {
					return false;
				}

				$row = $query->fetch(PDO::FETCH_ASSOC);

				$sid = $row['id'];
				$uid = $row['uid'];
				$expiredate = strtotime($row['expiredate']);
				$currentdate = strtotime(date("Y-m-d H:i:s"));
				$db_ip = $row['ip'];
				$db_agent = $row['agent'];
				$db_cookie = $row['cookie_crc'];

				if ($currentdate > $expiredate) {
					$this->deleteExistingSessions($uid);

					return false;
				}

				if ($ip != $db_ip) {
					return false;
				}

				if ($db_cookie == sha1($hash . $this->config->site_key)) {
					return true;
				}

				return false;
			}

		/*
			* Retrieves the UID associated with a given session hash
			* @param string $hash
			* @return int $uid
		*/

			public function getSessionUID($hash)
			{
				$query = $this->dbh->prepare("SELECT uid FROM {$this->config->table_sessions} WHERE hash = ?");
				$query->execute(array($hash));

				if ($query->rowCount() == 0) {
					return false;
				}

				return $query->fetch(PDO::FETCH_ASSOC)['uid'];
			}

		/*
			* Checks if an email is already in use
			* @param string $email
			* @return boolean
		*/

			private function isEmailTaken($email)
			{
				$query = $this->dbh->prepare("SELECT * FROM {$this->config->table_users} WHERE email = ?");
				$query->execute(array($email));

				if ($query->rowCount() == 0) {
					return false;
				}

				return true;
			}




		/*
			* Gets user data for a given UID and returns an array
			* @param int $uid
			* @return array $data
		*/
			public function getMyDayDrills($uid)
			{			

				$query = $this->dbh->prepare("SELECT * FROM {$this->config->table_srs} WHERE uid = ? order by drill_name");

				$currentdate = date("Y-m-d H:i:s");
			//echo($currentdate);
				$query->execute(array($uid));
			//$query->execute(array($uid, $currentdate));

				if ($query->rowCount() == 0) {
					return false;
				}

				$i = 0;
				while($row = $query->fetch(PDO::FETCH_ASSOC)){ 

				//$data[$i] = $row;
				//if($row['next_repetition'] < $currentdate) 
				//{
				//echo $row."---";
					$data[$i] = $row;
					$i++;
				//}

				//print '<br/>'.$row['id'].'//'.$row['drill_name'].'//'.$row['next_repetition'].'//'.$row['speed'].'<br>'; 

				}


				if (!$data) {
					return false;
				}

			//$data['uid'] = $uid;
				return $data;


			}



		/*
			* Gets user data for a given UID and returns an array
			* @param int $uid
			* @return array $data
		*/		
			public function getMydrill($uid, $drill_name)
			{	

				$query = $this->dbh->prepare("SELECT * FROM {$this->config->table_srs} WHERE uid = ? AND drill_name = ?");
				$query->execute(array($uid, $drill_name));		


				$data = $query->fetch(PDO::FETCH_ASSOC);

				if (!$data) {
					return false;
				}

				$data['uid'] = $uid;

				return $data;



			}


		/*
			* Subscribe to a product
			* @param string $email
			* @param string $password
			* @return int $uid
		*/



			public function validatePrefs($uid,$sheetOrNote,$notationSystem,$phaseDuration,$language,$nextDay,$menu)
			{

				$query = $this->dbh->prepare("SELECT * FROM {$this->config->table_preferences} WHERE uid = ?");
				$query->execute(array($uid));

				$row = $query->fetch(PDO::FETCH_ASSOC);		

				if (!$row) {				
					$query = $this->dbh->prepare("INSERT INTO {$this->config->table_preferences} (uid, note, system, duration, lng, nextDayTime, mobileMenu) VALUES (?, ?, ?, ?, ?, ?, ?)");

					if(!$query->execute(array($uid, $sheetOrNote, $notationSystem, $phaseDuration, $language, $nextDay, $menu))) {					
						$return['error'] = true;
					//print_r($query);			
					//print_r($this->dbh->errorInfo());				
						$return['message'] = $this->lang["system_error"] . " #19";
						return $return;
					}	

					$return['error'] = false;
					$return['message'] = $this->lang["prefValidate"];
					return $return;

				}


				$query = $this->dbh->prepare("UPDATE {$this->config->table_preferences} SET note=?, system=?, duration=?, lng=?, nextDayTime=?, mobileMenu=? WHERE uid = ?");
			//return $query->execute(array($sheetOrNote,$notationSystem,$phaseDuration,$language,$nextDay,$menu,$uid));
				if(!$query->execute(array($sheetOrNote,$notationSystem,$phaseDuration,$language,$nextDay,$menu,$uid))) {					
					$return['error'] = true;
				//print_r($query);			
				//print_r($this->dbh->errorInfo());				
					$return['message'] = $this->lang["system_error"] . " #19";
					return $return;
				}	

				$return['error'] = false;
				$return['message'] = $this->lang["prefValidate"];
				return $return;

			}	



			public function giveAmark($uid, $drill_name, $next_repetition,  $current_note, $previous_repetition, $speed, $result)
			{




				$query = $this->dbh->prepare("SELECT * FROM {$this->config->table_srs} WHERE uid = ? AND drill_name = ?");
				$query->execute(array($uid, $drill_name));

				$row = $query->fetch(PDO::FETCH_ASSOC);			

				if (!$row) {
				//$attempt_count = 1;

					$query = $this->dbh->prepare("INSERT INTO {$this->config->table_srs} (uid, drill_name, next_repetition,  current_note, previous_repetition, speed, result) VALUES (?, ?, ?, ?, ?, ?, ?)");
					return $query->execute(array($uid, $drill_name, $next_repetition,  $current_note, $previous_repetition, $speed, $result));	

				}

				$query = $this->dbh->prepare("UPDATE {$this->config->table_srs} SET next_repetition=?, current_note=?, previous_repetition=?, speed=?, result=? WHERE uid = ? AND drill_name = ?");
				return $query->execute(array($next_repetition,  $current_note, $previous_repetition, $speed, $result, $uid, $drill_name));


			}

			public function giveAmarkAndUpdateDrillAchievement($uid, $drill_name, $next_repetition,  $current_note, $previous_repetition, $speed, $drillAchievementOut, $result)
			{




				$query = $this->dbh->prepare("SELECT * FROM {$this->config->table_srs} WHERE uid = ? AND drill_name = ?");
				$query->execute(array($uid, $drill_name));

				$row = $query->fetch(PDO::FETCH_ASSOC);			

				if (!$row) {
				//$attempt_count = 1;

					$query = $this->dbh->prepare("INSERT INTO {$this->config->table_srs} (uid, drill_name, next_repetition,  current_note, previous_repetition, speed, achievement, result) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
					return $query->execute(array($uid, $drill_name, $next_repetition,  $current_note, $previous_repetition, $speed, $drillAchievementOut, $result));	

				}

				$query = $this->dbh->prepare("UPDATE {$this->config->table_srs} SET next_repetition=?, current_note=?, previous_repetition=?, speed=?, achievement=?, result=? WHERE uid = ? AND drill_name = ?");

				//$result = "7:7;9;12";

				return $query->execute(array($next_repetition,  $current_note, $previous_repetition, $speed, $drillAchievementOut, $result, $uid, $drill_name));


			}

			public function updateWizard($id, $wizard)
			{



				$query = $this->dbh->prepare("UPDATE users SET wizard=? WHERE id = ?");

				//$result = "7:7;9;12";

				return $query->execute(array($wizard, $id));


			}

			



			public function subscribe($uid, $subscription_name, $startdate,  $expire, $type, $price, $price_dev, $chargeId)
			{
				$return['error'] = true;

			//$key = $this->getRandomKey(20);

			//echo $uid. "---" .$subscription_name. "---" .$startdate. "---" . $expire. "---" .$type. "---" .$price. "---" .$price_dev. "---" .$chargeId;
			if(true)//!$this->hasSubscribed($this->getSubscriptions($uid, $subscription_name), $subscription_name))
			{
				
				$query = $this->dbh->prepare("INSERT INTO {$this->config->table_subscriptions} (uid, subscription_name, subscription_date, start_date, expiration_date, type, price_num, price_dev, chargeId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				
				$subscription_date = date("Y-m-d H:i:s");
				if(!$query->execute(array($uid, $subscription_name, $subscription_date, $startdate, $expire, $type, $price, $price_dev, $chargeId))) {
					$return['message'] = $this->lang["system_error"] . " #09";
					return $return;
				}	
				
				$return['error'] = false;
				$return['message'] = $this->lang["subscriptionactivated"];
			}
			else
			{
				$return['message'] = $this->lang["alreadysubscribed"];
			}
			
			
			return $return;
		}
		
		
		/*
			* Subscribe to a product
			* @param string $email
			* @param string $password
			* @return int $uid
		*/

			public function unSubscribe($id)
			{
				$return['error'] = true;
				$state = 3;
			//$key = $this->getRandomKey(20);			
			//$query = $this->dbh->prepare("INSERT INTO {$this->config->table_subscriptions} (uid, subscription_name, expiration_date, type) VALUES (?, ?, ?, ?)");
				$query = $this->dbh->prepare("UPDATE {$this->config->table_subscriptions} SET state = ? WHERE id = ?");

				if(!$query->execute(array($state, $id))) {
					$return['message'] = $this->lang["system_error"] . " #09";
					return $return;
				}	

				$return['error'] = false;
				$return['message'] = $this->lang["subscriptionactivated"];
				return $return;
			}





		/*
			* Adds a new user to database
			* @param string $email
			* @param string $password
			* @return int $uid
		*/

			private function addUser($email, $password, $utmToStore)
			{
				$return['error'] = true;

				$query = $this->dbh->prepare("INSERT INTO {$this->config->table_users} VALUES ()");

				if(!$query->execute()) {
					$return['message'] = $this->lang["system_error"] . " #03";
					return $return;
				}

				$uid = $this->dbh->lastInsertId();
				$email = htmlentities(strtolower($email));


				$password = $this->getHash($password);
				$date_signup = date("Y-m-d H:i:s");
				$query = $this->dbh->prepare("UPDATE {$this->config->table_users} SET email = ?, password = ?, date_signup = ?, utm = ? WHERE id = ?");

				if(!$query->execute(array($email, $password, $date_signup, $utmToStore, $uid))) {


					$query = $this->dbh->prepare("DELETE FROM {$this->config->table_users} WHERE id = ?");
					$query->execute(array($uid));

					$return['message'] = $this->lang["system_error"] . " #04";
					return $return;
				}

				$return['error'] = false;
				return $return;
			}


		/*
			* Adds a new user to database
			* @param string $email
			* @param string $password
			* @return int $uid
		*/

			/*private function addUser($email, $password)*/
			private function addUserFB($userID_FBsignup, $email_FBsignup, $nameFB, $rs, $utmToStore)
			{
				$return['error'] = true;

				$query = $this->dbh->prepare("INSERT INTO {$this->config->table_users} VALUES ()");

				if(!$query->execute()) {
					$return['message'] = $this->lang["system_error"] . " #03";
					return $return;
				}

				$uid = $this->dbh->lastInsertId();
				$email = htmlentities(strtolower($email_FBsignup));


				$password = "fbnopassword";
				$password = $this->getHash($password);
				$date_signup = date("Y-m-d H:i:s");
				$isactive = 1;
				$query = $this->dbh->prepare("UPDATE {$this->config->table_users} SET email = ?, date_signup = ?,  rs_user_id = ?, rs_name = ?, isactive = ?, rs_brand = ?, utm = ? WHERE id = ?");

				$toto = $email." - ".$date_signup." - ".$userID_FBsignup." - ".$nameFB." - ".$isactive." - ".$uid;

				if(!$query->execute(array($email, $date_signup, $userID_FBsignup, $nameFB, $isactive, $rs, $utmToStore, $uid))) {


					$query = $this->dbh->prepare("DELETE FROM {$this->config->table_users} WHERE id = ?");
					$query->execute(array($uid));

					$return['message'] = $toto;
				//$return['message'] = $this->lang["system_error"] . " #04";
					return $return;
				}

				$return['error'] = false;
				return $return;
			}

		/*
			* Gets user data for a given UID and returns an array
			* @param int $uid
			* @return array $data
		*/

			public function getPrefs($uid)
			{
				$query = $this->dbh->prepare("SELECT note, system, duration, lng, nextDayTime, mobileMenu FROM {$this->config->table_preferences} WHERE uid = ?");
				$query->execute(array($uid));

				if ($query->rowCount() == 0) {
					return false;
				}

				$data = $query->fetch(PDO::FETCH_ASSOC);

				if (!$data) {
					return false;
				}

				$data['uid'] = $uid;
				return $data;
			}	
		/*
			* Gets user data for a given UID and returns an array
			* @param int $uid
			* @return array $data
		*/

			public function getUser($uid)
			{
				$query = $this->dbh->prepare("SELECT email, password, isactive, date_signup, rs_brand, rs_name, wizard FROM {$this->config->table_users} WHERE id = ?");
				$query->execute(array($uid));

				if ($query->rowCount() == 0) {
					return false;
				}

				$data = $query->fetch(PDO::FETCH_ASSOC);

				if (!$data) {
					return false;
				}

				$data['uid'] = $uid;
				return $data;
			}

		/*
			* Gets user subscriptions and returns an array
			* @param int $uid
			* @return array $data
		*/

			public function getSubscriptions($uid, $subscription_name)
			{
				$query = $this->dbh->prepare("SELECT * FROM {$this->config->table_subscriptions} WHERE uid = ? AND subscription_name = ? ORDER BY state, expiration_date DESC");
				$query->execute(array($uid, "FM"));

				if ($query->rowCount() == 0) {
					return false;
				}

				$i = 0;
				while($row = $query->fetch(PDO::FETCH_ASSOC)){ 

					$data[$i] = $row;
					$i++;
				//print '<br/>'.$row['id'].'//'.$row['subscription_name'].'//'.$row['subscription_date'].'//'.$row['expiration_date'].'<br>'; 

				}


				if (!$data) {
					return false;
				}

			//$data['uid'] = $uid;
				return $data;		
			}


		/*
			* Allows a user to delete their account
			* @param int $uid
			* @param string $password
			* @return array $return
		*/

			public function deleteUser($uid, $password)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				$validatePassword = $this->validatePassword($password);

				if($validatePassword['error'] == 1) {
					$this->addAttempt();

					$return['message'] = $validatePassword['message'];
					return $return;
				}

				$getUser = $this->getUser($uid);

				if(!password_verify($password, $getUser['password'])) {
					$this->addAttempt();

					$return['message'] = $this->lang["password_incorrect"];
					return $return;
				}

				$query = $this->dbh->prepare("DELETE FROM {$this->config->table_users} WHERE id = ?");

				if(!$query->execute(array($uid))) {
					$return['message'] = $this->lang["system_error"] . " #05";
					return $return;
				}

				$query = $this->dbh->prepare("DELETE FROM {$this->config->table_sessions} WHERE uid = ?");

				if(!$query->execute(array($uid))) {
					$return['message'] = $this->lang["system_error"] . " #06";
					return $return;
				}

				$query = $this->dbh->prepare("DELETE FROM {$this->config->table_requests} WHERE uid = ?");

				if(!$query->execute(array($uid))) {
					$return['message'] = $this->lang["system_error"] . " #07";
					return $return;
				}

				$return['error'] = false;
				$return['message'] = $this->lang["account_deleted"];

				return $return;
			}

		/*
			* Creates an activation entry and sends email to user
			* @param int $uid
			* @param string $email
			* @return boolean
		*/

			private function addRequest($uid, $email, $type)
			{
				//$email = "romain.butez@gmail.com";
				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;

				$return['error'] = true;

				if($type != "activation" && $type != "reset") {
					$return['message'] = $this->lang["system_error"] . " #08";
					return $return;
				}

				$query = $this->dbh->prepare("SELECT id, expire FROM {$this->config->table_requests} WHERE uid = ? AND type = ?");
				$query->execute(array($uid, $type));

				if($query->rowCount() > 0) {
					$row = $query->fetch(PDO::FETCH_ASSOC);

					$expiredate = strtotime($row['expire']);
					$currentdate = strtotime(date("Y-m-d H:i:s"));

					if ($currentdate < $expiredate) {
						$return['message'] = $this->lang["reset_exists"];
						return $return;
					}

					$this->deleteRequest($row['id']);
				}

				if($type == "activation" && $this->getUser($uid)['isactive'] == 1) {
					$return['message'] = $this->lang["already_activated"];
					return $return;
				}

				$key = $this->getRandomKey(20);
				$expire = date("Y-m-d H:i:s", strtotime("+1 day"));

				$query = $this->dbh->prepare("INSERT INTO {$this->config->table_requests} (uid, rkey, expire, type) VALUES (?, ?, ?, ?)");

				if(!$query->execute(array($uid, $key, $expire, $type))) {
					$return['message'] = $this->lang["system_error"] . " #09";
					return $return;
				}

			// Check configuration for SMTP parameters

				if($this->config->smtp) {
					/*$mail->isSMTP();
					$mail->Host = $this->config->smtp_host;
					$mail->SMTPAuth = $this->config->smtp_auth;
					$mail->Username = $this->config->smtp_username;
					$mail->Password = $this->config->smtp_password;
					$mail->Port = $this->config->smtp_port;*/

					$mail->isSMTP();
					$mail->Host = 'email-smtp.eu-west-1.amazonaws.com';
					$mail->SMTPAuth = true;
					$mail->Username = 'AKIAI52RHRUDI4ITVBRQ';
					$mail->Password = 'Aj03/dg3zA4TeFC532FFh8l05pQWXFiipsyABfSvW8Gk';
					$mail->Port = $this->config->smtp_port;

					$mail->SMTPSecure = 'ssl';
/*
					if($this->config->smtp_security != NULL) {
						$mail->SMTPSecure = $this->config->smtp_security;
					}*/
				}

				$mail->From = 'romain@musicianbooster.com';//$this->config->site_email;
				$mail->FromName = 'Romain [FretXMaster]';//$this->config->site_name;
				$mail->addAddress($email);
				$mail->isHTML(true);

				if($type == "activation") {
					$mail->Subject = sprintf($this->lang['email_activation_subject'], $this->config->site_name);
				//echo($this->lang['email_activation_body']);
				//$this->lang['email_activation_body'] = 'Le %2$s a %1$s singes %3$s ';


					$mail->Body = sprintf($this->lang['email_activation_body'], $this->config->site_url, $this->config->site_activation_page, $key);

				//echo("MAIL BODY :<p> ");
				//echo($mail->Body);

					$mail->AltBody = sprintf($this->lang['email_activation_altbody'], $this->config->site_url, $this->config->site_activation_page, $key);			
				} else {
					//$mail->Subject = sprintf($this->lang['email_reset_subject'], $this->config->site_name);
					$mail->Subject = "=?UTF-8?B?UsOpaW5pdGlhbGlzYXRpb24gZGUgdm90cmUgbW90IGRlIHBhc3Nl?=";
					$mail->Body = sprintf($this->lang['email_reset_body'], $this->config->site_url, $this->config->site_password_reset_page, $key);
					$mail->AltBody = sprintf($this->lang['email_reset_altbody'], $this->config->site_url, $this->config->site_password_reset_page, $key);
				}

				if(!$mail->send()) {
					$return['message'] = $this->lang["system_error"] . " #102";


				//echo("<p> ERROR INFO :");
				//echo($mail->ErrorInfo);

					return $return;
				}

				$return['error'] = false;
				return $return;
			}

		/*
			* Returns request data if key is valid
			* @param string $key
			* @param string $type
			* @return array $return
		*/

			private function getRequest($key, $type)
			{
				$return['error'] = true;

				$query = $this->dbh->prepare("SELECT id, uid, expire FROM {$this->config->table_requests} WHERE rkey = ? AND type = ?");
				$query->execute(array($key, $type));

				if ($query->rowCount() === 0) {
					$this->addAttempt();

					$return['message'] = $this->lang[$type."key_incorrect"];
					return $return;
				}

				$row = $query->fetch();

				$expiredate = strtotime($row['expire']);
				$currentdate = strtotime(date("Y-m-d H:i:s"));

				if ($currentdate > $expiredate) {
					$this->addAttempt();

					$this->deleteRequest($row['id']);

					$return['message'] = $this->lang[$type."key_expired"];
					return $return;
				}

				$return['error'] = false;
				$return['id'] = $row['id'];
				$return['uid'] = $row['uid'];

				return $return;
			}

		/*
			* Deletes request from database
			* @param int $id
			* @return boolean
		*/

			private function deleteRequest($id)
			{
				$query = $this->dbh->prepare("DELETE FROM {$this->config->table_requests} WHERE id = ?");
				return $query->execute(array($id));
			}

		/*
			* Verifies that a password is valid and respects security requirements
			* @param string $password
			* @return array $return
		*/

			private function validatePassword($password) {
				$return['error'] = true;

				if (strlen($password) < 6) {
					$return['message'] = $this->lang["password_short"];
					return $return;
				} elseif (strlen($password) > 150) {
					$return['message'] = $this->lang["password_long"];
					return $return;
				}/* elseif (!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password)) {
					$return['message'] = $this->lang["password_invalid"];
					return $return;
				}*/

				$return['error'] = false;
				return $return;
			}

		/*
			* Verifies that an email is valid
			* @param string $email
			* @return array $return
		*/

			private function validateEmail($email) {
				$return['error'] = true;

				if (strlen($email) < 5) {
					$return['message'] = $this->lang["email_short"];
					return $return;
				} elseif (strlen($email) > 100) {
					$return['message'] = $this->lang["email_long"];
					return $return;
				} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$return['message'] = $this->lang["email_invalid"];
					return $return;
				}

				$bannedEmails = json_decode(file_get_contents(__DIR__ . "/files/domains.json"));

				if(in_array(strtolower(explode('@', $email)[1]), $bannedEmails)) {
					$return['message'] = $this->lang["email_banned"];
					return $return;
				}


				$return['error'] = false;
				return $return;
			}


		/*
			* Allows a user to reset their password after requesting a reset key.
			* @param string $key
			* @param string $password
			* @param string $repeatpassword
			* @return array $return
		*/

			public function resetPass($key, $password, $repeatpassword)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				if(strlen($key) != 20) {
					$return['message'] = $this->lang["resetkey_invalid"];
					return $return;
				}

				$validatePassword = $this->validatePassword($password);

				if($validatePassword['error'] == 1) {
					$return['message'] = $validatePassword['message'];
					return $return;
				}

				if($password !== $repeatpassword) {
				// Passwords don't match
					$return['message'] = $this->lang["newpassword_nomatch"];
					return $return;
				}

				$data = $this->getRequest($key, "reset");

				if($data['error'] == 1) {
					$return['message'] = $data['message'];
					return $return;
				}

				$user = $this->getUser($data['uid']);

				if(!$user) {
					$this->addAttempt();
					$this->deleteRequest($data['id']);

					$return['message'] = $this->lang["system_error"] . " #11";
					return $return;
				}

				if(password_verify($password, $user['password'])) {
					$this->addAttempt();
					$this->deleteRequest($data['id']);

					$return['message'] = $this->lang["newpassword_match"];
					return $return;
				}

				$password = $this->getHash($password);

				$query = $this->dbh->prepare("UPDATE {$this->config->table_users} SET password = ? WHERE id = ?");
				$query->execute(array($password, $data['uid']));

				if ($query->rowCount() == 0) {
					$return['message'] = $this->lang["system_error"] . " #12";
					return $return;
				}

				$this->deleteRequest($data['id']);

				$return['error'] = false;
				$return['message'] = $this->lang["password_reset"];

				return $return;
			}

		/*
			* Recreates activation email for a given email and sends
			* @param string $email
			* @return array $return
		*/

			public function sendAmail($uid, $email, $object, $body)
			{
				$return['error'] = true;
				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				$validateEmail = $this->validateEmail($email);

				if($validateEmail['error'] == 1) {
					$return['message'] = $validateEmail['message'];
					return $return;
				}

				if($this->config->smtp) {


					$mail->isSMTP();
					$mail->Host = 'email-smtp.eu-west-1.amazonaws.com';
					$mail->SMTPAuth = true;
					$mail->Username = 'AKIAI52RHRUDI4ITVBRQ';
					$mail->Password = 'Aj03/dg3zA4TeFC532FFh8l05pQWXFiipsyABfSvW8Gk';
					$mail->Port = $this->config->smtp_port;

					$mail->SMTPSecure = 'ssl';



				}

			//$mail->From = $email;			
				$mail->From = "contact@musicianbooster.com"	;	
			//$mail->From = $this->config->site_email	;	
			//echo "<br/>".$mail->From;	
				$mail->FromName = "Romain [FretXMaster]";
			//echo "<br/>".$this->config->site_name;
				$mail->addAddress("romain@musicianbooster.com");			
			//echo "<br/>".$this->config->site_email;			
				$mail->isHTML(true);
			////echo isHTML(true);



				$mail->Subject = $object;
			//echo "<br/>".$object;
				$body = $email." // UID".$uid."<p></p>".$body;
				$mail->Body = $body;
			//echo "<br/>".$body;

				$mail->AltBody = $body;;			




				if(!$mail->send()) {
					$return['message'] = $this->lang["system_error"] . " #101";

				/*
				//echo("<p> ERROR INFO :");
				//echo($mail->ErrorInfo);*/
				
				return $return;
			}
			
			$return['error'] = false;
			$return['message'] = $this->lang["messageSent"];
			return $return;
		}
		
		public function sendAmailToClient($email, $object, $body)
		{
			$return['error'] = true;
			require 'PHPMailer/PHPMailerAutoload.php';
			
			$mail = new PHPMailer;
			$validateEmail = $this->validateEmail($email);
			
			if($validateEmail['error'] == 1) {
				$return['message'] = $validateEmail['message'];
				return $return;
			}
			
			if($this->config->smtp) {
				$mail->isSMTP();
				//$mail->isQmail();
				$mail->Host = $this->config->smtp_host;
				//echo "<br/>".$this->config->smtp_host;
				$mail->SMTPAuth = $this->config->smtp_auth;
				//echo "<br/>".$this->config->smtp_auth;
				$mail->Username = $this->config->smtp_username;
				//echo "<br/>".$this->config->smtp_username;
				$mail->Password = $this->config->smtp_password;
				//echo "<br/>".$this->config->smtp_password;
				$mail->Port = $this->config->smtp_port;
				//echo "<br/>".$this->config->smtp_port;
				
				if($this->config->smtp_security != NULL) {
					$mail->SMTPSecure = $this->config->smtp_security;
					//echo "<br/>".$this->config->smtp_security;
				}
			}
			
			//$mail->From = $email;			
			$mail->From = "romain@musicianbooster.com"	;	
			//$mail->From = $this->config->site_email	;	
			//echo "<br/>".$mail->From;	
			$mail->FromName = "Romain";
			//echo "<br/>".$this->config->site_name;
			$mail->addAddress($email);			
			//echo "<br/>".$this->config->site_email;			
			$mail->isHTML(true);
			////echo isHTML(true);
			
			
			
			$mail->Subject = $object;
			//echo "<br/>".$object;
			//$body = $email." // UID"."<p></p>".$body;
			$mail->Body = $body;
			//echo "<br/>".$body;
			
			$mail->AltBody = $body;
			

			if(!$mail->send()) {
				$return['message'] = $this->lang["system_error"] . " #101";
				//echo("<p> ERROR INFO :");
				//echo($mail->ErrorInfo);				
				return $return;
			}

			$return['error'] = false;
			$return['message'] = $this->lang["messageSentForDownload"];
			return $return;
		}
		/*
			* Recreates activation email for a given email and sends
			* @param string $email
			* @return array $return
		*/

			public function resendActivation($email)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				$validateEmail = $this->validateEmail($email);

				if($validateEmail['error'] == 1) {
					$return['message'] = $validateEmail['message'];
					return $return;
				}

				$query = $this->dbh->prepare("SELECT id FROM {$this->config->table_users} WHERE email = ?");
				$query->execute(array($email));

				if($query->rowCount() == 0) {
					$this->addAttempt();

					$return['message'] = $this->lang["email_incorrect"];
					return $return;
				}

				$row = $query->fetch(PDO::FETCH_ASSOC);

				if ($this->getUser($row['id'])['isactive'] == 1) {
					$this->addAttempt();

					$return['message'] = $this->lang["already_activated"];
					return $return;
				}

				$addRequest = $this->addRequest($row['id'], $email, "activation");

				if ($addRequest['error'] == 1) {
					$this->addAttempt();

					$return['message'] = $addRequest['message'];
					return $return;
				}

				$return['error'] = false;
				$return['message'] = $this->lang["activation_sent"];
				return $return;
			}

		/*
			* Changes a user's password
			* @param int $uid
			* @param string $currpass
			* @param string $newpass
			* @return array $return
		*/

			public function changePassword($uid, $currpass, $newpass, $repeatnewpass)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				$validatePassword = $this->validatePassword($currpass);

				if($validatePassword['error'] == 1) {
					$this->addAttempt();

					$return['message'] = $validatePassword['message'];
					return $return;
				}

				$validatePassword = $this->validatePassword($newpass);

				if($validatePassword['error'] == 1) {
					$return['message'] = $validatePassword['message'];
					return $return;
				} elseif($newpass !== $repeatnewpass) {
					$return['message'] = $this->lang["newpassword_nomatch"];
					return $return;
				}

				$user = $this->getUser($uid);

				if(!$user) {
					$this->addAttempt();

					$return['message'] = $this->lang["system_error"] . " #13";
					return $return;
				}

				if(!password_verify($currpass, $user['password'])) {
					$this->addAttempt();

					$return['message'] = $this->lang["password_incorrect"];
					return $return;
				}

				$newpass = $this->getHash($newpass);

				$query = $this->dbh->prepare("UPDATE {$this->config->table_users} SET password = ? WHERE id = ?");
				$query->execute(array($newpass, $uid));

				$return['error'] = false;
				$return['message'] = $this->lang["password_changed"];
				return $return;
			}

		/*
			* Changes a user's email
			* @param int $uid
			* @param string $currpass
			* @param string $newpass
			* @return array $return
		*/

			public function changeEmail($uid, $email, $password)
			{
				$return['error'] = true;

				if ($this->isBlocked()) {
					$return['message'] = $this->lang["user_blocked"];
					return $return;
				}

				$validateEmail = $this->validateEmail($email);

				if($validateEmail['error'] == 1)
				{
					$return['message'] = $validateEmail['message'];
					return $return;
				}

				$validatePassword = $this->validatePassword($password);

				if ($validatePassword['error'] == 1) {
					$return['message'] = $this->lang["password_notvalid"];
					return $return;
				}

				$user = $this->getUser($uid);

				if(!$user) {
					$this->addAttempt();

					$return['message'] = $this->lang["system_error"] . " #14";
					return $return;
				}

				if(!password_verify($password, $user['password'])) {
					$this->addAttempt();

					$return['message'] = $this->lang["password_incorrect"];
					return $return;
				}

				if ($email == $user['email']) {
					$this->addAttempt();

					$return['message'] = $this->lang["newemail_match"];
					return $return;
				}

				if ($this->isEmailTaken($email)) {
					$this->addAttempt();

					$return['message'] = $this->lang["email_taken"];
					return $return;
				}

				$query = $this->dbh->prepare("UPDATE {$this->config->table_users} SET email = ? WHERE id = ?");
				$query->execute(array($email, $uid));

				if ($query->rowCount() == 0) {
					$return['message'] = $this->lang["system_error"] . " #15";
					return $return;
				}

				$return['error'] = false;
				$return['message'] = $this->lang["email_changed"];
				return $return;
			}



		/*
			* Informs if a user is locked out
			* @return boolean
		*/

			public function validSubscription($subscriptions, $subscriptions_type)
			{
				$validSub = null;
				if(isset($subscriptions) && $subscriptions != false)
				{
					foreach ($subscriptions as $row) {

						$expiredate = strtotime($row['expiration_date']);
						$currentdate = strtotime(date("Y-m-d H:i:s"));

						if ($currentdate < $expiredate && $row['state'] != 3) {	

							if($validSub != null)
							{
								if($expiredate > strtotime($validSub['expiration_date'])) $validSub = $row;
							}
							else
							{
								$validSub = $row;
							}



						}
					//print '<br/>'.$row['id'].'//'.$row['subscription_name'].'//'.$row['subscription_date'].'//'.$row['expiration_date'].'<br>'; 

					}
				}

				return $validSub;
			}




		/*
			* Informs if a user is locked out
		* @return boolean
		*/
		
		private function isBlocked()
		{
			$ip = $this->getIp();
			
			$query = $this->dbh->prepare("SELECT count, expiredate FROM {$this->config->table_attempts} WHERE ip = ?");
			$query->execute(array($ip));
			
			if($query->rowCount() == 0) {
				return false;
			}
			
			$row = $query->fetch(PDO::FETCH_ASSOC);
			
			$expiredate = strtotime($row['expiredate']);
			$currentdate = strtotime(date("Y-m-d H:i:s"));
			
			if ($row['count'] == 5) {
				if ($currentdate < $expiredate) {
					return true;
				}
				$this->deleteAttempts($ip);
				return false;
			}
			
			if ($currentdate > $expiredate) {
				$this->deleteAttempts($ip);
			}
			
			return false;
		}

			/*
			* Adds an attempt to database
			* @return boolean
			*/
			
			private function addAttempt()
			{
				$ip = $this->getIp();

				$query = $this->dbh->prepare("SELECT count FROM {$this->config->table_attempts} WHERE ip = ?");
				$query->execute(array($ip));

				$row = $query->fetch(PDO::FETCH_ASSOC);

				$attempt_expiredate = date("Y-m-d H:i:s", strtotime("+30 minutes"));

				if (!$row) {
					$attempt_count = 1;

					$query = $this->dbh->prepare("INSERT INTO {$this->config->table_attempts} (ip, count, expiredate) VALUES (?, ?, ?)");
					return $query->execute(array($ip, $attempt_count, $attempt_expiredate));
				}

				$attempt_count = $row['count'] + 1;

				$query = $this->dbh->prepare("UPDATE {$this->config->table_attempts} SET count=?, expiredate=? WHERE ip=?");
				return $query->execute(array($attempt_count, $attempt_expiredate, $ip));
			}
			
			/*
			* Deletes all attempts for a given IP from database
			* @param string $ip
			* @return boolean
			*/
			
			private function deleteAttempts($ip)
			{
				$query = $this->dbh->prepare("DELETE FROM {$this->config->table_attempts} WHERE ip = ?");
				return $query->execute(array($ip));
			}
			
			/*
			* Returns a random string of a specified length
			* @param int $length
			* @return string $key
			*/
			
			public function getRandomKey($length = 20)
			{
				$chars = "A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0U1V2W3X4Y5Z6a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6";
				$key = "";

				for ($i = 0; $i < $length; $i++) {
					$key .= $chars{mt_rand(0, strlen($chars) - 1)};
				}

				return $key;
			}
			
			/*
			* Returns IP address
			* @return string $ip
			*/
			
			private function getIp()
			{
				if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
					return $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
					return $_SERVER['REMOTE_ADDR'];
				}
			}
			
			
			
			
			/*
			* Gets user data for a given UID and returns an array
			* @param int $uid
			* @return array $data
			*/
			public function getDownload($code)
			{						
				$query = $this->dbh->prepare("SELECT * FROM {$this->config->table_downloads} WHERE code = ?");						
				$query->execute(array($code));


			//$query = $this->dbh->prepare("SELECT note, system, duration, lng, nextDayTime, mobileMenu FROM {$this->config->table_preferences} WHERE uid = ?");
			//$query->execute(array($uid));

				if ($query->rowCount() == 0) {
					return false;
				}

				$data = $query->fetch(PDO::FETCH_ASSOC);

				if (!$data) {
					return false;
				}

			//$data['uid'] = $uid;
				return $data;			
			}
			
			public function logStuf($type1, $type2, $type3, $uid, $user, $code, $comm)
			{	
				$date = date("Y-m-d H:i:s");
				$query = $this->dbh->prepare("INSERT INTO log (TYPE1, TYPE2, TYPE3, uid, user, DATE, CODE, COMM) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
				return $query->execute(array($type1, $type2, $type3, $uid, $user, $date, $code, $comm));	
			}






















			public function getSQLsrs1()
			{
				$query = $this->dbh->prepare("SELECT count(id) as id FROM `srs` WHERE `previous_repetition` > CURDATE() - 1 AND `previous_repetition` <= CURDATE() AND `uid` <> 231");
				$query->execute();
				if($query->rowCount() == 0) {return false;}
				return $query->fetch(PDO::FETCH_ASSOC);
			}	
			public function getSQLsrs7()
			{
				$query = $this->dbh->prepare("SELECT count(id) as id FROM `srs` WHERE `previous_repetition` > CURDATE() - 8 AND `previous_repetition` <= CURDATE() AND `uid` <> 231");
				$query->execute();
				if($query->rowCount() == 0) {return false;}
				return $query->fetch(PDO::FETCH_ASSOC);
			}	
			public function getSQLsrs30()
			{
				$query = $this->dbh->prepare("SELECT count(id) as id FROM `srs` WHERE `previous_repetition` > CURDATE() - 31 AND `previous_repetition` <= CURDATE() AND `uid` <> 231");
				$query->execute();
				if($query->rowCount() == 0) {return false;}
				return $query->fetch(PDO::FETCH_ASSOC);
			}	




			public function getSQLusers($days)
			{
				$query = $this->dbh->prepare("SELECT
					count(*) as users,
					(SELECT count(rs_brand) FROM `users` as srs WHERE rs_brand = 'Facebook' AND `date_signup` => CURDATE() - ? AND `date_signup` <= CURDATE() AND `id` <> 231) as 'Facebook',
					(SELECT count(rs_brand) FROM `users` as srs WHERE rs_brand = 'Google' AND `date_signup` => CURDATE() - ? AND `date_signup` <= CURDATE() AND `id` <> 231) as 'Google'
					FROM `users`
					WHERE `date_signup` > CURDATE() - ?
					AND `date_signup` <= CURDATE()
					AND `id` <> 231");
				$query->execute(array($days, $days));
				//$query->execute();

				if($query->rowCount() == 0) {
					return false;
				}

				return $query->fetch(PDO::FETCH_ASSOC);
			}	


			
		}




		?>
