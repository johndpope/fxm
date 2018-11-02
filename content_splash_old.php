<div class="splash">

  <div id="snap">
    <div id="headSnap" class="headSnap"><?php echo $lang['splashHead_UTM'.$utm]; ?></div>
    <!--<div id="subSnap" class="subSnap">Apprenez et maîtrisez les notes de la guitare en vous amusant. <br/>Devenez à l'aise en toutes circonstances de jeu.</div>-->

    <?php if($language == 'zz') { ?>
      <img src="images/fr/visuelsScreens.png" style="width:70%;max-width:600px; ">
      <?php 
    }else
    { 
      ?>

      <div id="subSnap" class="subSnap"><?php echo $lang['splashSubHead_UTM'.$utm]; ?></div>
      <?php } ?> 
    </div>
    <div id="globalSignupZone" class="globalSignupZone">
      <div id="loginZone" class="loginZone splashEnterZone">
        <h3 class="loginTitle" id="loginTitle"><?php echo $lang['splashConnect']; ?></h3>
        <form>
          <input  class="loginFields" id="user-email" name="user-email" type="email" placeholder="<?php echo($lang['email']); ?>">  
          <input  class="loginFields" id="user-pw" name="user-pw" type="password" placeholder="<?php echo($lang['password']); ?>"><br/>           
          <div class="greenButton loginButton" name="submit_login" id="submit_login" type="submit"><?php echo($lang['login']); ?></div>
        </form>
      </div>    

      <div id="forgotPassZone" class="forgotPassZone splashEnterZone">
        <h3 class="loginTitle" id="loginTitle"><?php echo $lang['splashReinit']; ?></h3>
        <form>
          <input  class="loginFields" id="user-email-forgotPass" name="user-email-forgotPass" type="email" placeholder="<?php echo($lang['email']); ?>">  
          <div class="greenButton loginButton" name="submit_forgotPass" id="submit_forgotPass" type="submit"><?php echo $lang['splashSendMeReinit']; ?></div>
        </form>
      </div>

      <div id="reinitPassZone" class="reinitPassZone splashEnterZone">
        <h3 class="loginTitle" id="loginTitle"><?php echo $lang['splashReinitPass']; ?></h3>
        <form>
          <input  class="loginFields" id="user-email-reinitPass-1" name="user-email-reinitPass-1" type="password" placeholder="<?php echo($lang['createPassword']); ?>">  
          <input  class="loginFields" id="user-email-reinitPass-2" name="user-email-reinitPass-2" type="password" placeholder="<?php echo($lang['confirmPass']); ?>"> 
          <input type="hidden" id="requestkey" name="requestkey" value="<?php echo $requestkey ?>"> 
          <div class="greenButton loginButton" name="submit_reinitPass" id="submit_reinitPass" type="submit"><?php echo $lang['splashReinitPass']; ?></div>
        </form>
      </div>

      <div id="signupZone" class="signupZone splashEnterZone">
        <h3 class="loginTitle" id="loginTitle"><?php echo $lang['splashJoin']; ?> <span class="qwiTitleMini">Fret</span><span class="boyTitleMini">X</span><span class="bebTitleMini">Master</span></h3>
        <form>
         <input class="loginFields" id="user-email-signup" name="user-email-signup" type="email" placeholder="<?php echo($lang['email']); ?>">
         <input  class="loginFields" id="user-pw-signup" name="user-pw" type="password" placeholder="<?php echo($lang['createPassword1']); ?>"><br/>           
         <!--<input  class="loginFields" id="user-pw2-signup" name="user-pw" type="password" placeholder="Confirmer le mot de passe"><br/>  -->
         <div class="greenButton loginButton" name="submit_signup" id="submit_signup" type="submit">
          <?php echo($lang['getStarted']); ?></div>       
        </form>
      </div>

      <hr style="margin-top:10px;margin-bottom:10px"/>
      <!-- <span class="loginTitle">ou</span> -->


      <div scope="public_profile,email" onlogin="checkLoginState();" class="fb-login-button" data-max-rows="1" data-size="large" data-width="270" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"
      style="background: #3b5998;width: 270px;height: 42px;margin: auto;"
      ></div>


      <div class="loginContainer"></div>

      <div id="my-signin2"><span class="buttonText">-</span></div>
      <br/>


      <span class="loginZone splashEnterZone">
       <a class="hint loginTitle"  onclick="zoneToDisplay('forgotPassZone');" href="#"><?php echo($lang['forgotmypassword']);?></a>  <br/>
       <a class="hint loginTitle" onclick="zoneToDisplay('signupZone');" href="#"><?php echo($lang['notYetMember']);?><?php echo($lang['signupYou']);?></a>
     </span>

     <span class="signupZone splashEnterZone">
       <a class="hint loginTitle" onclick="zoneToDisplay('loginZone');" href="#"><?php echo $lang['splashAlreadymember']; ?></a>  

     </span>   

     <span class="forgotPassZone splashEnterZone">
       <a class="hint loginTitle" onclick="zoneToDisplay('loginZone');" href="#"><?php echo $lang['splashConnect']; ?></a>  

     </span>
   </div>
   <script>
    setSpashElements();
  </script>

