<?php
	include "dbUtilities.php";
	session_start();
	if(!isset($_SESSION['login']))
			header("Location: index.php");
		
	$username=$_SESSION['username'];
	$score = getFinalScore();
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script type="text/javascript" src="./js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="./js/Game.js"></script>
		<script type="text/javascript" src="./js/arkanoid.js"></script>
		<script type="text/javascript" src="./js/Circle.js"></script>
		<script type="text/javascript" src="./js/Block.js"></script>
		<link href="./stili/stile.css" rel="stylesheet" type="text/css" />
		<script>
			function nascondiTabella(){
				$("#classifica_container").fadeOut();
				
			}
		</script>
		<title>Arkanoid</title>
	</head>
	<body>
	<div id="menu-wrapper">
		<div id="menu">
		<ul>
			<li><a href="Home.php">Homepage</a></li>
			<li><a href="./Gioco.php">Gioco</a></li>
			<li><a href="Classifica.php">Classifica</a></li>
			<li><a href="Contatti.php">Contatti</a></li>
			<?php
				echo "<li><a href=\"Utente.php\">".$username."</a><li>"
			?>
		</ul>
		</div>
	</div>
		<div class="titolo_arkanoid">Arkanoid</div>
	<div class="gioco">
		<canvas id="my_canvas" class="canvas" width="582" height="500"></canvas>
	</div>
	<div id="classifica_container" hidden="true">
	<div id="classifica_sfondo">
	</div>
		<div id="classifica_pagina_gioco">
		<a id="tasto_rigioca" href="#" onclick="document.location.reload(true)">Rigioca</a> <br>
		<a id="nascondi_tabella" href="#" onclick="nascondiTabella()">Nascondi tabella</a>
		</div>
	</div>
	

	</body>
</html>