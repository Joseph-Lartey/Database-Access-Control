// Handle "Add to Cart" button clicks
document.querySelectorAll('.buy-btn').forEach((button) => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        const productCard = button.closest('.product-card');
        const quantityInput = productCard.querySelector('.quantity-input');
        const quantity = quantityInput.value || 1; // Default to 1 if not entered

        console.log(`Adding ${quantity} items to cart for product: ${productCard.querySelector('h3').textContent}`);
        // Add logic to handle cart addition here (e.g., API call or local storage update)
        alert(`${quantity} of ${productCard.querySelector('h3').textContent} added to cart.`);
    });
});

// Redirect to the product creation page
document.getElementById('createItemButton').addEventListener('click', function () {
    window.location.href = '../actiom/add_to_cart.php';
});
