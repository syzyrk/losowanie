<?php

function createLogFile($name, $event) {
    $folder = "logs";
    $file = $folder . '/' . $name . '.log';
    $content = "Użytkownik \"".$name."\"\n";
    $content .= "[" . date("d/m/Y H:i:s") . "] " . $event. ".";
    file_put_contents($file, $content);
}

function logFileAddEvent($name, $event) {
    $folder = "logs";
    $file = $folder . '/' . $name . '.log';
    $content = "[" . date("d/m/Y H:i:s") . "] " . $event. ".";
    file_put_contents($file, PHP_EOL . $content, FILE_APPEND);
}

function readLogFile($name) {
    $folder = "logs";
    $file = $folder . '/' . $name . '.log';
    if(file_exists($file)) {
        return file_get_contents($file);
    } else {
        return false;
    }
}

function deleteLogFile($name) {
    $folder = "logs";
    $file = $folder . '/' . $name . '.log';
    if (file_exists($file)) {
        $content = readLogFile($name);
        unlink($file);
        $file = $folder . '/removed/' . $name . '.log';
        file_put_contents($file, $content);
        return true;
    } else {
        return false;
    }
}

function getOS() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform  = "Unknown OS";
    $os_array     = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }
    return $os_platform;
}

function ipApi($x) {
    $json = file_get_contents('http://ip-api.com/json');
    $apiIP = json_decode($json, true);
    
    return $apiIP[$x];
}

?>
