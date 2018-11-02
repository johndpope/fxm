<?php

class FxmDbAccessor
{
	private $dbh;		


	public function __construct(\PDO $dbh)
	{
		$this->dbh = $dbh;			

	}


		/*
			* Récupérer les données SRS
		*/		
			public function getMyDrills($uid)
			{			
			//echo $uid."<p></p>";
				$query = $this->dbh->prepare("SELECT drill_name, next_repetition, previous_repetition, speed, current_note, result FROM srs WHERE uid = ? order by drill_name");
			//$query = $this->dbh->prepare("SELECT * FROM srs order by drill_name");

				$currentdate = date("Y-m-d H:i:s");
			//echo($currentdate);
				$query->execute(array($uid));

			//$query->execute(array($uid, $currentdate));
			//print_r($query);			
			//print_r($this->dbh->errorInfo());

				if ($query->rowCount() == 0) {
					return false;
				}

				$i = 0;
				while($row = $query->fetch(PDO::FETCH_ASSOC)){ 

				//$data[$i] = $row;

					$data[$row["drill_name"]]["next_repetition"] = $row["next_repetition"];
					$data[$row["drill_name"]]["previous_repetition"] = $row["previous_repetition"];
					$data[$row["drill_name"]]["speed"] = $row["speed"];
					$data[$row["drill_name"]]["current_note"] = $row["current_note"];
					$data[$row["drill_name"]]["result"] = $row["result"];
				//$data[$row["drill_name"]]["next_repetition"] = $row["next_repetition"];

				//$data[$i]["drill_name"] = $row["drill_name"];
				//$data[$i]["next_repetition"] = $row["next_repetition"];
				//$data[$i]["speed"] = $row["speed"];
				//$data[$i] = $row;
					$i++;

				}


				if (!$data) {
					return false;
				}

			//$data['uid'] = $uid;
				return $data;


			}




			public function getCharacter($uid)
			{
				$query = $this->dbh->prepare("SELECT * FROM fxmcharacter WHERE uid = ?");
				$query->execute(array($uid));



				if ($query->rowCount() == 0) {
					return false;
				}

				$data = $query->fetch(PDO::FETCH_ASSOC);

				if (!$data) {
					return false;
				}

				$data['uid'] = $uid;
		//	var_dump($data);
				return $data;
			}

			


			public function setObjects($id, $name, $characterBase, $guitarBase, $backgroundBase, $ampBase, $hair, $cup, $cdo) 
			{
				$return['error'] = true;
				$query = $this->dbh->prepare("SELECT id FROM fxmcharacter WHERE uid = ?");
				$query->execute(array($id));

				$row = $query->fetch(PDO::FETCH_ASSOC);	

				if (!$row) {

					$level = 1;
					$life = 100;
					$xp = 0;
					$money = 10;
					$amp = "a01";
					//$name = "Guitou";

					$query = $this->dbh->prepare("INSERT INTO fxmcharacter (uid, name, level, life, xp, money, characterBase, guitarBase, backgroundBase, amp, hair, cup, cdo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					return $query->execute(array($id, $name, $level, $life, $xp, $money, $characterBase, $guitarBase, $backgroundBase, $amp, $hair, $cup, $cdo));	
				}
				else
				{
					$query = $this->dbh->prepare("UPDATE fxmcharacter SET name = ?, characterBase = ?, guitarBase = ?, backgroundBase = ?, amp = ?, hair = ?, cup = ?, cdo = ? WHERE uid = ?");

					if(!$query->execute(array($name, $characterBase, $guitarBase, $backgroundBase, $ampBase, $hair, $cup, $cdo, $id))) 
					{
						$return['message'] = "system_error" . " #09";
						return $return;

					}	
				}
			//var_dump($query->execute(array($characterBase, $guitarBase, $backgroundBase, $id)));
				$return['error'] = false;
				$return['message'] = "mis à jour";

				return $return;
			}	


			//updateCharacterXP($this->_id, $points, $pointsLvl, $levelAfter)
			public function updateCharacterXP($id, $points, $pointsLvl, $levelAfter, $money, $dayXp, $dayMoney, $lifeDay, $date)
			{
				$return['error'] = true;

				$query = $this->dbh->prepare("UPDATE fxmcharacter SET xp = ?, xplvl = ?, level = ?, money = ?, dayxp = ?, daymoney = ?, daylife = ?, daydate = ? WHERE id = ?");

				if(!$query->execute(array($points, $pointsLvl, $levelAfter, $money, $dayXp, $dayMoney, $lifeDay, $date, $id))) 
				{
					$return['message'] = "system_error" . " #09";
					return $return;

				}	
				

				$return['error'] = false;
				$return['message'] = "mis à jour";

				return $return;
			}				
			
			public function buyObject($id, $reste, $inventory, $moneyDay)
			{
				$return['error'] = true;

				$query = $this->dbh->prepare("UPDATE fxmcharacter SET money = ?, inventory = ?, daymoney = ? WHERE id = ?");

				if(!$query->execute(array($reste, $inventory, $moneyDay, $id))) 
				{
					$return['message'] = "system_error" . " #09";
					return $return;
				}	
				
				$return['error'] = false;
				$return['message'] = "mis à jour";

				return $return;
			}	
			
			public function applyPotion($id, $reste, $life, $dayLife, $dayMoney)
			{
				$return['error'] = true;

				$query = $this->dbh->prepare("UPDATE fxmcharacter SET money = ?, life = ?, daymoney = ?, daylife = ? WHERE id = ?");

				if(!$query->execute(array($reste, $life, $dayMoney, $dayLife, $id))) 
				{
					$return['message'] = "system_error" . " #09";
					return $return;
				}	
				
				$return['error'] = false;
				$return['message'] = "mis à jour";

				return $return;
			}	

			//updateCharacterLife
			public function updateCharacterLife($id, $life, $daylife, $date, $money, $inventory, $guitar, $amp, $background, $xpDay, $moneyDay)
			{

				if($money == 0)
				{

					$return['error'] = true;

					$query = $this->dbh->prepare("UPDATE fxmcharacter SET life = ?, daylife = ?, daydate = ?, money = ?, inventory = ?, guitarBase = ?, amp = ?, backgroundBase = ?, dayxp = ?, daymoney = ? WHERE id = ?");

					if(!$query->execute(array($life, $daylife, $date, $money, $inventory, $guitar, $amp, $background, $xpDay, $moneyDay, $id))) 
					{
						$return['message'] = "system_error" . " #09";
						return $return;

					}	

					$return['error'] = false;
					$return['message'] = "mis à jour";

					return $return;
				}
				else
				{

					$return['error'] = true;

					$query = $this->dbh->prepare("UPDATE fxmcharacter SET life = ?, daylife = ?, daydate = ?, dayxp = ?, daymoney = ? WHERE id = ?");

					if(!$query->execute(array($life, $daylife, $date, $xpDay, $moneyDay, $id))) 
					{
						$return['message'] = "system_error" . " #09";
						return $return;

					}	

					$return['error'] = false;
					$return['message'] = "mis à jour";

					return $return;
				}


			}	

		}




		?>
