<?php
include_once "../actions/getuserDetails.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/shop.css">
	<title>Shop</title>
</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
		<ul class="side-menu">
			<li><a href="../views/shop.php" class="active"><i class='bx bxs-store icon'></i> Shop</a></li>
			<li><a href="../views/cart.php"><i class='bx bxs-cart icon'></i> Orders</a></li>
			<li><a href="../views/profile.php"><i class='bx bxs-user icon'></i> Profile</a></li>
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
                <?php echo getUserProfileImage() ?>
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
                include "../actions/get_products.php"

                ?>
				<!-- Product Card Example -->
                <!-- <div class="product-card">
                    <img src="../images/12.jpg" alt="Product 1">
                    <h3>Product Name 1</h3>
                    <p>Short description of the product.</p>
                    <span class="price">$25.00</span>
                    <input type="number" class="quantity-input" placeholder="Qty" min="1" value="1">
                    <button class="buy-btn">Add to Cart</button>
                </div>
                <div class="product-card">
                    <img src="../images/12.jpg" alt="Product 1">
                    <h3>Product Name 1</h3>
                    <p>Short description of the product.</p>
                    <span class="price">$25.00</span>
                    <input type="number" class="quantity-input" placeholder="Qty" min="1" value="1">
                    <button class="buy-btn">Add to Cart</button>
                </div>
                <div class="product-card">
                    <img src="../images/12.jpg" alt="Product 1">
                    <h3>Product Name 1</h3>
                    <p>Short description of the product.</p>
                    <span class="price">$25.00</span>
                    <input type="number" class="quantity-input" placeholder="Qty" min="1" value="1">
                    <button class="buy-btn">Add to Cart</button>
                </div> -->
				<!-- Add more products as needed -->
			</div>
		</main>
	</section>

    <script>
        document.querySelectorAll('.buy-btn').forEach((button) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const productCard = button.closest('.product-card');
            const quantityInput = productCard.querySelector('.quantity-input');
            const quantity = quantityInput.value || 1; // Default to 1 if not entered

            console.log(`Adding ${quantity} items to cart for product: ${productCard.querySelector('h3').textContent}`);
            // Handle cart addition here
        });
    });

    </script>

	<script>
	function addToCart(button) {
    const productID = button.getAttribute('data-product-id');
    const productCard = button.closest('.product-card');
    const quantityInput = productCard.querySelector('.quantity-input');
    const quantity = quantityInput.value || 1;

    if (!productID) {
        alert("Error: Product ID is missing.");
        return;
    }
    if (quantity <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    console.log(`ProductID: ${productID}, Quantity: ${quantity}`);

    fetch('../actions/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `ProductID=${encodeURIComponent(productID)}&Quantity=${encodeURIComponent(quantity)}`
    })
        .then(response => response.text())
        .then(data => {
            alert(data); // Display success or error message
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred while adding the product to the cart.");
        });
}





	</script>

</body>
</html>
