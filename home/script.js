
function validaCodice(){
    var v=parseInt(document.codiceForm.codiceZaino.value); 
    if(isNaN(v)){                                           //isNaN=is not a number
        alert("Il Codice deve essere un numero");
        return false;
    }
    return true;
}
function onScanSuccess(qrCodeMessage) {
	// handle on success condition with the decoded message
}
