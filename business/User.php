<?php
include("SrsDrill.php");
include("Character.php");
// Utilisateur
class User
{
  private $_uid;
  private $_email;
  private $_name;
  private $_rsBrand;
  private $_rsName;
  private $_signupDate;
  private $_lastLoginDate;
  private $_srsDrillTab;

  private $_wizard;
  
  public $_character;   

  private $_dbh; 
  private $_FxmDbAccessor; 
  
  public function __construct($dbh, $uid, $mail, $signupDate, $brand, $brandName, $wizard)
  {
   $this->_dbh = $dbh;
   $this->_FxmDbAccessor = new FxmDbAccessor($this->_dbh); 

   $this->_uid = $uid;

   $this->_email = $mail;
   $this->setName();

   $this->_signupDate = $signupDate;

   $this->_srsDrillTab = null;

   $this->_rsBrand = $brand;

   $this->_rsName = $brandName;

   $this->_wizard = $wizard;

   if($brandName != "")
     $name = $brandName;  
   else
     $name = explode('@', $this->_email)[0];

   $name = str_replace("."," ",$name);
   $name = ucwords($name);
   if(strlen($name) > 32) $name = substr($name, 0, 32);

   $this->_character = new Character($this->_uid, $name, $this->_dbh, $this->_FxmDbAccessor);

   //var_dump($this->_character);

   //if()
 }
 
 //uid
 public function getUID()
 {
   return $this->_uid;
 }

  //Création du nom à partir de l'email
 private function setName()
 {
  $this->_name = explode('@', $this->_email)[0];
}

  //Nom
public function getName()
{
  return $this->_name;
}
  //rsBRAND
public function getRsBrand()
{
  return $this->_rsBrand;
}  
//rsName
public function getRsName()
{
  return $this->_rsName;
}

  //Date d'inscription
public function getSignupDate()
{
  return $this->_signupDate;
}

  //Date d'inscription
public function getWizard()
{
  return $this->_wizard;
}

  //Données des drills
public function getSrsDrillTab()
{
    //Si le tableau de drill existe déjà, on le renvoie, sinon on interroge la base
 if($this->_srsDrillTab != null) 
 {
  return $this->_srsDrillTab;
}
else
{
 $this->_srsDrillTab = array();
      //Interrogation de la base, et récupération des dans un tableau
 $drills = $this->_FxmDbAccessor->getMyDrills($this->_uid);

      //Création du tableau de SrsDrill
 foreach ($drills as $row) 
 {        
  $srsDrill = new SrsDrill($row);        
  array_push($this->_srsDrillTab, $srsDrill);        
}    

return $this->_srsDrillTab;		
}
}



     //Données des drills 
public function getSrsDrill()
{

//Si le tableau de drill existe déjà, on le renvoie, sinon on interroge la base
  if($this->_srsDrillTab != null) 
  {
    return $this->_srsDrillTab;
  }
  else
  {
    $this->_srsDrillTab = $this->_FxmDbAccessor->getMyDrills($this->_uid);
    return $this->_srsDrillTab;
  }
}






}





?>