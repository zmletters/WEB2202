<?php
// The user is redirected here from login.php.

include('inc/session.inc.php'); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require('inc/login_functions.inc.php');
	redirect_user('home.php');
}

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
