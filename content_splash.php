<?php 
$requestkey = 0;
$utm="0";
$utmToStore = "";
if(isset($_GET["utm"]))
{
  $utmToStore = $_GET["utm"];
  if($_GET["utm"] == "FB201709" ||
    $_GET["utm"] == "FB201709" ||
    $_GET["utm"] == "FB201709")
  {
    $utm=$_GET["utm"];
  }
  else
  {
    $utm = "0";
  }
}
?>

<script type="text/javascript">
  var utmToStore = "";
  var lng = "";
  utmToStore = "<?php echo $utmToStore; ?>";
  lng = "<?php echo $language; ?>";

  var FBlng = "fr_FR"
  if(lng =="en") FBlng = "en_US";

  window.onload = function(event) {
    //setSpashElements();
    <?php
    if(isset($_GET['id']))
    {
      $requestkey = $_GET['id'];    
      ?>
      zoneToDisplay('reinitPassZone');
      <?php
    } 
    else
    {
      ?>
      zoneToDisplay('signupZone');
      $requestkey = 0;    
      <?php
    }
    ?>
  };
</script>


<script src="<?php echo $jsPath; ?>/splash.js?ver=<?php echo $versionJSLight; ?>"></script>

<?php 
if($language == 'fr')
{
  include("content_splash_new.php");
}
else
{
  include("content_splash_old.php");
}
?>



<div style="clear:left" class="footerMenu" >
  <span class="footerText"><a href="fxm.php?page=dashboard">FretXMaster <?php echo date("Y"); ?></a></span>&nbsp;&nbsp;&nbsp;
  <span class="footerText"><a href="fxm.php?page=conditions"><?php echo($lang['conditions']); ?></a></span>&nbsp;&nbsp;&nbsp;
  <span class="footerText"><a href="fxm.php?page=contacts"><?php echo($lang['contacts']); ?></a></span>
</div>
