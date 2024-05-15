function toggleLogoutPanel() {
  var panel = document.getElementById("logoutPanel");
  if (panel.style.display === "none") {
    panel.style.display = "block";
  } else {
    panel.style.display = "none";
  }
}
  
const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')
const title = document.querySelector('.title');
const content = document.querySelector('.modal-body');


function onLoad(){
  console.log("Uruchamiam funkcje w onLoad");
}

onLoad();
  
closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modal')
    closeModal()
  })
})

function iconModal(nr){
  switch(nr){
    case 0:
      break;
    case 1:
      return "https://cdn-icons-png.freepik.com/512/1409/1409819.png";
    case 2:
      return "https://static-00.iconduck.com/assets.00/process-error-icon-512x512-zmcympnc.png";
    case 3:
      return "https://static-00.iconduck.com/assets.00/info-icon-2048x2048-tcgtx810.png";
    case 4:
      return "https://static-00.iconduck.com/assets.00/success-icon-512x512-qdg1isa0.png";
  }
}
  
function openModal(f, a, b, c, d, e) {
  if (f == true){
    document.querySelector('.modal-header').style.borderBottom = '1px solid black';
    document.querySelector('.modal-header').style.padding = '10px 15px';
    document.querySelector('.modal-body').style.padding = '10px 15px';
    switch (a) {
      case 1:
        title.innerHTML = `<img src="${iconModal(d)}" style="width:15px">&nbsp`;
        title.innerHTML += b;
        content.innerHTML = c;
        break;
      case 2:
        title.innerHTML = `<img src="${iconModal(e)}" style="width:15px">&nbsp`;
        title.innerHTML = b;
        content.innerHTML = c;
        var buttonCode = `<div class="buttons">`;
        if (d.length > 1) {
          for (let i = 0; i < d.length - 1; i++) {
            currentButton = d[i];
            buttonValue = currentButton[0];
            buttonAction = currentButton[1];
            buttonCode += `<button onclick="${buttonAction}" style="margin-right: 10px;">${buttonValue}</button>`;
          }
          currentButton = d[d.length - 1];
          buttonValue = currentButton[0];
          buttonAction = currentButton[1];
          buttonCode += `<button onclick="${buttonAction}">${buttonValue}</button>`;
          buttonCode += "</div>";
          content.innerHTML += buttonCode;
        }
        break;
      case 3:
        content.innerHTML = b;
        document.querySelector('.modal-header').style.borderBottom = '0px';
        document.querySelector('.modal-header').style.padding = '5px 15px';
        document.querySelector('.modal-body').style.paddingTop = '0';
        document.querySelector('.modal-body').style.paddingLeft = '15px';
        document.querySelector('.modal-body').style.paddingBottom = '10px';
        break;
      case 4:
        title.innerHTML = `<img src="${iconModal(e)}" style="width:15px">&nbsp`;
        title.innerHTML = b;
        content.innerHTML = c;
        var inputCode = `<div class="input"><br><input type='text' id="modalInput" value="${d}"></input><button id="submitBtn">Submit</button>`;
        content.innerHTML += inputCode;
        break;
      case 5:
        title.innerHTML = `<img src="${iconModal(e)}" style="width:15px">&nbsp`;
        title.innerHTML = b;
        var imgCode = `<div><img src="${d}" style="float: left; margin: 8px; width: 250px;"></div><div>${c}</div>`;
        content.innerHTML = imgCode;
        break;
      default:
        console.error("Nieprawidłowa wartość a");
        return;
    }

    modal.classList.add('active');
    overlay.classList.add('active');
  }
  
  else if(modal.classList.contains('active')) {
    console.error("Jest już uruchomiony modal!");
    return; 
  }
}
/*openModal(4, "Title", "Content", "Default value", "Icon", function(inputValue) {
  console.log("Twoje imię:", inputValue);
  changeMain("Twoje imię to "+ inputValue);
  closeModal();
});*/



  
function closeModal() {
  if (modal == null) return
  title.innerHTML = "";
  content.innerHTML = "";
  modal.classList.remove('active')
  overlay.classList.remove('active')
}



