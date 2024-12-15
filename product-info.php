<?php
include('inc/session.inc.php');
require('mysqli_connect.php');
require('inc/functions.inc.php');

// Handle Add to Cart Logic
// Handle Add to Cart Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    check_user_logged_in();

    $user_id = $_SESSION['user_id']; // Ensure the user is logged in
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Validate input
    if ($user_id && $product_id && $quantity > 0) {
        // Check if the product with 'active' status already exists in the cart
        $query = "
            INSERT INTO cart (user_id, product_id, quantity, status) 
            VALUES (?, ?, ?, 'active') 
            ON DUPLICATE KEY UPDATE 
                quantity = quantity + VALUES(quantity), 
                status = 'active'
        ";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param('iii', $user_id, $product_id, $quantity);

        if ($stmt->execute()) {
            // Optionally redirect to cart or show a success message
            header('Location: cart.php'); // Redirect to cart page
            exit();
        } else {
            $error_message = 'Could not add to cart. Please try again later.';
        }
    } else {
        $error_message = 'Invalid product or quantity.';
    }
}

// Fetch Product Details
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $stmt = $dbc->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("Invalid product ID.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']); ?> - Product Info</title>
    <link rel="stylesheet" href="css/product-info.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <!-- Navbar -->
    <?php include('inc/navbar.inc.php'); ?>

    <div class="product-info-container">
        <div class="product-content">
            <!-- Product Image -->
            <div class="product-image">
                <img src="<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 class="product-title"><?= htmlspecialchars($product['name']); ?></h1>
                <p class="product-price">RM <?= number_format($product['price'], 2); ?>/<?= htmlspecialchars($product['unit']); ?></p>
                <p class="product-description"><?= htmlspecialchars($product['description']); ?></p>

                <!-- Rating Section -->
                <!-- <div class="product-rating">
                    <span class="rating-value">4.8</span>
                    <span class="rating-count">(1,873 reviews)</span>
                    <img src="img/star.svg" alt="Rating Icon">
                </div> -->

                <!-- Add to Cart Form -->
                <div class="product-actions">
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>">
                        <input type="hidden" id="hidden-quantity" name="quantity" value="1"> <!-- Hidden input -->

                        <!-- Quantity Selector -->
                        <div class="quantity-section">
                            <button type="button" class="decrement">-</button>
                            <span id="quantity" class="quantity">1</span>
                            <button type="button" class="increment">+</button>
                        </div>

                        <!-- Add to Cart Button -->
                        <button type="submit" class="add-to-cart">
                            <img src="img/shopping-cart-outline.svg" alt="Cart Icon"> Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('inc/footer.inc.php'); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const decrementButton = document.querySelector(".decrement");
            const incrementButton = document.querySelector(".increment");
            const quantitySpan = document.getElementById("quantity");
            const hiddenQuantityInput = document.getElementById("hidden-quantity");

            // Decrement quantity
            decrementButton.addEventListener("click", function() {
                let currentValue = parseInt(quantitySpan.textContent, 10);
                if (currentValue > 1) {
                    currentValue--;
                    quantitySpan.textContent = currentValue;
                    hiddenQuantityInput.value = currentValue; // Update hidden input
                }
            });

            // Increment quantity
            incrementButton.addEventListener("click", function() {
                let currentValue = parseInt(quantitySpan.textContent, 10);
                currentValue++;
                quantitySpan.textContent = currentValue;
                hiddenQuantityInput.value = currentValue; // Update hidden input
            });
        });
    </script>
</body>

</html>