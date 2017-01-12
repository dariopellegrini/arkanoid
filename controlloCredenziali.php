<?php
	ob_start();
	include "dbUtilities.php";
	session_start();
	
	// Si recuperano username e password con POST controllando eventuali caratteri speciali.
	
	$username = cambia_acc($_POST['username']);
	$password = $_POST['password'];


	// Se il controllo va bene si effettua il login e si ritorna una stringa OK, altrimenti errore.
	
	if(checkCredential($username,$password)){
		echo "OK";
		$_SESSION['login']=true;
		$_SESSION["username"]=$username;
		
		}
		else echo "Errore. Username o password errati."

?>