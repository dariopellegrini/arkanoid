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
		<link href="./stili/stile.css" rel="stylesheet" type="text/css" />
		<title>Classifica</title>
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

	<div class="titolo">Classifica generale</div>
	<div class="pagina">
		<?php
		$score = getUserScores($username);
		$points = $score[0]['punti'];
			printScores($username,$points);
		?>
	</div>
	</body>
</html>