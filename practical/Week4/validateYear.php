<?php 
//Year format = yyyy-mm-dd
$year = "1900-02-28";
//$year_pattern = "/^[1-2][09]\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";

// february checking. only making sure february has less than 29 days. does not include checking leap year.
$year_pattern = "/^[1-2][09]\d{2}-((0[1,3-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))$/";

if (preg_match($year_pattern, $year)) {
    echo "Valid date!";
} else {
    echo "Invalid date!";
}
?>