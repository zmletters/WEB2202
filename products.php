<?php

include('inc/session.inc.php');

require('mysqli_connect.php');


// Handle Add to Cart functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'] ?? null; // Ensure the user is logged in
    $product_id = intval($_POST['product_id']);
    $quantity = 1; // Adding 1 quantity by default

    if ($user_id && $product_id > 0) {
        // Check if the product is already in the cart with 'active' status
        $check_query = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ? AND status = 'active'";
        $stmt = $dbc->prepare($check_query);
        $stmt->bind_param('ii', $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If the product is already in the cart, update the quantity
            $row = $result->fetch_assoc();
            $new_quantity = $row['quantity'] + $quantity;

            $update_query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ? AND status = 'active'";
            $update_stmt = $dbc->prepare($update_query);
            $update_stmt->bind_param('iii', $new_quantity, $user_id, $product_id);

            if ($update_stmt->execute()) {
                // Successfully updated, refresh the page
                header('Location: products.php');
                exit();
            } else {
                echo '<p>Error: Could not update the cart. Please try again later.</p>';
            }
        } else {
            // If the product is not in the cart, insert it
            $insert_query = "INSERT INTO cart (user_id, product_id, quantity, status) 
                             VALUES (?, ?, ?, 'active')";
            $insert_stmt = $dbc->prepare($insert_query);
            $insert_stmt->bind_param('iii', $user_id, $product_id, $quantity);

            if ($insert_stmt->execute()) {
                // Successfully added to cart, refresh the page
                header('Location: products.php');
                exit();
            } else {
                echo '<p>Error: Could not add to the cart. Please try again later.</p>';
            }
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
    <!-- Footer -->
    <?php include('inc/footer.inc.php'); ?>
</body>



</html>


<!-- <img src="img/shopping-cart-outline.svg" alt="Cart Icon"> -->