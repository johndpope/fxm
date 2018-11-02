<?php
$title = $lang['mysubscriptions'];
include("php/pricing.php"); 
include("php/drillTools.php"); 

require_once('stripe-php-3.4.0/init.php');	
if(!$connected)
{
	header( 'Location: fxm.php?page=login' );
	die();
}

$allowedToSubscribe = false;
$nextSubscriptionDate = getClientCurrentDate();	
if(!$hasSubscribed) 
{
	$allowedToSubscribe = true;
}
else
{
	$nextSubscriptionDate = allowedToSubscribe($validSubscription);
	if($nextSubscriptionDate != null) $allowedToSubscribe = true;		
}

if(!$allowedToSubscribe) {
	$messInfo = $lang["impossibleToSubscribe"];
}



?>




<script>
	window.onresize = priceTable_resize;
	var allowedToSubscribe = <?php if($allowedToSubscribe) echo("true");
	else echo("false");?>;
	
	function priceTable_resize()
	{
		var max = document.getElementById('details1').clientHeight;
		if(document.getElementById('details6').clientHeight > max) max = document.getElementById('details6').clientHeight;
		if(document.getElementById('details12').clientHeight > max) max = document.getElementById('details12').clientHeight;
		max = max+'px';
		document.getElementById('details1').style.height = max;
		document.getElementById('details6').style.height = max;
		document.getElementById('details12').style.height = max;
		
		
		
	}
	
	function displayOfferButton(offer)
	{
		//alert(allowedToSubscribe);
		if(allowedToSubscribe == false)		
		{
			window.scrollTo(0,1);
			if(document.getElementById("buttonPrice1")) document.getElementById("buttonPrice1").style.display="none";
			if(document.getElementById("buttonPrice6")) document.getElementById("buttonPrice6").style.display="none";
			if(document.getElementById("buttonPrice12")) document.getElementById("buttonPrice12").style.display="none";
		}
		else
		{
			
			
			
			if(offer == "1")
			{
				if(document.getElementById("buttonPrice1")) document.getElementById("buttonPrice1").style.display="block";
				if(document.getElementById("buttonPrice6")) document.getElementById("buttonPrice6").style.display="none";
				if(document.getElementById("buttonPrice12")) document.getElementById("buttonPrice12").style.display="none";
				var myElements = document.querySelectorAll(".stripe-button-el span	"); 
				for (var i = 0; i < myElements.length; i++) {
					myElements[i].style.background = '#4897CC';
				}
			}
			if(offer == "6")
			{
				if(document.getElementById("buttonPrice1")) document.getElementById("buttonPrice1").style.display="none";
				if(document.getElementById("buttonPrice6")) document.getElementById("buttonPrice6").style.display="block";
				if(document.getElementById("buttonPrice12")) document.getElementById("buttonPrice12").style.display="none";
				var myElements = document.querySelectorAll(".stripe-button-el span	"); 
				for (var i = 0; i < myElements.length; i++) {
					myElements[i].style.background = '#2F9F9E';
				}
			}
			if(offer == "12")
			{
				if(document.getElementById("buttonPrice1")) document.getElementById("buttonPrice1").style.display="none";
				if(document.getElementById("buttonPrice6")) document.getElementById("buttonPrice6").style.display="none";
				if(document.getElementById("buttonPrice12")) document.getElementById("buttonPrice12").style.display="block";
				var myElements = document.querySelectorAll(".stripe-button-el span	"); 
				for (var i = 0; i < myElements.length; i++) {
					myElements[i].style.background = '#9C5D7A';
				}
			}
			
			
			if(document.getElementById("payButton")) document.getElementById("payButton").scrollIntoView();
			window.scrollBy(0, -26);
		}
		
	}
	
	
	
</script>

<div class="content-container">
	<div class="block-container">
		<!--BLOC PRINCIPAL DES EXERCICES -->
		<div class="main-block">
			<div class="block-content">
				<?php
				$prefpage = "subscribe";
				include("content_menu_preferences.php"); 
				?>
				<!--
				<?php echo($lang['joinFM']);?><p></p>
				<p></p>									
				<p class="left">
					<?php echo($lang['argumentaire01']);?>
				</p>
				<p class="left">
					<?php echo($lang['argumentaire02']);?>
				</p>	


				<?php echo($lang['chooseOffer']);?>	

			-->

