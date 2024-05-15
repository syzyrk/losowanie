<?php 
session_start(); 
include "db_conn.php";
include "logs.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['re_password']);
	$name = validate($_POST['name']);

	$user_data = 'uname='. $uname. '&name='. $name;

	if (empty($uname)) {
		header("Location: signup.php?error=Nazwa użytkownika jest wymagana&$user_data");
	    exit();
	} else if(empty($pass)){
        header("Location: signup.php?error=Hasło jest wymagane&$user_data");
	    exit();
	} else if(empty($re_pass)){
        header("Location: signup.php?error=Wymagane jest ponowne wpisanie hasła&$user_data");
	    exit();
	} else if(empty($name)){
        header("Location: signup.php?error=Nazwa jest wymagana&$user_data");
	    exit();
	} else if($pass !== $re_pass){
        header("Location: signup.php?error=Hasła się różnią&$user_data");
	    exit();
	} else {
        $hashed_password = password_hash($pass, PASSWORD_ARGON2I);

	    $sql = "SELECT * FROM users WHERE user_name='$uname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=Podana nazwa użytkownika jest już w użyciu&$user_data");
	        exit();
		} else {
           $sql2 = "INSERT INTO users(user_name, password, name) VALUES('$uname', '$hashed_password', '$name')";
           $result2 = mysqli_query($conn, $sql2);
		   createLogFile($uname,"Konto zostało utworzone");
           if ($result2) {
           	 header("Location: index.php?success=Pomyślnie utworzono konto. Zaloguj się poniżej");
	         exit();
           } else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
} else {
	header("Location: signup.php");
	exit();
}
