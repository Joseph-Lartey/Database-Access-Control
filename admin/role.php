<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/dashboard.css">
	<title>Shop</title>
</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
		<ul class="side-menu">
			<li><a href="../admin/dashboard.php"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li><a href="../admin/shop.php"><i class='bx bxs-store icon' ></i> Shop</a></li>
			<li><a href="../admin/profile.php"><i class='bx bxs-user icon' ></i> Profile</a></li>
			<li><a href="../admin/role.php" class="active"><i class='bx bx-history icon' ></i>Roles</a></li>
			<li><a href="../admin/orders.php"><i class='bx bx-store icon' ></i>Orders</a></li>
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
					<input type="text" placeholder="Search products...">
					<i class='bx bx-search icon'></i>
				</div>
			</form>
			<div class="nav-right">
				<img src="../path-to-your-image/image.png" alt="Profile Picture" class="profile-pic">
			</div>
		</nav>

		<main>
			<h1 class="title">Shop</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Shop</a></li>
			</ul>

			<div class="shop-grid">
                <?php
                include "../actions/get_users.php"
                ?>
			</div>
		</main>
	</section>

	<!-- Include the external JavaScript file -->
	<script src="../javascript/shop.js"></script>

</body>
</html>
