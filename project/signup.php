<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>Zarejestruj się</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <label>Nazwa wyświetlana</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Nazwa wyświetlana"><br>
          <?php }?>

          <label>Nazwa użytkownika</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="uname" 
                      placeholder="Nazwa użytkownika"><br>
          <?php }?>


     	<label>Hasło</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Hasło"><br>

          <label>Powtórz hasło</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Powtórz hasło"><br>

     	<button type="submit">Zarejestruj się</button>
          <a href="index.php" class="ca">Posiadasz już konto?</a>
     </form>
</body>
</html>