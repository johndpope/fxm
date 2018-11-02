

// █████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗
// ╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝
// ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗  
// ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝  




// 
// ███╗   ███╗ █████╗ ███╗   ██╗ ██████╗██╗  ██╗███████╗
// ████╗ ████║██╔══██╗████╗  ██║██╔════╝██║  ██║██╔════╝
// ██╔████╔██║███████║██╔██╗ ██║██║     ███████║█████╗  
// ██║╚██╔╝██║██╔══██║██║╚██╗██║██║     ██╔══██║██╔══╝  
// ██║ ╚═╝ ██║██║  ██║██║ ╚████║╚██████╗██║  ██║███████╗
// ╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝╚═╝  ╚═╝╚══════╝
//                                                     
//  ___  ____ ____ ____ _ _  _ ____ ____ 
//  |  \ |___ [__  [__  | |\ | |___ |__/ 
//  |__/ |___ ___] ___] | | \| |___ |  \ 
//                                 
//-------------------------------------------------------------------------------------------------------------------------



//Début du positionnement du manche
var fretBoardx = 40;
var initFretBoardx = fretBoardx;
var fretBoardy = 10;

var calculatedfretLenght;
var previousCalculatedfretLenght = fretBoardx;

var fretboardCanvas = document.getElementById('fretboardCanvas');
var fretboardCanvasCtx = fretboardCanvas ? fretboardCanvas.getContext("2d") : null;

var dotsCanvas = document.getElementById('dotsCanvas');
var dotsCanvasCtx = dotsCanvas ? dotsCanvas.getContext("2d") : null;

var fretBoardLength = 80;
var fretBoardHeight = 170;

var totalFretboardLenght = 2200;
var numberOfFrets = 22;

var fretLength = 6;
var fretHeight = fretBoardHeight;
var firstDotGap = 20;

var stdGapBetweenString = fretBoardHeight / 5.5;
var smallGap = (fretBoardHeight - (stdGapBetweenString * 5)) / 2;
var stringY;

var scaled = 1;

var nbStrings = 6;
//Déclaration des cordes à vide
var stringStarters = ["EN4", "BN3", "GN3", "DN3", "AN2", "EN2"];

var casesTab = new Array(numberOfFrets);
var cordesTab = new Array(nbStrings);



//Dessiner le manche
function fretboard_drawFB(scaled) {
	var fretsize = 50;
	previousCalculatedfretLenght = initFretBoardx;
	calculatedfretLenght = initFretBoardx;
	
	var expandCoeff;
	calculatedfretLenght = fretBoardx + fretsize * (numberOfFrets);
	expandCoeff = calculatedfretLenght / (fretboardCanvas.width - 40);
	fretsize = fretsize / expandCoeff;
	calculatedfretLenght = fretBoardx + fretsize * (numberOfFrets);
	
	if (scaled == 0) {
		for ( i = 0; i <= numberOfFrets; i++) {
			
			casesTab[i] = i == 0 ? (fretBoardx + fretLength / 2) - firstDotGap : fretBoardx + fretBoardLength / 2 + fretLength / 2;
			
			fretBoardLength = fretsize;
			
			fretboard_drawFond(i);
			fretBoardx = initFretBoardx + fretsize * i;
			//calculatedfretLenght = fretBoardx;
		}
	}
	
	if (scaled == 1) {
		for ( i = 0; i <= numberOfFrets; i++) {
			var n = i;
			//calcul distance par rapport au sillet
			calculatedfretLenght = totalFretboardLenght - (totalFretboardLenght / Math.pow(2, (n / 12)));
			
			calculatedfretLenght += initFretBoardx;
			fretBoardx = calculatedfretLenght;
			
		}
		//calcul coefficient d'agradissement (pour le resize)
		expandCoeff = fretBoardx / (fretboardCanvas.width - 40);
		fretBoardx = previousCalculatedfretLenght;
		
		previousCalculatedfretLenght = initFretBoardx;
		calculatedfretLenght = initFretBoardx;
		//dessiner les frettes
		for ( i = 0; i <= numberOfFrets; i++) {
			var n = i;
			
			//calcul distance par rapport au sillet
			calculatedfretLenght = totalFretboardLenght - (totalFretboardLenght / Math.pow(2, (n / 12)));
			
			if (scaled == 1)
				calculatedfretLenght = calculatedfretLenght / expandCoeff;
			
			calculatedfretLenght += initFretBoardx;
			
			//calcul taille de la frette (distance par rapport au sillet - distance de celle d'avant par rapport au sillet)
			fretBoardLength = calculatedfretLenght - previousCalculatedfretLenght;
			
			previousCalculatedfretLenght = calculatedfretLenght;
			
			//alimentation du tableau des frettes 
			casesTab[i] = i == 0 ? (fretBoardx + fretBoardLength / 2 + fretLength / 2) - firstDotGap : fretBoardx + fretBoardLength / 2 + fretLength / 2;
			
			fretboard_drawFond(i);
			fretBoardx = calculatedfretLenght;
		}
	}
	
	fretboard_drawFret(0);
	
	fretBoardx = initFretBoardx;
	fretboard_drawString();
	
	var xf = 0;
	var yc = 0;
	
	for ( ifret = 0; ifret <= numberOfFrets; ifret++) {
		if (snapshot[ifret] !== null && snapshot[ifret] !== undefined) {
			for ( iString = 0; iString <= 5; iString++) {
				if (snapshot[ifret][iString] !== null && snapshot[ifret][iString] !== undefined)
					fretboard_drawPoint(ifret, iString + 1, snapshot[ifret][iString].display, "0");
				
			}
		}
	}
}

