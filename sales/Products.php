<?php
// Include the connection file
include_once "../settings/connection.php";

// Fetch all products from the database
function getAllProducts() {
    global $pdo;
    $query = "SELECT ProductID, Name, Description, Price, StockQuantity, ProductImage FROM Products ORDER BY Name ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$products = getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Products</title>
    <style>
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
        }

        .product-table th, .product-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section id="sidebar">
		<a href="../sales/SalesOrders.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
        <ul class="side-menu">
            <li><a href="../sales/SalesOrders.php" ><i class='bx bxs-cart icon'></i> Orders</a></li>
			<li><a href="../sales/Products.php" class="active"><i class='bx bxs-store icon'></i> Products</a></li>
            <li><a href="../sales/profile.php"><i class='bx bxs-user icon'></i> Profile</a></li>
        </ul>
        <div class="ads">
            <div class="wrapper">
                <a href="../views/logout.php" class="btn-upgrade">Logout</a>
            </div>
        </div>
    </section>

    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search Products...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
        </nav>

        <main>
            <h1 class="title">Products</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Products</a></li>
            </ul>

            <table class="product-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <img 
                                    src="<?php echo htmlspecialchars($product['ProductImage'] ?: '../images/default.png'); ?>" 
                                    alt="Product Image" 
                                    class="product-image"
                                >
                            </td>
                            <td><?php echo htmlspecialchars($product['Name']); ?></td>
                            <td><?php echo htmlspecialchars($product['Description']); ?></td>
                            <td>$<?php echo number_format($product['Price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($product['StockQuantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </section>
</body>
</html>
