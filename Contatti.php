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
		
		<script>
			
			$(document).ready(function(){
			
			// Vengono fatti apparire i div in successione con delle animazioni.
			
				$("#immagine_contatti").fadeIn(700);
				$("#creatore").delay(500).fadeIn(700);

				});
		</script>
		
		<link href="./stili/stile.css" rel="stylesheet" type="text/css" />
		<title>Contatti</title>
	</head>
	<body>
	<div class="container">
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

	<div class="titolo">Contatti</div>
	<div id="container_contatti">
		<div id="immagine_contatti" hidden="true">
			<img src="./immagini/unibs.png" width="300" height="300"></img>
		</div>
		<div id="creatore" hidden="true">
		Autore: Dario Pellegrini<br>
		Matricola: 90871<br>
		Email: <a href="mailto:pellegrini.dario.1303@gmail.com">pellegrini.dario.1303@gmail.com</a>	
		</div>
		
	</div>
	</body>
</html>