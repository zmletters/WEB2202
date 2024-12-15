<?php

session_start();

require('mysqli_connect.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/productstyle.css">
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

                            <button class="add-to-cart">
                                <img src="img/shopping-cart-outline.svg" alt="Cart Icon"> Add to Cart
                            </button>
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