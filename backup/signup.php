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
        <!-- Left Section with Welcome Message and Background Image -->
        <div class="aside">
            <img src="img/signin.jpg" alt="Background Image" class="background-img">
            <div class="aside-content">
                <h1 class="text-wrapper">Join Freshara!</h1>
                <p class="tagline">Be a part of the journey toward Zero Hunger.</p>
            </div>
        </div>

        <!-- Right Section with Sign-Up Form -->
        <div class="container">
            <div class="form-signup-default">
                <h2 class="heading">Create your account</h2>
                <form action="signup.php" method="post" class="form">
                    <!-- Full Name Input -->
                    <div class="x-form-group">
                        <label for="name" class="form-title">First Name</label>
                        <input type="text" id="name" name="first_name" class="input" placeholder="Type your first name" required>
                    </div>

                    <div class="x-form-group">
                        <label for="name" class="form-title">Last Name</label>
                        <input type="text" id="name" name="last_name" class="input" placeholder="Type your last name" required>
                    </div>

                    <!-- Email Input -->
                    <div class="x-form-group">
                        <label for="email" class="form-title">E-mail</label>
                        <input type="email" id="email" name="email" class="input" placeholder="Type your e-mail" required>
                    </div>

                    <!-- Password Input -->
                    <div class="x-form-group">
                        <label for="password" class="form-title">Password</label>
                        <input type="password" id="password" name="pass1" class="input" placeholder="Create a password" required>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="x-form-group">
                        <label for="confirm-password" class="form-title">Confirm Password</label>
                        <input type="password" id="confirm-password" name="pass2" class="input" placeholder="Re-enter your password" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit" value="Sign Up" class="button">Sign Up</button>
                </form>

                <!-- Link to Sign-In Page -->
                <div class="LABEL-wrapper">
                    <p>Already have an account? <a href="login.php" class="text-wrapper-3">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



<?php

$page_title = 'Sign Up';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require('mysqli_connect.php');

    $errors = array();

    if (empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $safe_fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    }

    // Check for a last name:
    if (empty($_POST['last_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $safe_ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
    }

    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email.';
    } else {
        $safe_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }

    // Check for a password and match against the confirmed password:
    if ($_POST['pass1'] != $_POST['pass2']) {
        $errors[] = 'Your password does not match.';
    } else {
        $safe_pass = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
    }

    if (empty($errors)) { // If everything's OK.
        // Register the user in the database...
        $register_sql = "INSERT INTO users (first_name, last_name, email, pass, reg_date)  VALUES ('$safe_fn', '$safe_ln', '$safe_email', SHA1('$safe_pass'), NOW())";
        // Make the query:
        //Line50			
        $r = @mysqli_query($dbc, $register_sql); // Run the query.
        if ($r) { // If it ran OK.

            // Print a message:
            echo '<h1>Thank you!</h1>
		<p>You are now registered successfully.</p><p><br /></p>';
        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
        } // End of if ($r) IF.

        mysqli_close($dbc); // Close the database connection.

        exit();
    } else { // Report the errors.

        echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    } // End of if (empty($errors)) IF.

    mysqli_close($dbc); // Close the database connection.
}

?>