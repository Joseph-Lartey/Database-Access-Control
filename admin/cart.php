<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewsport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/cart.css">
	<title>Cart</title>
</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
		<ul class="side-menu">
            <li><a href="../admin/dashboard.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li><a href="../admin/shop.php"><i class='bx bxs-store icon'></i> Shop</a></li>
			<li><a href="../admin/cart.php" class="active"><i class='bx bxs-cart icon'></i> Cart</a></li>
			<li><a href="../admin/profile.php"><i class='bx bxs-user icon'></i> Profile</a></li>
			<li><a href="../admin/history.php"><i class='bx bx-history icon'></i> History</a></li>
            <li><a href="../admin/manage_roles.php"><i class='bx bx-history icon' ></i>Manage Users</a></li>

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
				<img src="../path-to-your-image/image.png" alt="Profile Picture" class="profile-pic">
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

			<div class="total-container">
				<p class="total-price">Total: $85.00</p>
				<a href="#" class="checkout-btn">Proceed to Checkout</a>
			</div>
		</main>
	</section>

</body>
</html>
