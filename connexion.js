function fonction() {
    var Checkbox = document.getElementById("info");
    var   infoa = document.getElementById("infoa");
    if(Checkbox.checked == true) {
        infoa.style.display = "block" ;
    } else {
        infoa.style.display = "none" ;
    }
}

function fonctiona() {
    var Checkbox1 = document.getElementById("immob") ;
    var immoba = document.getElementById("immoba") ;
     if(Checkbox1.checked == true) {
         immoba.style.display = "block" ;
     } else {
         immoba.style.display = "none" ;
     }
}



function functionb() {
    var checkbox = document.getElementById("tel") ;
    var txt = document.getElementById("Tel");
    if(checkbox.checked == true) {
        txt.style.display = "block" ;
    } else {
        txt.style.display = "none" ;
    }
}