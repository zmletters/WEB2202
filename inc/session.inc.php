<?php

session_start();

$timeout_duration = 900; // Set session timeout duration (15 minutes)

if (isset($_SESSION['last_activity'])) {
    $session_lifetime = time() - $_SESSION['last_activity'];

    if ($session_lifetime > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

$_SESSION['last_activity'] = time(); // Update last activity time
