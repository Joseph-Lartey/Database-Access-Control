<?php
function get_orders($pdo) {
    try {
        // Prepare the SQL query with concatenated first_name and last_name as Username
        $sql = "SELECT 
                    Orders.OrderID, 
                    Orders.Date, 
                    Orders.UserID, 
                    Orders.TotalAmount, 
                    Orders.Status, 
                    CONCAT(Users.first_name, ' ', Users.last_name) AS Username
                FROM Orders 
                JOIN Users ON Orders.UserID = Users.UserID 
                ORDER BY Orders.Date DESC";

        // Execute the query and fetch results
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        // Log and display any error
        die("Error fetching orders: " . $e->getMessage());
    }
}
