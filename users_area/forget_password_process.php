<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();

if (isset($_POST['reset'])) {
    $user_email = $_POST['user_email'];
} else {
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../mail/Exception.php';
require '../mail/PHPMailer.php';
require '../mail/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = "smtp.gmail.com";                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                // SMTP username
    $mail->Password   = '';                             // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Enable implicit TLS encryption
    $mail->Port       = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('', 'Srivastava E-Store');
    $mail->addAddress($user_email);                              // Add a recipient

    $code = substr(str_shuffle('123456789QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

    // Content
    $mail->isHTML(true);                                         // Set email format to HTML
    $mail->Subject = 'Password Reset';
    $mail->Body    = 'To reset your password click <a href="http://localhost/ecommercewebsite/users_area/change_password.php?code=' . $code . '">here</a>.</br> Reset your password within a day.';

    $con = mysqli_connect('localhost', 'root', '', 'mystore');

    if (!$con) {
        die(mysqli_error($con));
    }

    $verifyquery = $con->query("SELECT * FROM user_table WHERE user_email= '$user_email'");

    if ($verifyquery->num_rows) {
        $codeQuery = $con->query("UPDATE user_table SET code = '$code' WHERE user_email= '$user_email'");

        $mail->send();
        echo 'Message has been sent. Check your email.';
    }
    $con->close();
} catch (Exception $e) {
    echo "are bhai ni jarh. Mailer Error: {$mail->ErrorInfo}";
}