//Mettre à jour l'affichage anglais/français dans le snapshot
function fretboard_updateDisplayMethod() {
	for ( ifret = 0; ifret < snapshot.length; ifret++) {
		if (snapshot[ifret] !== null && snapshot[ifret] !== undefined) {
			for ( iString = 0; iString < snapshot[ifret].length; iString++) {
				if (snapshot[ifret][iString] !== null && snapshot[ifret][iString] !== undefined)
					snapshot[ifret][iString].display = fbLogic_displayableNote(snapshot[ifret][iString].note);
			}
		}
	}
}

//Dessiner un point/note sur le manche
function fretboard_drawPoint(x, y, symbole, anonymous) {
	
	if (symbole != "0") {
		xf = casesTab[x];
		yc = cordesTab[y];
		var texte;
		var couleur;
		var couleurTexte = "black";
		
		switch (symbole) {
			
			case "T" :
			texte = "T";
			couleur = "#FFFFFF";
			break;
			case "8" :
			texte = "8";
			couleur = "#FFFFFF";
			break;
			
			case "2m" :
			texte = "2m";
			couleur = "#FFFF99";
			break;
			case "2" :
			texte = "2";
			couleur = "#FFFF00";
			break;
			case "2M" :
			texte = "2";
			couleur = "#FFFF00";
			break;
			
			case "3m" :
			texte = "3m";
			//couleur = "#66FF99";
			couleur = dotsCanvasCtx.createLinearGradient(xf, yc, xf + stdGapBetweenString / 2, yc + stdGapBetweenString / 2);
			couleur.addColorStop(0, "#66FF99");
			couleur.addColorStop(1, "#99FFCC");
			dotsCanvasCtx.strokeStyle = "#99FFCC";
			// Fill with gradient
			
			break;
			case "3" :
			texte = "3";
			//couleur = "#00FF00";
			couleur = dotsCanvasCtx.createLinearGradient(xf, yc, xf + stdGapBetweenString / 2, yc + stdGapBetweenString / 2);
			couleur.addColorStop(0, "#00FF00");
			couleur.addColorStop(1, "#FFFFFF");
			dotsCanvasCtx.strokeStyle = "#33FF33";
			break;
			case "3M" :
			texte = "3";
			//couleur = "#00FF00";
			couleur = dotsCanvasCtx.createLinearGradient(xf, yc, xf + stdGapBetweenString / 2, yc + stdGapBetweenString / 2);
			couleur.addColorStop(0, "#00FF00");
			couleur.addColorStop(1, "#FFFFFF");
			dotsCanvasCtx.strokeStyle = "#33FF33";
			break;
			
			case "4" :
			texte = "4";
			couleur = "#FF0000";
			couleurTexte = "white";
			break;
			case "4J" :
			texte = "4";
			couleur = "#FF0000";
			couleurTexte = "white";
			break;
			case "4D" :
			texte = "4#";
			couleur = "#CC0000";
			couleurTexte = "white";
			break;
			
			case "5B" :
			texte = "5b";
			couleur = "#6A6AFF";
			couleurTexte = "white";
			break;
			case "5" :
			texte = "5";
			couleur = "#0000FF";
			couleurTexte = "white";
			break;
			case "5J" :
			texte = "5";
			couleur = "#0000FF";
			couleurTexte = "white";
			break;
			
			case "6m" :
			texte = "6m";
			couleur = "#FFBDFF";
			break;
			case "6" :
			texte = "6";
			couleur = "#FF66FF";
			break;
			case "6M" :
			texte = "6";
			couleur = "#FF66FF";
			break;
			
			case "7m" :
			texte = "7m";
			couleur = "#AAEEFF";
			break;
			case "7" :
			texte = "7";
			couleur = "#57DDFF";
			break;
			case "7M" :
			texte = "7";
			couleur = "#57DDFF";
			break;
			
			default :
			texte = symbole;
			couleur = "#000000";
			couleurTexte = "white";
			//break;
			
			var acc = texte.substring(texte.length - 1, texte.length);
			if (!(acc == "#" || acc == "b")) {
				couleur = "#FFFFFF";
				couleurTexte = "black";
			}
			
		}
		//"#55FF00";
		dotsCanvasCtx.stroke();
		dotsCanvasCtx.shadowOffsetX = 0;
		dotsCanvasCtx.shadowOffsetY = 2;
		dotsCanvasCtx.shadowBlur = 5;
		dotsCanvasCtx.shadowColor = 'black';
		
		dotsCanvasCtx.beginPath();
		var tailleRond = stdGapBetweenString / 2;
		if(tailleRond<12) tailleRond = 12;
		dotsCanvasCtx.arc(xf, yc, tailleRond, 0, Math.PI * 2, true);
		//trace("10", "-"+stdGapBetweenString / 2);
		dotsCanvasCtx.fillStyle = couleur;
		
		if (anonymous == "1")
			dotsCanvasCtx.fillStyle = "#29A9E6";
		
		dotsCanvasCtx.fill();
		
		dotsCanvasCtx.shadowOffsetX = 0;
		dotsCanvasCtx.shadowOffsetY = 0;
		dotsCanvasCtx.shadowBlur = 0;
		
		var taillePolice = "18";
		if (texte.length == 2)
			taillePolice = "14";
		if (texte.length == 3)
			taillePolice = "12";
		if (texte.length > 3)
			taillePolice = "10";
		
		if (anonymous == "1")
			dotsCanvasCtx.fillStyle == "#29A9E6";
		
		dotsCanvasCtx.font = taillePolice + "pt Calibri";
		
		dotsCanvasCtx.textAlign = "center";
		dotsCanvasCtx.textBaseline = "middle";
		dotsCanvasCtx.fillStyle = couleurTexte;
		
		if (anonymous != "1")
			dotsCanvasCtx.fillText(texte, xf, yc);
		
	}
}