function toSettings(){
  var message = `<style>.settings {
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      margin: 20px auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .settings h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
  }
  
  .settings form {
      margin-top: 20px;
  }
  
  .settings label {
      color: #555;
      font-size: 14px;
      display: block;
      margin-bottom: 5px;
  }
  
  .settings input[type="checkbox"] {
      margin-bottom: 10px;
  }
  
  .settings input[type="datetime-local"],
  .settings input[type="date"] {
      margin-bottom: 10px;
      width: calc(100% - 20px);
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
  }
  
  .settings input[type="submit"] {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: block;
      margin: 0 auto;
  }
  
  .settings input[type="submit"]:hover {
      background-color: #0056b3;
  }
  .slider-checkbox {
      display: inline-block;
      margin-right: 20px;
  }
  
  .slider-checkbox input {
      opacity: 0;
      width: 0;
      height: 0;
  }
  
  .slider-checkbox label {
      position: relative;
      cursor: pointer;
      display: inline-block;
      width: 60px;
      height: 34px;
      background-color: #ccc;
      border-radius: 34px;
      transition: .4s;
  }
  
  .slider-checkbox label:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      border-radius: 50%;
      transition: .4s;
  }
  
  .slider-checkbox input:checked + label {
      background-color: #2196F3;
  }
  
  .slider-checkbox input:focus + label {
      box-shadow: 0 0 1px #2196F3;
  }
  
  .slider-checkbox input:checked + label:before {
      transform: translateX(26px);
  }
  
  .slider-checkbox span {
      margin-left: 10px;
      vertical-align: middle;
  }
  
  .slider-checkbox {
  display: inline-block;
  margin-right: 20px;
}

  .slider-checkbox input {
      opacity: 0;
      width: 0;
      height: 0;
  }

  .slider-checkbox label {
      position: relative;
      cursor: pointer;
      display: inline-block;
      width: 60px;
      height: 34px;
      background-color: #ccc;
      border-radius: 34px;
      transition: .4s;
  }

  .slider-checkbox label span {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translate(-50%, -50%);
  }

  .slider-checkbox label:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      border-radius: 50%;
      transition: .4s;
  }

  .slider-checkbox input:checked + label {
      background-color: #2196F3;
  }

  .slider-checkbox input:focus + label {
      box-shadow: 0 0 1px #2196F3;
  }

  .slider-checkbox input:checked + label:before {
      transform: translateX(26px);
  }

  .slider-checkbox span {
      margin-left: 10px;
      vertical-align: middle;
  }

  
  
  </style>
  <div class="settings">
  <h2>Ustawienia</h2>
  <form action="settings.php" method="post">
      <div class="slider-checkbox">
          <input type="checkbox" id="active1" name="active1">
          <label for="active1"></label>
          <span>Aktywna stona?</span>
      </div>
      <div class="slider-checkbox">
          <input type="checkbox" id="active2" name="active2">
          <label for="active2"></label>
          <span>Aktywne losowanie?</span>
      </div>
      <label for="date1">Data losowania </label><input type="datetime-local" name="date1" id="date1"><br>
      <label for="date2">Data Mikołajek </label><input type="date" name="date2" id="date2" value="2024-10-12"><br>
      <input type="submit" value="ZAPISZ ZMIANY">
  </form>
</div>`;
  changeMain(message);
  if(aktywnaStrona == 'on'){
    document.getElementById("active1").checked = true;
  }
  else if(aktywnaStrona == 'off'){
    document.getElementById("active1").checked = false;
  }

  if(aktywneLosowanie == 'on'){
    document.getElementById("active2").checked = true
  }
  else if(aktywneLosowanie == 'off'){
    document.getElementById("active2").checked = false;
  }
  document.getElementById("date1").value = dataLosowania;
  document.getElementById("date2").value = dataMikolajek;
  
}

function changeMain(tresc){
  document.getElementById("main").innerHTML = tresc;
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("body").style.display = "block";
}

var Status = 0;
function setStatus(into) {
  Status = into;
}
function checkStatus(funkcja){
    switch(Status){
        case 0:
            funkcja()
            return true;
        case 1:
            if (confirm("Masz niezapisane zmiany. Czy na pewno chcesz kontynuować?") == true) {
                funkcja()
                Status = 0;
            } else {
                console.log("Zajęty! Nie wywołuję")
            }   
            return false;
        default:
            console.log("Default");
            return false
    }
}

function refreshData(){
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function(){
    document.getElementById('userTable').innerHTML = this.responseText;
  }
  xhttp.open("GET", "refresh.php");
  xhttp.send();
}

function userPage(id){
  var data = new FormData();
  data.append("id", id);
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function(){
    changeMain(this.responseText);
  }
  xhttp.open("POST", "userPage.php");
  xhttp.send(data);
}