<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "../settings/connection.php";

if (!isset($_SESSION['userID'])) {
    die("You must be logged in to buy stuff.");
}

$userID = $_SESSION['userID'];
$productID = $_POST['ProductID'] ?? null; // Safely get ProductID
$quantity = (int) ($_POST['Quantity'] ?? 0); // Safely get Quantity

if (!$productID || $quantity <= 0) {
    die("Invalid ProductID or Quantity.");
}

try {
    // Check product stock
    $stmt = $pdo->prepare("SELECT ProductID, StockQuantity, Price FROM Products WHERE ProductID = :productID");
    $stmt->execute(['productID' => $productID]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product not found. ProductID: $productID");
    }

    if ($product['StockQuantity'] < $quantity) {
        die("Insufficient stock for ProductID: $productID");
    }

    // Debugging
    error_log("Product found: " . json_encode($product));

    // Check for an open order with status 'Unprocessed'
    $stmt = $pdo->prepare("
        SELECT OrderID 
        FROM Orders 
        WHERE UserID = :userID AND Status = 'Unprocessed'
        LIMIT 1
    ");
    $stmt->execute(['userID' => $userID]);
    $order = $stmt->fetch();

    if (!$order) {
        // Create a new order with status 'Unprocessed'
        $stmt = $pdo->prepare("INSERT INTO Orders (UserID, TotalAmount, Status) VALUES (:userID, 0, 'Unprocessed')");
        $stmt->execute(['userID' => $userID]);
        $orderID = $pdo->lastInsertId();
    } else {
        $orderID = $order['OrderID'];
    }

    // Check if product is already in the cart
    $stmt = $pdo->prepare("SELECT Quantity FROM OrderDetails WHERE OrderID = :orderID AND ProductID = :productID");
    $stmt->execute(['orderID' => $orderID, 'productID' => $productID]);
    $orderDetail = $stmt->fetch();

    if ($orderDetail) {
        // Update quantity
        $newQuantity = $orderDetail['Quantity'] + $quantity;
        if ($newQuantity > $product['StockQuantity']) {
            die("Insufficient stock for updated quantity.");
        }

        $stmt = $pdo->prepare("
            UPDATE OrderDetails 
            SET Quantity = :quantity, Price = :price 
            WHERE OrderID = :orderID AND ProductID = :productID
        ");
        $stmt->execute([
            'quantity' => $newQuantity,
            'price' => $newQuantity * $product['Price'],
            'orderID' => $orderID,
            'productID' => $productID
        ]);
    } else {
        // Insert new item
        $stmt = $pdo->prepare("
            INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Price) 
            VALUES (:orderID, :productID, :quantity, :price)
        ");
        $stmt->execute([
            'orderID' => $orderID,
            'productID' => $productID,
            'quantity' => $quantity,
            'price' => $quantity * $product['Price']
        ]);
    }

    // Update product stock
    $stmt = $pdo->prepare("UPDATE Products SET StockQuantity = StockQuantity - :quantity WHERE ProductID = :productID");
    $stmt->execute(['quantity' => $quantity, 'productID' => $productID]);

    echo "Item added to cart successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}














// session_start(); // Start session
// include "../settings/connection.php"; // Database connection

// // Ensure user is logged in
// if (!isset($_SESSION['userID'])) {
//     die("You must be logged in to add items to the cart.");
// }

// $userID = $_SESSION['userID'];
// $productID = $_POST['ProductID']; // Product ID from the request
// $quantity = (int) $_POST['Quantity']; // Quantity from the request

// if ($quantity <= 0) {
//     die("Invalid quantity.");
// }

// try {
//     // Check product stock
//     $stmt = $pdo->prepare("SELECT StockQuantity FROM Products WHERE ProductID = :productID");
//     $stmt->execute(['productID' => $productID]);
//     $product = $stmt->fetch();

//     if (!$product) {
//         die("Product not found.");
//     }

//     if ($product['StockQuantity'] < $quantity) {
//         die("Insufficient stock for this product.");
//     }

//     // Check for an open order for the user
//     $stmt = $pdo->prepare("
//         SELECT OrderID 
//         FROM Orders 
//         WHERE userID = :userID 
//         AND NOT EXISTS (
//             SELECT 1 FROM OrderDetails od WHERE od.OrderID = Orders.OrderID
//         )
//         LIMIT 1
//     ");
//     $stmt->execute(['userID' => $userID]);
//     $order = $stmt->fetch();

//     if (!$order) {
//         // Create a new order if none exists
//         $stmt = $pdo->prepare("INSERT INTO Orders (userID, TotalAmount) VALUES (:userID, 0)");
//         $stmt->execute(['userID' => $userID]);
//         $orderID = $pdo->lastInsertId();
//     } else {
//         $orderID = $order['OrderID'];
//     }

//     // Check if the product is already in the cart
//     $stmt = $pdo->prepare("SELECT Quantity FROM OrderDetails WHERE OrderID = :orderID AND ProductID = :productID");
//     $stmt->execute(['orderID' => $orderID, 'productID' => $productID]);
//     $orderDetail = $stmt->fetch();

//     if ($orderDetail) {
//         // Update quantity if product already exists in the cart
//         $newQuantity = $orderDetail['Quantity'] + $quantity;
//         if ($newQuantity > $product['StockQuantity']) {
//             die("Insufficient stock for the updated quantity.");
//         }

//         $stmt = $pdo->prepare("UPDATE OrderDetails SET Quantity = :quantity, Price = :price WHERE OrderID = :orderID AND ProductID = :productID");
//         $stmt->execute([
//             'quantity' => $newQuantity,
//             'price' => $newQuantity * $product['Price'],
//             'orderID' => $orderID,
//             'productID' => $productID
//         ]);
//     } else {
//         // Insert new product into the cart
//         $stmt = $pdo->prepare("INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Price) VALUES (:orderID, :productID, :quantity, :price)");
//         $stmt->execute([
//             'orderID' => $orderID,
//             'productID' => $productID,
//             'quantity' => $quantity,
//             'price' => $quantity * $product['Price']
//         ]);
//     }

//     // Update stock quantity in the products table
//     $stmt = $pdo->prepare("UPDATE Products SET StockQuantity = StockQuantity - :quantity WHERE ProductID = :productID");
//     $stmt->execute(['quantity' => $quantity, 'productID' => $productID]);

//     echo "Product added to cart successfully!";
// } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }
?>
