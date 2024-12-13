<?php 
$IC = "121202-12-1212";
//$IC_pattern = "/^[\d]{6}-[\d]{2}-[\d]{4}$/";
$IC_pattern = "/^[\d]{2}(0[1-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])-[\d]{2}-[\d]{4}$/";


if (preg_match($IC_pattern, $IC)) {
    echo "Valid IC number!";
} else {
    echo "Invalid IC number!";
}

?>