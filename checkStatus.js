var Status = 0;
function setStatus(into) {
  Status = into;
}
function checkStatus(funkcja){
    switch(Status){
        case 0:
            console.log("Wywołuję funkcję\n" + funkcja)
            funkcja()
            return true;
        case 1:
            console.log("Zajęty! Nie wywołuję");
            return false;
        default:
            console.log("Default");
            return false
    }
}
