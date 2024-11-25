<?php
include_once "../actions/getOrderSales.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Orders</title>
    <style>
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
        }
        .order-table th, .order-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .order-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

		/* Style for the Status text */
		.status {
			display: inline-block;
			padding: 5px 12px;
			border-radius: 5px;
			color: #fff;
			text-align: center;
			font-size: 14px;
			font-weight: bold;
			margin-right: 10px;
		}

		/* Specific styles for each status */
		.status.unprocessed {
			background-color: #f44336; /* Red for unprocessed */
		}

		.status.processed {
			background-color: #4caf50; /* Green for processed */
		}

		/* Style for the buttons */
		.btn-process {
			display: inline-block;
			background-color: #36a2eb;
			color: white;
			padding: 5px 10px;
			text-decoration: none;
			border-radius: 5px;
			font-weight: bold;
			font-size: 14px;
			transition: background-color 0.3s ease;
		}

		.btn-process:hover {
			background-color: #287ab4;
		}

		.btn-process:active {
			background-color: #1d6f92;
		}

		/* Align the content in the Status column */
		td:last-child {
			display: flex;
			align-items: center;
			gap: 10px; /* Add space between status and button */
			justify-content: flex-start; /* Align left */
		}

		/* Adjust the table for consistent spacing */
		.order-table th, .order-table td {
			vertical-align: middle; /* Align text vertically in the center */
		}




    </style>
</head>
<body>
    <section id="sidebar">
        <a href="../admin/shop.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
        <ul class="side-menu">
			<li><a href="../admin/shop.php"><i class='bx bxs-store icon' ></i> Shop</a></li>
			<li><a href="../admin/profile.php"><i class='bx bxs-user icon' ></i> Profile</a></li>
			<li><a href="../admin/role.php"><i class='bx bx-history icon' ></i>Roles</a></li>
			<li><a href="../admin/orders.php" class="active"><i class='bx bx-store icon' ></i>Orders</a></li>
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
                    <input type="text" placeholder="Search Orders...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
        </nav>

        <main>
		<h1 class="title">Orders</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Cart</a></li>
			</ul>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Item Purchased</th>
                        <th>Quantity</th>
                        <th>Price (Subtotal)</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
					<?php foreach ($orders as $order): 
						$customerName = $order['CustomerName'] ?? 'N/A';
						$email = $order['Email'] ?? 'N/A';
						$itemName = $order['ItemName'] ?? 'N/A';
						$quantity = $order['Quantity'] ?? 0;
						$subtotal = $order['Subtotal'] ?? 0.00;
						$date = $order['OrderDate'] ?? 'N/A';
						$status = strtolower($order['OrderStatus'] ?? 'unprocessed');
						$orderDetailID = $order['OrderDetailID'] ?? null;

						if (!$orderDetailID) {
							echo "<tr><td colspan='7'>Invalid Order Detail ID</td></tr>";
							continue;
						}
					?>
					<tr>
						<td><?php echo htmlspecialchars($customerName); ?></td>
						<td><?php echo htmlspecialchars($email); ?></td>
						<td><?php echo htmlspecialchars($itemName); ?></td>
						<td><?php echo htmlspecialchars($quantity); ?></td>
						<td>$<?php echo number_format($subtotal, 2); ?></td>
						<td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($date))); ?></td>
						<td>
							<span class="status <?php echo htmlspecialchars($status); ?>">
								<?php echo ucfirst($status); ?>
							</span>
							<?php if ($status === 'unprocessed'): ?>
								<a href="../actions/updateOrderStatus.php?orderDetailID=<?php echo urlencode($orderDetailID); ?>&status=processed" class="btn-process">Mark as Processed</a>
							<?php elseif ($status === 'processed'): ?>
								<a href="../actions/updateOrderStatus.php?orderDetailID=<?php echo urlencode($orderDetailID); ?>&status=unprocessed" class="btn-process">Mark as Unprocessed</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
            </table>
        </main>
    </section>
</body>
</html>
