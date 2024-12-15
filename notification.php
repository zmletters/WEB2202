<?php
include('inc/session.inc.php');
require('mysqli_connect.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Fetch notifications for the user
$query = "SELECT id, message, created_at, is_read FROM notification WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $dbc->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}
$stmt->close();

// Mark notifications as read if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_read'])) {
    $notification_id = intval($_POST['notification_id']);

    $update_query = "UPDATE notification SET is_read = 1 WHERE id = ? AND user_id = ?";
    $update_stmt = $dbc->prepare($update_query);
    $update_stmt->bind_param('ii', $notification_id, $user_id);

    if ($update_stmt->execute()) {
        header('Location: notification.php'); // Refresh the page to show updated status
        exit();
    } else {
        echo "<p>Error updating notification status.</p>";
    }
    $update_stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="css/notification.css">
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>

    <main class="notifications-page">
        <h1>Your Notifications</h1>

        <?php if (empty($notifications)) : ?>
            <p>You have no notifications.</p>
        <?php else : ?>
            <ul class="notifications-list">
                <?php foreach ($notifications as $notification) : ?>
                    <li class="notification <?= $notification['is_read'] ? 'read' : 'unread'; ?>">
                        <div class="message">
                            <p><?= htmlspecialchars($notification['message']); ?></p>
                            <span class="date"><?= date('F j, Y, g:i a', strtotime($notification['created_at'])); ?></span>
                        </div>
                        <?php if (!$notification['is_read']) : ?>
                            <form method="POST" class="mark-read-form">
                                <input type="hidden" name="notification_id" value="<?= $notification['id']; ?>">
                                <button type="submit" name="mark_read" class="mark-read-button">Mark as Read</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>

    <?php include('inc/footer.inc.php'); ?>
</body>

</html>