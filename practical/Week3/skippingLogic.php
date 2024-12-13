<?php 
$count = 0;
// loop 5 times
while ($count <=4) {
    $count ++;
    // when the counter hit 3
    // break out of the loop
    if ($count == 3) {
        continue;
    }
    echo "The iteration is #$count <br>";
}
?>