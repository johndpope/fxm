function getMyDayDrills(uid) {
	$.post(
    'content_dailyRoutine_ax.php', 
    {
     uid : uid 
   },
   function(data){
    var getMyDayDrills = JSON.parse(data.trim());
   // alert(login.message);
   // alert(login.error);
   if(!getMyDayDrills.error){
     //window.location.href = "fxm.php?page=dashboard";
     $('body').notif({title:getMyDayDrills[0].drill_name, content:'MARCHE', cls:'success', timeout:5000})
     var html = "<table>";

     for (var i = 0; i < getMyDayDrills.length; i++) {
      html+="<tr>";

      html+="<td class='drill' exoname='";   
      html+=getMyDayDrills[i].drill_name;
      html+="'>";
      html+=getMyDayDrills[i].drill_name;
      html+="</td>";
      html+="</tr>";
    }



    html+="</table>";

    $("#drillTable").html(html);

    $(".drill").click(function(e){      
   
   //console.log("toto");
   chosenDrill = $(this).attr("exoname");
   drillCode = $(this).attr("exoname");
   //console.log(chosenDrill);console.log(drillCode);
   drills_setDrill(drillCode);
   //displayDailyChrono();
    //tick();
  })   


  }
  else{
   $('body').notif({title:getMyDayDrills.drill_name, content:'Mon contenuoo', cls:'error', timeout:5000})
 }
},
'text'
);
	return false;
}



$(document).ready(function(){
  getMyDayDrills(uid);
});