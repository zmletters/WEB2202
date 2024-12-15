<?php
include('inc/session.inc.php');
require('mysqli_connect.php');
require('inc/functions.inc.php');

// Ensure user is logged in
check_user_logged_in();

if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    header('Location: cart.php');
    exit();
}

$order_id = intval($_GET['order_id']);

// Fetch order details
$query = "
    SELECT o.id AS order_id, o.total_amount, o.order_date, o.shipping_address, o.status 
    FROM orders o
    WHERE o.id = ? AND o.user_id = ?
";
$stmt = $dbc->prepare($query);
$stmt->bind_param('ii', $order_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $order = $result->fetch_assoc();
} else {
    die("Order not found or access denied.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/order_confirmation.css">
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>
    <main>
        <div class="confirmation-page">
            <h1>Order Confirmation</h1>
            <p>Thank you for your order! Your order has been successfully placed.</p>
            <h2>Order Details</h2>
            <p><strong>Order ID:</strong> <?= $order['order_id']; ?></p>
            <p><strong>Total Amount:</strong> RM <?= number_format($order['total_amount'], 2); ?></p>
            <p><strong>Order Date:</strong> <?= $order['order_date']; ?></p>
            <p><strong>Shipping Address:</strong> <?= htmlspecialchars($order['shipping_address']); ?></p>
            <p><strong>Status:</strong> <?= ucfirst($order['status']); ?></p>
            <a href="products.php" class="back-to-products">&larr; Continue Shopping</a>
        </div>
    </main>
    <?php include('inc/footer.inc.php'); ?>
</body>

</html>