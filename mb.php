<?php
$connected = false;
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">	
	<meta name="theme-color" content="#0a4175" />
	<title>MusicianBooster</title>
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="icon" type="image/png" href="favicon2.ico" />

	<meta name="description" content="MusicianBooster">
	<meta name="author" content="MusicianBooster">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<script src="js/jquery-1.11.2.min.js"></script>   
</head>
<body>
	<header class="header">
		<a href="#" class="header__icon" id="header__icon"></a>
		<div class="header-container">
			<a href="http://www.musicianBooster.com/blog" class="header__logo">
				<span class="bebTitle">Musician</span>			
				<span class="boyTitle">Booster</span>
			</a>
			<nav class="menu">	
			</nav>
		</div>
	</header>
	?>
	<div class="heightBuffer">-</div>
	<span class="floating-character isInvisible">
		<div class="side-block">
			<div class="block-content" id="floater"> 
				
				
			</div>
		</div>
	</span>
	<?php 

	if(isset($_GET['page']) && !isset($page))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = "";		
	}
	switch ($page) {		
		case "999":
		case "mini":
		include("js/mb_content_minifier.php");
		break;
		case "download":
		include("js/mb_content_download.php");
		break;
		case "30417f879049d6136aadbe686c637916":
		include("js/mb_content_report.php");
		break;
		default:
		include("mb_content_form.php");
	}
	?>
</body>



</html>