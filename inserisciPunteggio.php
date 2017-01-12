<?php
	include "dbUtilities.php";
	session_start();
	if(!isset($_SESSION['login']))
			header("Location: index.php");
		
	$username=$_SESSION['username'];
	$points = $_POST['punti'];
	if($points=="") header("Location: index.php");
	else
	insertScore($username,$points);
?>