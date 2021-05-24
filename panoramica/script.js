function prelevaForm(){
    var v=parseInt(document.prelevaForm.inputName.value); 
    if(isNaN(v)){                                           //isNaN=is not a number
        
        return true;
    }
    alert("Il nome non può essere un numero");
    return false;
}