<?php
include_once "../settings/connection.php"; // Ensure you connect to your database

function getOrderDetails() {
    global $pdo;
    $query = "
    SELECT 
            od.OrderDetailID, -- Unique identifier for each item in an order
            CONCAT(u.first_name, ' ', u.last_name) AS CustomerName,
            u.email AS Email,
            p.Name AS ItemName,
            od.Quantity AS Quantity,
            (od.Quantity * od.Price) AS Subtotal,
            o.Date AS OrderDate,
            od.Status AS OrderStatus -- Fetch status from OrderDetails
        FROM Orders o
        JOIN Users u ON o.UserID = u.userID
        JOIN OrderDetails od ON o.OrderID = od.OrderID
        JOIN Products p ON od.ProductID = p.ProductID
        ORDER BY o.Date 
        ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$orders = getOrderDetails();
?>
