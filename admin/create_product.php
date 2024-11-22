<?php
include "../settings/core.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/create_product.css">
    <title>Create Product</title>
</head>

<body>
    <form class="container-15" id="myModal" method="POST" action="../actions/create_product.php">
        <div class="container-16">
            <div class="close-form-group">
                <button name="closeButton" id="closePopup" onclick="closePopup()">Close</button>
            </div>
            <input type="hidden" name="employee_ID" value="<?php echo $_SESSION['userID']; ?>">

            <div class="form-group">
                <label for="productname">Product Name:</label>
                <input type="text" required name="product_name" id="product_name" placeholder="Product Name" required>
                
                <label for="description">Product Description:</label>
                <input type="text" required name="product_description" id="product_description" placeholder="Product Description" required>
                
                <label for="price">Product Price:</label>
                <input type="text" required name="price" id="price" placeholder="Product Price" required>

                <label for="image">Product Image:</label>
                <input type="" name="image" id="image" placeholder="Product Image">
            </div>
            <input type="hidden" name="request_status" value="pending">

            <div class="submit">
                <button name="submitButton">Create</button>
            </div>
        </div>
    </form>
    <script src="../javascript/create_product.js" defer></script>
</body>

</html>