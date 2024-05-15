<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Zmień hasło</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		function wylogujSie(){
			window.location.href = "logout.php";
		}
	</script>
</head>
<body>
    <form action="change-p.php" method="post">
     	<h2>Zmień hasło</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
         <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
     	<label>Stare hasło</label>
     	<input type="password" name="op"><br>

     	<label>Nowe hasło</label>
     	<input type="password" name="np" ><br>

        <label>Powtórz nowe hasło</label>
     	<input type="password" name="c_np" ><br>

     	<button type="submit">Zmień hasło</button>
		 <a href="home/." class="ca">POWRÓT</a>
    </form>
</body>
</html>



<?php 
} else {
	header("Location: index.php");
	exit();
}

 ?>