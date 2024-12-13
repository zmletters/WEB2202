<?php 
$mobile = "014-5941294";
//$mobile_pattern = "/^01[]-[\d]{7}$/";
$mobile_pattern = "/^01[0-46-9]-[\d]{7}$/";


if (preg_match($mobile_pattern, $mobile)) {
    echo "Valid mobile number!";
} else {
    echo "Invalid mobile number!";
}

?>