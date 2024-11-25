<?php
include_once "../actions/getuserDetails.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewsport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/dashboard.css">
	<title>orders</title>
	<style>
		.cart-table {
			width: 100%;
			border-collapse: collapse;
			margin: 20px 0;
		}
		.cart-table th, .cart-table td {
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		.cart-table th {
			background-color: #f4f4f4;
			font-weight: bold;
		}
		.cart-table .remove-btn {
			color: #ff5252;
			cursor: pointer;
		}
		.total-container {
			text-align: right;
			padding: 20px;
		}
		.total-container .total-price {
			font-size: 20px;
			font-weight: bold;
		}
		.total-container .checkout-btn {
			display: inline-block;
			padding: 10px 20px;
			background-color: #36a2eb;
			color: #fff;
			border-radius: 5px;
			text-decoration: none;
			margin-top: 10px;
		}
		.total-container .checkout-btn:hover {
			background-color: #2a91d0;
		}
	</style>
</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
		<ul class="side-menu">
			<li><a href="../views/shop.php"><i class='bx bxs-store icon'></i> Shop</a></li>
			<li><a href="../views/cart.php" class="active"><i class='bx bxs-cart icon'></i> Orders</a></li>
			<li><a href="../views/profile.php"><i class='bx bxs-user icon'></i> Profile</a></li>
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
					<input type="text" placeholder="Search in Cart...">
					<i class='bx bx-search icon'></i>
				</div>
			</form>
			<div class="nav-right">
			<?php echo getUserProfileImage() ?>
			</div>
		</nav>

		<main>
			<h1 class="title">Cart</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Cart</a></li>
			</ul>

			<table class="cart-table">
				<thead>
					<tr>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php include "../actions/get_cart.php"; ?>


					<!-- <tr>
						<td>Product Name 1</td>
						<td>$25.00</td>
						<td>2</td>
						<td>$50.00</td>
						<td><span class="remove-btn">Remove</span></td>
					</tr>
					<tr>
						<td>Product Name 2</td>
						<td>$35.00</td>
						<td>1</td>
						<td>$35.00</td>
						<td><span class="remove-btn">Remove</span></td>
					</tr> -->
				</tbody>
			</table>

			<!-- <div class="total-container">
				<p class="total-price">Total: $85.00</p>
				<a href="#" class="checkout-btn">Proceed to Checkout</a>
			</div> -->
		</main>
	</section>

</body>
</html>
