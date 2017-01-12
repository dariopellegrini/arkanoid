<?php
	session_start();
	if(isset($_SESSION['login'])){
			header("Location: Home.php");
		}
?>
<html>
	<head>
		<title>Inserimento utente</title>
		<link href="./stili/stile.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="./js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="./js/inserimento_utente.js"></script>
	</head>
	
	<body>
	<h1 class="signup_others" id="utente_inserito" hidden="true">Utente inserito con successo</h1>
	
		<div id="signup_container">
			
			<h1> Inserimento nuovo utente </h1><br>
			
			<label>Inserire un nome utente: </label><br>
			<input type="text" id="username"/><div class="errore" id="errore_username"></div><br>
					
			<label>Selezionare una password: </label><br>
			<input type="password" id="password"/><div class="errore" id="errore_password"></div><br>
					
			<label>Confermare la password: </label><br>
			<input type="password" id="conferma_password"/><div></div><br>
					
			<label>Inserire un nome: </label><br>
			<input type="text" id="nome"/><div class="errore" id="errore_nome"></div><br>
					
			<label>Inserire un cognome: </label><br>
			<input type="text" id="cognome"/><div class="errore" id="errore_cognome"></div><br>
					
			<input type="submit" name="invio" value="Inserisci" onclick="controlloUtente()">
			
			


		</div>
	<div id="signup_others" class="signup_others">
		<a id="to_login" href="index.php">Pagina di login</a>
	</div>

	</body>
</html>
