<?php
    include "../db_conn.php";
    $userID = $_POST['id'];
    $newPass = $_POST['pass'];
    $sqlUser = "SELECT * FROM users WHERE id=$userID";
    $result = mysqli_query($conn, $sqlUser);
    if ($result->num_rows > 0) {
        $newPass = password_hash($newPass, PASSWORD_ARGON2I);
        $updatePass = "UPDATE users SET password='$newPass' WHERE id=$userID";
        $result = mysqli_query($conn, $updatePass);
        if (!$result){
            //Error
        }
        else{
            echo "Udało się!";
        }
    } else {
        //Nie znaleziono użytkownika
    }
?>