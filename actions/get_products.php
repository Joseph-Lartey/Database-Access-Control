<?php
include "../settings/connection.php"; // Adjust the path to your connection.php

try {
    // Fetch products from the database
    $stmt = $pdo->query("SELECT * FROM Products"); // Replace 'Products' with your table name if needed
    $products = $stmt->fetchAll(); // Fetch all products

    if ($products) {
        foreach ($products as $product) {
            echo '
            <div class="product-card">
                <img src="../images/' . htmlspecialchars($product['ProductImage']) . '" alt="' . htmlspecialchars($product['Name']) . '">
                <h3>' . htmlspecialchars($product['Name']) . '</h3>
                <p>' . htmlspecialchars($product['Description']) . '</p>
                <span class="price">$' . htmlspecialchars($product['Price']) . '</span>
                <input type="number" class="quantity-input" placeholder="Qty" min="1" value="1">
                <button class="buy-btn" data-product-id="' . htmlspecialchars($product['ProductID']) . '">Add to Cart</button>
            </div>';
        }
    } else {
        echo "<p>No products available.</p>";
    }
} catch (PDOException $e) {
    // Handle any query errors
    echo "Error retrieving products: " . $e->getMessage();
}
?>
