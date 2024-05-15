<?php

$sname= "localhost";
$unmae= "id22168924_db";
$password = "Sp12nara!";

$db_name = "id22168924_project_db";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}