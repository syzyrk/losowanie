<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    header("Location: home/index.php");
    exit();
}
if (isset($_COOKIE['uname'])) {
    echo "<script>
            window.onload = function() {
                document.getElementById('uname').value = '".$_COOKIE['uname']."';
            }
          </script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Logowanie - Losowanie mikołajkowe</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>function toogleVisibilityPassword(){
		var x = document.getElementById("passwordBox");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}	
	}</script>
</head>
<body>
     <form action="login.php" method="post">
     	<h2>Logowanie</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
		 <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
     	<label>Nazwa użytkownika</label>
     	<input type="text" name="uname" id="uname" placeholder="Nazwa użytkownika"><br>

     	<label>Hasło</label>
     	<input type="password" name="password" id="passwordBox" placeholder="Hasło"><br>

		<input type="checkbox" name="showPass" id="showPass" onclick="toogleVisibilityPassword()"><br>
		<label>Pokaż hasło</label><br>

     	<button type="submit">Zaloguj się</button>
          <a href="signup.php" class="ca">Zarejestruj się</a>
     </form>
</body>
</html>
