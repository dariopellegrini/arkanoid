<?php
	session_start();

	// Se check non è verificato invece di effettuare il logout si viene mandati alla pagina principale.
	
	$check = $_POST['check'];
	
	if($check!=""){
	
	$_SESSION=array();
	
	session_destroy();
	}
	
	header("Location: index.php");

?>