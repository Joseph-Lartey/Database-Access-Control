<?php
include_once "../settings/connection.php";  

if (isset($_GET['orderDetailID']) && isset($_GET['status'])) {
    $orderDetailID = $_GET['orderDetailID']; // Unique identifier for each item
    $newStatus = $_GET['status'];

    if ($newStatus !== 'processed' && $newStatus !== 'unprocessed') {
        die('Invalid status');
    }

    // Update query targeting the unique order item
    $query = "UPDATE OrderDetails SET Status = ? WHERE OrderDetailID = ?";
    $stmt = $pdo->prepare($query);

    if ($stmt->execute([$newStatus, $orderDetailID])) {
        header('Location: ../sales/SalesOrders.php');
        exit();
    } else {
        echo "Error updating status.";
    }
} else {
    echo "Missing required parameters.";
}
?>
