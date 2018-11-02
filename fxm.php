<?php include("php/incl.php");
$APPL = "FXM";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>FretXMaster</title>
	<meta property="og:title" content="Maîtrisez le manche, une fois pour toutes." />
	<meta property="og:url" content="http://www.fretxmaster.com"/>
	<meta property="og:site_name" content="FretXMaster"/>
	<meta property="og:description" content="Apprenez et maîtrisez les notes de la guitare en vous amusant. Devenez à l'aise en toutes circonstances de jeu.">
	<meta property="og:image" content="https://www.musicianbooster.com/fretxmaster/images/FB0.png"/>

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="http://www.fretxmaster.com">
	<meta name="twitter:creator" content="@BoosterContact">
	<meta name="twitter:title" content="Maîtrisez le manche, une fois pour toutes.">
	<meta name="twitter:description" content="Apprenez et maîtrisez les notes de la guitare en vous amusant. Devenez à l'aise en toutes circonstances de jeu.">
	<meta name="twitter:image" content="https://www.musicianbooster.com/fretxmaster/images/FB0.png">

	<script>
		VEXTAB_USE_SVG = true
		
		var base64 = {};
		base64["empty"]="";

		<?php $authorizedConnection = true; ?>
		var authorizedConnection = true;
		var debugMode = false;
		<?php $debugMode = false; 

		$cssPath = "css";
		$jsPath = "js";

		if($debugMode == true)
		{
			$cssPath = "cssBIG";
			$jsPath = "jsBIG";
		}

		$versionCSS = "3.22";
		$versionJSLight = "3.36";
		$versionJSHeavy = "3.3";
		$versionJSFixed = "3.3";
		?>

		var lang_jsLose1 = "<?php echo $lang["jsLose1"]; ?>";
		var lang_jsLose2 = "<?php echo $lang["jsLose2"]; ?>";
		var lang_jsError = "<?php echo $lang["jsError"]; ?>";
		var lang_jsFBError = "<?php echo $lang["jsFBError"]; ?>";
		var lang_jsGGError = "<?php echo $lang["jsGGError"]; ?>";
		var lang_jsGGError2 = "<?php echo $lang["jsGGError2"]; ?>";

		function addEvent(obj, event, fct) {
    if (obj.attachEvent) //Est-ce IE ?
        obj.attachEvent("on" + event, fct); //Ne pas oublier le "on"
    else
    	obj.addEventListener(event, fct, true);
}

</script>

<?php 

if($APPL == "RTS"){ ?>
<link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>/appShred.css?ver=<?php echo $versionCSS; ?>">
<?php }else{ ?>
<link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>/app.css?ver=<?php echo $versionCSS; ?>">

<?php } ?>

<link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>/responsive.css?ver=<?php echo $versionCSS; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>/animate.css?ver=<?php echo $versionCSS; ?>">

<link rel="icon" type="image/png" href="favicon2.ico" />
<link rel="icon" sizes="192x192" href="nice-highres.png">
<?php
if($authorizedConnection)
{
	?>
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,500" rel="stylesheet">
	<?php
}
?>


<meta name="description" content="FretXMaster">
<meta name="author" content="MusicianBooster">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<script src="<?php echo $jsPath; ?>/jquery-1.11.2.min.js"></script>   
<script>


	<?php
	if($authorizedConnection)
	{
		?>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-73542464-1', 'auto');
		ga('send', 'pageview');		
		<?php
	}
	?>
</script>
<?php 
if($authorizedConnection)
{
	?>
	<meta name="google-signin-client_id" content="919019235860-l65aul6gko9p2e7pkclng40abqi5tive.apps.googleusercontent.com">
	<?php
}
if($connected)
{ 
	?>
	<meta name="theme-color" content="#29A9E6"/>
	<?php
}
else
{
	?>
	<meta name="theme-color" content="#0a4175"/>
	<?php
}
?>

