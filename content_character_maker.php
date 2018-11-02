<?php
if(!$connected)
{
	header( 'Location: fxm.php?page=login' );
	die();
}
include("business/inventory.php");

$inventory = $user->_character->getInventory();

?>

<script>
	var details = new Array();
	details["character"] = "<?php echo $user->_character->getCharacterBase(); ?>"; 
	details["background"] = "<?php echo $user->_character->getBackground(); ?>"; 
	details["guitar"] = "<?php echo $user->_character->getGuitarBase(); ?>"; 
	details["amp"] = "<?php echo $user->_character->getAmp(); ?>"; 
	details["hair"] = "<?php echo $user->_character->getCharacterBaseHair(); ?>"; 
	details["cup"] = "<?php echo $user->_character->getCharacterBaseClothesUp(); ?>"; 
	details["cdo"] = "<?php echo $user->_character->getCharacterBaseClothesDown(); ?>"; 
	details["access1"] = "<?php echo $user->_character->getCharacterBaseAccess1(); ?>"; 
	details["access2"] = "<?php echo $user->_character->getCharacterBaseAccess2(); ?>"; 

	<?php
	if(isset($firstConnection) && $firstConnection == true)
	{ 
		?>		
		window.onload = function(event) {
			navigateWizard("modalFrame_WizardDash-01");
		};  		
		<?php 
	}
	?>
</script>

<div class="content-container">
	<div class="block-container">
		<!--BLOC PRINCIPAL DES EXERCICES -->
		<div class="main-block">
			<div class="block-content">

				<div class="menuMaker">
					<span class="makerBlocks makerBlocksSelected" onclick="$('.makerBlocks').removeClass('makerBlocksSelected');$(this).addClass('makerBlocksSelected'); navigating('characterBodySection', 'characterSection');"><?php echo($lang['caracteristics']); ?></span>

					<span class="makerBlocks" onclick="$('.makerBlocks').removeClass('makerBlocksSelected');$(this).addClass('makerBlocksSelected'); navigating('characterGuitarSection', 'characterSection');"><?php echo($lang['helps']); ?></span>

				</div>
				<p></p>

				<div id="characterBodySection" class="characterSection" onclick="navigating('characterBodySection', 'characterSection');">
					<div class="circleContainer">
						<div class="circleBlue">
						</div>
						<img alt="Character" src="images/person.svg" class="circleImg" />
					</div>
					<h3><?php echo($lang['name']); ?></h3>
					<p></p>
					<input maxlength="32" size="20" type="text" id="characterNameInput" value="<?php echo $user->_character->getName(); ?>" onchange="$('.saveButton').removeClass('saveButtonInactive');"
					onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"></input>
				</div>

				<div id="characterGuitarSection" class="characterSection isInvisible">


					<div class="circleContainer">
						<div class="circleBlue">

						</div>
						<img alt="Character" src="images/person.svg" class="circleImg" />
					</div>
					<h3><?php echo($lang['helps']); ?></h3>
					<p id="potion">
						<span class="object-frame" id="potion" alt="<?php echo($lang['potion']); ?>" title="<?php echo($lang['potion']); ?>">
							<img class="character-maker-image-ch" name="potion" src="images/potion.svg" alt="<?php echo($lang['potion']); ?>" />
							<span id="potion-price" class="object-price"><img style="width: 15px;padding-right: 5px;" class="" src="images/money0.png">500</span>				
							<span class="object-image" id="potion-buy" alt="<?php echo($lang['potion']); ?>" title="<?php echo($lang['potion']); ?>" onclick="buyPotion(500);"></span>
						</span>						
					</p>

				</div>

				<?php
				if(isset($firstConnection) && $firstConnection == true)
				{ 
					?>		
					<div class="saveButton" onclick="updateCharacter(details);$('.saveButton').addClass('saveButtonInactive');setTimeout(function(){window.location.href = 'fxm.php?page=dashboard';},1000);"><?php echo($lang['start']); ?></div>		
					<?php 
				}
				else
				{
					?>		
					<div class="saveButton saveButtonInactive" onclick="updateCharacter(details);$('.saveButton').addClass('saveButtonInactive');setTimeout(function(){window.location.href = 'fxm.php?page=dashboard';},1000);"><?php echo($lang['save']); ?></div>		
					<?php 
				}
				?>


			</div>
		</div>

		<div class="side-blocks">
			<div class="side-blocks-inner">
				<!--BLOC LATERAL DU PERSONNAGE -->
				<div class="side-block">
					<!-- <div class="block-content"> -->
					<?php include("component_characterFrame3.php"); ?>
					<div class="block-content character-name">
						<?php echo $user->_character->getName(); ?>
					</div>
					<!-- </div> -->
				</div>
			</div>
		</div>

	</div>
</div>
<?php 
include("modalFrame_Start.php"); 
include("modalFrame_Wizard.php"); 
?>

