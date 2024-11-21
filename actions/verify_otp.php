<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
include "../settings/connection.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userOTP = implode('', $_POST['OTP']);
    $expectedOTP = $_SESSION['OTP'];
    $signingIn = $_SESSION['signingIn'];
    $registering = $_SESSION['registering'];


    // Assuming the user ID is stored in the session after login
    $userID = $_SESSION['userID']; // Replace with your session key for user ID

    // Query to fetch the user's role
    $sql = "SELECT role FROM users WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the row as an associative array
        $role = $row['role']; // Access the 'role' column value
    } else {
        $role = 'Customer'; // Default role if no record is found
    }

    // Retrieve the hidden message from the POST data
    $message_1 = $_POST['message'] ?? '';
    $message_1 = trim((string)$_POST['message']);
    $registering = trim((string)$_SESSION['registering']);
    
    $currentTime = time();

    $userOTP = (string) $userOTP;
    $expectedOTP = (string) $_SESSION['OTP'];
    
    $OTP_time_created = $_SESSION['OTP_timestamp'];
    $overdueOTP = $currentTime - $OTP_time_created;

    if ($overdueOTP > 120) {
        header("Location: ../views/verify_otp.php?msg=OTP expired. Please try again.");
        exit();
    }

    // Check if the user input OTP matches the expected OTP and the message is "Forgot Password"
    if ($userOTP === $expectedOTP && $message_1 === 'Forgot Password' && $signingIn === 'signingIn' && $role === 'Administrator') {
        unset($_SESSION['OTP']);
        header("Location: ../views/admin.php?msg=" . urlencode($message_1));
        exit();
    }

    // Check if the user input OTP matches the expected OTP and the message is "Forgot Password"
    else if ($userOTP === $expectedOTP && $message_1 === 'Forgot Password' && $signingIn === 'signingIn' && $role === 'Sales Personnel') {
        unset($_SESSION['OTP']);
        header("Location: ../views/sales.php?msg=" . urlencode($message_1));
        exit();
    }
    
    // Check if the user input OTP matches the expected OTP and the message is "Forgot Password"
    else if ($userOTP === $expectedOTP && $message_1 === 'Forgot Password' && $signingIn === 'signingIn' && $role === 'Inventory Manager') {
        unset($_SESSION['OTP']);
        header("Location: ../views/invent.php?msg=" . urlencode($message_1));
        exit();
    }
    
    // Check if the user input OTP matches the expected OTP and the message is "Forgot Password"
    else if ($userOTP === $expectedOTP && $message_1 === 'Forgot Password' && $signingIn === 'signingIn' && $role === 'Customer') {
        unset($_SESSION['OTP']);
        header("Location: ../views/shop.php?msg=" . urlencode($message_1));
        exit();
    }

    else if ($userOTP === $expectedOTP && $message_1 === 'Forgot Password '&& $registering === 'registering'){
        unset($_SESSION['OTP']);
        header("Location: ../views/home.php?msg=" . urlencode($message_1));
        exit();
    }

    else if ($userOTP === $expectedOTP && $message_1 === 'Forgot Password') {
        unset($_SESSION['OTP']);
        header("Location: ../views/reset_password.php?msg=" . urlencode($message_1));
        exit();
    }

    else if ($userOTP === $expectedOTP && $message_1 === $registering) {
        unset($_SESSION['OTP']);
        header("Location: ../actions/register.php?msg=" . urlencode($message_1));
        exit();
    }

    // Check if the entered OTP matches the expected OTP (as a string)
    else if ($userOTP === $expectedOTP && $role === 'Administrator') {
        unset($_SESSION['OTP']);
        // header("Location: ../views/admin.php?msg=OTP verified successfully.");
        exit();
    }

    else if ($userOTP === $expectedOTP && $role === 'Sales Personnel') {
        unset($_SESSION['OTP']);
        header("Location: ../views/sales.php?msg=OTP verified successfully.");
        exit();
    }

    else if ($userOTP === $expectedOTP && $role === 'Inventory Manager') {
        unset($_SESSION['OTP']);
        header("Location: ../views/invent.php?msg=OTP verified successfully.");
        exit();
    }

    else if ($userOTP === $expectedOTP && $role === 'Customer') {
        unset($_SESSION['OTP']);
        header("Location: ../views/cart.php?msg=OTP verified successfully.");
        exit();
    }

    // If the OTP does not match
    header("Location: ../views/verify_otp.php?msg=Incorrect OTP. Please try again.");
    exit();
}
?>
