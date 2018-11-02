<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo($title);?></title>
		
		<meta name="description" content="<?php echo($title);?>" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    	
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		
		<?php if(isset($chargeSheet) && $chargeSheet) { ?>  
			<!-- VexFlow Compiled Source -->
			<script src="sheet/releases/vexflow-debug.js"></script>
			<script src="sheet/releases/vexflow-min.js"></script>
			<!-- Support Sources -->
			
			<script src="sheet/jquery-2.1.0.min.js"></script>
			
			<script src="js/guitar.js"></script>
			<script src="js/base64-binary.js"></script>
			
		<?php } ?>
	
		
			<link rel="icon" type="image/png" href="favicon.ico" />

		
		<script type="text/javascript">		
			function toggle_visibility(id) {
				var e = document.getElementById(id);
				if(e.style.display == 'block')
				e.style.display = 'none';
				else
				e.style.display = 'block';
			}
			
			
		</script>
		<!--
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73542464-1', 'auto');
  ga('send', 'pageview');

</script>

	-->	
		<?php
			//echo "ouch";
			//echo $_COOKIE["mbTimeDelta"];
			if(!isset($_COOKIE["mbTimeDelta"]))
			//echo "ohgfgjuch";
			//if(true)
			{
			
			
			?>		
			<script>
				window.onload = function() {
					var dateServeurPhp = "<?php  echo(date("D M d Y H:i:s O")); ?>" ;	
					//var dateServeurPhp = new Date("February 5, 2001 18:15:00");	
					var dateServeur = new Date(dateServeurPhp);
					var dateLocale = new Date(); 
					//Modif date locale pour le test
					//dateLocale.setHours(dateLocale.getHours() + 15);
					//dateLocale = new Date(dateLocale + (8*1000*60*60));
					
					var diff = Math.floor((dateLocale - dateServeur) / (1000*60*60));			
					//alert(dateServeurPhp+"//"+dateServeur+"//"+dateLocale+"//"+diff);
					if(isNaN(diff)) diff=0;
					
					TimeDelta(diff);			
				}	
				// handles the click event, sends the query
				function TimeDelta(dif) {
					$.ajax({
						url:'timeDelta.php?dif='+dif,
						success: function (response) {
							console.log(response);					
						},
						error: function () {					
						},
					});
					console.log("delta:"+dif);			
					return false;
				}
				
			</script>
			<?php
			}
		?>
		
		
	</head>			