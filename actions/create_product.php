<?php
// Include the database connection
include "../settings/connection.php";

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    // $userID = $_POST['userID']; // For tracking which employee created the product (if needed)
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $price = $_POST['price'];
    $productImage = $_POST['image']; // Assuming the image is provided as a URL or path
    $stockQuantity = 0; // Default stock quantity (modify as needed)

    // Validate input fields
    if (empty($productName) || empty($productDescription) || empty($price)) {
        die("All fields are required.");
    }

    // Ensure price is a valid number
    if (!is_numeric($price) || $price < 0) {
        die("Invalid price. Please enter a valid number.");
    }

    try {
        // Prepare SQL query to insert data into Products table
        $stmt = $pdo->prepare("
            INSERT INTO Products (Name, Description, Price, StockQuantity, ProductImage) 
            VALUES (:name, :description, :price, :stockQuantity, :image)
        ");
        $stmt->execute([
            ':name' => $productName,
            ':description' => $productDescription,
            ':price' => $price,
            ':stockQuantity' => $stockQuantity,
            ':image' => $productImage
        ]);

        // Redirect to a success page or show a success message
        header("Location: ../admin/shop.php?message=Product created successfully!");
        exit();
    } catch (PDOException $e) {
        // Handle any errors
        die("Error adding product: " . $e->getMessage());
    }
} else {
    // If accessed without POST data, redirect to the form page
    header("Location: ../admin/create_product.php");
    exit();
}
?>
