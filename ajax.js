var response;

function getValue() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response = this.responseText;
      getAjaxValue(response;
    }
  };
  xhttp.open("GET", "get_value.php", true);
  xhttp.send();
}

function getAjaxValue(ajax) {
  return ajax;
}