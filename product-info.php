<?php
session_start();
require('mysqli_connect.php');

// Fetch product details
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
                <p class="product-price">$<?= number_format($product['price'], 2); ?>/100g</p>
                <p class="product-description"><?= htmlspecialchars($product['description']); ?></p>

                <!-- Rating Section -->
                <div class="product-rating">
                    <span class="rating-value">4.8</span>
                    <span class="rating-count">(1,873 reviews)</span>
                    <img src="img/star.svg" alt="Rating Icon">
                </div>

                <!-- Quantity Selector -->
                <div class="quantity-section">
                    <button class="decrement">-</button>
                    <span class="quantity">1</span>
                    <button class="increment">+</button>
                </div>

                <!-- Action Buttons -->
                <div class="product-actions">
                    <button class="order-now">Order Now</button>
                    <button class="add-to-cart">
                        <img src="img/cart.svg" alt="Cart Icon"> Add to Cart
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="tabs">
            <button class="tab active">Description</button>
            <button class="tab">Reviews</button>
        </div>

        <!-- Reviews Section -->
        <section class="reviews">
            <h2>Add a Review</h2>
            <textarea placeholder="Share your thoughts..."></textarea>
            <button class="submit-review">Post It</button>

            <div class="comments">
                <h3>Comments (3)</h3>
                <div class="comment">
                    <p><strong>Darren Leong</strong> - Tasty!</p>
                    <p>about 1 hour ago</p>
                </div>
                <div class="comment">
                    <p><strong>Charles Wang</strong> - Good for health!</p>
                    <p>about 1 hour ago</p>
                </div>
            </div>
        </section>
    </div>
    <!-- Footer -->
    <?php include('inc/footer.inc.php'); ?>

</body>


</html>