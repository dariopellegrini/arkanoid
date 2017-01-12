<?php
	ob_start();
	include "dbUtilities.php";
	session_start();
	
	$id=$_POST['id'];
	
	if($id=="") header("Location: index.php");
	else{
		if(!isset($_SESSION['login']))
			echo "Login non effettuato.";

		else{
			deleteScore($id);
			echo "Punteggio eliminato.";
		}

	}	
?>