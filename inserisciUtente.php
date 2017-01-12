<?php
	include "dbUtilities.php";
	session_start();
	
	$username = htmlentities(cambia_acc($_POST['username']));
	$password = htmlentities($_POST['password']);
	$conferma_password = htmlentities($_POST['conferma_password']);
	$name = htmlentities(cambia_acc($_POST['nome']));
	$surname = htmlentities(cambia_acc($_POST['cognome']));
	
	if($username=="") header("Location: index.php"); // Se username è vuoto reindirizza a index.php.
	else
	
	if(checkUserInDB(strtolower($username))==true) echo "Utente non univoco";
		else if($username!=""){
		
			insertUser($username, $password, $name, $surname);
			
			// Una volta effettuata la registrazione la sessione viene avviata.
			
			$_SESSION['login']=true;
			$_SESSION["username"]=$username;
			echo "Utente ".$username." aggiunto con successo.";
		}
		
	//sostituisco le lettere accentate con le relativa entità html
?>