//Dessiner les frettes
function fretboard_drawFret(nb) {
	var fretColor = "#949494";
	//if(nb == 10) fretColor = "#FF9494";
	fretboardCanvasCtx.fillStyle = fretColor;
	fretboardCanvasCtx.fillRect(fretBoardx, fretBoardy, fretLength, fretHeight);
	
	fretboardCanvasCtx.shadowOffsetX = 4;
	fretboardCanvasCtx.shadowOffsetY = 0;
	fretboardCanvasCtx.shadowBlur = 5;
	fretboardCanvasCtx.shadowColor = 'black';
	fretboardCanvasCtx.fillRect(fretBoardx, fretBoardy, 1, fretHeight);
}

//Dessiner le fond des frettes
function fretboard_drawFond(nb) {
	var dotColor = "bisque";
	var miniDotColor = "#949494";
	fretboardCanvasCtx.shadowOffsetX = 0;
	fretboardCanvasCtx.shadowOffsetY = 0;
	fretboardCanvasCtx.shadowBlur = 0;
	fretboardCanvasCtx.shadowColor = 'black';
	
	// Fond
	fretboardCanvasCtx.fillStyle = "#3F3F3F";
	//if(nb == 10 || nb == 9) fretboardCanvasCtx.fillStyle = "#4F4F4F";

/*
	fretBoardx = Math.round(fretBoardx);
	fretBoardy = Math.round(fretBoardy);
	fretBoardLength = Math.round(fretBoardLength);
	fretBoardHeight = Math.round(fretBoardHeight);
	
	console.log(fretBoardx+" "+fretBoardy+" "+fretBoardLength+" "+fretBoardHeight);
	*/
	fretboardCanvasCtx.fillRect(fretBoardx, fretBoardy, fretBoardLength, fretBoardHeight);
	
	var dotSize = stdGapBetweenString / 4;
	var miniDotSize = 2;
	var middleOfTheFretX = 0;
	
	//Points seuls
	if (nb == 3 || nb == 5 || nb == 7 || nb == 9 || nb == 15 || nb == 17 || nb == 19 || nb == 21) {
		fretboardCanvasCtx.beginPath();
		fretboardCanvasCtx.arc(fretBoardx + fretBoardLength / 2 + fretLength / 2, fretBoardy + fretBoardHeight / 2, dotSize, 0, Math.PI * 2, true);
		fretboardCanvasCtx.strokeStyle = dotColor;
		fretboardCanvasCtx.fillStyle = dotColor;
		fretboardCanvasCtx.fill();
		
		fretboardCanvasCtx.beginPath();
		fretboardCanvasCtx.arc(fretBoardx + fretBoardLength / 2 + fretLength / 2, fretBoardy + fretBoardHeight + 10, miniDotSize, 0, Math.PI * 2, true);
		fretboardCanvasCtx.strokeStyle = miniDotColor;
		fretboardCanvasCtx.fillStyle = miniDotColor;
		fretboardCanvasCtx.fill();
	}
	
	//Points octave
	if (nb == 24 || nb == 12) {
		fretboardCanvasCtx.beginPath();
		fretboardCanvasCtx.arc(fretBoardx + fretBoardLength / 2 + fretLength / 2, fretBoardy + fretBoardHeight / 2 - stdGapBetweenString, dotSize, 0, Math.PI * 2, true);
		fretboardCanvasCtx.strokeStyle = dotColor;
		fretboardCanvasCtx.fillStyle = dotColor;
		fretboardCanvasCtx.fill();
		
		//DOT
		fretboardCanvasCtx.beginPath();
		fretboardCanvasCtx.arc(fretBoardx + fretBoardLength / 2 + fretLength / 2, fretBoardy + fretBoardHeight / 2 + stdGapBetweenString, dotSize, 0, Math.PI * 2, true);
		fretboardCanvasCtx.strokeStyle = dotColor;
		fretboardCanvasCtx.fillStyle = dotColor;
		fretboardCanvasCtx.fill();
		
		fretboardCanvasCtx.beginPath();
		fretboardCanvasCtx.arc(fretBoardx + fretBoardLength / 2 + fretLength / 2, fretBoardy + fretBoardHeight + 7, miniDotSize, 0, Math.PI * 2, true);
		fretboardCanvasCtx.strokeStyle = miniDotColor;
		fretboardCanvasCtx.fillStyle = miniDotColor;
		fretboardCanvasCtx.fill();
		
		fretboardCanvasCtx.beginPath();
		fretboardCanvasCtx.arc(fretBoardx + fretBoardLength / 2 + fretLength / 2, fretBoardy + fretBoardHeight + 17, miniDotSize, 0, Math.PI * 2, true);
		fretboardCanvasCtx.strokeStyle = miniDotColor;
		fretboardCanvasCtx.fillStyle = miniDotColor;
		fretboardCanvasCtx.fill();
	}
	// Frette
	fretboard_drawFret(nb);
}

