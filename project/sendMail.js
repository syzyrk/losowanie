function sendMail(from, to, replyTo, CC, BCC, attachments, subject, HTML, altBody){
  var data = new FormData();
  data.append("from", from.join(','));
  data.append("to",to.join(','));
  data.append("replyTo", replyTo.join(','));
  data.append("CC", CC.join(','));
  data.append("BCC", BCC.join(','));
  data.append("attachments", attachments.join(','));
  data.append("subject", subject);
  data.append("HTML", HTML);
  data.append("altBody", altBody);

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function(){
    console.log(this.responseText);
  }
  xhttp.open("POST", "../sendMail.php");
  xhttp.send(data);
}