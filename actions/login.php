<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Include the database connection file
include_once "../settings/connection.php";

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $errors = [];

    // Validate email
    if (empty($_POST['email'])) {
        $errors[] = "Email is required.";
    } else {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
    }

    // Validate password
    if (empty($_POST['password'])) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        $password = $_POST['password'];

        try {
            // Prepare the SQL query
            $stmt = $pdo->prepare("SELECT userID, first_name, last_name, password, role FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();

            // If the user is found
            if ($stmt->rowCount() === 1) {
                $row = $stmt->fetch();

                // Verify the password
                if (password_verify($password, $row['password'])) {
                    // Set session variables
                    $_SESSION['userID'] = $row['userID'];
                    $_SESSION['fname'] = $row['first_name'];
                    $_SESSION['lname'] = $row['last_name'];
                    $_SESSION['role'] = $row['role'];

                    // Generate OTP
                    $OTP = rand(100000, 999999);
                    $_SESSION['OTP'] = $OTP;
                    $_SESSION['email'] = $email;
                    $_SESSION['signingIn'] = "signingIn";
                    $_SESSION['OTP_timestamp'] = time();

                    // Send OTP email
                    sendOTP($email, $OTP);

                    // Redirect to OTP verification
                    $message = "Successfully signed in. Kindly check your email for the OTP.";
                    $encodedMessage = urlencode($message);
                    header("Location: ../views/verify_otp.php?email=" . urlencode($email) . "&msg=" . $encodedMessage);
                    exit();
                } else {
                    header("Location: ../views/login.php?msg=Invalid email or password.");
                    exit();
                }
            } else {
                header("Location: ../views/login.php?msg=Invalid email or password.");
                exit();
            }
        } catch (PDOException $e) {
            header("Location: ../views/login.php?msg=Database error: " . $e->getMessage());
            exit();
        }
    } else {
        // Concatenate errors and pass via URL
        header("Location: ../views/login.php?msg=" . urlencode(implode(" ", $errors)));
        exit();
    }
} else {
    // Handle invalid request method
    header("Location: ../views/login.php?msg=Invalid request method.");
    exit();
}

// Function to send OTP via email using PHPMailer
function sendOTP($email, $OTP) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kobekootinsanwu@gmail.com';
        $mail->Password = 'jmvi iiki ugus zqnm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kobekootinsanwu@gmail.com', 'Database Access Control');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your One-Time Password (OTP) is <b>$OTP</b>. Please use this to complete your registration.";
        $mail->AltBody = "Your One-Time Password (OTP) is $OTP. Please use this to complete your registration.";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
