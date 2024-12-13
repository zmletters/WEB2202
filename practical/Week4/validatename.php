<?php 
$username = "Tommy1&";
$username_pattern = "/^[a-zA-Z0-9]{5,10}$/";
$username_pattern = "/^[a-zA-Z\d]{5,10}$/";
$username_pattern = "/^[a-zA-Z\d\W]{5,10}$/";

//$username_pattern = "/^[a-zA-Z0-9._%+-]+$/";
//$emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if (preg_match($username_pattern, $username)) {
    echo "Valid username!";
} else {
    echo "Invalid username!";
}

?>