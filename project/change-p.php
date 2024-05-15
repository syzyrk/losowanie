<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    include "db_conn.php";

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);

    if(empty($op)){
      header("Location: change-password.php?error=Stare hasło jest wymagane");
	  exit();
    }else if(empty($np)){
      header("Location: change-password.php?error=Nowe hasło jest wymagane");
	  exit();
    }else if($np !== $c_np){
      header("Location: change-password.php?error=Hasła są różne");
	  exit();
    }else {
        $pHashed = password_hash($np, PASSWORD_ARGON2I);
        $id = $_SESSION['id'];

        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($op, $row['password'])) {
                if ($np === $op && $c_np === $op){
                    header("Location: change-password.php?error=Nowe hasło nie może być takie samo jak poprzenie");
                    exit();
                }else {
                    $sql_2 = "UPDATE users SET password='$pHashed' WHERE id='$id'";
                    mysqli_query($conn, $sql_2);
                    header("Location: change-password.php?success=Hasło zostało zmienione pomyślnie");
                    exit();
                }
            } else {
                header("Location: change-password.php?error=Złe hasło");
                exit();
            }
        } else {
            header("Location: change-password.php?error=Błąd. Spróbuj jeszcze raz");
            exit();
        }

    }

    
}
else{
	header("Location: change-password.php");
	exit();
}

}else{
    header("Location: index.php");
    exit();
}