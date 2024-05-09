<?php

function createLogFile($name, $event) {
    $logFileName = $folder . '/' . $name . '.log';
    $logContent = date('d/m/Y H:i:s') . ' ' . $event;
    file_put_contents($logFileName, $logContent);
}

function logFileAddEvent($name, $event) {
    $logFileName = $folder . '/' . $name . '.log';
    $logContent = "\n" . date('d/m/Y H:i:s') . ' ' . $event;
    file_put_contents($logFileName, $logContent, FILE_APPEND);
}

$folder = "logs";
createLogFile("example", "Log created", $folder);
logFileAddEvent("example", "New event added", $folder);

?>