<?php 
session_start(); 
include "db_conn.php";
include "logs.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=Nazwa użytkownika jest wymagana");
	    exit();
	} else if(empty($pass)){
        header("Location: index.php?error=Hasło jest wymanagne");
	    exit();
	} else {

		$sql = "SELECT * FROM users WHERE user_name='$uname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);

            if (password_verify($pass, $row['password'])) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
				date_default_timezone_set("Europe/Warsaw");
				$nowDate = date("Y-m-d H:i:s");
				$sql_2 = "UPDATE users SET lastLogin='$nowDate' WHERE id='" . $_SESSION["id"] . "'";
				mysqli_query($conn, $sql_2);
				//setcookie('uname', $_SESSION['user_name'], time() + 3600);
				if (ipApi("status") !== "success"){
					$logEvent = "Zalogowano do konta z urządzenia ".getOS().". Brak informacji o IP";
				}
				else {
					$logEvent = "Zalogowano do konta z urządzenia ".getOS().". IP: ".ipApi("query")." (".ipApi("org")." - ".ipApi("city").", ".ipApi("country").")";
				}
				logFileAddEvent($row['user_name'], $logEvent);
            	header("Location: home/index.php");
		        exit();
            } else {
				if (ipApi("status") !== "success"){
					$logEvent = "Nieudana próba logowania z urządzenia ".getOS().". Brak informacji o IP";
				}
				else {
					$logEvent = "Nieudana próba logowania z urządzenia ".getOS().". IP: ".ipApi("query")." (".ipApi("org")." - ".ipApi("city").", ".ipApi("country").")";
				}
				logFileAddEvent($row['user_name'], $logEvent);
				header("Location: index.php?error=Niepoprawna nazwa użytkownika lub hasło");
		        exit();
			}
		} else {
			if (ipApi("status") !== "success"){
				$logEvent = "Nieudana próba logowania z urządzenia ".getOS().". Brak informacji o IP";
			}
			else {
				$logEvent = "Nieudana próba logowania z urządzenia ".getOS().". IP: ".ipApi("query")." (".ipApi("org")." - ".ipApi("city").", ".ipApi("country").")";
			}
			logFileAddEvent($row['user_name'], $logEvent);
			header("Location: index.php?error=Niepoprawna nazwa użytkownika lub hasło");
	        exit();
		}
	}
	
} else {
	header("Location: index.php");
	exit();
}
