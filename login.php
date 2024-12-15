<?php
// Login processing script

$errors = [
    'email' => '',
    'password' => '',
    'general' => ''
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Need two helper files:
    require('inc/login_functions.inc.php');
    require('mysqli_connect.php');

    // Validate email
    if (empty($_POST['email'])) {
        $errors['email'] = 'You forgot to enter your email.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    // Validate password
    if (empty($_POST['pass'])) {
        $errors['password'] = 'You forgot to enter your password.';
    }

    if (array_filter($errors) === []) {
        // Check the login:
        list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

        if ($check) { // OK!
            // Set the session data:
            session_start();
            $_SESSION['user_id'] = $data["user_id"];
            $_SESSION['first_name'] = $data["first_name"];
            $_SESSION['role'] = $data["role"];

            // Redirect:
            redirect_user('home.php');
        } else { // Unsuccessful!
            $errors['general'] = 'Invalid email or password. Please try again.';
        }
    }

    mysqli_close($dbc); // Close the database connection.
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Freshara</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="sign-in">
        <!-- Left Section with Welcome Message and Background Image -->
        <div class="aside">
            <img src="img/signin.jpg" alt="Background Image" class="background-img">
            <div class="aside-content">

                <h1 class="text-wrapper"><a href="home.php">Welcome to Freshara!</a></h1>

                <p class="tagline">Where Sustainability Meets Zero Hunger.</p>
            </div>
        </div>

        <!-- Right Section with Login Form -->
        <div class="container">
            <div class="form-login-default">
                <h2 class="heading">Welcome back!</h2>

                <!-- General Error Message -->
                <?php if (!empty($errors['general'])): ?>
                    <p class="error"><?= $errors['general'] ?></p>
                <?php endif; ?>

                <form class="form" method="post">
                    <!-- Email Input -->
                    <div class="x-form-group">
                        <label for="email" class="form-title">E-mail</label>
                        <input name="email" type="email" class="input" placeholder="Type your e-mail" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                        <small class="error"><?= $errors['email'] ?></small>
                    </div>

                    <!-- Password Input -->
                    <div class="x-form-group">
                        <label for="password" class="form-title">Password</label>
                        <input name="pass" type="password" class="input" placeholder="Type your password" required>
                        <small class="error"><?= $errors['password'] ?></small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit" value="Login" class="button">Sign In</button>
                </form>

                <!-- Links for Sign-Up -->
                <div class="LABEL-wrapper">
                    <p>Don’t have an account? <a href="signup.php" class="text-wrapper-3">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>