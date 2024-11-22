<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Manage Products</title>
</head>
<body>
    <section id="sidebar">
        <a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
        <ul class="side-menu">
            <li><a href="../view/dashboard.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
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
            <div class="nav-right">
                <img src="../images/12.jpg" alt="Profile Picture" class="profile-pic">
            </div>
        </nav>

        <main>
            <h1 class="title">Products</h1>
            <button onclick="updateStock()">Update Stock</button>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Product records go here -->
                    <tr>
                        <td>001</td>
                        <td>Sample Product</td>
                        <td>Category A</td>
                        <td>$25.00</td>
                        <td>100</td>
                        <td>
                            <button onclick="editProduct()">Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    </section>

    <script>
        function updateStock() {
            alert("Stock update functionality triggered.");
        }

        function editProduct() {
            alert("Edit product functionality triggered.");
        }
    </script>
</body>
</html>
