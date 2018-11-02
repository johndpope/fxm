<?php
if(!$connected)
{
    header( 'Location: fxm.php?page=login' );
    die();
}

//var_dump($user);

//Si le décalage est déjà en cookie
if(!isset($_COOKIE["mbTimeDelta"]))
{
    include("modalFrame_Waiting.php");
?>
<script>
    window.onload = function() {
        updateTimeDelta();
    }
</script>
<?php
}
$SrsDrillTab = $user->getSrsDrill();
//var_dump($SrsDrillTab);
//if(firstConnection)
if($user->getWizard() == "0")
{
    $firstConnection = true;
}
//var_dump($SrsDrillTab);
include("php/drillTools.php"); 
$nbNoteOk = 0;
$nbNoteOkMaitrise = 0;
if($SrsDrillTab){
    foreach($SrsDrillTab as $drill)
    {
        if($drill["current_note"] == "1" && !($drill["next_repetition"] < getClientCurrentDate()))
        {
            $nbNoteOk++;
            $speed = $drill["speed"];
            $speedPct = ($speed/120)*100;
            if($speedPct>100) $speedPct = 100;
            $freshLevel = setLevelFromNextRepetition($drill["previous_repetition"], $drill["next_repetition"]);
            $freshLevelPct = $freshLevel*25;
            if($freshLevelPct>100) $freshLevelPct = 100;
            $totalPct = (($freshLevelPct + $speedPct)/2)/100;		
            $nbNoteOkMaitrise = $nbNoteOkMaitrise + $totalPct;
        }
    }
}
$nbNoteOk = ($nbNoteOk/61)*100;
$nbNoteOk = round($nbNoteOk);
$nbNoteOkMaitrise = ($nbNoteOkMaitrise/61)*100;
$nbNoteOkMaitrise = round($nbNoteOkMaitrise);

function displayDrill1($exo, $SrsDrillTab, $filter)
{
    displayDrill($exo, $SrsDrillTab, $filter, 0);
}

