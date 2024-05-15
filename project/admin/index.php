<?php 
session_start();

include "../logs.php";
include "../db_conn.php";

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

  if ($_SESSION['user_name'] != 'admin') {
    header("Location: ../home");
    exit();
  }

$sql = "SELECT * FROM ustawienia WHERE id='1'";
$ustawienia = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($ustawienia)) { 
    echo '<script>';
    echo 'var aktywnaStrona = "', $row['aktywnaStrona'], '";';
    echo 'var aktywneLosowanie = "', $row['aktywneLosowanie'], '";';
    echo 'var dataLosowania ="', $row['dataLosowania'], '";';
    echo 'var dataMikolajek ="', $row['dataMikolajek'], '";';
    echo '</script>';

}
if (isset($_GET['userID'])) {
  $userID = $_GET['userID'];
  echo "<script>setTimeout(function() { userPage(); }, 100);</script>";
}
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<title>Panel administracyjny</title>
<link rel="stylesheet" href="styles.css">
<script defer src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="userActions.js"></script>
<script src="view.js"></script>
<script src="../usefullFunctions.js"></script>
<script src="../sendMail.js"></script>
<?php if (isset($_GET['message'])) { ?>
     		<p class="message"><?php echo '<script>alert("', $_GET['message'], '")
        window.location.href = "../admin";
        </script>'?></p>
     	<?php } ?>
</head>
<body onload="setTimeout(showPage, 1000)">
<div id="loader"></div>
<div id="body" style="display: none;">
<header>
<div class="header">
  <span><p class="podpisUzytkownika" onclick="toggleLogoutPanel()">
  <b><?php echo $_SESSION['name']; ?></b></p></span>
  <div id="logoutPanel" style="display: none;">
    <a href="../logout.php" class="logout">Wyloguj się</a>
  </div>
</div>
</header>
<div class="sidenav">
  <a href="#" onclick="toUsers()">Użytkownicy</a>
  <a href="#" onclick="toSettings()">Ustawienia</a>
  <a href="../../phpmyadmin/index.php?route=/database/structure&server=1&db=test_db" target="_blank">phpmyadmin</a>
  <a href="#" onclick="openModal(1,'Test', 'Test2', 2)">Test modal</a>
</div>
<div id="main">
  
</div>


<div class="modal" id="modal">
    <div class="modal-header">
      <div class="title"></div>
      <button data-close-button class="close-button">&times;</button></div>
    <div class="modal-body">
      <h2>teścik</h2>
      <div class="buttons"><button>Hejka</button><button>Hejka2</button></div>
    </div>
</div>
<div id="overlay"></div>
</div>


<script>
  function toUsers(){
    refreshData(); 
    var message = `<div class="userData">
      <input id="searchUser" type="text" placeholder="Szukaj użytkowników...">
      <h2>Dane użytkowników:</h2>
      <table border=1 id="table">
      <thead>
      <tr>
        <td></td><th>Nazwa użytkownika</th><th>Nazwa</th>
      </tr>
      </thead>
      <tbody id="userTable">
      <?php
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            $index = 0;
            foreach ($row as $key => $value) {
                $index++;
                if ($index == 1){
                    $id = $value;
                    echo '<td><input type="checkbox" value="'.$id.'"><td>';
                }
                if ($index > 1 && $index <= 3) {
                  echo '<td><a href="#" onclick="userPage('."'".$id."'".');">'. $value .'</a></td>';
                }
            }
            echo '</tr>';
        }
      ?>
      </tbody>
    </table>
    </div>`;  
    $(document).ready(function(){
      $("#searchUser").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#userTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    changeMain(message);
}


</script>
   
</body>
</html>
<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>
