<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include "../settings/connection.php";

// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

if (isset($_GET['msg']) && $_GET['msg'] == "registering") {

    $firstName = $_SESSION['firstname'];
    $lastName = $_SESSION['lastname'];
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];
    $hashedPassword = $_SESSION['hashedPassword'];

    try {
        // Prepare SQL statement for insertion
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (:firstName, :lastName, :email, :password, :role)");
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            $message = "Successfully registered";
            $encodedMessage = urlencode($message);
            header("Location: ../views/shop.php?email=" . urlencode($email) . "&msg=" . $encodedMessage);
            exit();
        } else {
            header("Location: ../views/login.php?msg=Failed to register.");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../views/login.php?msg=Database error: " . $e->getMessage());
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    // Retrieve form inputs
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = 'Customer';

    $_SESSION['firstname'] = $firstName;
    $_SESSION['lastname'] = $lastName;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['confirmPassword'] = $confirmPassword;
    $_SESSION['role'] = $role;

    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
        header("Location: ../views/login.php?msg=All fields must be filled");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/login.php?msg=Please enter a valid email address.");
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        header("Location: ../views/login.php?msg=Passwords do not match.");
        exit();
    }

    // Validate password strength
    $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (!preg_match($passwordRegex, $password)) {
        header("Location: ../views/login.php?msg=Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.");
        exit();
    }

    try {
        // Check for existing email in the database
        $stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("Location: ../views/login.php?msg=Email already exists. Please use a different email.");
            exit();
        }

        // If no errors, proceed with user registration
        // Password hashing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['hashedPassword'] = $hashedPassword;

        // Generate OTP
        $OTP = rand(100000, 999999);
        $_SESSION['OTP'] = $OTP;
        $_SESSION['registering'] = "registering";
        $_SESSION['OTP_timestamp'] = time();

        // Send OTP email
        sendOTP($email, $OTP);

        header("Location: ../views/verify_otp.php?msg=registering");
        exit();
    } catch (PDOException $e) {
        header("Location: ../views/login.php?msg=Database error: " . $e->getMessage());
        exit();
    }
}

// Function to send OTP via email using PHPMailer
function sendOTP($email, $OTP)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kobekootinsanwu@gmail.com';
        $mail->Password   = 'jmvi iiki ugus zqnm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

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