<!--
			<div class="priceTable6">
				<table style="color:#000" class="priceTableInTable" onclick="displayOfferButton('6');">
					<tr><td class="priceType"><?php echo($lang['offer06Title']);?></td></tr>
					<tr><td class="priceTag1 priceTagColorGreen">
						<div class="circle-text"><div><?php echo($pricing['FM06EUR_label']);?><br/><span class="smallTag strike"><?php echo($pricing['FM06EUR_old']);?></span></div></div>

					</td>
				</tr>
				<tr>
					<td class="priceTagDetails" id="details6">
						<br/><i class="fa fa-check greenMark"></i> <?php echo sprintf($lang['FM06arg01'], $pricing['FM06EUR_label']);?>																	
						<br/><i class="fa fa-check greenMark"></i> <?php echo sprintf($lang['FM06arg02'], $pricing['FM06EUR_dailylabel']);?>	
						<br/><i class="fa fa-check greenMark"></i> <?php echo sprintf($lang['FM06arg03'], $pricing['FM06EUR_ecolabel']);?>
						<br/><i class="fa fa-check greenMark"></i> <?php echo($lang['FM06arg04']);?>
					</td>															
				</tr>

				<tr><td class="priceTagColorGreen priceTagBuy"><?php echo($lang['subscribe']);?></td></tr>
			</table>


		</div>	
	-->				
<!--
			<div class="templatemo-content-widget col-1 priceTable12">
				<table style="color:#000" class="priceTableInTable"  onclick="displayOfferButton('12');">
					<tr><td  class="priceType"><?php echo($lang['offer12Title']);?></td></tr>
					<tr><td class="priceTag1 priceTagColorRed">
						<div class="circle-text"><div><?php echo($pricing['FM12EUR_label']);?><br/><span class="smallTag strike"><?php echo($pricing['FM12EUR_old']);?></span></div></div>
					</td></tr>
					<tr>
						<td class="priceTagDetails" id="details12">
							<br/><i class="fa fa-check greenMark"></i> <?php echo sprintf($lang['FM12arg01'], $pricing['FM12EUR_label']);?>																	
							<br/><i class="fa fa-check greenMark"></i> <?php echo sprintf($lang['FM12arg02'], $pricing['FM12EUR_dailylabel']);?>	
							<br/><i class="fa fa-check greenMark"></i> <?php echo sprintf($lang['FM12arg03'], $pricing['FM12EUR_ecolabel']);?>
							<br/><i class="fa fa-check greenMark"></i> <?php echo($lang['FM12arg04']);?>
						</td>															
					</tr>

					<tr><td class="priceTagColorRed priceTagBuy"><?php echo($lang['subscribe']);?></td></tr>
				</table>

			</div>
		-->


		<br/>FretXmaster vous fera connaître et maitriser parfaitement les notes de la guitare.
		<br/>La maitriser les notes de la guitare est bien souvent négligé par les guitaristes autodidactes. Sans s'en rendre compte, ils passent à côté d'un outils essentiel pour progresser. 
		<br/>En suivant le programme FretXMaster


		<br/>=====
		<br/>Vous aurez une pleine compréhension de ce vous êtes en train de jouer: accords, gammes, notes…  
		<br/>Vous serez beaucoup plus à l'aise en improvisation  
		<br/>Vous saurez lire une partition (pas juste une tablature)  
		<br/>Vous boosterez votre motivation 
		<br/>Vous vous sentirez beaucoup plus confiant en jouant et vous serez plus relaxé, ce qui est essentiel pour acquérir un haut niveau dans la pratique d’un instrument.  
		====




		Vous comprendrez mieux la construction des accords
		Et en les comprenant mieux, vous les retiendrez mieux, vous pourrez jouer n’importe quel accord à n’importe quel endroit du manche et vous serez même capables d’en créer vous-même, à la volée.
		Vous comprendrez également bien mieux les gammes, les retiendrez beaucoup plus vite et les utiliserez de manière naturelle, sans réfléchir.
		En maîtrisant les notes, vous ne vous inquiéterez même plus de la justesse des notes que vous jouez. Vous pourrez laisser aller votre créativité et votre inspiration. Vous aurez l’esprit libre pour vous concentrer sur la musique. 

		Maitriser son instrument est libérateur, vous jouerez avec d’autres musiciens sans rougir ni avoir peur de ne pas être à la hauteur.

		Lire une partition, car FXm
		FretXMaster vous permet de vous initier à la lecture sur partition en la combinant à l'apprentissage des notes. Petit à petit, vous vous familiariserez avec cette écriture qui est beaucoup plus simple qu'elle en a l'air.
		Lire une partition est un outil de poids pour communiquer avec d’autres musiciens. C’est souvent cette lacune qui fait passer les guitaristes pour des amateurs, et ne sont pas vraiment considérés comme des musiciens




		Le but de FretXMaster n'est pas juste de vous montrer comment retrouver les notes sur la guitare, il s'agit de les apprendre, les maîtriser, de les intérioriser et de les graver dans votre mémoire à long terme pour que cela devienne complètement naturel.

