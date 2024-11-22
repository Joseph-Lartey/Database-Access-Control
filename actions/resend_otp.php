<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Configuration
// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include_once "../settings/connection.php"; // Include PDO connection
require '../vendor/autoload.php'; // Autoload PHPMailer

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $errors = [];

    // Generate OTP
    $OTP = rand(100000, 999999);

    // Store OTP and email in session for verification later
    $_SESSION['OTP'] = $OTP;
    $_SESSION['email'] = $email;
    $_SESSION['OTP_timestamp'] = time();

    // Optionally, store or update OTP in the database for further verification
    try {
        $sql = "UPDATE users SET OTP = :OTP, OTP_timestamp = :OTP_timestamp WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':OTP', $OTP, PDO::PARAM_INT);
        $stmt->bindParam(':OTP_timestamp', $_SESSION['OTP_timestamp'], PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }

    // Send OTP email
    sendOTP($email, $OTP);

    // Redirect to OTP verification page
    header("Location: ../views/verify_otp.php?msg=OTP has been resent.");
    exit();
}

// Function to send OTP via email using PHPMailer
function sendOTP($email, $OTP)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Specify SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'kobekootinsanwu@gmail.com'; // Outlook email address
        $mail->Password = 'jmvi iiki ugus zqnm'; // Outlook password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kobekootinsanwu@gmail.com', 'Database Access Control');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your One-Time Password (OTP) is <b>$OTP</b>. Please use this to complete your registration.";
        $mail->AltBody = "Your One-Time Password (OTP) is $OTP. Please use this to complete your registration.";

        // Send email
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
