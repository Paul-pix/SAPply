function prelevaForm(){
    var v=parseInt(document.prelevaForm.inputName.value); 
    if(isNaN(v)){                                           //isNaN=is not a number
        
        return true;
    }
    alert("Il nome non può essere un numero");
    return false;
}

function aggiornaFormFialario(){ 
    var t=parseInt(document.aggFform.quantita.value); 
    if(isNaN(t)||t<0){                                           
        alert("La quantità deve essere un numero positivo o zero");
        return false;
    }
    
    return true;
}
function aggiornaFormPresidi(){ 
    var s=parseInt(document.aggFPresidi.quantita.value); 
    if(isNaN(s)||s<0){                                           
        alert("La quantità deve essere un numero positivo o zero");
        return false;
    }
    
    return true;
}
function aggiungiFormFialario(){ 
    var t=parseInt(document.aggFform2.quantita.value); 
    if(isNaN(t)||t<0){                                           
        alert("La quantità deve essere un numero positivo o zero");
        return false;
    }
    
    return true;
}


