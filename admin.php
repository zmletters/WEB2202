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
    $address = trim($_POST['address']);
    $phone_no = trim($_POST['phone_no']);
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

// Fetch all users
$users = $dbc->query("SELECT * FROM users");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <h1>Admin - Manage Users</h1>

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
                        <!-- Non-editable User ID -->
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
                            <input type="text" name="address" value="<?= htmlspecialchars($row['address']) ?>" required>
                        </td>
                        <td>
                            <input type="text" name="phone_no" value="<?= htmlspecialchars($row['phone_no']) ?>" required>
                        </td>
                        <td>
                            <select name="role" required>
                                <option value="user" <?= $row['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </td>
                        <!-- Non-editable Registration Date -->
                        <td>
                            <?= $row['reg_date'] ?>
                        </td>
                        <td>
                            <button type="submit" name="save_user" class="save-button">Save</button>
                            <button type="submit" name="delete_user" class="delete-button">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>