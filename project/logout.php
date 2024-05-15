<?php 
include "logs.php";

session_start();
if (ipApi("status") !== "success"){
    $logEvent = "Wylogowano się z konta z urządzenia ".getOS().". Brak informacji o IP";
}
else {
    $logEvent = "Wylogowano się z konta z urządzenia ".getOS().". IP: ".ipApi("query")." (".ipApi("org")." - ".ipApi("city").", ".ipApi("country").")";
}
logFileAddEvent($_SESSION['user_name'], $logEvent);
session_unset();
session_destroy();


header("Location: index.php");

?>