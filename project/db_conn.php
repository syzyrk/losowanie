<?php

$sname= "localhost";
$unmae= "id22168924_db";
$password = "";

$db_name = "id22168924_project_db";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
