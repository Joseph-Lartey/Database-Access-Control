<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} // Start session to access logged-in user's data
include "../settings/connection.php"; // Database connection

// Ensure user is logged in
if (!isset($_SESSION['userID'])) {
    die("You must be logged in to view your cart.");
}

$userID = $_SESSION['userID'];

try {
    // Fetch the user's most recent order (active cart)
    $stmt = $pdo->prepare("
        SELECT o.OrderID, o.Date
        FROM Orders o
        WHERE o.UserID = :userID
        ORDER BY o.Date DESC
        LIMIT 1
    ");
    $stmt->execute(['userID' => $userID]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        $orderID = $order['OrderID'];
        $orderDate = $order['Date'];

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
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($cartItems) {
            $totalPrice = 0;

            foreach ($cartItems as $item) {
                $totalPrice += $item['Total'];

                echo '<tr>';
                echo '<td><img src="../images/' . htmlspecialchars($item['ProductImage']) . '" alt="' . htmlspecialchars($item['Name']) . '" style="width:50px;height:50px;"> ' . htmlspecialchars($item['Name']) . '</td>';
                echo '<td>$' . htmlspecialchars(number_format($item['Price'], 2)) . '</td>';
                echo '<td>' . htmlspecialchars($item['Quantity']) . '</td>';
                echo '<td>$' . htmlspecialchars(number_format($item['Total'], 2)) . '</td>';
                echo '<td>' . htmlspecialchars($orderDate) . '</td>'; // Display order date
                echo '</tr>';
            }

            // Output total price row
            echo '<tr>';
            echo '<td colspan="3" style="text-align:right; font-weight:bold;">Total:</td>';
            echo '<td colspan="2" style="font-weight:bold;">$' . number_format($totalPrice, 2) . '</td>';
            echo '</tr>';
        } else {
            echo '<tr><td colspan="5">Your purchase is empty.</td></tr>';
        }
    } else {
        echo '<tr><td colspan="5">No active orders found.</td></tr>';
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="5">Error retrieving cart: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
}
