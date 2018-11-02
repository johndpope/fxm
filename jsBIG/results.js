var tmpX;
function move(element, distance, pointEltName, levelPointsSize, levelSize, nextLevelSize, nextLevelSize2) {
	var nbTotal = 200;
	//distance=2000;
	var distancePerRound = distance / nbTotal;
	
	var elem = $("."+element);				

	var elemPointsToAdd = $(".pointsTab"); 
	var levelElt = $(".level-number"); 

	var pointElt = $("."+pointEltName); 

	var levelPointsSizeElt = $("."+levelPointsSize); 
	var nb = 0;
	var id = setInterval(frame, 1);
	var initDistancePointsTab = [];
	var tmpPoints = 0;

	var total = parseFloat(pointElt.html());

	for(i=0;i < elemPointsToAdd.length;i++)
	{
		initDistancePointsTab[i] = parseFloat(elemPointsToAdd[i].innerHTML) / nbTotal;

	}

	function frame() {
		if (nb >= nbTotal)
		{
			clearInterval(id);
		} 
		else 
		{
			nb++; 

			total = total+distancePerRound;
			tmpX = (total/levelSize)*100;
			elem.width(tmpX+"%");

			pointElt.html(Math.round(total));

			if(total >= levelSize)
			{
				total=total-levelSize;
				tmpX = (total/levelSize)*100;
				elem.width(tmpX+"%");
				levelElt.html(parseInt(levelElt.html()) + 1);					

				if(levelSize == nextLevelSize)
				{
					levelSize = nextLevelSize2;
					nextLevelSize = nextLevelSize2;
				}
				else levelSize = nextLevelSize;

				elem.attr('max', nextLevelSize);
				levelPointsSizeElt.html(nextLevelSize);
			}

			for(i=0;i < elemPointsToAdd.length;i++)
			{
				tmpPoints = parseFloat($(elemPointsToAdd[i]).attr("perso")) - initDistancePointsTab[i];
				$(elemPointsToAdd[i]).attr("perso", tmpPoints);
				if(Math.round(tmpPoints) <= 0) elemPointsToAdd[i].innerHTML = "-";
				else elemPointsToAdd[i].innerHTML = Math.round(tmpPoints);
			}
		}
	}
}

function moveMoney(wonMoneyElt, addedMoneyElt, wonMoney, addedMoney) {
	var nbTotal = 200;
	var distancePerRound = wonMoney / nbTotal;

	var wonMoneyElem = $("#"+wonMoneyElt)[0]; 
	var addedMoneyElem = $("."+addedMoneyElt); 

	var totalWonMoney = wonMoney;
	var totalAddedMoney = addedMoney;

	var nb = 0;
	var id = setInterval(frame, 1);					

	function frame() {
		if (nb >= nbTotal)
		{
			clearInterval(id);
		} 
		else 
		{
			nb++; 						

			totalWonMoney = totalWonMoney-distancePerRound;
			totalAddedMoney = totalAddedMoney+distancePerRound;

			wonMoneyElem.innerHTML = Math.round(totalWonMoney);						
			addedMoneyElem.html(Math.round(totalAddedMoney));
		}
	}
}


function moveLife(lostLifeElt, life, lostLife) {
	var nbTotal = 200;

	var distancePerRound = lostLife / nbTotal;

	var lostLifeElem = $("."+lostLifeElt); 

	var lostLifeTextElem = $(".character-life"); 
	var lostLifeTextElem2 = $(".character-life2"); 

	var totallostLife = life;
	var nb = 0;
	var id = setInterval(frame, 1);			

	function frame() {
		if (nb >= nbTotal)
		{
			clearInterval(id);
		} 
		else 
		{
			nb++; 						

			totallostLife = totallostLife-distancePerRound;
			lostLife = lostLife-distancePerRound;

			//tmpX = (total/levelSize)*100;
			lostLifeElem.width(totallostLife+"%");
			//lostLifeElem.attr('value', totallostLife);	

			lostLifeTextElem.html(Math.round(totallostLife));		
			lostLifeTextElem2.html('- '+Math.round(lostLife));	
			if(lostLife < 1) lostLifeTextElem2.html('-');	
		}
	}
}


function moveOn() {
	move('xpProgressBar', 
		wonPoints, 
		'character-xp', 
		'character-levelPointsSize',
		levelPointsSize, 
		nextLevelPointsSize, 
		nextLevelPointsSize2);
}