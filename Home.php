<?php
	include "dbUtilities.php";
	session_start();
	if(!isset($_SESSION['login']))
			header("Location: index.php");
		
	$username=$_SESSION['username'];
	$informazioni=getInformations($username);
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script type="text/javascript" src="./js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="./js/home.js"></script>
		<link href="./stili/stile.css" rel="stylesheet" type="text/css"/>
		
		<script>
			$(document).ready(function(){
			
			// Vengono fatti apparire i div in successione con delle animazioni.
			
				$("#saluto").fadeIn(700);
				$("#premi_play").delay(500).fadeIn(700);
				$("#start_button").delay(1000).slideDown(700);

				});
		</script>
		
		<title>Home</title>
	</head>
	<body>
	<div id="menu-wrapper">
		<div id="menu">
		<ul>
			<li><a href="Home.php">Homepage</a></li>
			<li><a href="Gioco.php">Gioco</a></li>
			<li><a href="Classifica.php">Classifica</a></li>
			<li><a href="Contatti.php">Contatti</a></li>
			<?php
				echo "<li><a href=\"Utente.php\">".$username."</a><li>"
			?>
		</ul>
		</div>
	</div>
	<div class="titolo">Homepage</div>
	<div id="page" class="container">
		<div id="saluto" class="testo" hidden="true">Ciao <?php echo $informazioni['nome']."!<br><br>" ?>Questa &egrave; la Homepage del 			sito di Arkanoid Online.</div>
		<div id="premi_play" class="testo" hidden="true" >Premi il tasto PLAY per giocare...</div>
		<div id="start_button" class="start_button" hidden="true">
			<a href="Gioco.php"><img src="./immagini/launch-start-button.png" width="200" height="200"></a>
		</div>
	</div>
	</body>
</html>