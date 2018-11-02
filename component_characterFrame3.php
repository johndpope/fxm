
<?php
$canvasSize = 230;
?>
<script> 
	var canvasSize = <?php echo $canvasSize ?>;
</script>
<style>
	.goo{
		width:230px;
		position:relative;
		height: 85px;
	}
</style>
<div class="block-content characterBlock">



	<div id="real" class="container-frame goo">


		<?php 
		if(strlen($user->_character->getName()) > 14)
	{/*
		?>
		<div class="character-name character-name-small"><?php echo $user->_character->getName(); ?></div>
		<?php */
	}
	else
	{/*
		?>
		<div class="character-name"><?php echo $user->_character->getName(); ?></div>
		<?php */
	}
	?>

	<div class="niv"><?php echo $lang["niv"]; ?></div>
	<!-- <div class="level-number">1</div> -->
	<div class="level-number"><?php echo $user->_character->getLevel(); ?></div>

	<div class="money-number"><img class="moneyBar" src="images/money0.png" /><span class="character-money"><?php echo $user->_character->getMoney(); ?></span></div>




<!-- 
	<div class="progress-container">
		<progress id="XPBarCharacter" class="XPBarCharacter progressBarCharacter" max="<?php echo $levelPointsSize; ?>" value="<?php echo $user->_character->getXPLvl(); ?>">
			
		</progress>										
		<progress id="LifeBarCharacter" class="LifeBarCharacter progressBarCharacter" max="100" value="<?php echo $user->_character->getLife(); ?>"></progress>									
	</div> -->


	<img class="heartImgBar" src="images/heartWhite.png" /><div class="life-number"><span class="character-life"><?php echo $user->_character->getLife(); ?></span> / 100</div>	

	<img class="heartImgBar starImgBar" src="images/xpWhite.png" />
	<div class="xp-number"><span class="character-xp"><?php echo $user->_character->getXPLvl(); ?></span> / <span class="character-levelPointsSize">	
		<?php echo $levelPointsSize ?></span>
	</div>



	<div class="xpProgress">
	<div class="xpProgressBack" ></div>
		<div class="xpProgressBar" style="width:<?php echo round((($user->_character->getXPLvl() / $levelPointsSize)*100)); ?>%"></div>

	</div>




	<div class="lifeProgress">
		<div class="lifeProgressBack"></div>
		<div class="lifeProgressBar" style="width:<?php echo $user->_character->getLife(); ?>%"></div>
	</div>




</div>


</div>

