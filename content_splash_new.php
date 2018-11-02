    <link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>/splash.css?ver=<?php echo $versionCSS; ?>">

<div class="splash">

  <div id="snap">
    <div id="headSnap" class="headSnap"><?php echo $lang['splashHead_UTM'.$utm]; ?></div>
    <!--<div id="subSnap" class="subSnap">Apprenez et maîtrisez les notes de la guitare en vous amusant. <br/>Devenez à l'aise en toutes circonstances de jeu.</div>-->

    <div id="subSnap" class="subSnap"><?php echo $lang['splashSubHead_UTM'.$utm]; ?></div>

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
       S'inscrire</div>       
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




<section id="firstSection">
  <div class="container">
    <div class="col-3 text--center">
      <img src="images/mockupGuitar-opt.jpg" alt="" class=""/>
    </div>
    <div class="col-7 details splashBlock">
      <h3>La maîtrise du manche en quelques minutes par jour </h3>
      <p>
        L'objectif de FretXMaster est de vous faire connaître et <strong>maîtriser les notes de la guitare</strong>.<br/>
        FretXMaster est une <strong>formation complète</strong> qui vous guidera pas à pas vers la parfaite maîtrise du manche de guitare. <br/>
        Elle est basé sur la méthode de la <strong>répétition espacée</strong>, qui vous guide chaque jour en vous indiquant quoi travailler en fonction de vos résultats passés.<br/>
        Maîtriser les notes du manche est un <strong>point de départ indispensable</strong> pour : <br/>
        <div class="container splashBlock">
          <div class="col-3 features ">
            <!-- <i class="fa fa-bolt">1</i> -->
            <img src="images/icoSplash01Chord.png" alt="" class="details-img--ball"/>
            <p>
              Avoir une pleine compréhension des concepts élémentaires de la guitare : accords, gammes...
            </p>
          </div>
          <div class="col-3 features">
            <!-- <i class="fa fa-bank">2</i> -->
            <img src="images/icoSplash02Imp.png" alt="" class="details-img--ball"/>
            <p>
              Avoir plus d'assurance en improvisation
            </p>
          </div>
          <div class="col-3 features">
            <!-- <i class="fa fa-heart">3</i> -->
            <img src="images/icoSplash03Sheet.png" alt="" class="details-img--ball"/>
            <p>
              Savoir déchiffrer de vraies partitions
            </p>
          </div>
        </div>



      </p>
    </div>
  </div>
  <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');">S'inscrire</div> 

</section>

<section class="section--primary--alt impair2">
  <div class="splashBlock container">
    <h3>Pourquoi connaître les notes du manche ?</h3>
    <p>
      Lorsqu'on est autodidacte, on ne se rend pas toujours compte de <strong>l'importance de connaitre les notes de manche</strong>. Ce n'est que lorsqu'on les maîtrise qu'on réalise leur utilité.<p/>
      Vouloir devenir un très bon guitariste sans maîtriser les notes du manche est un peu comme tenter de devenir écrivain sans connaitre l'alphabet. <br/>
      <strong>On ne peut pas réellement appliquer la théorie musicale sans avoir une maîtrise complète des notes de la guitare</strong>.<br/>
      Généralement, les guitaristes amateurs apprennent les gammes et les accords comme <strong>de simples formes géométriques</strong> et cela empêche de prendre une vraie liberté sur son jeu, il n'est pas possible de comprendre comment toutes les notions s'imbriquent ensemble. 

    </p>
  </div>
  <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');">S'inscrire</div> 

</section>



<section class="section--primary--alt">
  <div class="splashBlock container">
    <h3>Pourquoi est-ce difficile de maîtriser les notes du manche ?</h3>
    <p>

     <p/>
     Apprendre les notes du manche n'est pas ce qu'il y a de plus exaltant dans la pratique de la guitare et <strong>il n'existe pas vraiment de moyen simple de les maîtriser</strong>.
     Lorsqu'on commence à apprendre les notes du manche, on ne sait pas tout de suite s'en servir dans un contexte musical et on finit par oublier ce que l'on a appris. <br/>C'est très frustrant.<p/>
     Assimiler cette connaissance suffisamment bien pour pouvoir l'utiliser dans un vrai contexte musical <strong>prend du temps</strong>.<br/>
     Les notes sont très nombreuses et se ressemblent toutes, ce n'est pas comme le piano sur lequel la théorie musicale est plus évidente (les blanches sont les notes naturelles de la gamme de Do majeure, et les noires sont ses altérations).<p/>
     Il est très difficile de <strong>rester motivé</strong> seul dans cet apprentissage sur le long terme.<br/>
     Il est aussi très difficile d'organiser cet apprentissage: dans quel ordre apprendre le manche&nbsp;? À quel rythme&nbsp;?<br/>


   </p>
 </div>
 <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');">S'inscrire</div> 

