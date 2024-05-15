<?php
    include "../db_conn.php";
    include "../logs.php";
    $userID = $_POST['id'];
    $sqlUser = "SELECT * FROM users WHERE id=$userID";
    $result = mysqli_query($conn, $sqlUser);
    if ($result->num_rows > 0) {

        $deleteUser = "DELETE FROM users WHERE id=$userID";
        $result = mysqli_query($conn, $deleteUser);
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