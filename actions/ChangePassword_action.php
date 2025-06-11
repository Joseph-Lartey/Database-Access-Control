<?php
session_start();
include '../settings/connection.php';

error_reporting(E_ALL); // Display all errors
ini_set('display_errors', 1); // Show errors on the screen

function validatePassword($password) {
    $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/";
    return preg_match($regex, $password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("Form submitted"); // Debugging log

    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if ($newPassword !== $confirmPassword) {
        error_log("Passwords do not match"); // Debugging log
        header("Location: ../views/profile.php?msg=" . urlencode("New password and confirm password do not match."));
        exit();
    } elseif (!validatePassword($newPassword)) {
        error_log("Password validation failed"); // Debugging log
        header("Location: ../views/profile.php?msg=" . urlencode("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character."));
        exit();
    } else {
        if (isset($_SESSION['userID'])) {
            $userId = $_SESSION['userID'];
            error_log("User ID: $userId"); // Debugging log

            try {
                $query = "SELECT password FROM Users WHERE userID = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$userId]);
                $row = $stmt->fetch();

                if ($row) {
                    $currentHashedPassword = $row['password'];
                    error_log("Password fetched successfully"); // Debugging log

                    if (password_verify($currentPassword, $currentHashedPassword)) {
                        error_log("Current password verified"); // Debugging log
                        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                        $updateQuery = "UPDATE Users SET password = ? WHERE userID = ?";
                        $updateStmt = $pdo->prepare($updateQuery);
                        if ($updateStmt->execute([$newHashedPassword, $userId])) {
                            error_log("Password updated successfully"); // Debugging log
                            header("Location: ../views/login.php?msg=" . urlencode("Password updated successfully."));
                            exit();
                        } else {
                            error_log("Error updating password"); // Debugging log
                            header("Location: ../views/profile.php?msg=" . urlencode("Error updating password."));
                            exit();
                        }
                    } else {
                        error_log("Current password is incorrect"); // Debugging log
                        header("Location: ../views/profile.php?msg=" . urlencode("Current password is incorrect."));
                        exit();
                    }
                } else {
                    error_log("User not found in database"); // Debugging log
                    header("Location: ../views/profile.php?msg=" . urlencode("User not found."));
                    exit();
                }
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage()); // Debugging log
                header("Location: ../views/profile.php?msg=" . urlencode("Database error: " . $e->getMessage()));
                exit();
            }
        } else {
            error_log("Session user ID not set"); // Debugging log
            header("Location: ../views/profile.php?msg=" . urlencode("Session data not found. Please log in again."));
            exit();
        }
    }
} else {
    error_log("Invalid request method"); // Debugging log
    header("Location: ../views/profile.php?msg=" . urlencode("Invalid request method."));
    exit();
}
?>
