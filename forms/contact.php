<?php
// Include the PHPMailer Autoload file
require '../vendor/autoload.php'; // Adjust the path as needed

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'htindev@gmail.com';

// Initialize PHPMailer
$mail = new PHPMailer(true); // Passing `true` enables exceptions

try {
    //Server settings
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'htindev@gmail.com'; // SMTP username
    $mail->Password = 'tbyuxlwnifcaoojk'; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // TCP port to connect to

    // Sender and recipient settings
    $mail->setFrom($_POST['email'], $_POST['name']); // Sender's email address and name
    $mail->addAddress($receiving_email_address); // Add a recipient
    $mail->addReplyTo($_POST['email'], $_POST['name']); // Add sender's email address as Reply-To

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $_POST['subject']; // Email subject
    // $mail->Body = "Sender's Email: " . $_POST['email'] . "<br><br>" . $_POST['message']; // Email body
    $mail->Body = "<h2>Message from Contact Form</h2>" .
    "<p><strong>Sender's Email:</strong> " . $_POST['email'] . "</p>" .
    "<p><strong>Message:</strong></p>" .
    "<p>" . nl2br($_POST['message']) . "</p>";

    // Send the email
    if ($mail->send()) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => $mail->ErrorInfo));
    }

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}


