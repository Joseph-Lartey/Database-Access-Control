<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/shop.css">
	<title>Shop</title>
	<style>
		.shop-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
			gap: 20px;
			padding: 20px;
		}
		.product-card {
			border: 1px solid #ddd;
			border-radius: 10px;
			overflow: hidden;
			text-align: center;
			background-color: #fff;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
			transition: transform 0.2s ease-in-out;
		}
		.product-card:hover {
			transform: translateY(-5px);
		}
		.product-card img {
			width: 100%;
			height: 150px;
			object-fit: cover;
		}
		.product-card h3 {
			font-size: 18px;
			margin: 10px 0;
		}
		.product-card p {
			color: #777;
			font-size: 14px;
			margin: 10px;
		}
		.product-card .price {
			font-weight: bold;
			color: #333;
			font-size: 16px;
		}
		.product-card .buy-btn {
			display: inline-block;
			margin: 10px 0;
			padding: 10px 20px;
			background-color: #923d41;
			color: #fff;
			border-radius: 5px;
			text-decoration: none;
			transition: background-color 0.3s;
		}
		.product-card .buy-btn:hover {
			background-color: #2a91d0;
		}
	</style>
</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
		<ul class="side-menu">
			<li><a href="../view/dashboard.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
			<li><a href="../view/shop.php" class="active"><i class='bx bxs-store icon'></i> Shop</a></li>
			<li><a href="../view/cart.php"><i class='bx bxs-cart icon'></i> Cart</a></li>
			<li><a href="../view/profile.php"><i class='bx bxs-user icon'></i> Profile</a></li>
			<li><a href="../admin/history.php"><i class='bx bx-history icon'></i> History</a></li>
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
				<!-- Product Card Example -->
				<div class="product-card">
					<img src="../images/12.jpg" alt="Product 1">
					<h3>Product Name 1</h3>
					<p>Short description of the product.</p>
					<span class="price">$25.00</span>
					<a href="#" class="buy-btn">Buy Now</a>
				</div>
				<div class="product-card">
					<img src="../images/12.jpg" alt="Product 2">
					<h3>Product Name 2</h3>
					<p>Short description of the product.</p>
					<span class="price">$35.00</span>
					<a href="#" class="buy-btn">Buy Now</a>
				</div>
				<div class="product-card">
					<img src="../images/12.jpg" alt="Product 3">
					<h3>Product Name 3</h3>
					<p>Short description of the product.</p>
					<span class="price">$45.00</span>
					<a href="#" class="buy-btn">Buy Now</a>
				</div>
				<!-- Add more products as needed -->
			</div>
		</main>
	</section>

</body>
</html>
