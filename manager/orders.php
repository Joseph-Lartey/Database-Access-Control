<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>View Orders</title>
    <style>
        /* Navigation profile picture styling */
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
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100px;
            text-align: center;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* Main content styling */
        main {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .title {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
    </style>
</head>
<body>
    <section id="sidebar">
        <a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
        <ul class="side-menu">
            <li><a href="../view/dashboard.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li><a href="../manager/products.php"><i class='bx bx-box icon'></i> Products</a></li>
            <li><a href="../manager/orders.php" class="active"><i class='bx bx-receipt icon'></i> Orders</a></li>
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
            <h1 class="title">Orders</h1>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Order Details</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Order records -->
                    <tr>
                        <td>1001</td>
                        <td>John Doe</td>
                        <td>$250.00</td>
                        <td>Completed</td>
                        <td>
                            <button onclick="viewDetails()">View Details</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1002</td>
                        <td>Jane Smith</td>
                        <td>$120.00</td>
                        <td>Pending</td>
                        <td>
                            <button onclick="viewDetails()">View Details</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    </section>

    <script>
        function viewDetails() {
            alert("Order details view triggered.");
        }
    </script>
</body>
</html>
