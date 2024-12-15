<?php
include('inc/session.inc.php');
require('mysqli_connect.php');

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) && $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Initialize messages
$success_message = $error_message = "";

// Handle Save User (Edit User)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_user'])) {
    $user_id = intval($_POST['user_id']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']) ?: null;
    $phone_no = trim($_POST['phone_no']) ?: null;
    $role = trim($_POST['role']);

    $stmt = $dbc->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, address = ?, phone_no = ?, role = ? WHERE user_id = ?");
    $stmt->bind_param('ssssssi', $first_name, $last_name, $email, $address, $phone_no, $role, $user_id);

    if ($stmt->execute()) {
        $success_message = "User updated successfully!";
    } else {
        $error_message = "Error updating user: " . $stmt->error;
    }
}

// Handle Delete User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id = intval($_POST['user_id']);

    $stmt = $dbc->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        $success_message = "User deleted successfully!";
    } else {
        $error_message = "Error deleting user: " . $stmt->error;
    }
}


// Handle Update Order Status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_order'])) {
    $order_id = intval($_POST['order_id']);
    $status = trim($_POST['status']);

    // Fetch the user's details for the notification
    $fetch_user_query = "SELECT user_id FROM orders WHERE id = ?";
    $user_stmt = $dbc->prepare($fetch_user_query);
    $user_stmt->bind_param('i', $order_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();

    if ($user_result->num_rows === 1) {
        $user = $user_result->fetch_assoc();
        $user_id = $user['user_id'];

        // Update order status
        $update_order_query = "UPDATE orders SET status = ? WHERE id = ?";
        $order_stmt = $dbc->prepare($update_order_query);
        $order_stmt->bind_param('si', $status, $order_id);

        if ($order_stmt->execute()) {
            // Insert a notification for the user
            $message = "Hey! The status of your order for Order ID: $order_id is now $status!";
            $insert_notification_query = "INSERT INTO notification (user_id, message, is_read) VALUES (?, ?, 0)";
            $notif_stmt = $dbc->prepare($insert_notification_query);
            $notif_stmt->bind_param('is', $user_id, $message);

            if ($notif_stmt->execute()) {
                $success_message = "Order status updated successfully, and user notified!";
            } else {
                $error_message = "Order updated, but notification failed: " . $notif_stmt->error;
            }
            $notif_stmt->close();
        } else {
            $error_message = "Error updating order status: " . $order_stmt->error;
        }
        $order_stmt->close();
    } else {
        $error_message = "Error finding user for this order.";
    }
    $user_stmt->close();
}


// Fetch all users
$users = $dbc->query("SELECT * FROM users");

// Fetch all orders
$orders = $dbc->query("SELECT o.id AS order_id, o.user_id, u.first_name, u.last_name, o.total_amount, o.order_date, o.shipping_address, o.status 
                       FROM orders o 
                       INNER JOIN users u ON o.user_id = u.user_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users and Orders</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/navbar.css" />
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>
    <h1>Admin - Manage Users and Orders</h1>

    <!-- Success and Error Messages -->
    <?php if (!empty($success_message)) echo "<p class='success'>$success_message</p>"; ?>
    <?php if (!empty($error_message)) echo "<p class='error'>$error_message</p>"; ?>

    <!-- Users Table -->
    <h2>All Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone No</th>
                <th>Role</th>
                <th>Registration Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $users->fetch_assoc()) : ?>
                <tr>
                    <!-- Row with Editable Form -->
                    <form action="admin.php" method="POST">
                        <td>
                            <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                            <?= $row['user_id'] ?>
                        </td>
                        <td>
                            <input type="text" name="first_name" value="<?= htmlspecialchars($row['first_name']) ?>" required>
                        </td>
                        <td>
                            <input type="text" name="last_name" value="<?= htmlspecialchars($row['last_name']) ?>" required>
                        </td>
                        <td>
                            <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
                        </td>
                        <td>
                            <input type="text" name="address" value="<?= htmlspecialchars($row['address']) ?>">
                        </td>
                        <td>
                            <input type="text" name="phone_no" value="<?= htmlspecialchars($row['phone_no']) ?>">
                        </td>
                        <td>
                            <select name="role" required>
                                <option value="user" <?= $row['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
                                <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </td>
                        <td>
                            <?= $row['reg_date'] ?>
                        </td>
                        <td>
                            <button type="submit" name="save_user" class="save-button">Save</button>
                        </td>
                    </form>
                    <!-- Separate Delete Form -->
                    <form action="admin.php" method="POST">
                        <td>
                            <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                            <button type="submit" name="delete_user" class="delete-button">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Orders Table -->
    <h2>All Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Shipping Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $orders->fetch_assoc()) : ?>
                <tr>
                    <!-- Row with Editable Form -->
                    <form action="admin.php" method="POST">
                        <td>
                            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                            <?= $order['order_id'] ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?>
                        </td>
                        <td>
                            RM <?= number_format($order['total_amount'], 2) ?>
                        </td>
                        <td>
                            <?= $order['order_date'] ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($order['shipping_address']) ?>
                        </td>
                        <td>
                            <select name="status" required>
                                <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" name="update_order" class="update-button">Update</button>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>