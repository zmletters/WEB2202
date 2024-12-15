<?php
session_start();
require('mysqli_connect.php');

if (isset($_POST['cart_id'], $_POST['action'])) {
    $cart_id = intval($_POST['cart_id']);
    $action = $_POST['action'];

    // Fetch the current quantity from the database
    $stmt = $dbc->prepare("SELECT quantity FROM cart WHERE id = ?");
    $stmt->bind_param('i', $cart_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cartItem = $result->fetch_assoc();
    $stmt->close();

    if ($cartItem) {
        $quantity = $cartItem['quantity'];

        // Adjust quantity based on action
        if ($action == 'increment') {
            $quantity++;
        } elseif ($action == 'decrement' && $quantity > 1) {
            $quantity--;
        }

        // Update the quantity in the database
        $stmt = $dbc->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->bind_param('ii', $quantity, $cart_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Redirect back to the cart page
header('Location: cart.php');
exit();