</head>
<body>	
	<?php  
	include("menu.php"); 
	?>
	<div class="heightBuffer">-</div>
	<span class="floating-character isInvisible">
		<div class="side-block">
			<div class="block-content" id="floater"> 

			</div>
		</div>
	</span>
	<?php if(isset($_GET['page']) && !isset($page))
	{
		$page = $_GET['page'];
	}
	else
	{
		if(!isset($page)) $page= "splash";
	}
	switch ($page) {
		case "0":
		case "dashboard":
		include("content_dashboard.php");
		break;
		case "1":
		case "drill":
		include("content_drill.php");
		break;
		case "2":
		case "cm":
		include("content_character_maker.php");
		break;
		case "3":
		case "account":
		include("content_account.php");
		break;
		case "4":
		case "sub":
		include("content_sub.php");
		break;
		case "5":
		case "subscribe":
		include("content_subscribe.php");
		break;
		case "6":
		case "preferences":
		include("content_preferences.php");
		break;
		case "login":
		include("content_splash.php");
		break;
		case "splash":
		include("content_splash.php");
		break;
		case "10":
		case "contacts":
		case "contact":
		include("content_contacts.php");
		break;
		case "11":
		case "cond":
		case "conditions":
		include("content_cond.php");
		break;
		case "hiddensurprise":
		include("content_hiddensurprise.php");
		break;
		case "999":
		case "dailyRoutine":
		include("content_dailyRoutine.php");
		break;
		case "30417f879049d6136aadbe686c637916":
		include("content_report.php");
		break;
		case "30417f879049d6136aadbe686c637917":
		include("content_drillShred.php");
		break;
		case "toto":
		case "30417f879049d6136aadbe686c637918":
		include("content_drillShred2.php");
		break;
		default:
		include("content_dashboard.php");
	}
	?>


	<script type="text/javascript" src="<?php echo $jsPath; ?>/app.js?ver=<?php echo $versionJSLight; ?>"></script>   
	<script type="text/javascript" src="<?php echo $jsPath; ?>/mustache.js?ver=<?php echo $versionJSLight; ?>"></script>
	<script type="text/javascript" src="<?php echo $jsPath; ?>/notif.js?ver=<?php echo $versionJSLight; ?>"></script>
	<script type="text/javascript" src="<?php echo $jsPath; ?>/content_login_ax.js?ver=<?php echo $versionJSLight; ?>"></script>
	<!--<script type="text/javascript" src="js/wizard.js"></script>   -->
	<?php
	switch ($page) {
		case "0":
		break;
		case "8":
		case "9":
		case "login":
		case "splash":


		if($authorizedConnection)
		{
			?>
			<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
			<?php
		}
		?>
		<?php




		break;
		case "drill":
		case "1":
		case "999":	
		?>		
		<script src="sheet/releases/vexflow-debug.js?ver=2.2"></script>
		<script src="<?php echo $jsPath; ?>/base64-binary.js?ver=2.2"></script>

		<script src="<?php echo $jsPath; ?>/sound/drumsBasic.js?ver=2.2"></script>

		<script src='<?php echo $jsPath; ?>/init.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/fbCanvas.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/notationSystem.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/fbLogic.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/soundSystem.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/schedulerEngine.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/sheetGuitar.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/fretxDrill.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src="<?php echo $jsPath; ?>/NoSleep.min.js?ver=<?php echo $versionJSFixed; ?>"></script>
		<script src='<?php echo $jsPath; ?>/met.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/game.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src="<?php echo $jsPath; ?>/guitarListener.js?ver=<?php echo $versionJSFixed; ?>"></script>
		<?php
		break;
		case "toto":
		case "30417f879049d6136aadbe686c637918":
		?>		
		<script src="sheet/releases/vexflow-debug.js?ver=2.2"></script>
		<script src="sheet/releases/vextab-div.js?ver=2.2"></script>
		<script src="<?php echo $jsPath; ?>/base64-binary.js?ver=2.2"></script>

		<script src="<?php echo $jsPath; ?>/sound/drumsBasic.js?ver=2.2"></script>

		<script src='<?php echo $jsPath; ?>/init.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/fbCanvas.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/notationSystem.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/fbLogic.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/soundSystem.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/schedulerEngine.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/sheetGuitar.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src='<?php echo $jsPath; ?>/fretxDrill.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src="<?php echo $jsPath; ?>/NoSleep.min.js?ver=<?php echo $versionJSFixed; ?>"></script>
		<script src='<?php echo $jsPath; ?>/met.js?ver=<?php echo $versionJSFixed; ?>' type='text/javascript'></script>
		<script src="<?php echo $jsPath; ?>/guitarListener.js?ver=<?php echo $versionJSFixed; ?>"></script>
		<?php
		break;		
	}
	?>
</body>
</html>



