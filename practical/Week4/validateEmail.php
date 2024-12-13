<?php
$email = "abc@yahoo.com";
$email_pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if (preg_match($email_pattern, $email)) {
    echo "Valid email!";
} else {
    echo "Invalid email!";
}

?>