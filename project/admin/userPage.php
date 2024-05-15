<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    .userCard{
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;  
    }
    i {font-size: 30px;}
    h2 {display: inline;}

    
    a.actions:link, a.actions:visited {
        background-color: #3669f4;
        color: white;
        padding: 14px 25px;
        text-decoration: none;
        display: inline-block;
    }

    a.actions:hover, a.actions:active {
        background-color: rgb(86, 154, 83);
    }
    #closeSession:hover{
        background-color: red;
    }
    #turnBack {
        text-decoration: none;
        color: black;
    }
</style>
<?php
    include "../db_conn.php";
    $userID = $_POST['id'];
    $sqlUser = "SELECT * FROM users WHERE id=$userID";
    $result = mysqli_query($conn, $sqlUser);
    if ($result->num_rows > 0) {
        $rowData = $result->fetch_assoc();
        $nick = $rowData["user_name"];
        $name = $rowData["name"];
        $pass = $rowData["password"];
        $lastLogin = $rowData["lastLogin"];
    } else {
        echo "Jest problem :)";
    }
?>

<script type="text/javascript"> 
    var lastLogin =  new Date('<?php echo $lastLogin; ?>');
    var currentTime = new Date(); 
    var timeDifference = Math.abs(currentTime - lastLogin) / 1000; 

    if (timeDifference < 60) {
        console.log(Math.round(timeDifference) + " sekund(y)");
    } else if (timeDifference < 3600) {
        console.log(Math.round(timeDifference / 60) + " minut(y)");
    } else if (timeDifference < 86400){ 
        console.log(Math.round(timeDifference / 3600) + " godzina(y)");
    } else {
        console.log(Math.floor(timeDifference / 86400) + " dzień/dni");
    }
</script>

<div class="userCard">
    <a href="#" id="turnBack" onClick="checkStatus(function() {
    toUsers();
    });"><i class="fa-solid fa-circle-arrow-left"></i>&nbsp;<h2>POWRÓT</a></h2>
    <h1><?php echo $name ?></h1><br>
    <i class="far fa-envelope"></i><h2>&nbsp;</h2><br>
    <i class="fa-solid fa-calendar-days"></i><h2>&nbsp;<?php echo $lastLogin; ?></h2><br>
    <br><br>
    <h1>Akcje:</h1>
    <a href="#" class="actions" onclick="deleteUser(<?php echo $userID; ?>)"><i class="fa-solid fa-trash-can"></i><h2>&nbsp;Usuń użytkownika</h2><br></a>
    <a href="#" class="actions" onclick="changePass(<?php echo $userID; ?>)"><i class="fa-solid fa-key"></i><h2>&nbsp;Zmień hasło</h2><br></a>
    <a href="#" class="actions" onclick="writeMail(<?php echo $userID; ?>)"><i class="fa-regular fa-message"></i><h2>&nbsp;Napisz e-maila</h2><br></a>
    <a href="#" class="actions" onclick="exitSession(<?php echo $userID; ?>)" id="closeSession"><i class="fa-solid fa-power-off"></i></i><h2>&nbsp;Wyłącz sesję</h2></a>
</div>