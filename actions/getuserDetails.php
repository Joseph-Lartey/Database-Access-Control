<?php
include "../settings/connection.php";

function getUserProfileDetails() {
    global $pdo;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['userID'])) {
        return "<p>Error: User not logged in. Please log in again.</p>";
    }

    $userID = $_SESSION['userID'];

    try {
        $stmt = $pdo->prepare("SELECT first_name, last_name, email, role FROM Users WHERE userID = ?");
        $stmt->execute([$userID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return "<p><strong>Name:</strong> " . htmlspecialchars($result['first_name']) . " " . htmlspecialchars($result['last_name']) . "</p>" .
                   "<p><strong>Email:</strong> " . htmlspecialchars($result['email']) . "</p>" .
                   "<p><strong>Role:</strong> " . htmlspecialchars($result['role']) . "</p>";
        } else {
            return "<p>No profile details found for the user.</p>";
        }
    } catch (PDOException $e) {
        return "<p>Error fetching profile details: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}


function getUserProfileImage() {
    global $pdo;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['userID'])) {
        header("Location: ../views/login.php");
        exit();
    }

    $userID = $_SESSION['userID'];

    try {
        $stmt = $pdo->prepare("SELECT ProfileImage FROM Users WHERE userID = ?");
        $stmt->execute([$userID]);
        $profileImage = $stmt->fetchColumn();

        if ($profileImage) {
            return '<img src="../uploads/' . htmlspecialchars($profileImage) . '" alt="Profile Picture" class="profile-pic">';
        } else {
            return '<img src="../images/12.jpg" alt="Default Profile Picture" class="profile-pic"';
        }
    } catch (PDOException $e) {
        return '<p>Error fetching profile image: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
?>
