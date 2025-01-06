<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if (!$email) {
        echo "Invalid email address.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'muhammadpanjiddd@gmail.com';
        $mail->Password = 'PanjiGanteng'; // Ganti dengan password Gmail atau App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('your-email@gmail.com'); // Ganti dengan email tujuan
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body = "You have received a new message from $name ($email):\n\n$message";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Failed to send the message. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>