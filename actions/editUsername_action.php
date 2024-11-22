<?php

include('../settings/connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["Firstname"]) && isset($_POST["username"]) && !empty($_POST["Firstname"]) && !empty($_POST["username"])) {

        $firstname = htmlspecialchars($_POST["Firstname"]);
        $lastname = htmlspecialchars($_POST["username"]);

        try {
            // Get the user ID from the session
            $user_id = $_SESSION['userID'];

            // Prepare and execute the update query
            $stmt = $pdo->prepare("UPDATE Users SET first_name = ?, last_name = ? WHERE userID = ?");
            $stmt->execute([$firstname, $lastname, $user_id]);

            // Check if any rows were updated
            if ($stmt->rowCount() > 0) {
                header("Location: ../views/profile.php?msg=" . urlencode("Profile updated successfully."));
                exit();
            } else {
                header("Location: ../views/profile.php?msg=" . urlencode("Failed to update profile. Please try again."));
                exit();
            }
        } catch (PDOException $e) {
            // Handle database errors
            header("Location: ../views/profile.php?msg=" . urlencode("Database error: " . $e->getMessage()));
            exit();
        }
    } else {
        // Handle empty fields
        header("Location: ../views/profile.php?msg=" . urlencode("Please fill in all the required fields."));
        exit();
    }
} else {
    // Handle invalid request method
    header("Location: ../views/profile.php?msg=" . urlencode("Invalid request method. Please try again."));
    exit();
}

?>
