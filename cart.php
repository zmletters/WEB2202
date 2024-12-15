<?php
require('inc/functions.inc.php');

// if (isset($_SESSION['first_name'])) {
// } else {
//     redirect_user('home.php');
// }

include('inc/session.inc.php');
include('mysqli_connect.php'); // Include database connection file

// Fetch cart data with product details from the database
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
    $query = "
    SELECT 
        c.id AS cart_id, 
        c.quantity, 
        p.product_id, 
        p.name AS product_name, 
        p.price, 
        p.image_url 
    FROM cart c
    INNER JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id = ? AND c.status = 'active'
";
    $stmt = $dbc->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $cartItems = [];
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
    $stmt->close();
} else {
    $cartItems = [];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/cart.css">
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>
    <main>
        <div class="cart-page">


            <div class="cart-container">
                <h1>Cart</h1>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td>
                                    <div class="cart-item">
                                        <img src="<?php echo $item['image_url']; ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" class="cart-item-image">
                                        <span><?php echo htmlspecialchars($item['product_name']); ?></span>
                                    </div>
                                </td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                <td>
                                    <div class="quantity-control">
                                        <!-- Quantity Update Form -->
                                        <form action="update_cart.php" method="POST" class="update-quantity-form">
                                            <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                            <button type="submit" name="action" value="decrement" class="quantity-btn">-</button>
                                            <input type="text" name="quantity" value="<?php echo $item['quantity']; ?>" class="quantity-input" readonly>
                                            <button type="submit" name="action" value="increment" class="quantity-btn">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td>
                                    <form action="remove_from_cart.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                        <button type="submit" class="remove-btn">X Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="cart-footer">
                    <a href="products.php" class="back-to-shopping">&larr; Back to shopping</a>
                    <div class="total-price">
                        Total Price: <span>$<?php echo number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems)), 2); ?></span>
                    </div>
                    <a href="checkout.php" class="checkout-btn">Check Out</a>
                </div>
            </div>


        </div>
    </main>
    <?php include('inc/footer.inc.php'); ?>
</body>



</html>