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

        .quantity-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .quantity-input {
        width: 60px;
        height: 30px;
        text-align: center;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.3s;
    }

    .quantity-input:focus {
        border-color: #2a91d0;
        box-shadow: 0 0 5px rgba(42, 145, 208, 0.5);
    }

    .buy-btn {
        display: inline-block;
        padding: 8px 15px;
        background-color: #923d41;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .buy-btn:hover {
        background-color: #2a91d0;
    }
    </style>

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
