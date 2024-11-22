<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include_once "../settings/connection.php"; // Ensure this connection file is valid

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'] ?? trim($_POST['email']);
    $message = $_POST['message'] ?? '';
    $errors = [];

    try {
        if ($message === 'Forgot Password') {
            // Check if the email exists in the database
            $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                // Email exists, proceed to generate OTP

                // Generate OTP
                $OTP = rand(100000, 999999);

                // Store OTP and email in session for verification later
                $_SESSION['OTP'] = $OTP;
                $_SESSION['email'] = $email;
                $_SESSION['OTP_timestamp'] = time();

                // Send OTP email
                sendOTP($email, $OTP);

                header("Location: ../views/verify_otp.php?msg=" . urlencode($message));
                exit();
            } else {
                // Email does not exist, return error
                header("Location: ../views/forgot_password.php?msg=Email not found.");
                exit();
            }
        } elseif ($message === 'New Password') {
            if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
                $password = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirm_password']);

                // Check password strength
                $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
                if (!preg_match($passwordRegex, $password)) {
                    header("Location: ../views/reset_password.php?msg=Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.");
                    exit();
                }

                if ($password !== $confirmPassword) {
                    header("Location: ../views/reset_password.php?msg=Passwords do not match.");
                    exit();
                }

                // Hash the new password
                $hashedPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
                $stmt->execute([$hashedPassword, $email]);

                // Redirect to login with success message
                header("Location: ../views/login.php?msg=Password updated successfully.");
                exit();
            } else {
                echo "New password or confirmation not provided.";
            }
        } else {
            echo "No password reset request received.";
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} elseif (isset($_GET['message1']) && isset($_GET['message2']) && isset($_GET['email'])) {
    $message1 = $_GET['message1'];
    $message2 = $_GET['message2'];
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);

    // Generate OTP
    $OTP = rand(100000, 999999);

    // Store OTP and email in session for verification later
    $_SESSION['OTP'] = $OTP;
    $_SESSION['OTP_timestamp'] = time();

    // Send OTP email
    sendOTP($email, $OTP);

    header("Location: ../views/verify_otp.php?msg=Forgot Password&msg2=A code has been sent to your email address");
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
        $mail->Username = 'kobekootinsanwu@gmail.com'; // Your email address
        $mail->Password = 'jmvi iiki ugus zqnm'; // Your email password or app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kobekootinsanwu@gmail.com', 'Two Factor Authentication Website');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your One-Time Password (OTP) is <b>$OTP</b>. Please use this to complete your request.";
        $mail->AltBody = "Your One-Time Password (OTP) is $OTP. Please use this to complete your request.";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
