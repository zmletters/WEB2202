<?php
include('inc/session.inc.php');
include('mysqli_connect.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cartId = intval($_POST['cart_id']);

    // Prepare the query to delete the specific cart item
    $query = "DELETE FROM cart WHERE id = ?";
    $stmt = $dbc->prepare($query);
    $stmt->bind_param('i', $cartId);

    if ($stmt->execute()) {
        // Redirect back to the cart page after successful deletion
        header('Location: cart.php');
        exit();
    } else {
        // Handle errors if the deletion fails
        echo "Error removing item: " . $dbc->error;
    }

    $stmt->close();
} else {
    // Redirect to cart page if accessed improperly
    header('Location: cart.php');
    exit();
}