//Dessiner les cordes
function fretboard_drawString() {
	
	fretboardCanvasCtx.shadowOffsetX = 0;
	fretboardCanvasCtx.shadowOffsetY = 2;
	fretboardCanvasCtx.shadowBlur = 5;
	fretboardCanvasCtx.shadowColor = 'black';
	
	stringY = fretBoardy;
	
	var stringThickness = 0;
	var stringColor = "#D8D8D8";
	
	var stringLenght = calculatedfretLenght + fretLength - initFretBoardx;
	
	// Corde 1
	fretboardCanvasCtx.fillStyle = stringColor;
	stringThickness = 1;
	fretboardCanvasCtx.fillRect(fretBoardx, stringY + smallGap, stringLenght, stringThickness);
	stringY += smallGap;
	
	cordesTab[1] = stringY;
	
	// Corde 2
	fretboardCanvasCtx.fillStyle = stringColor;
	stringThickness = 1;
	fretboardCanvasCtx.fillRect((parseInt(fretBoardx))+0.5, (parseInt(stringY + stdGapBetweenString)), stringLenght, stringThickness);
	stringY += stdGapBetweenString;
	
	cordesTab[2] = stringY;
	
	// Corde 3
	fretboardCanvasCtx.fillStyle = stringColor;
	stringThickness = 2;
	fretboardCanvasCtx.fillRect(fretBoardx, stringY + stdGapBetweenString - (stringThickness / 2), stringLenght, stringThickness);
	stringY += stdGapBetweenString;
	cordesTab[3] = stringY;
	
	// Corde 4
	fretboardCanvasCtx.fillStyle = stringColor;
	stringThickness = 2;
	fretboardCanvasCtx.fillRect(fretBoardx, stringY + stdGapBetweenString - (stringThickness / 2), stringLenght, stringThickness);
	stringY += stdGapBetweenString;
	cordesTab[4] = stringY;
	
	// Corde 5
	fretboardCanvasCtx.fillStyle = stringColor;
	stringThickness = 3;
	fretboardCanvasCtx.fillRect(fretBoardx, stringY + stdGapBetweenString - (stringThickness / 2), stringLenght, stringThickness);
	stringY += stdGapBetweenString;
	cordesTab[5] = stringY;
	
	// Corde 6
	fretboardCanvasCtx.fillStyle = stringColor;
	stringThickness = 5;
	fretboardCanvasCtx.fillRect(fretBoardx, stringY + stdGapBetweenString - (stringThickness / 2), stringLenght, stringThickness);
	stringY += stdGapBetweenString;
	cordesTab[6] = stringY;
}


