<?php 
$annual_sal = 60000;

if ($annual_sal <= 25000) {
    $tax = 0.05;
} elseif ($annual_sal <= 50000) {
    $tax = 0.07;
} elseif ($annual_sal <= 100000) {
    $tax = 0.09;
} elseif ($annual_sal > 100000) {
    $tax = 0.15;
} else {
    echo "Sorry, invalid data perhaps?";
}

echo "Tax to pay is: ".($annual_sal*$tax);
?>