<?php

$from_data = explode(',', $_POST['from']);
$to = explode(',', $_POST['to']);
$subject = $_POST['subject'];
$HTML = $_POST['HTML'];
$altBody = $_POST['altBody'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = "kzawadzki000@gmail.com";
    $mail->Password   = "chee noao rlxy wuci";
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = "UTF-8";
    
    //Recipients
    $from_email = $from_data[0];
    $from_name = isset($from_data[1]) ? $from_data[1] : null;
    $mail->setFrom($from_email, $from_name);

    foreach ($to as $recipient) {
        $mail->addAddress($recipient);
    }

    if(isset($_POST['replyTo'])){
        $replyTo_data = explode(',', $_POST['replyTo']);
        $replyTo_email = $replyTo_data[0];
        $replyTo_name = isset($replyTo_data[1]) ? $replyTo_data[1] : null;
        $mail->addReplyTo($replyTo_email, $replyTo_name);
    }

    if (!empty($_POST['CC'])) {
        $CC = explode(',', $_POST['CC']);
        foreach ($CC as $DW) {
            $mail->addCC($DW);
        }
    }

    if(!empty($_POST['BCC'])){
        $BCC = explode(',', $_POST['BCC']);
        foreach ($BCC as $UDW){
            $mail->addBCC($UDW);
        }
    }

    //Attachments
    if(!empty($_POST['attachments'])){
        $attachments = explode(',', $_POST['attachments']);
        foreach ($attachments as $file){
            if (isset($file[1])){
                $mail->addAttachment($file[0], $file[1]);
            }
        }
    }

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $HTML;
    $mail->AltBody = $altBody;

    $mail->send();
    echo 'Wiadomość została wysłana';
} catch (Exception $e) {
    echo "Wiadomość nie mogła zostać wysłana. Błąd : {$mail->ErrorInfo}";
}
?>