<br/>PROBLEME:
Autodidactes ne connaissent pas le manche
Passe du temps à trouver le nom d'une note
Connaissance partielle des gammes, accords
Pas au niveau des vrais musiciens
pas de possibilité de communication
Ca s'oublit super vite
Galèrent à apprendre
Chiant à apprendre

<br/>FAUSSES SOLUTIONS
Essayer d'apprendre seul => on oublie, on ne s'y tiens pas
NE pas les apprendre => toujours pas de connaissance

<br/>SOLUTIONS
Ne s'oublie pas grace au SRS
Te dis quand travailler

Mode intéractif
<br/>COUT DE NE PAS AGIR
Reste un petit guitariste de rien qui n'est oas un vrai musicien, avec exmeple du pianiste et tout
<br/>
<br/>


page de vente
1 promesse
	x sans y, formule mysterieuse
	marketing negatif, dire que c pas pour tout le monde (ke pr les gens seriues, ki veulent aller loin)



2 ce que tu veux
(pk)
	pk ils veulent le résultat



3 obstacles
	les pb 
		on sait pas exactement comment progresser
		difficile d'apprendre seul


4 vrai pb : pas x mais y
	la base quon oublie maitriser le manche


5 ce dt vous avez vraiment besoin
	solution fxm



6 résultat
r1 - 
r2 - 
,imoprte quel x peut y - 
limite : pk ca marcherait pas
annulation de la limite
nimporte quel x puet y parce que z
nimportel guitariste peut maitriser tout ca en faisantr jutse ca

7 histoire (optionnel)



8 grande idée
	revenir au bases et se considérer comme un musicien


9 plan (benefice)
	explication des modules et les benefices a chaque fois (horizontal / transversal)
	concept cérébral

	parler des résultat à chauqe fin de module 
	résulatt tangible, la personne simahgine en train de l'utiliser (chq jour tu passer a2mn à utiliser le truc)


10 résultats bis
	répeter résultat finaux
	r1 - 
	r2
	anulaition limite
	niporque lx peu y


11 appel a action: ca ne coute rien
	si mail après inscirption hors fxm (via blog), ne pas montrer touyt de suite qu'il y a un produit à vendre

	parler du ROI, ce que ca fait économiser en temps / argent
	ca coute rien par ceque si t'aime pas tu demande remboursement
	ca teconomisera des heures de cours
	tu apprendra tout plus vite

	(ca ne coute rien => inscription)


12 cout des alternatives
(ne pas agir)
	tu va toujours galérer à comprendre les trucs


13 comment cam rche concrteement
	expliquer comment marche l'application (ne pas parler d'application mais toujours une formaultion liée au résultat)
	se mettre ds le tete de lutillstaeur ,il doit suimaginer lutiliser