</div>
<a href="#" id="titi"><img class="down-arrow" src="images/leftarrow.png" /></a>
<!--<a href="#" onclick="$('#toto').addClass('fadeOutLeft').delay(500);$(window).scrollTop($('#firstSection').offset().top - 66);"><img class="down-arrow" src="images/leftarrow.png" /></a>-->

<section class="pair" id="firstSection"> 

  <div class="splashSnap pair"><?php echo $lang['splashHead01']; ?></div>  

  <div class="splashBlock">
    <img src="images/guitarSplash.png"  class="splashImages01" />
    

    <div>


      <p>
        <?php echo $lang['splashHead01_01']; ?>
        <p></p>
        <?php echo $lang['splashHead01_02']; ?>
        <p></p>
        <?php echo $lang['splashHead01_03']; ?>
      </p>

      <p>
        <?php echo $lang['splashHead01_04']; ?>
        <br/>&nbsp;&nbsp; <?php echo $lang['splashHead01_05']; ?>
        <br/>&nbsp;&nbsp; <?php echo $lang['splashHead01_06']; ?>
        <br/>&nbsp;&nbsp; <?php echo $lang['splashHead01_07']; ?>    
        <br/>&nbsp;&nbsp; <?php echo $lang['splashHead01_09']; ?>
      </p>

    </div>
  </div>



  <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');"><?php echo($lang['getStarted']); ?></div> 
  <br/>
</section>

<section class="impair">

  <div class="splashSnap impair"><?php echo $lang['splashHead02']; ?></div>
  <div class="splashBlock">
    <img src="images/brain1.png"  class="splashImages01" />
    <div>
      <?php echo $lang['splashHead02_02']; ?>
      <p></p>
      <?php echo $lang['splashHead02_01']; ?>
      <p></p>
      <?php echo $lang['splashHead02_03']; ?>
      <p></p>
      <?php echo $lang['splashHead02_04']; ?>
      <p></p>
      <?php echo $lang['splashHead02_05']; ?>     
    </div> 



    <p></p>
    <div>


    </div>
  </div>


  <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');"><?php echo($lang['getStarted']); ?></div> 
  <br/>
</section>

<section class="pair" id="unitSection">

  <div class="splashSnap pair"><?php echo $lang['splashHead03']; ?></div>
  <div class="splashBlock">

    <img src="images/pointsSplash.png"  class="splashImages02" />
    <img src="images/points2Splash.png"  class="splashImages02" />
    <img src="images/bouleSplash.png"  class="splashImages02" />
    <img src="images/bouleGold.png"  class="splashImages02" />
    <div>
      <p></p>
      <?php echo $lang['splashHead03_01']; ?>
      <p></p>
      <?php echo $lang['splashHead03_02']; ?>
      <p></p>
      <?php echo $lang['splashHead03_03']; ?>
      <p></p>
      <?php echo $lang['splashHead03_04']; ?>
    </div> 

  </div>

  <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');"><?php echo($lang['getStarted']); ?></div> 
  <br/>

</section>

<section class="impair">

  <div class="splashSnap impair"><?php echo $lang['splashHead04']; ?></div>
  <div class="splashBlock">
    <img src="images/micSplash.png"  class="splashImages01" />
    <div>

      <?php echo $lang['splashHead04_01']; ?>
      <p></p>
      <?php echo $lang['splashHead04_02']; ?>
      <p></p>
      <?php echo $lang['splashHead04_03']; ?>

      
      <p></p>&nbsp;

      <p></p>&nbsp;

    </div> 



    <p></p>
    <div>


    </div>
  </div>


  <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');"><?php echo($lang['getStarted']); ?></div> 
  <br/>

  <div style="width:100%;text-align:center;">
    <div class="fb-page" data-href="https://www.facebook.com/MusicianBooster/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/MusicianBooster/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MusicianBooster/">MusicianBooster</a></blockquote></div>
  </div>
  <p>&nbsp;</p>
</section>


