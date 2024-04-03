<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ścieżka do pliku autoload.php dla PHPMailera

if (isset($_POST['submit'])) {
    // Generowanie 6-cyfrowego kodu weryfikacyjnego
    $kod = rand(100000, 999999);

    // Tworzenie treści wiadomości e-mail z wygenerowanym kodem
    $wiadomosc = "<h1>Twój kod weryfikacyjny: $kod</h1>";

    // Adres e-mail odbiorcy
    $adresEmail = "adres@domena.pl"; // Tutaj podaj adres e-mail docelowego odbiorcy

    // Konfiguracja PHPMailera
    $mail = new PHPMailer(true);
    try {
        // Ustawienia serwera SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Tutaj podaj adres serwera SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'your@example.com'; // Tutaj podaj swój adres e-mail
        $mail->Password = 'your_password'; // Tutaj podaj swoje hasło do e-maila
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Ustawienia nadawcy i odbiorcy
        $mail->setFrom('your@example.com', 'Your Name'); // Tutaj podaj swój adres e-mail i nazwę
        $mail->addAddress($adresEmail);

        // Treść wiadomości
        $mail->isHTML(true);
        $mail->Subject = 'Kod weryfikacyjny';
        $mail->Body = $wiadomosc;

        // Wysłanie wiadomości e-mail
        $mail->send();
        echo "<script>alert('Wiadomość została wysłana z kodem weryfikacyjnym: $kod')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Wystąpił błąd podczas wysyłania wiadomości: {$mail->ErrorInfo}')</script>";
    }
}
?>