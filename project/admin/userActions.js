function deleteUser(id){
    var data = new FormData();
    data.append("id", id);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
      console.log(this.responseText)
    }
    xhttp.open("POST", "deleteUser.php");
    xhttp.send(data);
}

function changePass(id){
    var pass = "1234";
    var data = new FormData();
    data.append("id", id);
    data.append("pass", pass)
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
      console.log(this.responseText)
    }
    xhttp.open("POST", "changePass.php");
    xhttp.send(data);
}

function writeMail(id){
    var data = new FormData();
    data.append("id", id);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
      console.log(this.responseText)
    }
    xhttp.open("POST", "writeMail.php");
    xhttp.send(data);
}

function exitSession(id){
    var data = new FormData();
    data.append("id", id);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
      console.log(this.responseText)
    }
    xhttp.open("POST", "exitSession.php");
    xhttp.send(data);
}