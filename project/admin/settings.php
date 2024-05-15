<?php
include "../db_conn.php";
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$date1 = validate($_POST['date1']);
$date2 = validate($_POST['date2']);
$active1 = isset($_POST['active1']) ? validate($_POST['active1']) : '';
$active2 = isset($_POST['active2']) ? validate($_POST['active2']) : '';

if(empty($active1)){
    $active1 = 'off';
}
if(empty($active2)){
    $active2 = 'off';
}

$sql = "UPDATE ustawienia SET aktywnaStrona='$active1' WHERE id='1'";
$sql_2 = "UPDATE ustawienia SET aktywneLosowanie='$active2' WHERE id='1'";
$sql_3 = "UPDATE ustawienia SET dataLosowania='$date1' WHERE id='1'";
$sql_4 = "UPDATE ustawienia SET dataMikolajek='$date2' WHERE id='1'";


mysqli_query($conn, $sql);
mysqli_query($conn, $sql_2);
mysqli_query($conn, $sql_3);
mysqli_query($conn, $sql_4);


header("Location: ./?message=Pomyślnie zmieniono ");
exit();




?>