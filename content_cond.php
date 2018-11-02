<?php	

include("php/drillTools.php"); 

$contactObject = "";
if(isset($_GET['type']))
{
	$contactObject = $_GET['type'];


}	


if(isset($_POST['validate']))
{
	if(!isset($uid))
	{	
		$uid = "";
		$address = $_POST['user-email'];
	}
	else
	{
		$address = $connectedAs;
	}
	$body = $_POST['inputNote'];
	$body = str_replace("\n","<br />",$body);
	$contactObject = $_POST['contactObject'];
	$sendAmail = $authenticate->sendAmail($uid,$address,$contactObject,$body);
	//var_dump($sendAmail);
	if(!$sendAmail['error'])
		$messInfo = $sendAmail['message'];
	else 
		$messErr = $sendAmail['message'];	

		//include("php/lang.php");

}	


?>

<script type="text/javascript">		
	window.onload = function(){ 

		<?php
		if($messErr != "") 
			{ ?>

				$('body').notif({title:"<?php echo $messErr; ?>", cls:'error', timeout:5000});<?php
			} ?>

			<?php if($messInfo != "") { ?>

				$('body').notif({title:"<?php echo $messInfo; ?>", cls:'success', timeout:5000});
				<?php } ?>
			}



		</script>

		<div class="content-container">
			<div class="block-container">
				<div class="unique-block">
					<div class="block-content">

						<div class="circleContainer">
							<div class="circleBlue">

							</div>
							<img alt="Character" src="images/contacts.png" class="circleImg" />
						</div>
						<h3>Mentions légales</h3>



						<section id="banner">

							<article id="main" class="container special">
								<p>			
									<br/><span class="bold">1. Informations légales</span>

									<br/>Conformément aux dispositions des articles 6-III et 19 de la loi pour la Confiance dans l’Économie Numérique, nous vous informons que :

									<br/>L’éditeur et le directeur de la publication du présent site internet est :
									<br/>Romain B., pour MusicianBooster
									<br/>Adresse de courrier électronique : contact (at) musicianbooster (point) com
									<br/>Numéro SIRET : 818 193 617
									<br/>
									<br/>L’hébergeur du présent site internet est :
									<br/>Hébergeur : OVH
									<br/>Société : OVH 
									<br/>Adresse web : <a href="www.ovh.com">www.ovh.com</a>
									<br/>Adresse Postale : 2 rue kellermann 
									<br/>BP 80157
									<br/>59053 ROUBAIX Cedex 1
									<br/>Téléphone : +33 (0)8 203 203 63
									<br/>Adresse électronique (E-Mail) : support@ovh.com

									<br/>
									<br/><span class="bold">2. Informatique et Libertés</span>
									<br/>Les données personnelles collectées sur le site ne seront en aucun cas distribuées à des tiers, ni vendues, ni louées, ni prêtées. En application de la loi n°78-17 du 6 janvier 1978 modifiée en 2004, relative à l’informatique, aux fichiers et aux libertés, le site web a fait l’objet d’une déclaration auprès de la Commission Nationale de l’Informatique et des Libertés (www.cnil.fr). Les traitements automatisés de données nominatives réalisés à partir du présent site web ont donc été traités en conformité avec les exigences de cette loi.

									<br/>L’utilisateur est notamment informé que conformément à l’article 32 de cette même loi, les informations qu’il communique par le biais des formulaires présents sur le site sont nécessaires pour répondre à sa demande et sont destinées à l’éditeur du site.

									<br/>Conformément à cette loi, vous bénéficiez d’un droit d’accès et de rectification aux informations qui vous concernent, ainsi que d’un droit d’opposition au traitement de vos données pour des motifs légitimes. Vous pouvez exercer l’ensemble de ces droits auprès de l’éditeur du site par l’intermédiaire du formulaire de courrier électronique.
									<br/>
									<br/><span class="bold">3. Propriété intellectuelle</span>

									<br/>La structure générale ainsi que tous les autres éléments composant le site sont la propriété exclusive de l’éditeur du site, sauf mention contraire.

									<br/>Toute représentation totale ou partielle de ce site par quelle que personne que ce soit, sans l’autorisation expresse de l’éditeur est interdite et constituerait une contrefaçon sanctionnée par les articles L. 335-2 et suivants du Code de la propriété intellectuelle. Cela dit, conformément à l’article L. 122-5 du Code de la propriété intellectuelle, les courtes citations du contenu sont autorisées, sous réserve que soient indiqués clairement le nom de l’auteur et de la source, par un lien vers une des pages de ce site web.
									<br/>
									<br/><span class="bold">4. Analyse du trafic</span>

									<br/>Ce site utilise Google Analytics, un service d’analyse du trafic de site internet fourni par Google. Google Analytics utilise des cookies, qui sont des fichiers textes hébergés sur votre ordinateur, pour aider le site internet à analyser l’utilisation du site par ses utilisateurs. Les données générées par les cookies concernant votre utilisation du site (y compris votre adresse IP) sont transmises et stockées par Google sur des serveurs situés aux Etats-Unis. Google utilise ces informations dans le but d’évaluer l’utilisation du site par ses visiteurs, de compiler des rapports sur l’activité du site à destination de son éditeur et de fournir d’autres services relatifs à l’activité du site et à l’utilisation d’Internet. Google est susceptible de communiquer ces données à des tiers en cas d’obligation légale ou lorsque ces tiers traitent ces données pour le compte de Google, y compris notamment l’éditeur de ce site. Google s’engage à ne jamais recouper votre adresse IP avec toute autre donnée détenue par Google. Vous pouvez désactiver l’utilisation de cookies en sélectionnant les paramètres appropriés de votre navigateur. Cependant, une telle désactivation pourrait empêcher l’utilisation de certaines fonctionnalités de ce site. En utilisant ce site Web, vous acceptez que Google traite des données vous concernant de la manière et aux fins décrites ci-dessus.
								</p>
							</article>
						</section>	

						
					</div>

				</div>
			</div>

		</div>
