
<?php
$canvasSize = 230;
?>
<script> 
	var canvasSize = <?php echo $canvasSize ?>;
</script>
<style>
	.goo{width:230px;position:relative;}
</style>

<div id="real" class="container-frame goo">
	<div class="character-frame">		
		<canvas class="character-amp character-image" id="cvsBACK_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsBODY_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsFACE_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsHAIR_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsCLUP_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsCLDO_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsGUIT_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsARMS_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsCLAR_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsACCS_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
		<canvas class="character-amp character-image" id="cvsX_mob" width=<?php echo $canvasSize ?> height=<?php echo $canvasSize ?>></canvas>
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

<script src="js/jquery-1.11.2.min.js"></script>   

<script>
	function drawInCanvas(canvasId, imagePath, colorShift)
	{
		//var colorshift = -0.00;
		var cvs = document.getElementById(canvasId);var ctx = cvs.getContext("2d");
		ctx.clearRect(0, 0, canvasSize, canvasSize);
		var img = new Image();
		img.crossOrigin = "anonymous";
		img.onload = function(){ctx.drawImage(img, 0, 0, canvasSize, canvasSize);};

		img.src = imagePath;
	}

	function initCharacterDrawing()
	{


		drawInCanvas("cvsBACK_mob", "<?php echo $user->_character->getBackgroundImageSource(); ?>", 0);
		drawInCanvas("cvsBODY_mob", "<?php echo $user->_character->getCharacterBaseImageSource(); ?>", 0);
		drawInCanvas("cvsFACE_mob", "<?php echo $user->_character->getCharacterBaseFaceImageSource(); ?>", 0);
		drawInCanvas("cvsHAIR_mob", "<?php echo $user->_character->getCharacterBaseHairImageSource(); ?>", 0);
		drawInCanvas("cvsCLUP_mob", "<?php echo $user->_character->getCharacterBaseClothesUpImageSource(); ?>", 0);
		drawInCanvas("cvsCLDO_mob", "<?php echo $user->_character->getCharacterBaseClothesDownImageSource(); ?>", 0);
		drawInCanvas("cvsARMS_mob", "<?php echo $user->_character->getCharacterBaseArmsImageSource(); ?>", 0);
		drawInCanvas("cvsGUIT_mob", "<?php echo $user->_character->getGuitarBaseImageSource(); ?>", 0);
		drawInCanvas("cvsCLAR_mob", "<?php echo $user->_character->getCharacterBaseClothesArmsImageSource(); ?>", 0);
		drawInCanvas("cvsACCS_mob", "<?php echo $user->_character->getCharacterBaseAccessImageSource(); ?>", 0);

	}

	initCharacterDrawing();

	function recolorPants(colorshift, canvas, ctx) {

		var imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
		var data = imgData.data;

		for (var i = 0; i < data.length; i += 4) {
			red = data[i + 0];
			green = data[i + 1];
			blue = data[i + 2];
			alpha = data[i + 3];

        // skip transparent/semiTransparent pixels
        if (alpha < 200) {
        	continue;
        }

        var hsl = rgbToHsl(red, green, blue);
        var hue = hsl.h * 360;

        // change blueish pixels to the new color
        if (hue > 15 && hue < 62) {
        //if (true) {
        	var newRgb = hslToRgb(hsl.h, hsl.s, hsl.l + colorshift);
        	//var newRgb = hslToRgb(hsl.h + colorshift, hsl.s, hsl.l);
        	data[i + 0] = newRgb.r;
        	data[i + 1] = newRgb.g;
        	data[i + 2] = newRgb.b;
        	data[i + 3] = 255;
        }
    }
    ctx.putImageData(imgData, 0, 0);
}

function rgbToHsl(r, g, b) {
	r /= 255, g /= 255, b /= 255;
	var max = Math.max(r, g, b),
	min = Math.min(r, g, b);
	var h, s, l = (max + min) / 2;

	if (max == min) {
        h = s = 0; // achromatic
    } else {
    	var d = max - min;
    	s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
    	switch (max) {
    		case r:
    		h = (g - b) / d + (g < b ? 6 : 0);
    		break;
    		case g:
    		h = (b - r) / d + 2;
    		break;
    		case b:
    		h = (r - g) / d + 4;
    		break;
    	}
    	h /= 6;
    }

    return ({
    	h: h,
    	s: s,
    	l: l,
    });
}


function hslToRgb(h, s, l) {
	var r, g, b;

	if (s == 0) {
        r = g = b = l; // achromatic
    } else {
    	function hue2rgb(p, q, t) {
    		if (t < 0) t += 1;
    		if (t > 1) t -= 1;
    		if (t < 1 / 6) return p + (q - p) * 6 * t;
    		if (t < 1 / 2) return q;
    		if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
    		return p;
    	}

    	var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
    	var p = 2 * l - q;
    	r = hue2rgb(p, q, h + 1 / 3);
    	g = hue2rgb(p, q, h);
    	b = hue2rgb(p, q, h - 1 / 3);
    }

    return ({
    	r: Math.round(r * 255),
    	g: Math.round(g * 255),
    	b: Math.round(b * 255),
    });
}

</script>