var keepnumberOfFrets = 0;
var keepfrtKnwLimitFr2 = 0;

var fretboardEndpoint;

var dontUpdateChrono;
//Retailler le manche
function fretboard_resize() {
	

	// $('.whiteNote')
	
	if(fretboardCanvas)	
	{
		sheet_updateSheetWithNote(null);
		
		//TEST/////
		fretBoardx = 10;
		fretBoardy = 5;
		fretBoardHeight = 100;
		fretboardEndpoint = 5;
		fretLength = 2;
		var monCanvas = document.getElementById('mon_canvas');
		var overCanvas = document.getElementById('overCanvas');
		monCanvas.height = fretboardCanvas.height = dotsCanvas.height = fretBoardHeight + 25;
		
		
		initFretBoardx = fretBoardx;
		fretHeight = fretBoardHeight;
		stdGapBetweenString = fretBoardHeight / 5.5;
		smallGap = (fretBoardHeight - (stdGapBetweenString * 5)) / 2;
		
		
		
		
		
		
		
		
		
		
		if(force12ifSmallScreen)
		{
			//alert(fretboardCanvas.clientWidth);
			if(window.innerWidth < 800)
			{
				fretBoardHeight = Math.round(window.innerWidth / 6.29);		
				
				if(keepnumberOfFrets == 0) keepnumberOfFrets = numberOfFrets;
				if(keepfrtKnwLimitFr2 == 0) keepfrtKnwLimitFr2 = frtKnwLimitFr2;
				
				//trace("08", keepnumberOfFrets+"/"+numberOfFrets+"/"+keepfrtKnwLimitFr2+"/"+keepfrtKnwLimitFr2);
				
				if(frtKnwLimitFr2 > 12) frtKnwLimitFr2 = 12;
				if(numberOfFrets > 12) numberOfFrets = 12;
				
				//alert(keepnumberOfFrets+"/"+numberOfFrets+"/"+keepnumberOfFrets+"/"+keepnumberOfFrets);
			}
			else
			{
				
				fretBoardHeight = Math.round(window.innerWidth / 9.14);
				
				//trace("08", keepnumberOfFrets+"-/"+numberOfFrets+"-/"+keepfrtKnwLimitFr2+"-/"+keepfrtKnwLimitFr2);
				
				if(keepnumberOfFrets != 0) numberOfFrets = keepnumberOfFrets;
				if(keepfrtKnwLimitFr2 != 0) frtKnwLimitFr2 = keepfrtKnwLimitFr2;
			}	
			
			//alert(fretBoardHeight);
			if(fretBoardHeight<100) fretBoardHeight = 100;
			if(fretBoardHeight>170) fretBoardHeight = 170;
			fretLength = fretBoardHeight*(6/200);//fretLength = 2;
			
			if(fretBoardHeight<=120) 
			{
				fretBoardx = 10;
				fretBoardy = 10;
				fretboardEndpoint = 5;
				firstDotGap = 0;
				fretLength = 2;
			}
			else
			{
				fretBoardx = 40;
				fretBoardy = 10;				
				fretboardEndpoint = -25;				
				firstDotGap = 20;
			}					
			
			var monCanvas = document.getElementById('mon_canvas');
			monCanvas.height = fretboardCanvas.height = dotsCanvas.height = fretBoardHeight + 25;
			initFretBoardx = fretBoardx;
			fretHeight = fretBoardHeight;
			stdGapBetweenString = fretBoardHeight / 5.5;
			smallGap = (fretBoardHeight - (stdGapBetweenString * 5)) / 2;
			
		}
		fretboardCanvas.width = document.body.clientWidth;// + fretboardEndpoint;	
		fretboardCanvasCtx.clearRect(0, 0, fretboardCanvas.width, fretboardCanvas.height);
		dotsCanvas.width = document.body.clientWidth;// + fretboardEndpoint;
		dotsCanvasCtx.clearRect(0, 0, dotsCanvas.width, dotsCanvas.height);
		
		overCanvas.height = fretboardCanvas.height;
		overCanvas.width = fretboardCanvas.width;
		
		fretboard_drawFB(scaled);
	}
	
	
	
	dontUpdateChrono = true;
	//pyramid_updatePyramid();
	dontUpdateChrono = false;



var top = 66 + ($('#fretboardCanvas').innerHeight()/4);
	$('#successCheck').css('height',$('#fretboardCanvas').innerHeight()/2);
	$('#successCheck').css('top',top+'px');

	var fontsize = $('.whiteNoteLabel').width()*0.6;
	$('.whiteNoteLabel').css('font-size', fontsize+'px');
	$('.whiteNoteLabel').css('color', '#777');
}

//Vider le manche de son contenu
function fretboard_emptyUpLayer() {
	if(dotsCanvas)
	{
		
		dotsCanvas.width = document.body.clientWidth;// + fretboardEndpoint;
		dotsCanvasCtx.clearRect(0, 0, dotsCanvas.width, dotsCanvas.height);
	}
}

//Vider le snapshot du manche
function fretboard_initFretboard() {
	for ( ifret = 0; ifret <= numberOfFrets; ifret++) {
		var strings = new Array(6);
		for ( iString = 0; iString <= 5; iString++) {
			strings[iString] = new Array();
			strings[iString].note = "0";
			strings[iString].display = "0";
		}
		snapshot[ifret] = strings;
	}
}

//Créer le snapshot de toutes les notes du manche
function fretboard_initFretboardShowAll() {
	for ( ifret = 0; ifret <= numberOfFrets; ifret++) {
		
		for ( iString = 0; iString <= 5; iString++) {
			var note = fbLogic_getNoteFromCoordinates(ifret, iString);
			var dNote = fbLogic_displayableNote(note);
			snapshot[ifret][iString].note = note;
			snapshot[ifret][iString].display = dNote;
		}
	}
}
