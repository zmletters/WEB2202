<?php
include('inc/session.inc.php');					 // Access the existing session.
require('inc/functions.inc.php');

// If no session variable exists, redirect the user:
if (!isset($_SESSION['user_id'])) {

	redirect_user('login.php');
} else { // Cancel the session:

	$_SESSION = array();
	session_destroy();
	redirect_user('home.php');
}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';


// Print a customized message:
echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";
