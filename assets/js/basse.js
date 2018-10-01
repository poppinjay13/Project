Function EnableSubmit = function(val){
    var sbmt = document.getElementById("Accept");
    if (val.checked == true){
		sbmt.disabled = false;
	}else{
        sbmt.disabled = true;
    }
};