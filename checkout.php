<?php
include('inc/session.inc.php');
require('mysqli_connect.php');
require('inc/functions.inc.php');

// Ensure user is logged in
check_user_logged_in();

$user_id = $_SESSION['user_id'];
$total_amount = 0;

// Fetch active cart items
$query = "
    SELECT 
        c.id AS cart_id, 
        c.quantity, 
        p.product_id, 
        p.name AS product_name, 
        p.price, 
        (c.quantity * p.price) AS total_price
    FROM cart c
    INNER JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id = ? AND c.status = 'active'
";
$stmt = $dbc->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
    $total_amount += $row['total_price'];
}
$stmt->close();

// Handle Order Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shipping_address = trim($_POST['shipping_address']);

    if (empty($shipping_address)) {
        $error_message = "Shipping address is required.";
    } else {
        // Insert order into the `orders` table
        $order_query = "
            INSERT INTO orders (user_id, total_amount, shipping_address, status) 
            VALUES (?, ?, ?, 'pending')
        ";
        $stmt = $dbc->prepare($order_query);
        $stmt->bind_param('ids', $user_id, $total_amount, $shipping_address);

        if ($stmt->execute()) {
            // Get the last inserted order ID
            $order_id = $stmt->insert_id;

            // Update the cart items to `checked_out`
            $update_cart_query = "
                UPDATE cart 
                SET status = 'checked_out' 
                WHERE user_id = ? AND status = 'active'
            ";
            $cart_stmt = $dbc->prepare($update_cart_query);
            $cart_stmt->bind_param('i', $user_id);
            $cart_stmt->execute();
            $cart_stmt->close();

            // Redirect to a confirmation page or show success message
            header('Location: order_confirmation.php?order_id=' . $order_id);
            exit();
        } else {
            $error_message = "Failed to place order. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>
    <main>
        <div class="checkout-page">
            <h1>Checkout</h1>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?= htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <!-- Cart Details -->
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['product_name']); ?></td>
                            <td>RM <?= number_format($item['price'], 2); ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td>RM <?= number_format($item['total_price'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Order Form -->
            <form action="checkout.php" method="POST">
                <div class="form-group">
                    <label for="shipping_address">Shipping Address:</label>
                    <textarea id="shipping_address" name="shipping_address" rows="3" required></textarea>
                </div>
                <div class="total-amount">
                    Total Amount: <span>RM <?= number_format($total_amount, 2); ?></span>
                </div>
                <button type="submit" class="order-btn">Place Order</button>
            </form>
        </div>
    </main>
    <?php include('inc/footer.inc.php'); ?>
</body>

</html>