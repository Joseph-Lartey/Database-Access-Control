<?php
session_start(); // Start session to access logged-in user's data
include "../settings/connection.php"; // Database connection

// Ensure user is logged in
if (!isset($_SESSION['UserID'])) {
    die("You must be logged in to view your cart.");
}

$userID = $_SESSION['UserID'];

try {
    // Fetch the user's active (open) order
    $stmt = $pdo->prepare("
        SELECT o.OrderID
        FROM Orders o
        WHERE o.UserID = :userID
        AND NOT EXISTS (
            SELECT 1
            FROM OrderDetails od
            WHERE od.OrderID = o.OrderID
        )
        LIMIT 1
    ");
    $stmt->execute(['userID' => $userID]);
    $order = $stmt->fetch();

    if ($order) {
        $orderID = $order['OrderID'];

        // Fetch cart items
        $stmt = $pdo->prepare("
            SELECT 
                p.ProductID,
                p.Name,
                p.Price,
                p.ProductImage,
                od.Quantity,
                (p.Price * od.Quantity) AS Total
            FROM OrderDetails od
            JOIN Products p ON od.ProductID = p.ProductID
            WHERE od.OrderID = :orderID
        ");
        $stmt->execute(['orderID' => $orderID]);
        $cartItems = $stmt->fetchAll();

        // Generate table rows for cart items
        if ($cartItems) {
            $totalPrice = 0;

            foreach ($cartItems as $item) {
                $totalPrice += $item['Total'];

                echo '<tr>';
                echo '<td><img src="../images/' . htmlspecialchars($item['ProductImage']) . '" alt="' . htmlspecialchars($item['Name']) . '" style="width:50px;height:50px;"> ' . htmlspecialchars($item['Name']) . '</td>';
                echo '<td>$' . htmlspecialchars(number_format($item['Price'], 2)) . '</td>';
                echo '<td>' . htmlspecialchars($item['Quantity']) . '</td>';
                echo '<td>$' . htmlspecialchars(number_format($item['Total'], 2)) . '</td>';
                echo '<td><span class="remove-btn" data-id="' . htmlspecialchars($item['ProductID']) . '">Remove</span></td>';
                echo '</tr>';
            }

            // Output total price row
            echo '<tr>';
            echo '<td colspan="3" style="text-align:right; font-weight:bold;">Total:</td>';
            echo '<td colspan="2" style="font-weight:bold;">$' . number_format($totalPrice, 2) . '</td>';
            echo '</tr>';
        } else {
            echo '<tr><td colspan="5">Your cart is empty.</td></tr>';
        }
    } else {
        echo '<tr><td colspan="5">No active orders found.</td></tr>';
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="5">Error retrieving cart: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
}
?>