14 2 options
=> comme avt
=> expermient qqch de nouvo
	moi jai mis des année a comprendre que ct essentiel, tu peux toi aussi passer des années a le comprendre


15 appel à l'action 2
	comment commander, parler de stripe

16 objections
	raison de pas acheter 
	"meme si" vous etes débutant : x
	"meme si" vous etes pro : x
	"meme si" vous pensez que c pas pr vous : x


17 on commence tout de suite, lien avec le début de la formation
	lien direct pour commencer tout de suite
	initier le process de maniere tangible (tu clique sur la boule, tu choisi ta vitesse)























		<span id="payButton"></span>											
		<form id="buttonPrice1" style="display:block;" action="mysubscriptions.php" method="POST">
											<!--
											<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
											data-key="pk_live_P4bc4xwHrdGDD9AFA9dxueh4"
											data-amount="<?php echo($pricing['FM01EUR_stripelabel']); ?>"
											data-name='FretXMaster'
											data-description="<?php echo sprintf($lang['stripebuttonFM01'], $pricing['FM01EUR_label']);?>"		
											data-image="img/FXM.png"
											data-locale="<?php echo($language); ?>"
											data-currency="EUR"
											data-email="<?php echo($connectedAs); ?>"
											data-label="<?php echo sprintf($lang['stripebuttonFM01'], $pricing['FM01EUR_label']);?>"
											data-panel-label="<?php echo($lang['validatePay']); ?> (<?php echo($pricing['FM01EUR_label'].$lang['permonth']);?>)">		
												
												
											</script>
											<input type="hidden" name="pricing" value="01">
										-->
									</form>
									<form  id="buttonPrice6" style="display:block;" action="fxm.php?page=sub" method="POST">
										<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										data-key="pk_test_GvM99ms8EQKkVK9A5U7VB2ZK"
										data-amount="<?php echo($pricing['FM06EUR_stripelabel']); ?>"
										data-name='FretXMaster'
										data-description="<?php echo sprintf($lang['stripebuttonFM06'], $pricing['FM06EUR_label']);?>"		
										data-image="images/FXM.jpg"
										data-locale="<?php echo($language); ?>"
										data-currency="EUR"
										data-email="<?php echo($connectedAs); ?>"
										data-label="<?php echo sprintf($lang['stripebuttonFM06'], $pricing['FM06EUR_label']);?>"
										data-panel-label="<?php echo($lang['validatePay']); ?> (<?php echo($pricing['FM06EUR_label']);?>)">
									</script>
									<input type="hidden" name="pricing" value="06">
								</form>
								<p></p>
								<form  id="buttonPrice12" style="display:block;" action="fxm.php?page=sub" method="POST">
									<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_GvM99ms8EQKkVK9A5U7VB2ZK"
									data-amount="<?php echo($pricing['FM12EUR_stripelabel']); ?>"
									data-name='FretXMaster'
									data-description="<?php echo sprintf($lang['stripebuttonFM12'], $pricing['FM12EUR_label']);?>"		
									data-image="images/FXM.jpg"
									data-locale="<?php echo($language); ?>"
									data-currency="EUR"
									data-email="<?php echo($connectedAs); ?>"
									data-label="<?php echo sprintf($lang['stripebuttonFM12'], $pricing['FM12EUR_label']);?>"
									data-panel-label="<?php echo($lang['validatePay']); ?> (<?php echo($pricing['FM12EUR_label']);?>)">												
								</script>
								<input type="hidden" name="pricing" value="12">
								
							</form>
							
							<br/>
							<a href="http://www.stripe.com" target="_blank"><img src="images/powered_by_stripe.png" alt=""/></a><br/>
							<span class="hint"><?php echo($lang['stripeMessage']); ?></span>

							<form action="fxm.php?page=sub">

								<input type="text" name="name" required />
								<input type="email" name="email" required />


							</form>
						</div>
					</div>




					<?php 
					$prefpage = "subscribe";
					include("content_side_preferences.php"); 
					?>
				</div>

			</div>



















