</section>

<section class="section--primary--alt impair">
  <div class="splashBlock container">
    <h3>FretXMaster, guide pas à pas vers la maîtrise du manche</h3>
    <p>
     FretXMaster une solution amusante pour <strong>rester motivé</strong> dans l'apprentissage du manche:<p/>
     FretXMaster est comme un jeu dans lequel chaque unité est déclinée en <strong>deux phases</strong>.<br/>
     <div class="col-3 text--center"><img src="images/screen1.png" alt="" class=""/></div>
     <div class="col-7 text--center">Lors de la première phase, retrouvez la note affichée sur le manche en la jouant sur le clavier</div>
     <p/>
     <div class="col-3 text--center"><img src="images/screen2.png" alt="" class=""/></div>
     <div class="col-7 text--center">Lors de la deuxième phase, retrouvez la note affichée sur la partition en la jouant sur votre guitare. Si vous souhaitez vous entraîner sans votre guitare en main, vous pouvez choisir de vous auto-évaluer à chaque unité</div>
     <p/>
     <strong>FretXMaster est efficace</strong>
     <p/>
     FretXMaster est basé sur le système de <strong>répétition espacée</strong>: plus une unité est maîtrisée, plus les révisions s'espacent dans le temps. Il ancre l'apprentissage dans la <strong>mémoire à long-terme</strong>.
     Il sera votre coach personnalisé, capable de vous dire chaque jour quelles unités revoir, au bon moment, en se basant sur vos résultats passés.
     <p/>
     FretXMaster vous accompagne jusqu'à la <strong>maîtrise totale des notes du manche</strong>. Sans prise de tête, inutile de réfléchir à la manière ou au rythme avec lequel vous apprendrez. 
   </p>
 </div>
 <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');">S'inscrire</div> 

</section>
<!--
<section class="section--primary--light">
  <div class="splashBlock container">
    <blockquote class="testimonial">
      <p>La méthode marche très bien, c'est devenu beaucoup plus facile de trouver les notes pendant une impro, relever un thème est beaucoup plus simple.</p>
      <cite>
        Ulrich, utilisateur
      </cite>
    </blockquote>
  </div>
</section>
-->


<section class="section--primary--alt">
  <div class="splashBlock container">
    <h3>FretXMaster est-il fait pour moi ?</h3>
    <p>
      FretXMaster est fait pour ceux qui prennent l'apprentissage de la guitare au sérieux.
      <p/>
      Car le mieux est d'utiliser FretXMaster <strong>un peu chaque jour</strong>, même pour quelques minutes (une ou deux sessions par jour est déjà suffisant).<br/>
      En <strong>quelques jours</strong>, vous aurez déjà les <strong>premiers bénéfices de l'apprentissage</strong>, et saurez mieux vous y retrouver sur le manche et commencerez à avoir vos repères.<br/>
      La maîtrise vient sur le long terme, avec un entrainement régulier. <br/>
      <strong>En quelques mois, la connaissance des notes du manche sera complètement naturelle et sera entièrement intégrée dans votre jeu, vous ne verrez plus le manche de la même façon</strong>.<br/>
      En se focalisant sur vos points faibles, FretXMaster s'assure que le manche est parfaitement maîtrisé.
      
    </p>
  </div>
  <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');">S'inscrire</div> 

</section>



<section class="section--primary--mockup">
  <div class="container splashBlock">
   <h3>Ce que vous réserve FretXMaster</h3><br/>
   <div class="col-3 features ">
    <!-- <i class="fa fa-bolt">1</i> -->
    <div class="dotContainer"><img src="images/n1.png" /></div>

    <p>
      <strong>Le premier module, initiation</strong><br/>
    Le premier module commence doucement avec les cordes à vides. En général, elles sont bien connues mais une révision s'impose! C'est aussi un premier contact avec la notation musicale (lecture de partitions).        </p>
  </div>
  <div class="col-3 features">
    <div class="dotContainer"><img src="images/n2.png" /></div>
    <p>
      <strong>Deuxième module, les notes naturelles</strong><br/>
      Dans le 2e module, les cordes sont étudiées une par une.
      Nous nous concentrons sur les 7 notes dites "naturelles" (sans dièse, ni bémol).
      Ces notes sont cruciales car elles resteront des références pour naviguer sur le manche.
      On démarre ici l'apprentissage de la visualisation horizontale du manche.
    </p>
  </div>
  <div class="col-3 features">
    <div class="dotContainer"><img src="images/n3.png" /></div>
    <p>
     <strong>Troisième module, les altérations</strong><br/>
     Prolongement du 2e module, on y complète l'apprentissage de la visualisation horizontale en y ajoutant les notes altérées (dièses et bémols).
     À la fin de ce module vous serez à l'aise sur l'ensemble du manche, quel que soit le type de note.
   Vous serez également capable de déchiffrer des partitions simples.</p>
 </div>
