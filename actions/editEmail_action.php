<?php
include('../settings/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['old_email']) && !empty($_POST['new_email'])) {

        $oldEmail = $_POST['old_email'];
        $newEmail = $_POST['new_email'];

        try {
            // Check if the old email exists in the database
            $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = ?");
            $stmt->execute([$oldEmail]);
            $user = $stmt->fetch();

            if ($user) {
                // Update the email
                $updateStmt = $pdo->prepare("UPDATE Users SET email = ? WHERE email = ?");
                $updateStmt->execute([$newEmail, $oldEmail]);

                if ($updateStmt->rowCount() > 0) {
                    header("Location: ../views/profile.php?msg=" . urlencode("Email updated successfully."));
                    exit();
                } else {
                    header("Location: ../views/profile.php?msg=" . urlencode("Failed to update email."));
                    exit();
                }
            } else {
                header("Location: ../views/profile.php?msg=" . urlencode("Old email does not exist."));
                exit();
            }
        } catch (PDOException $e) {
            header("Location: ../views/profile.php?msg=" . urlencode("Database error: " . $e->getMessage()));
            exit();
        }
    } else {
        header("Location: ../views/profile.php?msg=" . urlencode("Old and new email must not be empty."));
        exit();
    }
} else {
    header("Location: ../views/profile.php?msg=" . urlencode("Invalid request method."));
    exit();
}
?>
