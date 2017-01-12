
				
			
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