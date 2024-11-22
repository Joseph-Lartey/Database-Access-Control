<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>View Orders</title>
    <style>
		.nav-right {
    margin-left: auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-right .profile-pic {
    width: 40px; /* Adjust size as needed */
    height: 40px;
    border-radius: 50%; /* Makes it circular */
    object-fit: cover;
    cursor: pointer;
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
			<i class='bx bx-menu toggle-sidebar' ></i>
			<form action="#">
				<div class="form-group">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</form>
			<!-- <a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a> -->
			<div class="nav-right">
				<img src="../images/12.jpg" alt="Profile Picture" class="profile-pic">
			</div>

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
                    <!-- Order records go here -->
                    <tr>
                        <td>1001</td>
                        <td>John Doe</td>
                        <td>$250.00</td>
                        <td>Completed</td>
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

