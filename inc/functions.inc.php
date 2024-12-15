<?php
function redirect_user($page)
{

    // Start defining the URL...
    // URL is http:// plus the host name plus the current directory:
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    // Remove any trailing slashes:
    $url = rtrim($url, '/\\');

    // Add the page:
    $url .= '/' . $page;

    // Redirect the user:
    header("Location: $url");
    exit(); // Quit the script.

} // End of redirect_user() function.


function check_user_logged_in()
{
    if (!isset($_SESSION['user_id'])) {
        redirect_user('login.php');
        exit();
    }
}
