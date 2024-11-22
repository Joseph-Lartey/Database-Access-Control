<?php
// Include database connection
include "../settings/connection.php";

try {
    // Check if product_id is passed via GET request
    if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
        $productId = $_GET['product_id'];

        // Prepare SQL query to delete the product by its ID
        $stmt = $pdo->prepare("DELETE FROM Products WHERE ProductID = :product_id");
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the products page (shop.php) after deletion
        header("Location: ../admin/shop.php?message=Product deleted successfully!");
        exit();
    } else {
        // Redirect if no valid product_id is provided
        header("Location: ../admin/shop.php?error=Invalid product ID");
        exit();
    }
} catch (PDOException $e) {
    // Handle any errors
    echo "Error deleting product: " . $e->getMessage();
}
?>
