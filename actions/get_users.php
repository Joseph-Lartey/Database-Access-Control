<?php
include "../settings/connection.php"; // Adjust the path to your connection.php

try {
    // Fetch users from the database
    $stmt = $pdo->query("SELECT * FROM Users"); // Fetch all users from the Users table
    $users = $stmt->fetchAll(); // Fetch all users

    if ($users) {
        echo '<div class="user-cards-container">'; // Add a container for the cards
        foreach ($users as $user) {
            echo '
            <div class="user-card">
                <img src="../images/' . (!empty($user['ProfileImage']) ? htmlspecialchars($user['ProfileImage']) : 'default.png') . '" alt="' . htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) . '">
                <h3>' . htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) . '</h3>
                <p>Email: ' . htmlspecialchars($user['email']) . '</p>
                <p>Current Role: ' . htmlspecialchars($user['role']) . '</p>
                
                <form method="POST" action="../actions/update_role.php">
                    <label for="role">Change Role:</label>
                    <select name="role" id="role">
                        <option value="Administrator"' . ($user['role'] === 'Administrator' ? ' selected' : '') . '>Administrator</option>
                        <option value="Sales Personnel"' . ($user['role'] === 'Sales Personnel' ? ' selected' : '') . '>Sales Personnel</option>
                        <option value="Inventory Manager"' . ($user['role'] === 'Inventory Manager' ? ' selected' : '') . '>Inventory Manager</option>
                        <option value="Customer"' . ($user['role'] === 'Customer' ? ' selected' : '') . '>Customer</option>
                    </select>
                    <input type="hidden" name="user_id" value="' . htmlspecialchars($user['userID']) . '">
                    <button type="submit" class="update-role-btn">Update Role</button>
                </form>
            </div>';
        }
        echo '</div>'; // Close the container
    } else {
        echo "<p>No users available.</p>";
    }
} catch (PDOException $e) {
    // Handle any query errors
    echo "Error retrieving users: " . $e->getMessage();
}
