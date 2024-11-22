<?php
include "../settings/connection.php"; // Ensure the database connection is included

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id']) && isset($_POST['role'])) {
        $userId = intval($_POST['user_id']);
        $newRole = $_POST['role'];

        try {
            // Update the user's role in the database
            $stmt = $pdo->prepare("UPDATE Users SET role = :role WHERE userID = :user_id");
            $stmt->bindParam(':role', $newRole, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect back to the admin user management page
            header("Location: ../admin/manage_role.php?success=1");
            exit();
        } catch (PDOException $e) {
            echo "Error updating user role: " . $e->getMessage();
        }
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request method.";
}
?>
