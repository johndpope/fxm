
<a href="fxm.php?page=cm"> 
	<div class="container-frame">
		<div class="character-frame">
			<img class="character-background character-image" src="<?php echo $user->_character->getBackgroundImageSource(); ?>" alt=""/>
			<img class="character-amp character-image" src="<?php echo $user->_character->getAmpBaseImageSource(); ?>" alt=""/>
			<img class="character-character character-image" src="<?php echo $user->_character->getCharacterBaseImageSource(); ?>" alt=""/>

			<img class="character-character character-image" src="<?php echo $user->_character->getCharacterBaseClothesUpImageSource(); ?>" alt=""/>
			<img class="character-character character-image" src="<?php echo $user->_character->getCharacterBaseClothesDownImageSource(); ?>" alt=""/>

			<img class="character-guitar character-image" src="<?php echo $user->_character->getGuitarBaseImageSource(); ?>" alt=""/>

			<img class="character-character character-image" src="<?php echo $user->_character->getCharacterBaseArmsImageSource(); ?>" alt=""/> 
			<img class="character-character character-image" src="<?php echo $user->_character->getCharacterBaseFaceImageSource(); ?>" alt=""/>
			<img class="character-character character-image" src="<?php echo $user->_character->getCharacterBaseHairImageSource(); ?>" alt=""/>

			<img class="character-character character-image" src="<?php echo $user->_character->getCharacterBaseClothesArmsImageSource(); ?>" alt=""/>
			<img class="character-character character-image" src="<?php echo $user->_character->getCharacterBaseAccessImageSource(); ?>" alt=""/>
		</div>
		<div class="character-name"><?php echo $user->_character->getName(); ?></div>
		<div class="level-number"><?php echo $user->_character->getLevel(); ?></div>
		<div class="character-money money-number"><?php echo $user->_character->getMoney(); ?></div>

		<div class="progress-container">
			<progress id="XPBarCharacter" class="XPBarCharacter progressBarCharacter" max="<?php echo $levelPointsSize; ?>" value="<?php echo $user->_character->getXPLvl(); ?>"></progress>										
			<progress id="LifeBarCharacter" class="LifeBarCharacter progressBarCharacter" max="100" value="<?php echo $user->_character->getLife(); ?>"></progress>									
		</div>
		<div class="life-number"><span class="character-life"><?php echo $user->_character->getLife(); ?></span> / 100</div>
		<div class="xp-number"><span class="character-xp"><?php echo $user->_character->getXPLvl(); ?></span> / <span class="character-levelPointsSize"><?php echo $levelPointsSize ?></span></div>
	</div>
</a>