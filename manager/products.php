<?php
include '../settings/connection.php';

// Fetch products data
$query = $pdo->prepare("SELECT * FROM Products");
$query->execute();
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// Handle updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    
    if (isset($_POST['update_stock'])) {
        $new_stock = intval($_POST['stock_quantity']);
        // Update stock quantity in the database
        $update_stock_query = $pdo->prepare("UPDATE Products SET StockQuantity = :stock_quantity WHERE ProductID = :product_id");
        $update_stock_query->bindParam(':stock_quantity', $new_stock, PDO::PARAM_INT);
        $update_stock_query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $update_stock_query->execute();
    }
    
    if (isset($_POST['update_price'])) {
        $new_price = floatval($_POST['price']);
        // Update price in the database
        $update_price_query = $pdo->prepare("UPDATE Products SET Price = :price WHERE ProductID = :product_id");
        $update_price_query->bindParam(':price', $new_price, PDO::PARAM_STR);
        $update_price_query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $update_price_query->execute();
    }

    // Reload the page to reflect updated data
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Manage Products</title>
    <style>
        /* Styling for the navigation profile picture */
        .nav-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-right .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        /* Styling for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table thead th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Styling for buttons */
        button {
            background-color: #923d41;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            
            text-align: center;
        }

        button:hover {
            background-color: #2a91d0;
        }
    </style>
</head>
<body>
    <section id="sidebar">
        <a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
        <ul class="side-menu">
            <li><a href="../manager/products.php" class="active"><i class='bx bx-box icon'></i> Products</a></li>
            <li><a href="../manager/orders.php"><i class='bx bx-receipt icon'></i> Orders</a></li>
        </ul>
        <div class="ads">
            <div class="wrapper">
                <a href="../login/logout.php" class="btn-upgrade">Logout</a>
            </div>
        </div>
    </section>

    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
            <div class="nav-right">
                <img src="../images/12.jpg" alt="Profile Picture" class="profile-pic">
            </div>
        </nav>

        <main>
            <h1 class="title">Products</h1>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['ProductID']) ?></td>
                    <td><?= htmlspecialchars($product['Name']) ?></td>
                    <td><?= htmlspecialchars($product['Description']) ?></td>
                    <td><?= htmlspecialchars($product['Price']) ?></td>
                    <td><?= htmlspecialchars($product['StockQuantity']) ?></td>
                    <td>
                        <!-- Form to update stock -->
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['ProductID']) ?>">
                            <input type="number" name="stock_quantity" value="<?= htmlspecialchars($product['StockQuantity']) ?>" required>
                            <button type="submit" name="update_stock">Update Stock</button>
                        </form>
                        <!-- Form to update price -->
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['ProductID']) ?>">
                            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['Price']) ?>" required>
                            <button type="submit" name="update_price">Update Price</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </section>

    <script>
        function updateStock() {
            alert("Stock update functionality triggered.");
        }
    </script>
</body>
</html>
