<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/dashboard.css">
	<title>History</title>
	<style>
		.history-table {
			width: 100%;
			border-collapse: collapse;
			margin: 20px 0;
		}
		.history-table th, .history-table td {
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		.history-table th {
			background-color: #f4f4f4;
			font-weight: bold;
		}
		.history-table .status {
			padding: 5px 10px;
			border-radius: 5px;
			color: #fff;
			font-size: 12px;
		}
		.status.completed {
			background-color: #36a2eb;
		}
		.status.pending {
			background-color: #ffbb33;
		}
	</style>
</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i>QuickShop</a>
		<ul class="side-menu">
			<li><a href="../view/dashboard.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
			<li><a href="../view/shop.php"><i class='bx bxs-store icon'></i> Shop</a></li>
			<li><a href="../view/cart.php"><i class='bx bxs-cart icon'></i> Cart</a></li>
			<li><a href="../view/profile.php"><i class='bx bxs-user icon'></i> Profile</a></li>
			<li><a href="../admin/history.php" class="active"><i class='bx bx-history icon'></i> History</a></li>
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
					<input type="text" placeholder="Search history...">
					<i class='bx bx-search icon'></i>
				</div>
			</form>
			<div class="nav-right">
				<img src="../path-to-your-image/image.png" alt="Profile Picture" class="profile-pic">
			</div>
		</nav>

		<main>
			<h1 class="title">Order History</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">History</a></li>
			</ul>

			<table class="history-table">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Date</th>
						<th>Total</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>#001</td>
						<td>2024-11-20</td>
						<td>$85.00</td>
						<td><span class="status completed">Completed</span></td>
					</tr>
					<tr>
						<td>#002</td>
						<td>2024-11-18</td>
						<td>$40.00</td>
						<td><span class="status pending">Pending</span></td>
					</tr>
					<!-- Add more history entries as needed -->
				</tbody>
			</table>
		</main>
	</section>

</body>
</html>
