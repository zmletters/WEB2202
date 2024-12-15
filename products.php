<?php

include('inc/session.inc.php');

require('mysqli_connect.php');


// Handle Add to Cart functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'] ?? null; // Ensure the user is logged in
    $product_id = intval($_POST['product_id']);
    $quantity = 1; // Adding 1 quantity by default

    if ($user_id && $product_id > 0) {
        // Insert or update the cart
        $query = "INSERT INTO cart (user_id, product_id, quantity) 
                  VALUES (?, ?, ?) 
                  ON DUPLICATE KEY UPDATE quantity = quantity + ?,
                  status = 'active'";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param('iiii', $user_id, $product_id, $quantity, $quantity);

        if ($stmt->execute()) {
            // Successfully added to cart, refresh the page
            header('Location: products.php');
            exit();
        } else {
            echo '<p>Error: Could not add to cart. Please try again later.</p>';
        }
    } else {
        echo '<p>Error: You must be logged in to add to the cart.</p>';
        header('Location: login.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <!-- Navbar -->
    <?php include('inc/navbar.inc.php'); ?>
    <div class="products">


        <!-- Search and Deals Section
        <div class="search-deals">
            <div class="search-bar">
                <input type="text" placeholder="Search for anything...">
                <button class="search-btn"><img src="img/icon-59.svg" alt="Search"></button>
            </div>
        </div> -->

        <!-- Product Listing -->
        <h2>All Products</h2>
        <div class="product-list">
            <?php
            // Fetch products from the database
            $sql = "SELECT * FROM products"; // Keep this simple to avoid filtering.

            $result = $dbc->query($sql);

            if (!$result) {
                die("Error fetching products: " . $dbc->error);
            }
            // Check if there are any products
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="product-card">
                        <a href="product-info.php?id=' . $row['product_id'] . '">
                        <img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">
                        </a>
                        <div class="product-info">
                            <h3>' . htmlspecialchars($row['name']) . '</h3>
                            <p class="price">RM' . number_format($row['price'], 2) . '/' . htmlspecialchars($row['unit']) . ' </p>

                            <form action="products.php" method="POST">
                                <input type="hidden" name="product_id" value="' . $row['product_id'] . '">
                                <button type="submit" class="add-to-cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No products available at the moment.</p>';
            }
            ?>
        </div>


    </div>
</body>

<!-- Footer -->
<?php include('inc/footer.inc.php'); ?>

</html>


<!-- <img src="img/shopping-cart-outline.svg" alt="Cart Icon"> -->