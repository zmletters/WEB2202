<?php
$page_title = 'Sign Up';

$errors = [
    'first_name' => '',
    'last_name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => ''
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require('mysqli_connect.php');

    $safe_fn = $safe_ln = $safe_email = $safe_pass = '';

    // Validate first name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'You forgot to enter your first name.';
    } else {
        $safe_fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    }

    // Validate last name
    if (empty($_POST['last_name'])) {
        $errors['last_name'] = 'You forgot to enter your last name.';
    } else {
        $safe_ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
    }

    // Validate email
    if (empty($_POST['email'])) {
        $errors['email'] = 'You forgot to enter your email.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    } else {
        $safe_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }

    // Validate password
    if (empty($_POST['pass1'])) {
        $errors['password'] = 'You forgot to enter your password.';
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%!*\-])[A-Za-z\d@#$%!*\-]{8,}$/', $_POST['pass1'])) {
        $errors['password'] = 'Password must be at least 8 characters long and include symbols, letters and numbers.';
    } else {
        $safe_pass = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
    }

    // Validate confirm password
    if (empty($_POST['pass2'])) {
        $errors['confirm_password'] = 'You forgot to confirm your password.';
    } elseif ($_POST['pass1'] != $_POST['pass2']) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }

    if (array_filter($errors) === []) { // If no errors
        // Register the user in the database
        $register_sql = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES (?, ?, ?, SHA1(?), NOW())";
        $stmt = $dbc->prepare($register_sql);
        $stmt->bind_param('ssss', $safe_fn, $safe_ln, $safe_email, $safe_pass);

        if ($stmt->execute()) {
            // Redirect or success message
            header('Location: signup_success.php');
            exit();
        } else {
            // Debugging message
            echo '<h1>System Error</h1><p class="error">Could not register due to a system error.</p>';
        }

        $stmt->close();
    }
    $dbc->close(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Freshara</title>
    <link rel="stylesheet" href="css/signup.css">
</head>

<body>
    <div class="sign-up">
        <div class="aside">
            <img src="img/signin.jpg" alt="Background Image" class="background-img">
            <div class="aside-content">
                <h1 class="text-wrapper"><a href="home.php">Join Freshara!</a></h1>
                <p class="tagline">Be a part of the journey toward Zero Hunger.</p>
            </div>
        </div>

        <div class="container">
            <div class="form-signup-default">
                <h2 class="heading">Create your account</h2>
                <form action="signup.php" method="post" class="form">
                    <!-- First Name -->
                    <div class="x-form-group">
                        <label for="first_name" class="form-title">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="input" placeholder="Type your first name" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" required>
                        <small class="error"><?= $errors['first_name'] ?></small>
                    </div>

                    <!-- Last Name -->
                    <div class="x-form-group">
                        <label for="last_name" class="form-title">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="input" placeholder="Type your last name" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" required>
                        <small class="error"><?= $errors['last_name'] ?></small>
                    </div>

                    <!-- Email -->
                    <div class="x-form-group">
                        <label for="email" class="form-title">E-mail</label>
                        <input type="email" id="email" name="email" class="input" placeholder="Type your e-mail" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                        <small class="error"><?= $errors['email'] ?></small>
                    </div>

                    <!-- Password -->
                    <div class="x-form-group">
                        <label for="password" class="form-title">Password</label>
                        <input type="password" id="password" name="pass1" class="input" placeholder="Create a password" required>
                        <small class="error"><?= $errors['password'] ?></small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="x-form-group">
                        <label for="confirm_password" class="form-title">Confirm Password</label>
                        <input type="password" id="confirm_password" name="pass2" class="input" placeholder="Re-enter your password" required>
                        <small class="error"><?= $errors['confirm_password'] ?></small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="button">Sign Up</button>
                </form>

                <div class="LABEL-wrapper">
                    <p>Already have an account? <a href="login.php" class="text-wrapper-3">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>