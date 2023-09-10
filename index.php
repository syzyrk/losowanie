<?php
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "login") {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    //obiektowo
    $db = new mysqli("localhost", "root", "", "auth");

    //strukturalnie 
    //$d = mysqli_connect("localhost", "root", "", "auth");
    //mysqli_query($d, "SELECT * FROM user");


    //ręcznie:
    //$q = "SELECT * FROM user WHERE email = '$email'";
    //echo $q;
    //$db->query($q);

    //prepared statements
    $q = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
    //podstaw wartości
    $q->bind_param("s", $email);
    //wykonaj
    $q->execute();
    $result = $q->get_result();

    $userRow = $result->fetch_assoc();
    if ($userRow == null) {
        //konto nie istnieje
        echo "<script>alert('Błędny login lub hasło')</script>'";
    } else {
        //konto istnieje
        if (password_verify($password, $userRow['passwordHash'])) {
            //hasło poprawne
            echo "<script>alert('Zalogowano poprawnie')</script>";
        } else {
            //hasło niepoprawne
            echo "<script>alert('Błędny login lub hasło')</script>";
        }
    }
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "register") {
//rejestracja nowego użytkownika
    $db = new mysqli("localhost", "root", "", "auth");
    $email = $_REQUEST['email'];
    //wyczyść email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = $_REQUEST['password'];
    $passwordRepeat = $_REQUEST['passwordRepeat'];

    if($password == $passwordRepeat) {
        //hasła są identyczne - kontynuuj
        $q = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        $q->bind_param("ss", $email, $passwordHash);
        $result = $q->execute();
        if($result) {
            echo "<script>alert('Konto utworzono poprawnie')</script>"; 
        } else {
            echo "<script>alert('Coś poszło nie tak!')</script)";
        }
    } else {

        echo "<script>alert('Hasła nie są zgodne - spróbuj ponownie!')</script>";
    }
}



?>
<h1>Zaloguj się</h1>
<form action="index.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <input type="hidden" name="action" value="login">
    <input type="submit" value="Zaloguj">
</form>
<h1>Zarejestruj się</h1>
<form action="index.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <label for="passwordRepeatInput">Hasło ponownie:</label>
    <input type="password" name="passwordRepeat" id="passwordRepeatInput">
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Zarejestruj">
</form>
<style>
        /* Możesz również dodać styl bezpośrednio w sekcji <style> */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 10px;
            margin-top: 10px;
            background-color: #ff6b6b;
            border: 1px solid #ff4242;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }
    </style>