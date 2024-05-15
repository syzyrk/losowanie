var status = 0;

function checkStatus(funkcja){
    switch(status){
        case 0:
            funkcja();
            return true;
        case 1:
            return false;
        default: 
            return false;
    }
}

checkStatus(function(){
    console.log("siema");
    console.log("hejka")
})