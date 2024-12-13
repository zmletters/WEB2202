<?php

function doDB() {
    global $mysqli;
    
    // connect to server and select db;
    $mysqli = mysqli_connect("localhost","root","","db1");
    
    if (mysqli_connect_errno()) {
        echo "Connect failed: ". mysqli_connect_error();
        exit();
    }
}

?>