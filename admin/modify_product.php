<?php
include "../settings/connection.php"; // Database connection

// Fetch the product ID from the URL
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Fetch the product details from the database
    $stmt = $pdo->prepare("SELECT * FROM products WHERE ProductID = :product_id");
    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch();

    // Check if product exists
    if (!$product) {
        echo "<p>Product not found.</p>";
        exit();
    }
} else {
    echo "<p>Invalid product ID.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/create_product.css">
    <title>Modify Product</title>
</head>

<body>
    <form class="container-15" id="myModal" method="POST" action="../actions/modify_product.php">
        <div class="container-16">
            <div class="close-form-group">
                <button name="closeButton" id="closePopup" onclick="closePopup()">Close</button>
            </div>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ProductID']); ?>">

            <div class="form-group">
                <label for="productname">Product Name:</label>
                <input type="text" required name="product_name" id="product_name" placeholder="Product Name" value="<?php echo htmlspecialchars($product['Name']); ?>" required>
                
                <label for="description">Product Description:</label>
                <input type="text" required name="product_description" id="product_description" placeholder="Product Description" value="<?php echo htmlspecialchars($product['Description']); ?>" required>
                
                <label for="price">Product Price:</label>
                <input type="text" required name="price" id="price" placeholder="Product Price" value="<?php echo htmlspecialchars($product['Price']); ?>" required>

                <label for="image">Product Image:</label>
                <input type="text" name="image" id="image" placeholder="Product Image URL" value="<?php echo htmlspecialchars($product['ProductImage']); ?>">
            </div>
            <input type="hidden" name="request_status" value="pending">

            <div class="submit">
                <button name="submitButton">Update</button>
            </div>
        </div>
    </form>
    <script src="../javascript/create_product.js" defer></script>
</body>

</html>
