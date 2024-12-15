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
                <h1 class="text-wrapper">Welcome to Freshara!</h1>
                <p class="tagline">Where Sustainability Meets Zero Hunger.</p>
            </div>
        </div>

        <!-- Right Section with Login Form -->
        <div class="container">
            <div class="form-login-default">
                <h2 class="heading">Welcome back!</h2>
                <form class="form" method='post'>
                    <!-- Email Input -->
                    <div class="x-form-group">
                        <label for="email" class="form-title">E-mail</label>
                        <input name="email" type="email" class="input" placeholder="Type your e-mail" required>
                    </div>

                    <!-- Password Input -->
                    <div class="x-form-group">
                        <label for="password" class="form-title">Password</label>
                        <input name="pass" type="password" class="input" placeholder="Type your password" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit" value="Login" class="button">Sign In</button>
                </form>

                <!-- Links for Sign-Up and Admin Login -->
                <div class="LABEL-wrapper">
                    <p>Don’t have an account? <a href="signup.php" class="text-wrapper-3">Sign Up</a></p>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

<?php
// Login processing script

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Need two helper files:
    require('inc/login_functions.inc.php');
    require('mysqli_connect.php');

    // Need the database connection:
    // $dbc = @mysqli_connect("localhost", "root", "", "db_user") or die('Could not connect to MySQL: ' . mysqli_connect_error());

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

        // Assign $data to $errors for login_page.inc.php:
        $errors = $data;
    }

    mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.


if (isset($errors) && !empty($errors)) {
    echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
    foreach ($errors as $msg) {
        echo " - $msg<br />\n";
    }
    echo '</p><p>Please try again.</p>';
}

?>