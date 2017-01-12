<?php
include "dbUtilities.php";
session_start();
	if(!isset($_SESSION['login']))
			header("Location: index.php");
		
$username=$_SESSION['username'];





foreach($_FILES as $nome_file=>$descrittore){
			$tmp_name = $descrittore["tmp_name"];
			$name = $descrittore["name"];
			$type = $descrittore["type"];
			$size = $descrittore["size"];
			
			
			if(substr($type,0,6)!="image/") echo "Errore: il file non e' un jpeg...";
			else
			
				if(is_uploaded_file($tmp_name)){
					move_uploaded_file($tmp_name, "immagini/$name");
					uploadImage($username,"immagini/$name");
					echo "Immagine inserita.<br><a href=\"Utente.php\">Torna alla pagina dell'utente</a>";
					}
			else
				echo "Errore nell'upload.";
			}
	?>
