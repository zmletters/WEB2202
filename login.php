<!DOCTYPE html>
<html>

<head>
    <title>Login | Freshara</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/loginglobals.css" />
    <link rel="stylesheet" href="css/loginstyleguide.css" />
    <link rel="stylesheet" href="css/loginstyle.css" />
</head>

<body>
    <div class="sign-in">
        <div class="aside">
            <div class="text-wrapper">Welcome to Freshara!</div>
            <p class="tagline">Where Sustainability Meets Zero Hunger.</p>
        </div>
        <div class="container">
            <div class="main">
                <div class="form-login-default">
                    <div class="heading">Welcome back!</div>
                    <form class="form" method='post'>
                        <div class="x-form-group">
                            <div class="input-large">
                                <div class="form-title-default">
                                    <label class="form-title" for="input-2">Email</label>
                                </div>
                                <div class="input">
                                    <div class="control-wrapper">
                                        <div class="control">
                                            <input name="email" class="text" placeholder="Type your email" type="text"
                                                id="input-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x-form-group">
                            <div class="input-large">
                                <div class="form-title-default">
                                    <div class="form-title">Password</div>
                                </div>
                                <div class="input">
                                    <div class="control-wrapper">
                                        <div class="control">
                                            <input name="pass" class="text" placeholder="Type your password" type="text"
                                                id="input-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-help-text">
                                    <div class="form-help-text-2">Forgot
                                        Password?</div>
                                </div>
                            </div>
                        </div>
                        <button name='submit' value='Login' class="button">
                            <div class="label">Sign
                                In</div>
                        </button>
                </div>

            </div>
            <div class="LABEL-wrapper">
                <p class="LABEL">
                    <span class="span">Don’t have an account?</span>
                </p>
            </div>
            <div class="LABEL-wrapper"><span class="text-wrapper-3">Sign
                    Up</span></div>
            <div class="LABEL-wrapper">
                <div class="LABEL-2">Admin
                    Login</div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>


<?php
// This page processes the login form submission.
// The script uses sessions.

// Check if the form has been submitted:
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

        // Redirect:
        redirect_user('loggedin.php');
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