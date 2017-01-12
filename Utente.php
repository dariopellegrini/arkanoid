<?php
	include "dbUtilities.php";
	session_start();
	if(!isset($_SESSION['login']))
			header("Location: index.php");
		
	$username=$_SESSION['username'];
	$punteggi = getUserScores($username);
	
	$errore_caricamento_immagine = false;
?>

<?php

	
		// Caricamento immagine.
			
			foreach($_FILES as $nome_file=>$descrittore){
			$tmp_name = $descrittore["tmp_name"];
			$name = $descrittore["name"];
			$type = $descrittore["type"];
			$size = $descrittore["size"];
			
			if(substr($type,0,5)!="image") echo  "<script> alert(\"Errore: il file non &egrave; un'immagine.\");</script>";
			else
			
				if(is_uploaded_file($tmp_name)){
					move_uploaded_file($tmp_name, "immagini/$name");
					uploadImage($username,"immagini/$name");
					}
			else
				echo "Errore nell'upload.";
			}


// Recupero informazioni sull'utente.
	$informazioni = getInformations($username);	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script type="text/javascript" src="./js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="./js/caricamento_immagine.js"></script>
		<link href="./stili/stile.css" rel="stylesheet" type="text/css" />
		<title><?php echo $informazioni['nome']." ".$informazioni['cognome']?></title>
		<script>
		
		// Passo alla pagina logout in AJAX un valore per verificare che il logout venga effettuato solo alla pressione del
		// tasto e non inserendo il solo URL nella pahina degli indirizzi.
		
			function effettua_logout(){
				$.ajax({
					type: "POST",
					url: "logout.php",
					data: "check=logout",
					cache: false,
					success: function(dat) {
						window.location.reload(); //Se il logout è andato bene ricarico la pagina.
					}});
			}
			
			var abbassato_form=false;
			function abbassaForm(){
				if(abbassato_form==false)
					$("#image_change").slideDown();
					
					
				else
					$("#image_change").slideUp();
					
				abbassato_form=!abbassato_form;
			}
		</script>
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
			<li><a href="#" onclick="effettua_logout()">Logout</a></li>
		</div>
	</div>
		

	<div class="titolo">Profilo utente</div>
	<div class="pagina">
		<div class="immagine_utente">
		<?php
			echo "<a href=\"#\" onclick=\"abbassaForm()\"><img id=\"immagine_utente\"  src=\"".$informazioni['immagine']."\"></a>";
		?>
		</div>
		
		<div id="image_change" hidden="true">
		<form action="Utente.php" enctype="multipart/form-data" method="post">
			<input type="file" name="fileupload" method="post">
			<input type="submit" name="upload" value="Cambia immagine">
		</form>
		</div>
		
		<div class="informazioni_utente">
		<?php
			echo "
			Username: ".$username. "<br>
			Nome: ".$informazioni['nome']. " <br>
			Cognome: ".$informazioni['cognome'];
		?>
		</div>
		
		<div id="gestione_punteggi">
			<a href="gestione_punteggi.php">Gestione punteggi</a>
		</div>
		
		<div class="punteggio"><?php
		if($punteggi)
			echo getBestPosition($username)."&deg; - ".$punteggi[0]['punti']." punti.";
		else
			echo "Nessun punteggio disponibile."
		?></div>
		
	</div>
	<div id="errore_immagine"></div>
	</body>
</html>