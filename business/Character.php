<?php

class Character
{
  private $_id;
  private $_uid;
  private $_name;
  private $_firstConnectionName;
  private $_level;
  private $_life;
  private $_money;
  //experience totale
  private $_xp; 
  //experience dans le niveau
  private $_xpLvl; 
  private $_characterBase;
  private $_guitarBase;
  private $_background; 
  private $_clothesUp;
  private $_clothesDown;
  private $_hair;
  private $_face;
  private $_access1;
  private $_access2;

  private $_ampBase;
  private $_inventory;

  private $_dayXp;
  private $_dayLife;
  private $_dayMoney;
  private $_dayDate;

  private $_dbh;
  private $_FxmDbAccessor;

  // Nous déclarons une méthode dont le seul but est d'afficher un texte.

  public function __construct($uid, $name, $dbh, $FxmDbAccessor)
  {

   $this->_uid = $uid;
   $this->_id = "0";
   $this->_dbh = $dbh;
   $this->_FxmDbAccessor = new FxmDbAccessor($this->_dbh);
   $this->_firstConnectionName = $name;
   $this->populate();

 }

 private function populate()
 {
  //$this->_uid = $uid;
  //appel bases
  $data = $this->_FxmDbAccessor->getCharacter($this->_uid);
  //var_dump($data);
  //echo $this->_id;
  if($data != false)
  {
    $this->_id = $data['id'];
    $this->_name = $data['name'];

    $this->_level = $data['level'];
    $this->_life = $data['life'];
    $this->_money = $data['money'];
    $this->_xp = $data['xp'];
    $this->_xpLvl = $data['xplvl'];

    $this->_characterBase = $data['characterBase'];
    $this->_guitarBase = $data['guitarBase'];
    $this->_background = $data['backgroundBase'];
    $this->_clothesUp = $data['cup'];
    $this->_clothesDown = $data['cdo'];
    $this->_hair = $data['hair'];
    $this->_access1 = $data['access1'];
    $this->_access2 = $data['access2'];
    $this->_ampBase = $data['amp'];


    $this->_dayXp = $data['dayxp'];
    $this->_dayMoney = $data['daymoney'];
    $this->_dayLife = $data['daylife'];
    $this->_dayDate = $data['daydate'];
    $this->_inventory = $data['inventory'];
   // echo "zertyui";
  }
  else
  {
    //$data = $this->_FxmDbAccessor->


    $this->_name = $this->_firstConnectionName;//"Guitarist";
    $this->_level = "1";
    $this->_life = "100";
    $this->_money = "10";
    $this->_xp = "0";
    $this->_characterBase = "p1";
    $this->_guitarBase = "g1";
    $this->_background = "b1";
    $this->_ampBase = "fender";
    $this->_dayXp = 0;
    $this->_dayMoney = 0;
    $this->_dayLife = 0;
    $this->_inventory = "";

    $this->setBase($this->_name, $this->_characterBase, $this->_guitarBase, $this->_background, $this->_ampBase, "", "", "");

  }



}



public function getId()
{
  return $this->_id;
}


public function getName()
{
 if($this->_name == null) $this->populate();    

 return $this->_name;
}

public function getInventory()
{
  return $this->_inventory;
}

public function getLevel()
{
  return $this->_level;
}

public function getLife()
{
  return $this->_life;
}

public function getMoney()
{
  return $this->_money;
}

public function getXP()
{
  return $this->_xp;
}

public function getDayXP()
{
 if(date('Y-m-d', strtotime(getClientCurrentDate())) == date('Y-m-d', strtotime($this->_dayDate)))
 {
  return $this->_dayXp;
}
else
{
  return 0;
}
}
public function getDayLife()
{


  if(date('Y-m-d', strtotime(getClientCurrentDate())) == date('Y-m-d', strtotime($this->_dayDate)))
  {
   return $this->_dayLife;
 }
 else
 {
  return 0;
}
}
public function getDayMoney()
{


 if(date('Y-m-d', strtotime(getClientCurrentDate())) == date('Y-m-d', strtotime($this->_dayDate)))
 {
   return $this->_dayMoney;
 }
 else
 {
  return 0;
}

}
public function getDayDate()
{
 return $this->_dayDate;
}

public function getXPLvl()
{
  return $this->_xpLvl;
}

public function getCharacterBase()
{
  return $this->_characterBase;
}

public function getCharacterBaseImageSource()
{
  return "images/".$this->_characterBase.".png";

}


public function getCharacterBaseAccess1()
{
  $objTab = explode("|", $this->_access1);
  return $objTab[0];
  
}
public function getCharacterBaseAccess1ImageSource()
{
  return "images/".$this->_characterBase."/".$this->_characterBase.$this->getCharacterBaseAccess1().".png";
}


public function getCharacterBaseAccess2()
{
  $objTab = explode("|", $this->_access2);
  return $objTab[0];
}
public function getCharacterBaseAccess2ImageSource()
{
  return "images/".$this->_characterBase."/".$this->_characterBase.$this->getCharacterBaseAccess1().".png";
}




public function getCharacterBaseFace()
{
  return $this->_face;
}
public function getCharacterBaseFaceImageSource()
{
  return "images/".$this->_characterBase."/".$this->_characterBase.$this->_face.".png";
}

public function getCharacterBaseHair()
{
  $objTab = explode("|", $this->_hair);
  return $objTab[0];
}
public function getCharacterBaseHairImageSource()
{
  return "images/".$this->_characterBase."/".$this->_characterBase.$this->getCharacterBaseHair().".png";
}


public function getCharacterBaseClothesUp()
{
  $objTab1 = explode("|", $this->_clothesUp);  
  return $objTab1[0];
}

public function getCharacterBaseClothesUpImageSource()
{

  return "images/".$this->_characterBase."/".$this->_characterBase.$this->getCharacterBaseClothesUp().".png";
}

public function getCharacterBaseClothesDown()
{
  $objTab = explode("|", $this->_clothesDown);
  return $objTab[0];
}
public function getCharacterBaseClothesDownImageSource()
{
  return "images/".$this->_characterBase."/".$this->_characterBase.$this->getCharacterBaseClothesDown().".png";
}

public function getCharacterBaseArmsImageSource()
{
  return "images/".$this->_characterBase."/".$this->_characterBase."ar.png";
}



public function getCharacterBaseClothesArmsImageSource()
{
  return "images/".$this->_characterBase."/".$this->_characterBase.$this->getCharacterBaseClothesUp()."a.png";
}


public function getCharacterBaseAccessImageSource()
{
  return "images/".$this->_characterBase."/".$this->_characterBase."ac02.png";
}

public function getGuitarBase()
{
  return $this->_guitarBase;
}
public function getGuitarBaseImageSource()
{
  return "images/".$this->_guitarBase.".png";
}


public function getAmpBaseImageSource()
{
  return "images/".$this->_ampBase.".png";
}


public function getBackground()
{
  return $this->_background;
}
public function getBackgroundImageSource()
{
  return "images/".$this->_background.".png";
}

public function getAmp()
{
  return $this->_ampBase;
}

public function setBase($name, $characterBase, $guitarBase, $backgroundBase, $ampBase, $hair, $cup, $cdo)
{
  $this->_name = $name;
  $this->_characterBase = $characterBase;
  $this->_guitarBase = $guitarBase;
  $this->_ampBase = $ampBase;
  $this->_hair = $hair;
  $this->_cup = $cup;
  $this->_cdo = $cdo;
  $this->_background = $backgroundBase;
  return $this->_FxmDbAccessor->setObjects($this->_uid, $name, $characterBase, $guitarBase, $backgroundBase, $ampBase, $hair, $cup, $cdo);    
}

public function updateCharacterXP($points, $pointsLvl, $levelAfter, $money)
{

  $date = date('Y-m-d', strtotime(getClientCurrentDate()));
  $daydate = date('Y-m-d', strtotime($this->_dayDate));
  if($daydate != $date)
  {
    $this->_dayXp = 0;
    $this->_dayMoney = 0;
    $this->_dayLife = 0;
    $lifeDay = 0;
  }
  else
  {
    $lifeDay = $this->_dayLife;
  }

  $this->_dayXp = $this->getDayXP() + ($points-$this->_xp);
  $this->_dayMoney = $this->getDayMoney() + ($money-$this->_money);

  $this->_xp = $points;
  $this->_xpLvl = $pointsLvl;
  $this->_level = $levelAfter;
  $this->_money = $money;

  return $this->_FxmDbAccessor->updateCharacterXP($this->_id, $points, $pointsLvl, $levelAfter, $money, $this->_dayXp, $this->_dayMoney, $lifeDay, $date);    
}

public function updateCharacterLife($life, $inventory, $guitar, $amp, $background)
{
  $date = date('Y-m-d', strtotime(getClientCurrentDate()));
  $daydate = date('Y-m-d', strtotime($this->_dayDate));
  if($daydate != $date)
  {
    $this->_dayXp = 0;
    $this->_dayMoney = 0;
    $this->_dayLife = 0;
    $xpDay = 0;
    $moneyDay = 0;
  }
  else
  {
    $xpDay = $this->_dayXp;
    $moneyDay = $this->_dayMoney;
  }

  $this->_dayLife = $this->getDayLife() + ($life-$this->_life);
  $this->_life = $life;

  if($life <= 0) 
  {
    $life = 100;
    $this->_dayMoney = $this->_dayMoney - $this->_money;
    $moneyDay = $this->_dayMoney;
    //$this->_FxmDbAccessor->updateCharacterMoneyAndInventory($this->_id, 0, $inventory);    
    return $this->_FxmDbAccessor->updateCharacterLife($this->_id, $life, $this->_dayLife, $date, 0, $inventory, $guitar, $amp, $background, $xpDay, $moneyDay);        
  }  
  else
  {    
    return $this->_FxmDbAccessor->updateCharacterLife($this->_id, $life, $this->_dayLife, $date, -1, "", "", "", "", $xpDay, $moneyDay);        
  }
  
}

public function buyObject($idObject, $reste)
{
  $this->_dayMoney = $this->_dayMoney - ($this->_money - $reste);
  $this->_money = $reste;

  $inventory = $this->_inventory."|".$idObject;
  return $this->_FxmDbAccessor->buyObject($this->_id, $reste, $inventory, $this->_dayMoney);  
}

public function applyPotion($reste, $life)
{  
  $this->_dayMoney = $this->_dayMoney - ($this->_money - $reste);
  $this->_money = $reste;

  $this->_dayLife = $this->_dayLife + ($life - $this->_life);
  $this->_life = $life;

  return $this->_FxmDbAccessor->applyPotion($this->_id, $reste, $life, $this->_dayLife, $this->_dayMoney);  
}




}



?>