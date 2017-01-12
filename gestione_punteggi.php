<?php
	include "dbUtilities.php";
	session_start();
	if(!isset($_SESSION['login']))
			header("Location: index.php");
		
	$username=$_SESSION['username'];
	$informazioni = getInformations($username);
	$punteggi = getUserScores($username);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script type="text/javascript" src="./js/jquery-1.9.1.js"></script>
		<link href="./stili/stile.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="./js/gestione_punteggi.js"></script>

		<title>Gestione punteggi</title>
			</head>
<body>
<div class="titolo">Gestione punteggi di <?php echo $username ?></div>
<?php

// Viene stampata una tabella con la lista dei punteggi e i tasti e le checkbox per l'eliminazione.
	echo "<table id=\"box-table-a\">
					<thead><tr>
						<td>Posizione</td>
						<td>Punti</td>
						<td>Data</td>
						<td>Elimina</td>
						<td><a href=\"#\" onclick=\"eliminaSelezionati(".sizeof($punteggi).")\">Cancella</td>
					</tr></thead>";
					
			$i=0;
			foreach($punteggi as $elemento) {
			
			// Ogni checkbox ha un nome incrementale e come valore l'id dell'elemento corrispondente.
				
			//	if($i<50){
				echo "<tr>
						<td>".$elemento['posizione']."</td>
						<td>".$elemento['punti']."</td>
						<td>".$elemento['data']."</td>
						<td><a href=\"#\" onclick='eliminaSingolo(".$elemento['id'].")'>X</a></td>
						<td><input id=\"checkbox_".$i."\" value=\"".$elemento['id']."\" type=\"checkbox\"/></td>
						</tr>";
						$i++;
						}
			//	}

			echo "</table>";
			echo "<div id=\"checkbox_modificators\">
					<a  href=\"#\" onclick=\"selezionaTutti(".sizeof($punteggi).")\">Seleziona tutti /</a>
					<a  href=\"#\" onclick=\"deselezionaTutti(".sizeof($punteggi).")\"> Deseleziona tutti</a>
					</div>";
?>
<br>

<div  style="text-align: center;">
<a  href="Utente.php">Torna alla pagina dell'utente</a>
</div>
</body>
</html>

