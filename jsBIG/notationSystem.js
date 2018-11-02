

function  insertNoteAndUpdateLife(bpm, drillCode, note, next, life, result) {
	//console.log(result);
	$.post(
		'insert.php', 
		{
			speed : bpm, 
			code : drillCode,
			note : note,
			next : next,
			life : life,
			result : result
		},
		function(data){
			console.log(data);
			var udpLife = JSON.parse(data.trim());
			if(udpLife.lost != ""){
				$('body').notif({title:lang_jsLose1, content:lang_jsLose2, cls:'error', timeout:20000})   			
			}

		},
		'text'
		);
	return false;
}


function  insertNoteAndUpdateXP(bpm, drillCode, note, next, points, pointsLvl, levelAfter, money, drillAchievementOut, result) {
	//console.log(result);
	$.post(
		'insert.php', 
		{
			speed : bpm, 
			code : drillCode,
			note : note,
			next : next,
			points : points,
			pointsLvl : pointsLvl,
			money : money,
			levelAfter : levelAfter,
			drillAchievementOut : drillAchievementOut,
			result : result
		},
		function(data){
			
			
		},
		'text'
		);
	return false;
}
