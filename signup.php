<!DOCTYPE html>
<html>

<head>
    <title>Sign Up | Freshara</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/signup.css" />
</head>

<body>
    <div class="signup">
        <div class="leftcol">
            <p class="signup-title">
                Welcome to Freshara!
            </p>
            <div class="tagline">Where Sustainability Meets Zero Hunger.</div>
        </div>
        <div class="rightcol">
            <p class="signup-h1"></p>
            <form class="signup-form" method="post">
                <label class="signup-form-label">First Name</label>
                <input name="first_name" class="signup-form-input" placeholder="First Name" type="text"
                    value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
                <label class=" signup-form-label">Last Name</label>
                <input name="last_name" class="signup-form-input" placeholder="Last Name" type="text"
                    value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
                <label class="signup-form-label">Password</label>
                <input name="pass1" class="signup-form-input" placeholder="Enter your password" type="password"
                    value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
                <label class="signup-form-label">Confirm Password</label>
                <input name="pass2" class="signup-form-input" placeholder="Enter your password" type="password"
                    value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
                <label class="signup-form-label">Email</label>
                <input name="email" class="signup-form-input" placeholder="Enter your email" type="email"
                    value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">

                <input type="submit" name="submit" value="Register" />
            </form>
            <button name="submit" value="Register" class="signup-button">Sign Up</button>

            <div class="signup-below">
                <p class="signup-text1">Already have an account?</p>
                <p class="signup-signinbutton"> Sign In</p>
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