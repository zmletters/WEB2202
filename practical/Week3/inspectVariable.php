<?php 
    // define variables
    $name = 'Fiona';
    $age = 120;
    $validUser = true;
    $money = 98.60;
    $addition = null;
    
    // display variable contents
    var_dump($name);
    echo '<br>';
    var_dump($age);
    echo '<br>';
    var_dump($validUser);
    echo '<br>';
    var_dump($money);
    echo '<br>';
    var_dump($addition);
    echo '<br>';
    print_r($name);
    echo '<br>';
    // get variable types only
    echo gettype($money);
?>