function displayDrill($exo, $SrsDrillTab, $filter, &$nb, $name)
{	
    global $hasSubscribed;	
    $exo0 = substr($exo, 0, 6);

    $level = "01";
    $freshLevel = "0";
    $due = false;
    $next = "0";
    $speed = "40";
    $dueDate = "";
    $score = -1;
    $note = -1;
    $result = "";

    /*Si le drill existe*/
    if(isset($SrsDrillTab[$exo])) 
    {
        /* Le drill est il à revoir aujourdhui ? */
        if($SrsDrillTab[$exo]["next_repetition"] <= getClientCurrentDate()) 
        {
            $due = true;
        }

        $speed = $SrsDrillTab[$exo]["speed"];
        $dueDate = $SrsDrillTab[$exo]["next_repetition"];
        $result = $SrsDrillTab[$exo]["result"];
        $note = $SrsDrillTab[$exo]["current_note"];
        //var_dump($SrsDrillTab[$exo]);

        if($result != "")
        {
            $t = explode(';', $result);
            $score1 = explode(':', $t[0]);
            $score2 = explode(':', $t[1]);

            $score1q = $score1[0];
            $score1a = $score1[1];
            $score2q = $score2[0];
            $score2a = $score2[1];

            $score1 = $score1a == 0 ? 0 : ($score1q / $score1a);
            $score2 = $score2a == 0 ? 0 : ($score2q / $score2a);
            $score = round((($score1 + $score2)/2)*100);



        }

        setlocale(LC_TIME, 'fr');
        $dueDate = strftime('%x', strtotime($dueDate));

        /* on définit son niveau de vitesse */
        $level = setLevelFromSpeed($speed)	;
        /* on définit son niveau de récence */
        $freshLevel = setLevelFromNextRepetition($SrsDrillTab[$exo]["previous_repetition"], $SrsDrillTab[$exo]["next_repetition"]);
        $next = $SrsDrillTab[$exo]["next_repetition"];
    }

    if($filter && $due) 
    {
        $nb++;
    }

    if(!($filter) || ($filter && $due && $nb <= 3)){

        $colorBoule = "#cccccc";

        $display = "";
        /*Frame encadrant le drill*/			

        /* on autorise ou pas le clic en fonction de la souscription */
        if(!($hasSubscribed || isDrillAllowedToFree($exo0)))
        {
            $display = $display."<div id=\"".$exo."\" class=\"lockedDrill drill-frame\" exo=\"".$exo."\" onclick=\"\">";
            //$display = $display."<span class=\"drill-name premium\">PREMIUM</span>";
        }
        else
        {
            $display = $display."<div id=\"".$exo."\" class=\"modalToogler drill-frame\" exo=\"".$exo."\" onclick=\"chooseDrill('".$exo."', '".$speed."', '".$dueDate."', '".$score."', '".$note."', '".$result."');\">";
        }

        /*Boule*/
        if($filter) $bouleName = $exo."-bouleDue";
        else $bouleName = $exo."-boule";

        $display = $display."<canvas class=\"drill-image\" id=\"".$bouleName."\" width=\"80px\" height=\"80px\" color=\"80px\"></canvas>";

        /* en fonction de la catégorie, on place la couleur de la boule et l'icone qui va bien */ 
        if(substr($exo, 3, 1) == "1") 
        {
            $colorBoule = "#29A9E6";
            $display = $display."<img id=\"".$exo."-neck\" class=\"drill-speed drill-neckCenter\" src=\"images/audio.svg\"/>";
        }
        if(substr($exo, 3, 1) == "2") 
        {			
            $colorBoule = "#b71c1c";
            $display = $display."<img id=\"".$exo."-neck\" class=\"drill-speed drill-neckCenter\" src=\"images/neckwhite.svg\"/>";
        }
        if(substr($exo, 3, 1) == "3") 
        {
            $colorBoule = "#00897B";
            $display = $display."<img id=\"".$exo."-neck\" class=\"drill-speed drill-neck\" src=\"images/neckwhite.svg\"/>";
        }
        if(substr($exo, 3, 1) == "4") 
        {
            $colorBoule = "#0473A9";
            $display = $display."<img id=\"".$exo."-neck\" class=\"drill-speed drill-neck\" src=\"images/2fret.png\"/>";
        }
        if(substr($exo, 3, 1) == "5") 
        {
            $colorBoule = "#FF9800";
            $display = $display."<img id=\"".$exo."-neck\" class=\"drill-speed drill-neckDouble\" src=\"images/4fret3.png\"/>";
        }
        if(substr($exo, 3, 1) == "6") 
        {
            $colorBoule = "#F3AFA5";
            $display = $display."<img id=\"".$exo."-neck\" class=\"drill-speed drill-neck\" src=\"images/pick0.png\"/>";
        }

        if(!($hasSubscribed || isDrillAllowedToFree($exo0)))
        {
            $colorBoule = "lightgray";
        }

        /*Nom du drill et couleur de boule*/
        $display = $display."<span class=\"drill-name\" speed=\"".$speed."\" fresh=\"".$freshLevel."\" color=\"".$colorBoule."\" >".$name."</span>";

        /* Ajout du dièse, du bemol, ou des deux */
        if(substr($exo, 6, 1) == "D") $display = $display."<span class=\"sign-name\"><img src=\"images/sharpSign1.svg\" /></span>";
        if(substr($exo, 6, 1) == "B") $display = $display."<span class=\"sign-name\"><img src=\"images/flatSign1.svg\" /></span>";
        if(substr($exo, 6, 1) == "A") 
        {
            $display = $display."<span class=\"sign-name sign-name1\"><img src=\"images/sharpSign1.svg\" /></span>";
            $display = $display."<span class=\"sign-name sign-name2\"><img src=\"images/flatSign1.svg\" /></span>";
        }		

        if(!($hasSubscribed || isDrillAllowedToFree($exo0)))
        {
            //$display = $display."<div id=\"".$exo."\" class=\"lockedDrill drill-frame\" exo=\"".$exo."\" onclick=\"\">";
            $display = $display."<span class=\"drill-name premium\">PREMIUM</span>";
        }

        $display = $display."</div>";

        /* script déclencheur qui initie le dessin du canvas pour la boule */
        if(!isset($SrsDrillTab[$exo])) {$speed = "20"; $freshLevel="0";}
        $display = $display."<script>drawIn('".$bouleName."', 'images/drill0.png', '".$colorBoule."', ".$speed.", ".$freshLevel.");</script>";
        echo $display;	
    }
}