</div>
<div class="container splashBlock">
  <div class="col-3 features">
    <div class="dotContainer"><img src="images/n4.png" /></div>
    <p>
     <strong>Quatrième module, la visualisation verticale</strong><br/>
     C'est la complémentarité des 2 types de visualisation qui vous mènera vers la maîtrise du manche.
     On apprendra ici les frettes par groupe de 2 pour faciliter l'intégration du manche.
   Au fil des unités, le manche se construira dans votre esprit comme un puzzle.  </p>
 </div>
 <div class="col-3 features">
  <div class="dotContainer"><img src="images/n5.png" /></div>
  <p>
   <strong>Cinquième module</strong><br/>
   Dans la continuité du 4e module, on termine l'apprentissage de la visualisation verticale en groupant les frettes par 4.
   Peu à peu, le manche devient comme un tout et la visualisation du manche devient globale.
   La connaissance des notes deviendra naturelle et vous n'aurez même plus à réfléchir.
   Votre lecture des partitions devient de plus en plus rapide et précise.
 </p>
</div>
<div class="col-3 features">
  <div class="dotContainer"><img src="images/n6.png" />

  </div>
  <p>
   <strong>Sixième et dernier module</strong><br/>
   Le but du dernier module est d'assembler toutes les pièces du puzzle.
   Il s'agit d'enchaînements spécifiques, sans cohérence musicale, qui mettront à l'épreuve votre visualisation globale du manche.   
 La réussite de ces enchaînements sur le long terme et à haute vitesse signera votre maîtrise totale et définitive du manche.</p>
</div>
</div>
<div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');">S'inscrire</div> 

</section>

<section class="section--primary--light">
  <div class="splashBlock container">
    <blockquote class="testimonial">
      <p>La méthode marche très bien, c'est devenu beaucoup plus facile de trouver les notes pendant une impro, relever un thème est beaucoup plus simple.</p>
      <!--<cite>
        Ulrich, utilisateur
      </cite>-->
    </blockquote>
  </div>
</section>

<section class="section--primary--alt">
  <div class="splashBlock container">
    <h3>Inscription et abonnement</h3>
    <p>

      Après l'inscription, vous aurez accès au 1er module et à une partie du 2e module, ce qui bien suffisant pour appréhender l'outil et comprendre comment il fonctionne.<br/>
      Vous pourrez ensuite choisir de vous abonner pour une période de 6 mois ou 1 an.<p/>

      Il ne faudra pas attendre un an avant de ressentir les bénéfices de FretXMaster. Après quelques jours, vous ne verrez déjà plus le manche de la même façon. <br/>
      L'apprentissage est réellement progressif et on peut vraiment arriver à une haute maîtrise du manche sans y passer 3h par jour. 
      Vous pouvez très bien décider de ne faire qu'une seule session chaque jour. Ce qui ne peut ne vous prendre que 2mn !<br/>
      <strong>FretXMaster suivra quand même vos progrès et saura toujours guider votre apprentissage</strong><p/>
      En vous abonnant, vous soutenez une <strong>initiative indépendante</strong>. MusicianBooster est une (très) petite entreprise française indépendante, guidée par la passion de la musique. <br/>
      Nous sommes basés à <strong>Lille</strong> dans le nord de la France. N’hésitez pas à nous poser toutes vos questions et remarques, nous adorons échanger avec d'autres musiciens passionnés.
      
    </p>
  </div>
  <div class="greenButton loginButton" onclick="zoneToDisplay('signupZone');">S'inscrire</div> 
  <div style="width:100%;text-align:center;">
    <div class="fb-page" data-href="https://www.facebook.com/MusicianBooster/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/MusicianBooster/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MusicianBooster/">MusicianBooster</a></blockquote></div>
  </div>
  <p>&nbsp;</p>
</section>
