/* Controlli fatti: campo vuoto, caratteri speciali, lunghezza dei campi. */

function controlloUtente(){

	var caratteri_speciali = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?„Ω€®™æ¨œøπåß∂ƒ∞∆ªªº¬¶∑†©√∫˜µ…•«“‘¥~‹÷´`≠¡ˆ`";
	
	var verify=true;
	var username = $("#username").val();
	username = username.replace(/^\s+|\s+$/g,""); // Trim degli spazi.
	username = username.replace(/ +/g, " "); // Eliminazione degli spazi multipli
	
	var password = $("#password").val();
	var conferma_password = $("#conferma_password").val();
	
	var nome = $("#nome").val();
	nome = nome.replace(/^\s+|\s+$/g,"");
	nome = nome.replace(/ +/g, " ");
	
	var cognome = $("#cognome").val();
	cognome = cognome.replace(/^\s+|\s+$/g,"");
	cognome = cognome.replace(/ +/g, " ");
	
	if(username=="" || username==" "){$("#errore_username").text("Nome utente non inserito"); verify=false;}
		else if(username.length>30){$("#errore_username").text("Lo username deve contenere massimo 30 caratteri"); verify=false;}
			else if(!validazione(username))
					{$("#errore_username").text("Lo username contiene caratteri speciali"); verify=false;}
			else $("#errore_username").text("");
	
	if(password==""){$("#errore_password").text("Password non inserita"); verify=false;}
		else if(password.length>32){$("#errore_password").text("La password deve contenere massimo 32 caratteri"); verify=false;} 
			else if(password!=conferma_password){$("#errore_password").text("Le password non sono uguali"); verify=false;}
				else if(!validazione(password))
					{$("#errore_password").text("La password contiene caratteri speciali"); verify=false;}
				else $("#errore_password").text("");
	
	
	if(nome=="" || nome==" "){$("#errore_nome").text("Nome non inserito"); verify=false;}
		else if(!validazione(nome))
					{$("#errore_nome").text("Il nome contiene caratteri speciali"); verify=false;}
		else $("#errore_nome").text("");
		
	if(cognome=="" || cognome==" "){$("#errore_cognome").text("Cognome non inserito"); verify=false;}
		else if(!validazione(cognome))
					{$("#errore_cognome").text("Il cognome contiene caratteri speciali"); verify=false;}
		else $("#errore_cognome").text("");
	
	if(verify==true){

	$.ajax({
		type: "POST",
		url: "inserisciUtente.php",
		data: "username="+username+"&password="+password+"&nome="+nome+"&cognome="+cognome,
		cache: false,
		success: function(dat) {
			$("#errore_password").text("");
			if(dat=="Utente non univoco")$("#errore_username").text(dat);
				else{
					nascondiForms();
					$("#to_login").text("Entra nel sito")
					}
			}

		});
		}	
}

function nascondiForms(){
	$("#utente_inserito").fadeIn();
	$("#utente_inserito").slideDown();
	$("#signup_container").slideUp();
	
}

function validazione(str) {
   	var caratteri_speciali = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?„Ω€®æ¨œøπåß∂ƒ∞∆ªªº¬¶∑†©√∫˜µ…•«“‘¥~‹÷´`≠¡ˆ`";

    for (var i = 0; i < str.length; i++) {
       if (caratteri_speciali.indexOf(str.charAt(i)) != -1) {
        //   alert ("File name has special characters ~`!#$%^&*+=-[]\\\';,/{}|\":<>? \nThese are not allowed\n");
           return false;
       }
    }
    return true;
}
