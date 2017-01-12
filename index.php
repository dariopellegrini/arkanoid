<?php
	ob_start();
	include "dbUtilities.php";
	session_start();
//	session_destroy();
?>
<html>
	<head>
		<title>Arkanoid</title>
		<link href="./stili/stile.css" rel="stylesheet" type="text/css" />
	</head>
	<script type="text/javascript" src="./js/jquery-1.9.1.js"></script>
	
	<script>
		
		function inviaCredenziali(){
			
			var username = $("input[name='username']").val();
			var password = $("input[name='password']").val();
			
			$.ajax({
				type: "POST",
				url: "controlloCredenziali.php",
				data: "username="+username+"&password="+password,
				cache: false,
				success: function(dat) {
					if(dat=="OK") location.reload();
					else
						$("#errore_login").text(dat);
						$("#errore_login").slideDown();
							}
							});
		}
		
	</script>
	
	<body>
	
	
	<h1 id="arkanoid_login">Arkanoid</h1>
	
	<?php

		if(isset($_SESSION['login'])){
			header("Location: Home.php");
		}
		else{
			echo "
			<div id=\"login_container\">
			
			<label class=\"username\">Nome utente: </label><br>
			<input type=\"text\" class=\"username\" name=\"username\"/><br>
			<label class=\"password\">Password: </label><br>
			<input type=\"password\" class=\"password\" name=\"password\"/><br>
			<input type=\"submit\" class=\"submit\" name=\"invio\" value=\"Login\" onclick=\"inviaCredenziali()\">
			<div id=\"errore_login\" class=\"errore\" hidden=true></div><br>
			<a href=\"inserimento_utente.php\">Inserimento nuovo utente</a>
			</div>
			";
		}
		
	?>

	</body>
</html>