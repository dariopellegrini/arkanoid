/* Chiamata AJAX per la cancellazione del punteggio. */

function funzioneCancella(elemento){
						$.ajax({
						type: "POST",
						url: "cancellazionePunteggio.php",
						data: "id="+elemento,
						cache: false,
						success: function(dat) {
							
							// Aggiorno la tabella.
							$("#box-table-a").load(location.href+" #box-table-a","slow");
				//	location.reload();
							
						}
						});
}

/* Elimina il singolo punteggio. */

function eliminaSingolo(elemento){
	if (confirm('Confermare la cancellazione di questo punteggio?')) { 
	funzioneCancella(elemento);
 }
}

/* Elimina i punteggi selezionati dalla checkbox. */

function eliminaSelezionati(length){

	var uno_selezionato = false; // Variabile per la richiesta della domanda.
	
	for(var counter=0; counter<length; counter++){
			if($("#checkbox_"+counter).is(':checked'))
				uno_selezionato=true;
		}

		if(uno_selezionato==false) return;
		
	if (confirm('Confermare la cancellazione di questi punteggi?')) {
		for(var counter=0; counter<length; counter++){
			if($("#checkbox_"+counter).is(':checked'))
			funzioneCancella($("#checkbox_"+counter).val());
		}
 }
	

}

function selezionaTutti(length){
	for(var counter=0; counter<length; counter++){
		$("#checkbox_"+counter).prop('checked', true);

	}
}

function deselezionaTutti(length){
	for(var counter=0; counter<length; counter++){
		$("#checkbox_"+counter).prop('checked', false);

	}
}
			


