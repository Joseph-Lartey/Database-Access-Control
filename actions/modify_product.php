<?php
include "../settings/connection.php"; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the product data from the form
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $price = $_POST['price'];
    $productImage = $_POST['image'];

    try {
        // Prepare the SQL query to update the product
        $stmt = $pdo->prepare("UPDATE Products SET Name = :name, Description = :description, Price = :price, ProductImage = :image WHERE ProductID = :product_id");
        $stmt->bindParam(':name', $productName);
        $stmt->bindParam(':description', $productDescription);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $productImage);
        $stmt->bindParam(':product_id', $productId);

        // Execute the query
        $stmt->execute();

        // Redirect back to the shop page with a success message
        header("Location: ../admin/shop.php?message=Product updated successfully!");
        exit();
    } catch (PDOException $e) {
        echo "Error updating product: " . $e->getMessage();
    }
}
?>