$numberOfdrillDisplayed = 0;

?>
<script src="<?php echo $jsPath; ?>/dash.js?ver=<?php echo $versionJSLight; ?>"></script>
<script>
    <?php
    //if(true)
    if(isset($firstConnection) && $firstConnection == true)
    {
    ?>
    window.onload = function(event) {
        navigateWizard("modalFrame_WizardDash-01");
    };
    <?php
    }
    ?>

    function initCharacterDrawing()
    {
        drawInCanvas("cvsBACK", "<?php echo $user->_character->getBackgroundimagesource(); ?>", 0);
        drawInCanvas("cvsBODY", "<?php echo $user->_character->getCharacterBaseimagesource(); ?>", 0);
        drawInCanvas("cvsFACE", "<?php echo $user->_character->getCharacterBaseFaceimagesource(); ?>", 0);
        drawInCanvas("cvsHAIR", "<?php echo $user->_character->getCharacterBaseHairimagesource(); ?>", 0);
        drawInCanvas("cvsCLUP", "<?php echo $user->_character->getCharacterBaseClothesUpimagesource(); ?>", 0);
        drawInCanvas("cvsCLDO", "<?php echo $user->_character->getCharacterBaseClothesDownimagesource(); ?>", 0);
        drawInCanvas("cvsARMS", "<?php echo $user->_character->getCharacterBaseArmsimagesource(); ?>", 0);
        drawInCanvas("cvsGUIT", "<?php echo $user->_character->getGuitarBaseimagesource(); ?>", 0);
        drawInCanvas("cvsCLAR", "<?php echo $user->_character->getCharacterBaseClothesArmsimagesource(); ?>", 0);
        drawInCanvas("cvsACC1", "<?php echo $user->_character->getCharacterBaseAccess1(); ?>", 0);
        drawInCanvas("cvsACC2", "<?php echo $user->_character->getCharacterBaseAccess2(); ?>", 0);
    }


    //Mise en cookie du timeDelta
    function updateTimeDelta() {
        var dateServeurPhp = "<?php  echo(date("D M d Y H:i:s O")); ?>";	
        var dateServeur = new Date(dateServeurPhp);
        var dateLocale = new Date(); 
        //Modif date locale pour le test
        var diff = Math.floor((dateLocale - dateServeur) / (1000*60*60));			
        if(isNaN(diff)) diff=0;	
        TimeDelta(diff);	
    }
    //Mise en cookie du timeDelta
    function TimeDelta(difference) {
        $.post(
            'time_ax.php', 
            {				
                diff : difference
            },
            function(data){
                //console.log(data);
                window.location.href = "fxm.php?page=dashboard";
            },
            'text'
        );
        return false;
    }


