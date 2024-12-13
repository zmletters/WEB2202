<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Sign Up</title>
    <!-- <link rel="stylesheet" href="css/signupglobal.css"> -->
    <link rel="stylesheet" href="css/signupstyle.css">
</head>

<body>
    <div class="sign-up">
        <div class="overlap-wrapper">
            <div class="overlap-group">
                <!-- Aside Section -->
                <aside class="aside">
                    <div class="aside-content">
                        <img src="img/cacaed07-84eb-43c1-a998-efd9054e9c70-1.png" alt="Welcome to Freshara" class="aside-image">
                        <h2 class="aside-title">Welcome to Freshara!</h2>
                        <p class="aside-description">Where Sustainability Meets Zero Hunger.</p>
                    </div>
                </aside>
                <!-- Main Container -->
                <div class="container">
                    <div class="main">
                        <div class="form-register">
                            <div class="heading">
                                <h1 class="title">Registration</h1>
                            </div>
                            <form class="form" method="post">
                                <div class="form-group">
                                    <label for="input-name" class="form-title">First Name</label>
                                    <input name="first_name" id="input-name" type="text" class="text-input" placeholder="Enter your name"
                                        value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="input-name" class="form-title">Last Name</label>
                                    <input name="last_name" id="input-name" type="text" class="text-input" placeholder="Enter your name"
                                        value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
                                </div>


                                <div class="form-group">
                                    <label for="input-email" class="form-title">E-mail or Phone Number</label>
                                    <input name="email" id="input-email" type="text" class="text-input" placeholder="Type your e-mail"
                                        value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="input-password" class="form-title">Password</label>
                                    <input name="pass1" id="input-password" type="password" class="text-input" placeholder="Enter password"
                                        value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
                                    <small class="form-help-text">Must be at least 8 characters</small>
                                </div>

                                <div class="form-group">
                                    <label for="input-cormpassword" class="form-title">Confirm Password</label>
                                    <input name="pass2" id="input-cormpassword" type="password" class="text-input" placeholder="Enter password"
                                        value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
                                    <small class="form-help-text">Must be at least 8 characters</small>
                                </div>
                                <input type="submit" name="submit" value="Register" />
                                <button type="submit" class="button">Sign Up</button>
                            </form>

                            <div class="signin-link">
                                <p>Already have an account? <a href="#">Sign In</a></p>
                            </div>
                        </div>
                    </div>
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