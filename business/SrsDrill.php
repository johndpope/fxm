<?php
// Nous créons une classe « Personnage ».
class SrsDrill
{
  private $_drillCode;
  private $_nextRepetition;
  private $_previousRepetition;
  private $_interval;
  private $_currentNote;
  private $_speed;

  private $_score1q;
  private $_score1a;
  private $_score2q;
  private $_score2a;




  // Nous déclarons une méthode dont le seul but est d'afficher un texte.
  public function __construct($data)
  {
   $this->_drillCode = $data['drill_name'];
   $this->_nextRepetition = $data['next_repetition'];
   $this->_previousRepetition = $data['previous_repetition'];
     //$this->_interval = $data[''];
   $this->_currentNote = $data['current_note'];
   $this->_speed = $data['speed'];    

   if($data['result'] != "")
   {
     $t = explode(';', $data['result']);
   // $score1=$t[0];
   // $score2=$t[1];
     $score1 = explode(':', $t[0]);
     $score2 = explode(':', $t[1]);

     $this->_score1q = $score1[0];
     $this->_score1a = $score1[1];
     $this->_score2q = $score2[0];
     $this->_score2a = $score2[1];
   }
 }

  //
 public function getDrillCode()
 {
  return $this->_drillCode;
}

public function getNextRepetition()
{
  return $this->_nextRepetition;
}

public function getPreviousRepetition()
{
  return $this->_previousRepetition;
}

public function getCurrentNote()
{
  return $this->_currentNote;
}

public function getSpeed()
{
  return $this->_speed;
}

}



?>