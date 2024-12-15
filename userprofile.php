<?php
include('inc/session.inc.php');
require('mysqli_connect.php');

// Check if user is logged in and has a valid session
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID from the session

// Fetch user data from the database
$query = "SELECT user_id, first_name, last_name, email, address, phone_no FROM users WHERE user_id = ?";
$stmt = $dbc->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/userprofile.css">
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>
    <div class="profile-page">


        <div class="profile-container">
            <aside class="profile-sidebar">
                <ul>
                    <li><a href="#personal-info" class="active">Personal info</a></li>
                    <li><a href="#login-security">Login and security</a></li>
                    <!-- <li><a href="#">My payments</a></li>
                    <li><a href="#">My orders</a></li> -->
                </ul>
            </aside>

            <section class="profile-content">
                <h1 id="personal-info">Personal info</h1>

                <form method='post' class="profile-form">
                    <fieldset>
                        <legend>Account info</legend>

                        <div class="form-group">
                            <label for="account-id">Account ID</label>
                            <input type="text" id="account-id" name="account_id" value="<?php echo $user_data['user_id']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first_name" value="<?php echo htmlspecialchars($user_data['first_name']); ?>" placeholder="First Name">
                        </div>

                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last_name" value="<?php echo htmlspecialchars($user_data['last_name']); ?>" placeholder="Last Name">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data['phone_no']); ?>" placeholder="Phone number">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="address">Your Address</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user_data['address']); ?>" placeholder="Address">
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button type="submit" class="btn-update" name="update_profile">Update profile</button>
                    </div>
                </form>

                <h1 id="login-security">Login and Security</h1>
                <form method="post" class="security-form">
                    <fieldset>
                        <legend>Change Password</legend>

                        <div class="form-group">
                            <label for="current-password">Current Password</label>
                            <input type="password" id="current-password" name="current_password" placeholder="Enter current password" required>
                        </div>

                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" id="new-password" name="new_password" placeholder="Enter new password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm new password" required>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button type="submit" name="update_password" class="btn-update">Update Password</button>
                    </div>
            </section>
        </div>


    </div>
</body>
<?php include('inc/footer.inc.php'); ?>

</html>


<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    // Collect form data
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Validate form data
    $errors = [];

    if (empty($first_name)) {
        $errors[] = "First name is required.";
    }

    if (empty($last_name)) {
        $errors[] = "Last name is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }

    // if (empty($phone) || !preg_match('/^\+?\d{8,15}$/', $phone)) {
    //     $errors[] = "A valid phone number is required (e.g., +60123456789).";
    // }

    if (empty($errors)) {
        // Update the user's data in the database
        $query = "UPDATE users 
                  SET first_name = ?, last_name = ?, email = ?, phone_no = ?, address = ? 
                  WHERE user_id = ?";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param('sssssi', $first_name, $last_name, $email, $phone, $address, $user_id);

        if ($stmt->execute()) {
            // Successfully updated
            header('Refresh:1; URL=user_profile.php?update_success=1');
            exit();
        } else {
            // Database update failed
            $errors[] = "Failed to update your profile. Please try again.";
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_password'])) {
    $errors = [];
    $user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session

    // Validate the current password
    if (empty($_POST['current_password'])) {
        $errors[] = 'You forgot to enter your current password.';
    } else {
        $current_password = mysqli_real_escape_string($dbc, trim($_POST['current_password']));
    }

    // Validate the new password and confirmation
    if (empty($_POST['new_password'])) {
        $errors[] = 'You forgot to enter your new password.';
    } else {
        $new_password = mysqli_real_escape_string($dbc, trim($_POST['new_password']));
    }

    if (empty($_POST['confirm_password'])) {
        $errors[] = 'You forgot to confirm your new password.';
    } elseif ($_POST['new_password'] !== $_POST['confirm_password']) {
        $errors[] = 'Your new password and confirmation do not match.';
    }

    if (empty($errors)) {
        // Fetch the current hashed password from the database
        $query = "SELECT pass FROM users WHERE user_id = ?";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verify the current password
            if (sha1($current_password) == $row['pass']) {
                // Update the new password in the database
                $update_query = "UPDATE users SET pass = SHA1(?) WHERE user_id = ?";
                $update_stmt = $dbc->prepare($update_query);
                $update_stmt->bind_param('si', $new_password, $user_id);

                if ($update_stmt->execute()) {
                    echo '<p class="success">Your password has been changed successfully!</p>';
                } else {
                    $errors[] = 'Your password could not be changed due to a system error.';
                }
            } else {
                $errors[] = 'Your current password is incorrect.';
            }
        } else {
            $errors[] = 'User not found.';
        }
    }

    // Display errors if any
    if (!empty($errors)) {
        echo '<p class="error">The following error(s) occurred:<br>';
        foreach ($errors as $msg) {
            echo " - $msg<br>";
        }
        echo '</p>';
    }

    mysqli_close($dbc); // Close the database connection
}



?>