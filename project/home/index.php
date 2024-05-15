<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    include "../db_conn.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Losowanie mikołajkowe</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function wylogujSie() {
            window.location.href = "../logout.php";
        }

        function zmienHaslo() {
            window.location.href = "../change-password.php";
        }

        <?php
            $sql = "SELECT * FROM users WHERE id='" . $_SESSION['id'] . "'";
            $result = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_assoc($result)) {
                $nrUcznia = $row['idUcznia'];
                echo "let nrUcznia =" . $nrUcznia . ";";
            }
        ?>
        document.addEventListener("DOMContentLoaded", function() {
            if (nrUcznia == 0) {
                document.getElementById("error").innerHTML = "<h1 class='error'>Uwaga! Nie jesteś przypisany do grupy uczniów!</h1>";
            }
        });
    </script>
</head>
<body>

<?php
    if ($_SESSION['user_name'] == 'admin') {
        header("Location: ../admin/");
        exit();
    }
?>

<span id="error"></span>
<h1>Witaj, <?php echo $_SESSION['name']; ?></h1>

<input type="button" value="Zmień hasło" onclick="zmienHaslo()">
<input type="button" value="Wyloguj się" onclick="wylogujSie()">
</body>
</html>

<?php
} else {
    header("Location: ../index.php");
    exit();
}
?>
