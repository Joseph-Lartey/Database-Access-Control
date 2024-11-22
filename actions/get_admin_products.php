<?php
include "../settings/connection.php"; // Adjust the path to your connection.php

try {
    // Fetch products from the database
    $stmt = $pdo->query("SELECT * FROM Products"); // Replace 'Products' with your table name if needed
    $products = $stmt->fetchAll(); // Fetch all products

    echo '<div class="product-cards-container">'; // Start the container for the product cards

    if ($products) {
        foreach ($products as $product) {
            echo '
            <div class="product-card">
                <img src="../images/' . htmlspecialchars($product['ProductImage']) . '" alt="' . htmlspecialchars($product['Name']) . '">
                <h3>' . htmlspecialchars($product['Name']) . '</h3>
                <p>' . htmlspecialchars($product['Description']) . '</p>
                <span class="price">$' . htmlspecialchars($product['Price']) . '</span>
                <input type="number" class="quantity-input" placeholder="Qty" min="1" value="1">
                <a href="../actions/add_product.php?product_id=' . htmlspecialchars($product['ProductID']) . '" class="add-btn">
                    <button type="button" class="add-btn">Add to Cart</button>
                </a>
                <a href="../actions/delete_product.php?product_id=' . htmlspecialchars($product['ProductID']) . '" class="delete-btn">
                    <button type="button" class="delete-btn">Delete Item</button>
                </a>
                <a href="../admin/modify_product.php?product_id=' . htmlspecialchars($product['ProductID']) . '" class="modify-btn">
                    <button type="button" class="modify-btn">Modify Item</button>
                </a>            
            </div>';
        }
    } else {
        echo "<p>No products available.</p>";
    }

    echo '</div>'; // End the container
} catch (PDOException $e) {
    // Handle any query errors
    echo "Error retrieving products: " . $e->getMessage();
}
