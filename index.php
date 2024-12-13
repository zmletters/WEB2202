# https://phptherightway.com/




<?php
session_start();
if (!isset($_SESSION['user_id'])) {

    // Need the functions:
    require('inc/login_functions.inc.php');
    redirect_user('login.php');
}



echo "You are now logged in, {$_SESSION['first_name']}!"
?>