</script>
<div class="content-container">
    <div class="block-container">
        <div class="menuProg">
            <span class="myAdvancementButton menuProgLeft"><?php echo($lang['units']); ?></span>		
            <span class="myAdvancementButton menuProgRight"><?php echo($lang['progress']); ?></span>
            <span class="myAdvancementButton menuProgLeft" style="height:28px;background-color:rgba(255,0,0,0);"></span>		
            <span class="myAdvancementButton menuProgRight" style="height:28px;background-color:rgba(255,0,0,0);"></span>		
            <span  id="totolane" class="myAdvancementButton menuProgLane menuProgLaneLeft"></span>		
        </div>
        <div class="side-blocks" id="totoside">
            <div class="side-blocks-inner">
                <!--BLOC LATERAL DU PERSONNAGE -->
                <div class="side-block">

                    <?php include("component_characterFrame3.php"); ?>

                    <div class="block-content character-name">
                        <?php echo $user->_character->getName(); ?>
                    </div>
                </div>
                <div class="side-block">
                    <!--BLOC DES STATS -->
                    <div class="block-content">
                        <h4><?php echo($lang['progress']); ?></h4>
                        <div class="helpButtonProg">

                            <img alt="<?php echo($lang['help']); ?>" src="images/help.svg" class="circleImg" />
                        </div><hr/>
                        <div class="titleSide"><?php echo($lang['fretboardKnowledge']); ?> : <?php echo $nbNoteOk; ?>%</div>
                        <progress id="" class="ConnaissanceBar" max="100" value="<?php echo $nbNoteOk; ?>"></progress>
                        <div class="titleSide"><?php echo($lang['fretboardMastery']); ?> : <?php echo $nbNoteOkMaitrise; ?>%</div>
                        <progress id="" class="MaitriseBar" max="100" value="<?php echo $nbNoteOkMaitrise; ?>"></progress>
                        <p></p>
                        <h4><?php echo($lang['today']); ?></h4><hr/>
                        <span class="statUnit"><img class="heartImg" src="images/xpColor.png" /></span><div class="stats"><?php if($user->_character->getDayXP() > 0) echo "+"; echo $user->_character->getDayXP(); ?> </div><hr/>
                        <span class="statUnit"><img class="heartImg" src="images/money0.png" /></span><div class="stats"><?php if($user->_character->getDayMoney() > 0) echo "+"; echo $user->_character->getDayMoney(); ?> </div><hr/>
                        <span class="statUnit"><img class="heartImg" src="images/heartPink.png" /></span><div class="stats"><?php if($user->_character->getDayLife() > 0) echo "+"; echo $user->_character->getDayLife(); ?> </div>
                    </div>
                </div>
                <div class="side-block">
                    <div class="block-content social-block" id="social">
                        <h4><?php echo($lang['followUs']); ?></h4><hr/>
                        <p>
                            <a href="https://www.facebook.com/MusicianBooster/" target="_blank" title="Facebook" id="facebook" class="social fb"></a>
                            <a href="https://twitter.com/BoosterContact" target="_blank" title="Twitter" id="twitter" class="social tw"></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--BLOC PRINCIPAL DES EXERCICES -->

        <div class="main-block" id="totomain">
            <div class="block-content">

                <div class="title">
                    <!-- À revoir aujourd'hui -->
                    <?php echo($lang['spacedRepetition']); ?>
                </div>
                <h3><?php echo($lang['daysUnits']); ?></h3>

                <div class="helpButton">

                    <img alt="<?php echo($lang['help']); ?>" src="images/help.svg" class="circleImg" />
                </div>
                <hr/>

                <p></p>
                <div class="drill-group">
                    <?php 
                    displayDrill("FM01A1N", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM01A1"].$lang['label_alteredN']);
                    displayDrill("FM01B1N", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM01B1"].$lang['label_alteredN']);
                    displayDrill("FM02A1N", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM02A1"].$lang['label_alteredN']);
                    displayDrill("FM02B1N", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM02B1"].$lang['label_alteredN']);
                    displayDrill("FM02C1N", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM02C1"].$lang['label_alteredN']);
                    displayDrill("FM02D1N", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM02D1"].$lang['label_alteredN']);
                    displayDrill("FM02E1N", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM02E1"].$lang['label_alteredN']);
                    displayDrill("FM02F1N", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM02F1"].$lang['label_alteredN']);
                    displayDrill("FM03A1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03A1"].$lang['label_alteredD']);
                    displayDrill("FM03A1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03A1"].$lang['label_alteredB']);
                    displayDrill("FM03A1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03A1"].$lang['label_alteredA']);
                    displayDrill("FM03B1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03B1"].$lang['label_alteredD']);
                    displayDrill("FM03B1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03B1"].$lang['label_alteredB']);
                    displayDrill("FM03B1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03B1"].$lang['label_alteredA']);
                    displayDrill("FM03C1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03C1"].$lang['label_alteredD']);
                    displayDrill("FM03C1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03C1"].$lang['label_alteredB']);
                    displayDrill("FM03C1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03C1"].$lang['label_alteredA']);
                    displayDrill("FM03D1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03D1"].$lang['label_alteredD']);
                    displayDrill("FM03D1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03D1"].$lang['label_alteredB']);
                    displayDrill("FM03D1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03D1"].$lang['label_alteredA']);
                    displayDrill("FM03E1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03E1"].$lang['label_alteredD']);
                    displayDrill("FM03E1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03E1"].$lang['label_alteredB']);
                    displayDrill("FM03E1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03E1"].$lang['label_alteredA']);
                    displayDrill("FM03F1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03F1"].$lang['label_alteredD']);
                    displayDrill("FM03F1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03F1"].$lang['label_alteredB']);
                    displayDrill("FM03F1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM03F1"].$lang['label_alteredA']);
                    displayDrill("FM04A1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04A1"].$lang['label_alteredD']);
                    displayDrill("FM04A1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04A1"].$lang['label_alteredB']);
                    displayDrill("FM04A1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04A1"].$lang['label_alteredA']);
                    displayDrill("FM04B1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04B1"].$lang['label_alteredD']);
                    displayDrill("FM04B1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04B1"].$lang['label_alteredB']);
                    displayDrill("FM04B1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04B1"].$lang['label_alteredA']);
                    displayDrill("FM04C1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04C1"].$lang['label_alteredD']);
                    displayDrill("FM04C1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04C1"].$lang['label_alteredB']);
                    displayDrill("FM04C1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04C1"].$lang['label_alteredA']);
                    displayDrill("FM04D1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04D1"].$lang['label_alteredD']);
                    displayDrill("FM04D1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04D1"].$lang['label_alteredB']);
                    displayDrill("FM04D1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04D1"].$lang['label_alteredA']);
                    displayDrill("FM04E1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04E1"].$lang['label_alteredD']);
                    displayDrill("FM04E1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04E1"].$lang['label_alteredB']);
                    displayDrill("FM04E1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04E1"].$lang['label_alteredA']);
                    displayDrill("FM04F1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04F1"].$lang['label_alteredD']);
                    displayDrill("FM04F1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04F1"].$lang['label_alteredB']);
                    displayDrill("FM04F1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM04F1"].$lang['label_alteredA']);
                    displayDrill("FM05A1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05A1"].$lang['label_alteredD']);
                    displayDrill("FM05A1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05A1"].$lang['label_alteredB']);
                    displayDrill("FM05A1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05A1"].$lang['label_alteredA']);
                    displayDrill("FM05B1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05B1"].$lang['label_alteredD']);
                    displayDrill("FM05B1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05B1"].$lang['label_alteredB']);
                    displayDrill("FM05B1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05B1"].$lang['label_alteredA']);
                    displayDrill("FM05C1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05C1"].$lang['label_alteredD']);
                    displayDrill("FM05C1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05C1"].$lang['label_alteredB']);
                    displayDrill("FM05C1A", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM05C1"].$lang['label_alteredA']);
                    displayDrill("FM06A1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM06A1"].$lang['label_alteredD']);
                    displayDrill("FM06A1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM06A1"].$lang['label_alteredB']);
                    displayDrill("FM06B1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM06B1"].$lang['label_alteredD']);
                    displayDrill("FM06B1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM06B1"].$lang['label_alteredB']);
                    displayDrill("FM06C1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM06C1"].$lang['label_alteredD']);
                    displayDrill("FM06C1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM06C1"].$lang['label_alteredB']);
                    displayDrill("FM06D1D", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM06D1"].$lang['label_alteredD']);
                    displayDrill("FM06D1B", $SrsDrillTab, true, $numberOfdrillDisplayed, $lang["label_FM06D1"].$lang['label_alteredB']); 
                    ?>
                    <p></p>
                    <?php 
                    $reste = $numberOfdrillDisplayed-3;
                    if($reste > 0) {
                    ?><p></p><span class="other"><?php
                        //echo "et ".$reste." autre(s)..."; 
                        printf($lang['others'], $reste);
                    ?></span><?php
                    }
                    ?>
                    <?php 


                    if($numberOfdrillDisplayed == 0) 
                    {
                    ?>
                    <p></p><span class="other"><?php echo($lang['noUnits']); ?></span><br/>
                    <span class="other"><?php echo($lang['startNewUnits']); ?></span>
                    <?php
                    }
                    else
                    {
                    ?>
                    <script>
                        var displ = <?php echo $numberOfdrillDisplayed; ?>;
                        $('title')[0].innerHTML= "("+displ+") "+$('title')[0].innerHTML;//displ = 27;


                        $('.notifNumber')[0].innerHTML= displ;
                        if(displ > 9) {
                            $('.notifNumber').css('top','-25px')
                            $('.notifNumber').css('left','2px')
                            $('.notifNumber').css('font-size','9px')

                        }
                        if(displ > 0) {
                            $('.circleNotifNumber').removeClass('isInvisible');	
                        }

                    </script>
                    <?php 
                    } 
                    ?>
                </div>



            </div>
        </div>

        <!-- <div class="title">Progresser</div> -->
        <!--BLOC PRINCIPAL DES EXERCICES -->

        <div class="main-block" style="margin-top: 45px;">
            <div class="titleUnit" style="position: absolute;top: -40px;">
                <div class="circleContainer">
                    <div class="circleBlue"></div>
                    <img alt="School" src="images/school.png" class="circleImg" />
                </div>
                <h3><?php echo($lang['fretXUnits']); ?></h3><p/>
            </div>

            <div class="card" id="cardModule1" style="background-color: #29A9E6;">
                <div class="block-content">
                    <div class="title"><?php echo $lang['label_FM01M']; ?></div>
                    <h3><?php echo $lang['label_FM01']; ?></h3>
                    <img alt="More" src="images/ic_close_white_24px.svg" class="moreVert" onclick="$('#cardModule1').hide();" />
                    <hr/>
                    <div class="instructions">
                        <?php echo $lang['label_FM01M_guide']; ?>

                    </div>
                </div>
            </div>

            <div class="block-content module1">
                <div class="title"><?php echo $lang['label_FM01M']; ?></div>
                <h3><?php echo $lang['label_FM01']; ?></h3>



                <img alt="More" src="images/ic_more_vert_black_24px.svg" class="moreVert" onclick="$('#cardModule1').show();"/>

                <hr/>
                <!--<div class="subtitle">[icone fxm] Unités FretXMaster</div><p></p>-->
                <div class="drill-group">
                    <?php displayDrill("FM01A1N", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM01A1"].$lang['label_alteredN']); ?>
                    <?php displayDrill("FM01B1N", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM01B1"].$lang['label_alteredN']); ?><p></p>


                </div>
            </div>
        </div>

        <div class="main-block">


            <div class="card" id="cardModule2" style="background-color: #b71c1c;">
                <div class="block-content">
                    <div class="title">
                        <?php echo $lang['label_FM02M']; ?>
                    </div>
                    <h3><?php echo $lang['label_FM02']; ?></h3>
                    <img alt="More" src="images/ic_close_white_24px.svg" class="moreVert" onclick="$('#cardModule2').hide();" />
                    <hr/>
                    <div class="instructions">
                        <?php echo $lang['label_FM02M_guide']; ?>
                    </div>
                </div>
            </div>



            <div class="block-content module2">

                <div class="title">
                    <?php echo $lang['label_FM02M']; ?>
                </div>
                <h3><?php echo $lang['label_FM02']; ?></h3>
                <img alt="More" src="images/ic_more_vert_black_24px.svg" class="moreVert"  onclick="$('#cardModule2').show();" />
                <hr/>
                <div class="drill-group">


                    <?php displayDrill("FM02A1N", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM02A1"].$lang['label_alteredN']); ?>
                    <?php displayDrill("FM02B1N", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM02B1"].$lang['label_alteredN']); ?><p></p>
                    <?php displayDrill("FM02C1N", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM02C1"].$lang['label_alteredN']); ?>
                    <?php displayDrill("FM02D1N", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM02D1"].$lang['label_alteredN']); ?><p></p>
                    <?php displayDrill("FM02E1N", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM02E1"].$lang['label_alteredN']); ?>
                    <?php displayDrill("FM02F1N", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM02F1"].$lang['label_alteredN']); ?><p></p><p></p>			
                </div>
            </div>
        </div>
        <div class="main-block">



            <div class="card" id="cardModule3" style="background-color: #00897B;">
                <div class="block-content">
                    <div class="title">
                        <?php echo $lang['label_FM03M']; ?>
                    </div>
                    <h3><?php echo $lang['label_FM03']; ?></h3>
                    <img alt="More" src="images/ic_close_white_24px.svg" class="moreVert" onclick="$('#cardModule3').hide();" />
                    <hr/>
                    <div class="instructions">
                        <?php echo $lang['label_FM03M_guide']; ?>
                    </div>
                </div>
            </div>



            <div class="block-content module3">
                <div class="title">
                    <?php echo $lang['label_FM03M']; ?>
                </div>
                <h3><?php echo $lang['label_FM03']; ?></h3>
                <img alt="More" src="images/ic_more_vert_black_24px.svg" class="moreVert"  onclick="$('#cardModule3').show();" />
                <hr/>
                <div class="drill-group">


                    <?php displayDrill("FM03A1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03A1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM03A1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03A1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM03A1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03A1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM03B1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03B1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM03B1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03B1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM03B1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03B1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM03C1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03C1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM03C1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03C1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM03C1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03C1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM03D1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03D1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM03D1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03D1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM03D1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03D1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM03E1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03E1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM03E1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03E1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM03E1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03E1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM03F1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03F1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM03F1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03F1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM03F1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM03F1"].$lang['label_alteredA']); ?><p></p><p></p>			</div>
            </div>
        </div>
        <div class="main-block">




            <div class="card" id="cardModule4" style="background-color: #0473A9;">
                <div class="block-content">
                    <div class="title">
                        <?php echo $lang['label_FM04M']; ?>
                    </div>
                    <h3><?php echo $lang['label_FM04']; ?></h3>
                    <img alt="More" src="images/ic_close_white_24px.svg" class="moreVert" onclick="$('#cardModule4').hide();" />
                    <hr/>
                    <div class="instructions">
                        <?php echo $lang['label_FM04M_guide']; ?>
                    </div>
                </div>
            </div>






            <div class="block-content module4">
                <div class="title">
                    <?php echo $lang['label_FM04M']; ?>
                </div>
                <h3><?php echo $lang['label_FM04']; ?></h3>
                <img alt="More" src="images/ic_more_vert_black_24px.svg" class="moreVert"  onclick="$('#cardModule4').show();" />
                <hr/>
                <div class="drill-group">


                    <?php displayDrill("FM04A1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04A1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM04A1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04A1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM04A1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04A1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM04B1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04B1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM04B1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04B1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM04B1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04B1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM04C1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04C1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM04C1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04C1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM04C1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04C1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM04D1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04D1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM04D1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04D1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM04D1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04D1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM04E1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04E1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM04E1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04E1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM04E1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04E1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM04F1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04F1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM04F1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04F1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM04F1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM04F1"].$lang['label_alteredA']); ?><p></p><p></p>			</div>
            </div>
        </div>
        <div class="main-block">





            <div class="card" id="cardModule5" style="background-color: #FF9800;">
                <div class="block-content">
                    <div class="title">
                        <?php echo $lang['label_FM05M']; ?>
                    </div>
                    <h3><?php echo $lang['label_FM05']; ?></h3>
                    <img alt="More" src="images/ic_close_white_24px.svg" class="moreVert" onclick="$('#cardModule5').hide();" />
                    <hr/>
                    <div class="instructions">
                        <?php echo $lang['label_FM05M_guide']; ?>
                    </div>
                </div>
            </div>




            <div class="block-content module5">
                <div class="title">
                    <?php echo $lang['label_FM05M']; ?>
                </div>
                <h3><?php echo $lang['label_FM05']; ?></h3>
                <img alt="More" src="images/ic_more_vert_black_24px.svg" class="moreVert" onclick="$('#cardModule5').show();" />
                <hr/>
                <div class="drill-group">


                    <?php displayDrill("FM05A1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05A1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM05A1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05A1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM05A1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05A1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM05B1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05B1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM05B1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05B1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM05B1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05B1"].$lang['label_alteredA']); ?><p></p>
                    <?php displayDrill("FM05C1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05C1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM05C1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05C1"].$lang['label_alteredB']); ?>
                    <?php displayDrill("FM05C1A", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM05C1"].$lang['label_alteredA']); ?><p></p><p></p>				</div>
            </div>
        </div>
        <div class="main-block">


            <div class="card" id="cardModule6" style="background-color: #F3AFA5;">
                <div class="block-content">
                    <div class="title">
                        <?php echo $lang['label_FM06M']; ?>
                    </div>
                    <h3><?php echo $lang['label_FM06']; ?></h3>
                    <img alt="More" src="images/ic_close_white_24px.svg" class="moreVert" onclick="$('#cardModule6').hide();" />
                    <hr/>
                    <div class="instructions">
                        <?php echo $lang['label_FM06M_guide']; ?>
                    </div>
                </div>
            </div>



            <div class="block-content module6">
                <div class="title">
                    <?php echo $lang['label_FM06M']; ?>
                </div>
                <h3><?php echo $lang['label_FM06']; ?></h3>
                <img alt="More" src="images/ic_more_vert_black_24px.svg" class="moreVert"  onclick="$('#cardModule6').show();" />
                <hr/>
                <div class="drill-group">
                    <?php displayDrill("FM06A1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM06A1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM06A1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM06A1"].$lang['label_alteredB']); ?><p></p>
                    <?php displayDrill("FM06B1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM06B1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM06B1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM06B1"].$lang['label_alteredB']); ?><p></p>
                    <?php displayDrill("FM06C1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM06C1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM06C1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM06C1"].$lang['label_alteredB']); ?><p></p>
                    <?php displayDrill("FM06D1D", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM06D1"].$lang['label_alteredD']); ?>
                    <?php displayDrill("FM06D1B", $SrsDrillTab, false, $numberOfdrillDisplayed, $lang["label_FM06D1"].$lang['label_alteredB']); ?>
                </div>
            </div>
            <p>&nbsp;</p>

        </div>		


        <div class="main-block">
            <div class="block-content">

                

<div style="clear:left" class="footerMenu" >
  <span class="footerText"><a href="fxm.php?page=dashboard">FretXMaster <?php echo date("Y"); ?></a></span>&nbsp;&nbsp;&nbsp;
  <span class="footerText"><a href="fxm.php?page=conditions"><?php echo($lang['conditions']); ?></a></span>&nbsp;&nbsp;&nbsp;
  <span class="footerText"><a href="fxm.php?page=contacts"><?php echo($lang['contacts']); ?></a></span>
</div>
            </div>






        </div>

    </div>





</div>
<div class="footer hint"></div>
<?php 
include("modalFrame_Start.php"); 
include("modalFrame_Wizard.php"); 
?>